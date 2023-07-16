<?php

namespace App\Http\Controllers\admin\provider; //RUTA DE LA CARPETA DEL CONTROLADOR CREADO

use App\Http\Controllers\Controller; //EXTENSION DEL CONTROLLADOR GENERAL
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProviderController extends Controller
{

    //protegiendo rutas
    public function __construct()
    {
        $this->middleware('auth');
    }

    //FORMULARIO Y TABLA DE PROVEDORES
    public function index()
    {
        return view('admin.proveedor.index');
    }


    //METODO PARA GUARDAR LOS DATOS DEL FORMULARIO
    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|unique:providers',
            'descripcion' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            Provider::insert([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion
            ]);

            return response()->json([
                'code' => 1,
                'msg' => 'Proovedor Agredado Correctamente'
            ]);
        }
    }


    //TABLA DE DATOS PROVIDERS
    public function fetchProviders()
    {
        $providers = Provider::all();

        $data = view('admin.proveedor.all-providers', [
            'providers' => $providers
        ])->render();

        return response()->json([
            'code' => 1,
            'result' => $data
        ]);
    }


    public function show($id)
    {
        $provider = Provider::find($id);
        return response()->json([
            'code' => 1,
            'result' => $provider
        ]);
    }

    public function update(Request $request)
    {
        $provider_id = $request->id_provider;
        $provider = Provider::find($provider_id);

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'descripcion' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $provider->update([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion
            ]);

            return response()->json([
                'code' => 1,
                'msg' => 'Actualizado correctamente'
            ]);
        }
    }

    public function delete(Request $request)
    {
        $provider = Provider::find($request->provider_id);
        $query = $provider->delete();

        if ($query) {
            return response()->json([
                'code' => 1,
                'msg' => 'Proveedor Eliminado'
            ]);
        } else {
            return response()->json([
                'code' => 0,
                'msg' => 'Hubo un error'
            ]);
        }
    }
}
