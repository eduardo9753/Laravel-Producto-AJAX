<?php

namespace App\Http\Controllers\admin\supply; //RUTA DE LA CARPETA DEL CONTROLADOR CREADO

use App\Http\Controllers\Controller; //EXTENSION DEL CONTROLLADOR GENERAL
use App\Models\Category;
use App\Models\Provider;
use App\Models\Supply;
use App\Models\SupplyProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class SupplyController extends Controller
{
    //
    public function index()
    {
        $categories = Category::all();
        $providers  = Provider::all();
        $supplies = Supply::all();
        return view('admin.suministro.index', [
            'categories' => $categories,
            'providers' =>  $providers,
            'supplies' => $supplies
        ]);
    }

    //GUARDAR DATOS
    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|unique:categories',
            'precio' => 'required',
            'stock' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code'  => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $save = Supply::create([ //con create podemos acceder al ultimo id
                'nombre' => $request->nombre,
                'precio' => $request->precio,
                'stock' => $request->stock,
                'user_id' => Auth::user()->id,
                'category_id' => $request->category_id
            ]);

            if ($save) {
                $ultimo_id_supply = $save->id;

                SupplyProvider::create([
                    'provider_id' => $request->provider_id,
                    'supply_id' => $ultimo_id_supply
                ]);

                return response()->json([
                    'code' => 1,
                    'msg' => 'Suministro agregada correctamente'
                ]);
            }
        }
    }


    //FECT JUICE
    public function fetchSupplies()
    {
        $supplies = Supply::all();

        $data = view('admin.suministro.all-supplies', [
            'supplies' => $supplies
        ])->render();

        return response()->json([
            'code' => 1,
            'result' => $data
            //<div class="card-body" id="AllSupplies"></div>
        ]);
    }

    //MOSTRAR DATOS POR ID
    public function show($id)
    {
        $supplies = Supply::find($id);
        return response()->json([
            'code' => 1,
            'result' => $supplies
        ]);
    }

    //ACTUALIZAR
    public function update(Request $request)
    {
        $supply_id = $request->supply_id;
        $supply = Supply::find($supply_id);

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'precio' => 'required',
            'stock' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $supply->update([
                'nombre' => $request->nombre,
                'precio' => $request->precio,
                'stock' => $request->stock,
                'user_id' => Auth::user()->id,
                'category_id' => $request->category_id
            ]);

            return response()->json([
                'code' => 1,
                'msg' => 'Suministro Actualizado'
            ]);
        }
    }
}
