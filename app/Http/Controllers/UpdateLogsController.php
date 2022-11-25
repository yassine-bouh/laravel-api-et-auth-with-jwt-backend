<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Update_logs;
use Illuminate\Support\Facades\Validator;
class UpdateLogsController extends Controller
{
    public function index(Request $req){
       try {
         $rules=[
            'module' => 'required|string|max:255',
            'field' => 'required|string|max:255',
            'old_value' => 'required|string|max:255',
            'new_value' => 'required|string|max:255'
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
         $update_logs = Update_logs::create($req->all());
         return response()->json($update_logs);
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
        return response()->json(Update_logs::orderBy('id', 'desc')->paginate(50));
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function update(Request $req, Update_logs $update_logs){
       try {
         $rules=[
            'module' => 'string|max:255',
            'field' => 'string|max:255',
            'old_value' => 'string|max:255',
            'new_value' => 'string|max:255'
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
        $update_logs->update($req->all());
        return response()->json($update_logs, 200);
         }
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function delete(Request $req, Update_logs $update_logs){
       try {
        $update_logs->delete();
        return response()->json(null, 204);
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
