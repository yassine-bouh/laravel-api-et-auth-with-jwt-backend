<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Params;
use Illuminate\Support\Facades\Validator;

class ParamController extends Controller
{
    public function index(Request $req){
       try {
         $rules=[
            'code' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'module' => 'required|string|max:255',
            'value' => 'required|string|max:255'
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
         $params = Params::create($req->all());
         return response()->json($params);
         }
       }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
     }
    


    public function show(Request $req){
       try {
        return response()->json(Params::orderBy('id', 'desc')->paginate(50));
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function update(Request $req, Params $params){
       try {
         $rules=[
            'code' => 'string|max:255',
            'type' => 'string|max:255',
            'module' => 'string|max:255',
            'value' => 'string|max:255'
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
        $params->update($req->all());
        return response()->json($params, 200);
         }
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function delete(Request $req, Params $params){
       try {
        $params->delete();
        return response()->json(null, 204);
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
