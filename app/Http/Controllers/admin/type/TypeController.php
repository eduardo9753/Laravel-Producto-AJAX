<?php

namespace App\Http\Controllers\admin\type;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypeController extends Controller
{
    //vista tipo
    public function index()
    {
        $types = Type::all();
        return view('admin.tipo.index', [
            'types' => $types
        ]);
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|string'
        ]);

        //insert
        Type::create(['nombre' => $request->nombre]);

        //redirect
        return redirect()->route('tipo.index');
    }


    //MOSTRAR DATOS DE LA CATEGORIA EN EL MODAL
    public function show($id)
    {
        $types = Type::find($id);

        return response()->json([
            'code' => 1,
            'result' => $types
        ]);
    }

     //ACTUALIZAR LOS DATOS
     public function update(Request $request)
     {
         $type_id = $request->id_tipo;
         $type = Type::find($type_id);
 
         $validator = Validator::make($request->all(), [
             'nombre' => 'required|string|unique:categories'
         ]);
 
         if ($validator->fails()) {
             return response()->json([
                 'code' => 0,
                 'error' => $validator->errors()->toArray()
             ]);
         } else {
             $type->update([
                 'nombre' => $request->nombre
             ]);
             return response()->json([
                 'code' => 1,
                 'msg' => 'Tipo Actualizado'
             ]);
         }
     }

    //eliminar
    public function delete(Request $request)
    {
        $type = Type::find($request->type_id);
        $query = $type->delete();

        if ($query) {
            return redirect()->route('tipo.index');
        } else {
            return redirect()->route('tipo.index');
        }
    }
}
