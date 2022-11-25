<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test_axe;
use Illuminate\Support\Facades\Validator;
class TestAxeController extends Controller
{
     public function index(Request $req){
       try {
         $rules=[
            'id_test' => 'required|integer',
            'id_axe' => 'required|integer'
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
         $test_axe = Test_axe::create($req->all());
         return response()->json($test_axe);
         }        
       }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
     }


     public function showTestAxe(Request $req){
       try {
        return response()->json(Test_axe::orderBy('id', 'desc')->paginate(50));
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function updateTestAxe(Request $req, Test_axe $test_axe){
       try {
        $rules=[
            'id_test' => 'integer',
            'id_axe' => 'integer'
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
        $test_axe->update($req->all());
        return response()->json($test_axe, 200);
         }
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }

    }


    public function deleteTestAxe(Request $req, Test_axe $test_axe){
       try {
        $test_axe->delete();
        return response()->json(null, 204);
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
