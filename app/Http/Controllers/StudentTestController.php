<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student_test;
use Illuminate\Support\Facades\Validator;

class StudentTestController extends Controller
{
     public function index(Request $req){
       try {
         $rules=[
            'id_student' => 'required|integer',
            'id_test' => 'required|integer',
            'id_axe' => 'required|integer',
            'score' => 'required|integer',
            'comment' => 'required|string|max:255'
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
         $student_test = Student_test::create($req->all());
         return response()->json($student_test);
         }        
       }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
     }


     public function showStudentTest(Request $req){
       try {
        return response()->json(Student_test::orderBy('id', 'desc')->paginate(50));
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function updateStudentTest(Request $req, Student_test $student_test){
       try {
         $rules=[
            'id_student' => 'integer',
            'id_test' => 'integer',
            'id_axe' => 'integer',
            'score' => 'integer',
            'comment' => 'string|max:255'
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
        $student_test->update($req->all());
        return response()->json($student_test, 200);
         }
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }

    }


    public function deleteStudentTest(Request $req, Student_test $student_test){
       try {
        $student_test->delete();
        return response()->json(null, 204);
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
