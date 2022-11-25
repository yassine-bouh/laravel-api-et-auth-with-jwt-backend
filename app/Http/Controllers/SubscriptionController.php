<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\subscription;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    public function index(Request $req){
       try {
         $rules=[
            'resume' => 'required|string|max:255',
            'detail' => 'required|string|max:255'
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
         $subscription = subscription::create($req->all());
         return response()->json($subscription);
         }
       }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
     }
     public function subscriptionById( $id)
    {
    try{
         $selected=subscription::findOrFail($id);
            if(isset($selected))
            {
                return response()->json([
                    'institution'=>$selected
                ]);
            }
            else 
	        {
                return response()->json([
                    'error'=>'Data Not Found',
                ]);
            }
    } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

     public function showSubscription(Request $req){
       try {
        return response()->json(subscription::orderBy('id', 'desc')->paginate(50));
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function updatesubscription(Request $req, subscription $subscription){
       try {
         $rules=[
            'resume' => 'string|max:255',
            'detail' => 'string|max:255'
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
        $subscription->update($req->all());
        return response()->json($subscription, 200);
         }
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }

    }


    public function deleteSubscription(Request $req, subscription $subscription){
       try {
        $subscription->delete();
        return response()->json(null, 204);
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
