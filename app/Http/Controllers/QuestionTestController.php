<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question_test;
use Illuminate\Support\Facades\Validator;

class QuestionTestController extends Controller
{
    public function index(Request $req){
       try {
         $rules=[
            'id_question' => 'required|integer',
            'id_test' => 'required|integer',
            'score' => 'integer',
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
         $question_test = Question_test::create($req->all());
         return response()->json($test_axe);
         }
       }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
     }


     public function shwoQuestionTest(Request $req){
       try {
        return response()->json(Question_test::orderBy('id', 'desc')->paginate(50));
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function updateQuestionTest(Request $req, Question_test $question_test){
       try {
         $rules=[
            'id_question' => 'integer',
            'id_test' => 'integer',
            'score' => 'integer',
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
        $question_test->update($req->all());
        return response()->json($question_test, 200);
         }
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }

    }


    public function deleteQuestionTest(Request $req, Question_test $question_test){
       try {
        $question_test->delete();
        return response()->json(null, 204);
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
