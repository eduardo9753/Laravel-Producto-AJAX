<?php

namespace App\Http\Controllers\admin\caja;

use App\Http\Controllers\Controller;
use App\Models\Box;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CajaController extends Controller
{
    //
    public function index()
    {
        $boxes = Box::all();
        return view('admin.caja.index', [
            'boxes' => $boxes
        ]);
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'egreso' => 'required',
            'ingreso' => 'required'
        ]);

        Box::create([
            'egreso' => $request->egreso,
            'ingreso' => $request->ingreso,
            'fecha' => date('y-m-d'),
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('caja.index');
    }

    public function delete(Request $request)
    {
        $caja = Box::find($request->caja_id);
        $query = $caja->delete();

        if ($query) {
            return redirect()->route('caja.index');
        } else {
            return redirect()->route('caja.index');
        }
    }
}
