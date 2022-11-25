<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\answer;
use Illuminate\Support\Facades\Validator;

class AnswerController extends Controller
{
     public function index(Request $req){
       try {
         $rules=[
            'id_question' => 'required|integer',
            'id_weight' => 'required|integer',
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
         $answer = answer::create($req->all());
         return response()->json($answer);
         }

       }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
     }


     public function showAnswer(Request $req){
       try {
        return response()->json(answer::orderBy('id', 'desc')->paginate(50));
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function updateAnswer(Request $req, answer $answer){
       try {
         $rules=[
            'id_question' => 'integer',
            'id_weight' => 'integer',
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
        $answer->update($req->all());
        return response()->json($answer, 200);
         }
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }

    }


    public function deleteAnswer(Request $req, answer $answer){
       try {
        $answer->delete();
        return response()->json(null, 204);
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
