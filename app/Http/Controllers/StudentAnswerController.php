<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student_answer;
use Illuminate\Support\Facades\Validator;

class StudentAnswerController extends Controller
{
     public function index(Request $req){
       try {
         $rules=[
            'id_student' => 'required|integer',
            'id_answer' => 'required|integer'
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
         $student_answer = Student_answer::create($req->all());
         return response()->json($student_answer);
         }       
       }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
     }


     public function showStudentAnswer(Request $req){
       try {
        return response()->json(Student_answer::orderBy('id', 'desc')->paginate(50));
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function updateStudentAnswer(Request $req, Student_answer $student_answer){
       try {
        $rules=[
            'id_student' => 'integer',
            'id_answer' => 'integer'
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
        $student_answer->update($req->all());
        return response()->json($student_answer, 200);
         }
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }

    }


    public function deleteStudentAnswer(Request $req, Student_answer $student_answer){
       try {
        $student_answer->delete();
        return response()->json(null, 204);
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
