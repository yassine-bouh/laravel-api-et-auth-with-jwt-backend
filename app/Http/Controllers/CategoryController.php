<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(Request $req){
       try {
         $rules=[
            'id_language' => 'required|integer',
            'resume' => 'required|string|max:255',
            'detail' => 'required|string|max:255',
            'principacl' => 'required|string|max:255',
            'activity' => 'required|string|max:255',
            'actions' => 'required|string|max:255',
            'quality' => 'required|string|max:225',
            'image' => 'required|string|max:255'
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
         $category = category::create($req->all());
         return response()->json($category);
         }       
       }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
     }
    


    public function showCategory(Request $req){
       try {
        return response()->json(category::orderBy('id', 'desc')->paginate(50));
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function updateCategory(Request $req, category $category){
       try {
         $rules=[
            'id_language' => 'integer',
            'resume' => 'string|max:255',
            'detail' => 'string|max:255',
            'principacl' => 'string|max:255',
            'activity' => 'string|max:255',
            'actions' => 'string|max:255',
            'quality' => 'string|max:225',
            'image' => 'string|max:255'
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
        $category->update($req->all());
        return response()->json($category, 200);
         }
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function deleteCategory(Request $req, category $category){
       try {
        $category->delete();
        return response()->json(null, 204);
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
