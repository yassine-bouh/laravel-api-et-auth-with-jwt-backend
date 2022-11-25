<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Axe;
use Illuminate\Support\Facades\Validator;

class AxeController extends Controller
{
     public function index(Request $req){
       try {
         $rules=[
            'resume' => 'required|string|max:255'
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
         $axe = Axe::create($req->all());
         return response()->json($axe);
         }        
       }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
     }


     public function showAxe(Request $req){
       try {
        return response()->json(Axe::orderBy('id', 'desc')->paginate(50));
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
        public function readAxe( $id)
    {
    try{
         $selected=Axe::findOrFail($id);
            if(isset($selected))
            {
                return response()->json([
                    'axe'=>$selected
                ]);
            }
            else 
	        {
                return response()->json([
                    'error'=>'Data Not Found',
                ]);
            }
    } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }




    public function updateAxe(Request $req, Axe $axe){
       try {
         $rules=[
            'resume' => 'string|max:255'
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
        $axe->update($req->all());
        return response()->json($axe, 200);
         }
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }

    }


    public function deleteAxe(Request $req, Axe $axe){
       try {
        $axe->delete();
        return response()->json(null, 204);
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
