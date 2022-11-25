<?php

namespace App\Http\Controllers;

use App\Models\coach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CoachController extends Controller
{
    public function index(Request $req){
       try {
         $rules=[
            'id_user' => 'required|integer',
            'type' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'mobile' => 'required|string|max:255',
            'detail' => 'required|string|max:255',
            'email' => 'required|string|max:255'
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
         $coach = coach::create($req->all());
         return response()->json($coach);
         }
       }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
     }
   


    public function showCoach(Request $req){
        try {
        return response()->json(coach::orderBy('id', 'desc')->paginate(50));
        }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function updateCoach(Request $req, coach $coach){
       try {
         $rules=[
            'id_user' => 'integer',
            'type' => 'string|max:255',
            'firstname' => 'string|max:255',
            'lastname' => 'string|max:255',
            'address' => 'string|max:255',
            'city' => 'string|max:255',
            'country' => 'string|max:255',
            'mobile' => 'string|max:255',
            'detail' => 'string|max:255',
            'email' => 'string|max:255'
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
        $coach->update($req->all());
        return response()->json($coach, 200);
         }
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }

    }


    public function deleteCoach(Request $req, coach $coach){
       try {
        $coach->delete();
        return response()->json(null, 204);
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
