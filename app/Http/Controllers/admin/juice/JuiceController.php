<?php

namespace App\Http\Controllers\admin\juice; //RUTA DE LA CARPETA DEL CONTROLADOR CREADO

use App\Http\Controllers\Controller; //EXTENSION DEL CONTROLLADOR GENERAL
use App\Models\Juice;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image; //AJUTE DE LAS FOTOS
use Illuminate\Support\Facades\File;


class JuiceController extends Controller
{
    //protegiendo rutas 
    public function __construct()
    {
        $this->middleware('auth');
    }

    //FORMULARIO DE PRODUCTOS
    public function index()
    {
        $types = Type::all();
        $juices = Juice::all();
        return view('admin.jugo.index', [
            'types' => $types,
            'juices' => $juices
        ]);
    }

    //GUARDAR LOS DATOS DEL FORMULARIO
    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre'  => 'required|string|unique:juices',
            'imagen' => 'required|image',
            'precio' => 'required',
            'descripcion' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code'  => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            //despues de validar subrimos los archicos al servidor y a la BD
            $imagen = $request->file('imagen');
            $nombreImagen = Str::uuid() . "." . $imagen->extension(); //DANDOLE UN ID UNICO A LA IMAGEN

            $imagenServidor = Image::make($imagen); //CREANDO LA IMAGEN CON Intervation
            $imagenServidor->fit(400, 400);       //DANDOLE TAMAÑO UNICO

            $imagenPath = public_path('productos') . "/" . $nombreImagen; //DIRECCIONANDO A LA RUTA
            $upload = $imagenServidor->save($imagenPath);      //GUARDANDO IMAGEN

            if ($upload) {
                Juice::insert([
                    'nombre'  => $request->nombre,
                    'imagen' => $nombreImagen,
                    'precio' => $request->precio,
                    'descripcion' => $request->descripcion,
                    'user_id' => Auth::user()->id, //auth()->user()->id
                    'type_id' => $request->type_id
                ]);

                return response()->json([
                    'code' => 1,
                    'msg' => 'Jugo agregado correctamente'
                ]);
            }
        }
    }

    //FECT JUICE
    public function fetchJuices()
    {
        $juices = Juice::all();

        $data = view('admin.jugo.all-juices', [
            'juices' => $juices
        ])->render();

        return response()->json([
            'code' => 1,
            'result' => $data
            //<div class="card-body" id="AllJuices"></div>
        ]);
    }

    //TRAENDO DATOS DEL JUGO POR ID
    public function show($id)
    {
        //$juices = Juice::find($id);
        $juices = Juice::join('types', 'types.id', '=', 'juices.type_id')
            ->select(
                'juices.nombre',
                'juices.imagen',
                'juices.precio',
                'juices.descripcion',
                'juices.user_id',
                'juices.type_id',
                'juices.id',
                'types.nombre as nombre_tipo'
            )
            ->where('juices.id', '=', $id)
            ->first(); //CUANDO SON TABLAS UNIDAS PODER ESTE COMANDO 
        //PARA QUE AJAX RECONOZCA LOS DATOS A LEER

        return response()->json([
            'code' => 1,
            'result' => $juices
        ]);
        //Request $request : $request->id ->para el segundo metodo
        //Route::get('/product/show', [ProductController::class, 'show'])->name('product.show');
    }

    //ACTUALIZANDO LOS PRODUCTOS
    public function update(Request $request)
    {
        //busacmos el producto por el id mandado
        $id_juice = $request->id_juice; //valor del id producto de la cada del modal
        $juice = Juice::find($id_juice);

        //validamos los datos
        $validator = Validator::make($request->all(), [
            'nombre'  => 'required|string',
            'precio' => 'required',
            'descripcion' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code'  => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {

            //vemos si tiene foto
            if ($request->hasFile('imagen_update_juice')) {
                $imagen = $request->file('imagen_update_juice');
                $nombreImagen = Str::uuid() . "." . $imagen->extension(); //DANDOLE UN ID UNICO A LA IMAGEN

                $imagenServidor = Image::make($imagen); //CREANDO LA IMAGEN CON Intervation
                $imagenServidor->fit(1000, 1000);       //DANDOLE TAMAÑO UNICO

                $imagenPath = public_path('productos') . "/" . $nombreImagen; //DIRECCIONANDO A LA RUTA
                $upload = $imagenServidor->save($imagenPath);      //GUARDANDO IMAGEN

                if ($upload) {
                    //eliminamos la imagen antigua si es que existe
                    if ($juice->imagen) {
                        $path_delete = public_path('productos/' . $juice->imagen);
                        if (File::exists($path_delete)) {
                            unlink($path_delete);
                        }
                    }
                }
            } else {
                $nombreImagen = $juice->imagen;
            }

            //actualizamos los datos
            $juice->update([
                'nombre'  => $request->nombre,
                'imagen' => $nombreImagen,
                'precio' => $request->precio,
                'descripcion' => $request->descripcion,
                'user_id' => Auth::user()->id, //auth()->user()->id
                'type_id' => $request->type_id
            ]);

            return response()->json(['code' => 1, 'msg' => 'Producto Actualizado correctamente']);
        }
    }

    //ELIMINANDO LOS PRODUCTOS
    public function delete(Request $request)
    {
        $juice = Juice::find($request->juice_id);
        if ($juice->imagen) {
            $path_delete = public_path('productos/' . $juice->imagen);
            if (File::exists($path_delete)) {
                unlink($path_delete);
            }
        }

        $query = $juice->delete();
        if ($query) {
            return response()->json([
                'code' => 1,
                'msg' => 'Producto Eliminado'
            ]);
        } else {
            return response()->json([
                'code' => 0,
                'msg' => 'Hubo un error'
            ]);
        }
    }
}
