<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Concepto;
use Input;
use Schema;
use Redirect;

class ConceptosController extends Controller
{
    public function index()
    {
        $conceptos = Concepto::select()
            ->orderBy('id')
            ->get()
            ;
        
        // $test_columns = Schema::getColumnListing('tests');
        $conceptos_model = new Concepto();
        $fillable_columns = $conepto_model->getFillable();
        foreach ($fillable_columns as $key => $value) {
            $concepto_columns[$value] = $value;
        }
        
        return view('index',compact('conceptos','concepto_columns'));
    }
    public function update(Request $request, $id)
    {
        $concepto = Concepto::find($id);
        $column_clave_sat = Input::get('clave_sat');
        $column_concepto = Input::get('concepto');
        
        if( Input::has('clave_sat') && Input::has('concepto')) {
            $concepto = Concepto::select()
                ->where('id', '=', $id)
                ->update([$column_clave_sat => $column_concepto]);
            return response()->json([ 'code'=>200], 200);
        }
        
        return response()->json([ 'error'=> 400, 'message'=> 'Not enought params' ], 400);
    }
    public function bulk_update(Request $request)
    {
        if (Input::has('ids_to_edit') && Input::has('bulk_clave_sat') && Input::has('bulk_concepto')) {
            $ids = Input::get('ids_to_edit');
            $bulk_clave_sat = Input::get('bulk_clave_sat');
            $bulk_concepto = Input::get('bulk_concepto');
            foreach ($ids as $id) {
                $concepto = Concepto::select()
                    ->where('id', '=', $id)
                    ->update([$bulk_clave_sat => $bulk_concepto]);
            }
            // return Redirect::route('client/leads')->with('message', $message);
            $message = "Done";
        } else {
            $message = "Error. Empty or Wrong data provided.";
            return Redirect::back()->withErrors(array('message' => $message))->withInput();
        }
        return Redirect::back()->with('message', $message);
    }
}
