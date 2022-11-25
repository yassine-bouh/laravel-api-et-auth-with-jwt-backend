<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification_logs;
use Illuminate\Support\Facades\Validator;

class NotificationLogsController extends Controller
{
    public function index(Request $req){
       try {
          $rules=[
            'module' => 'required|string|max:255',
            'notification' => 'required|string|max:255',
            'send_status' => 'required|string|max:255',
            'to' => 'required|string|max:255',
            'bc' => 'required|string|max:255',
            'bcc' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'body' => 'required|string|max:255',
            'send_date' => 'required|date'
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
         $notification_logs = Notification_logs::create($req->all());
         return response()->json($notification_logs);
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
        return response()->json(Notification_logs::orderBy('id', 'desc')->paginate(50));
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function update(Request $req, Notification_logs $notification_logs){
       try {
         $rules=[
            'module' => 'string|max:255',
            'notification' => 'string|max:255',
            'send_status' => 'string|max:255',
            'to' => 'string|max:255',
            'bc' => 'string|max:255',
            'bcc' => 'string|max:255',
            'subject' => 'string|max:255',
            'body' => 'string|max:255',
            'send_date' => 'date'
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
        $notification_logs->update($req->all());
        return response()->json($notification_logs, 200);
         }
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function delete(Request $req, Notification_logs $Notification_logs){
       try {
        $notification_logs->delete();
        return response()->json(null, 204);
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
