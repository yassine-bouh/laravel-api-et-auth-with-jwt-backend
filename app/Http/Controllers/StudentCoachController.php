<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student_coach;
use Illuminate\Support\Facades\Validator;

class StudentCoachController extends Controller
{
    public function index(Request $req){
       try {
         $rules=[
            'id_student' => 'required|integer',
            'id_coach' => 'required|integer',
            'entred_date' => 'date'
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
         $student_coach = student_coach::create($req->all());
         return response()->json($student_coach);
         }       
       }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
     }


     public function showStudentCoach(Request $req){
       try {
        return response()->json(student_coach::orderBy('id', 'desc')->paginate(50));
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function updateStudentCoach(Request $req, student_coach $student_coach){
       try {
         $rules=[
            'id_student' => 'integer',
            'id_coach' => 'integer',
            'entred_date' => 'date'
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
        $student_coach->update($req->all());
        return response()->json($student_coach, 200);
         }
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }

    }


    public function deleteStudentCoach(Request $req, student_coach $student_coach){
       try {
        $student_coach->delete();
        return response()->json(null, 204);
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
