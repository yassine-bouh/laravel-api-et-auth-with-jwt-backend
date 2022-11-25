<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\question;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
     public function index(Request $req){
       try {
         $rules=[
            'id_language' => 'required|integer',
            'id_category' => 'required|integer',
            'type' => 'required|string|max:20',
            'resume' => 'required|string|max:225',
            'details' => 'required|string|max:225'
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }
         else{
         $question = question::create($req->all());
         return response()->json($question);
         }
       }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
     }
   


    public function showQuestion(Request $req){
        try {
        return response()->json(question::orderBy('id', 'desc')->paginate(50));
        }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function updateQuestion(Request $req, question $question){
       try {
         $rules=[
            'id_language' => 'integer',
            'id_category' => 'integer',
            'type' => 'string|max:20',
            'resume' => 'string|max:225',
            'details' => 'string|max:225'
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
        $question->update($req->all());
        return response()->json($question, 200);
         }
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function deleteQuestion(Request $req, question $question){
       try {
        $question->delete();
        return response()->json(null, 204);
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }



}
