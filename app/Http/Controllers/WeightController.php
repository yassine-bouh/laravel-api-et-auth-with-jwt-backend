<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\weight;
use Illuminate\Support\Facades\Validator;

class WeightController extends Controller
{
     //creer weight
     public function index(Request $req){
       try {
         $rules=[
            'id_language' => 'required|integer',
            'resume' => 'required|string|max:255',
            'w_value' => 'required|integer'
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
         $weight = weight::create($req->all());
         return response()->json($weight);
         }        
       }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
     }

     //lister weight
     public function showWeight(Request $req){
        try {
        return response()->json(weight::orderBy('id', 'desc')->paginate(50));
        }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    //modifier weight
    public function updateWeight(Request $req, weight $weight){
       try {
         $rules=[
            'id_language' => 'integer',
            'resume' => 'string|max:255',
            'w_value' => 'integer'
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
        $weight->update($req->all());
        return response()->json($weight, 200);
         }
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
       }
    

    //supprimer weight
    public function deleteWeight(Request $req, weight $weight){
       try {
        $weight->delete();
        return response()->json(null, 204);
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
       
    }
}
