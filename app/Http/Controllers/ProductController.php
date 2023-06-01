<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image; //AJUTE DE LAS FOTOS
use Illuminate\Support\Str;

class ProductController extends Controller
{
    //protegiendo rutas 
    public function __construct()
    {
        $this->middleware('auth');
    }

    //FORMULARIO DE PRODUCTOS
    public function index()
    {
        $providers = Provider::all();
        $categories = Category::all();
        return view('producto.index', [
            'providers' => $providers,
            'categories' => $categories
        ]);
    }

    //GUARDAR LOS DATOS DEL FORMULARIO
    public function save(Request $request)
    {
        //validamos los datos
        $validator = Validator::make($request->all(), [
            'product_name'  => 'required|string|unique:products',
            'product_image' => 'required|image',
            'stock' => 'required',
            'precio' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code'  => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            //despues de validar subrimos los archicos al servidor y a la BD
            $imagen = $request->file('product_image');
            $nombreImagen = Str::uuid() . "." . $imagen->extension(); //DANDOLE UN ID UNICO A LA IMAGEN

            $imagenServidor = Image::make($imagen); //CREANDO LA IMAGEN CON Intervation
            $imagenServidor->fit(400, 400);       //DANDOLE TAMAÑO UNICO

            $imagenPath = public_path('storage/files') . "/" . $nombreImagen; //DIRECCIONANDO A LA RUTA
            $upload = $imagenServidor->save($imagenPath);      //GUARDANDO IMAGEN

            if ($upload) {
                Product::insert([
                    'product_name'  => $request->product_name,
                    'product_image' => $nombreImagen,
                    'provider_id' => $request->provider_id,
                    'category_id' => $request->category_id,
                    'stock' => $request->stock,
                    'precio' => $request->precio,
                    'user_id' => auth()->user()->id
                ]);

                return response()->json([
                    'code' => 1,
                    'msg' => 'New product has been seved successfully'
                ]);
            }
        }
    }

    //FECT PRODUCT
    public function fetchProducts()
    {
        //traendo los datos de la base de datos
        $products = Product::all();

        //te retorna la platilla con los datos de la base de datos
        $data = view('producto.all-products', [
            'products' => $products
        ])->render();

        //retornamos los datos en formato json
        return response()->json([
            'code' => 1,
            'result' => $data //devolviendo todo el html con los datos para que lo pinte en 
            //<div class="card-body" id="AllProducts"></div>
        ]);
    }

    //TRAENDO DATOS DEL PRODUCTO POR ID
    public function show($id)
    {
        $product = Product::find($id);
        return response()->json([
            'code' => 1,
            'result' => $product //revolviendo al ajax los datos para que lo pinte en el modal
        ]);
        //Request $request : $request->id ->para el segundo metodo
        //Route::get('/product/show', [ProductController::class, 'show'])->name('product.show');
    }

    //ACTUALIZANDO LOS PRODUCTOS
    public function update(Request $request)
    {
        //busacmos el producto por el id mandado
        $product_id = $request->pid; //valor del id producto de la cada del modal
        $product = Product::find($product_id);

        //validamos los datos
        $validator = Validator::make($request->all(), [
            'product_name'  => 'required|string|unique:products', //
            'product_image_update' => 'image', //campo de la nueva foto que se va subir
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code'  => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {

            //vemos si tiene foto
            if ($request->hasFile('product_image_update')) {
                $imagen = $request->file('product_image_update');
                $nombreImagen = Str::uuid() . "." . $imagen->extension(); //DANDOLE UN ID UNICO A LA IMAGEN

                $imagenServidor = Image::make($imagen); //CREANDO LA IMAGEN CON Intervation
                $imagenServidor->fit(400, 400);       //DANDOLE TAMAÑO UNICO

                $imagenPath = public_path('storage/files') . "/" . $nombreImagen; //DIRECCIONANDO A LA RUTA
                $upload = $imagenServidor->save($imagenPath);      //GUARDANDO IMAGEN

                if ($upload) {
                    //eliminamos la imagen antigua si es que existe
                    if ($product->product_image) {
                        $path_delete = public_path('storage/files/' . $product->product_image);
                        if (File::exists($path_delete)) {
                            unlink($path_delete);
                        }
                    }
                }
            } else {
                $nombreImagen = $product->product_image;
            }

            //actualizamos los datos
            $product->update([
                'product_name' => $request->product_name,
                'product_image' => $nombreImagen
            ]);

            return response()->json(['code' => 1, 'msg' => 'Produt has been updated successfully']);
        }
    }

    //ELIMINANDO LOS PRODUCTOS
    public function delete(Request $request)
    {
        $product = Product::find($request->product_id);
        if ($product->product_image) {
            $path_delete = public_path('storage/files/' . $product->product_image);
            if (File::exists($path_delete)) {
                unlink($path_delete);
            }
        }

        $query = $product->delete();
        if ($query) {
            return response()->json([
                'code' => 1,
                'msg' => 'Product has been deleted'
            ]);
        } else {
            return response()->json([
                'code' => 0,
                'msg' => 'Something went wrong'
            ]);
        }
    }
}
