<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student_test_category_score;
use Illuminate\Support\Facades\Validator;

class Student_test_category_scoreContoller extends Controller
{
     public function index(Request $req){
       try {
         $rules=[
            'id_student_test' => 'required|integer',
            'id_category' => 'required|integer',
            'score' => 'required|string|max:255'
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
         $student_test_category_score = Student_test_category_score::create($req->all());
         return response()->json($student_test_category_score);
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
        return response()->json(Student_test_category_score::orderBy('id', 'desc')->paginate(50));
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function update(Request $req, Student_test_category_score $student_test_category_score){
       try {
         $rules=[
            'id_student_test' => 'integer',
            'id_category' => 'integer',
            'score' => 'string|max:255'
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
        $student_test_category_score->update($req->all());
        return response()->json($student_test_category_score, 200);
         }
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function delete(Request $req, Student_test_category_score $student_test_category_score){
       try {
        $student_test_category_score->delete();
        return response()->json(null, 204);
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
