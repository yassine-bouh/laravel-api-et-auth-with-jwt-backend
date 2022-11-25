<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student_subscription_at;
use Illuminate\Support\Facades\Validator;
class StudentSubscriptionAtController extends Controller
{
        public function index(Request $req){
       try {
         $rules=[
            'id_student' => 'required|integer',
            'id_subscription' => 'required|integer',
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
         $student_subscription_at = student_subscription_at::create($req->all());
         return response()->json($student_subscription_at);
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
        return response()->json(student_subscription_at::orderBy('id', 'desc')->paginate(50));
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function update(Request $req, student_subscription_at $student_subscription_at){
       try {
         $rules=[
            'id_student' => 'integer',
            'id_subscription' => 'integer',
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
        $student_subscription_at->update($req->all());
        return response()->json($student_subscription_at, 200);
         }

       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }

    }


    public function delete(Request $req, student_subscription_at $student_subscription_at){
       try {
        $student_subscription_at->delete();
        return response()->json(null, 204);
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
