<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category_category;
use Illuminate\Support\Facades\Validator;


class Category_categoryController extends Controller
{
     public function index(Request $req){
       try {
         $rules=[
            'id_language' => 'required|integer',
            'id_cat_one' => 'required|integer',
            'id_cat_two' => 'required|integer',
            'resume' => 'required|string|max:255',
            'detail' => 'required|string|max:255',
            'principal' => 'required|string|max:255',
            'activity' => 'required|string|max:255',
            'actions' => 'required|string|max:255',
            'quality' => 'required|string|max:255',
            'image' => 'required|string|max:255'
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
         $category_category = Category_category::create($req->all());
         return response()->json($category_category);
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
        return response()->json(Category_category::orderBy('id', 'desc')->paginate(50));
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function update(Request $req, Category_category $category_category){
       try {
         $rules=[
            'id_language' => 'integer',
            'id_cat_one' => 'integer',
            'id_cat_two' => 'integer',
            'resume' => 'string|max:255',
            'detail' => 'text|max:255',
            'principal' => 'string|max:255',
            'activity' => 'string|max:255',
            'actions' => 'string|max:255',
            'quality' => 'string|max:255',
            'image' => 'string|max:255'
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
        $category_category->update($req->all());
        return response()->json($category_category, 200);
         }
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function delete(Request $req, Category_category $category_category){
       try {
        $category_category->delete();
        return response()->json(null, 204);
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
