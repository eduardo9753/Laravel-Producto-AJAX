<?php

namespace App\Http\Controllers\admin\category; //RUTA DE LA CARPETA DEL CONTROLADOR CREADO

use App\Http\Controllers\Controller; //EXTENSION DEL CONTROLLADOR GENERAL
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //protegiendo rutas
    public function __construct()
    {
        $this->middleware('auth');
    }

    //VISTA DE LA CATEGORIA
    public function index()
    {
        $categories = Category::all();
        return view('admin.categoria.index',[
            'categories' => $categories
        ]);
    }

    //GUARDAR DAROS CATEGORIA VIA AJAX
    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|unique:categories'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code'  => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $save = Category::insert(['nombre' => $request->nombre]);

            if ($save) {
                return response()->json([
                    'code' => 1,
                    'msg' => 'Categoria agregada correctamente'
                ]);
            }
        }
    }

    //TRAENDO LOS DATOS A LA TABLA
    public function fecthCategories()
    {
        $categories = Category::all();

        $data = view('admin.categoria.all-categories', [
            'categories' => $categories
        ])->render();

        return response()->json([
            'code' => 1,
            'result' => $data
        ]);
    }

    //MOSTRAR DATOS DE LA CATEGORIA EN EL MODAL
    public function show($id)
    {
        $category = Category::find($id);

        return response()->json([
            'code' => 1,
            'result' => $category
        ]);
    }

    //ACTUALIZAR LOS DATOS
    public function update(Request $request)
    {
        $category_id = $request->id_category;
        $category = Category::find($category_id);

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|unique:categories'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $category->update([
                'nombre' => $request->nombre
            ]);
            return response()->json([
                'code' => 1,
                'msg' => 'Categoria Actualizada'
            ]);
        }
    }
}
