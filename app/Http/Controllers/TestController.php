<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\test;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
     public function index(Request $req){
       try {
         $rules=[
            'name' => 'required|string',
            'test_date' => 'required|date',
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
         $test = test::create($req->all());
         return response()->json($test);
         }      
       }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
     }


     public function showTest(Request $req){
       try {
        return response()->json(test::orderBy('id', 'desc')->paginate(50));
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function updateTest(Request $req, test $test){
       try {
         $rules=[
            'name' => 'required|string',
            'test_date' => 'date',
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
        $test->update($req->all());
        return response()->json($test, 200);
         }
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }

    }


    public function deleteTest(Request $req, test $test){
       try {
        $test->delete();
        return response()->json(null, 204);
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
