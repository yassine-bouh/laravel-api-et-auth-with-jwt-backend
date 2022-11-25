<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category_job;
use Illuminate\Support\Facades\Validator;
class CategoryJobController extends Controller
{
    public function index(Request $req){
       try {
         $rules=[
            'id_category' => 'required|integer',
            'id_job' => 'required|integer',
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
         $category_job = Category_job::create($req->all());
         return response()->json($category_job);
         }
       }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
     }
   


    public function showCategoryJob(Request $req){
        try {
        return response()->json(Category_job::orderBy('id', 'desc')->paginate(50));
        }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function updateCategoryJob(Request $req, Category_job $category_job){
       try {
         $rules=[
            'id_category' => 'integer',
            'id_job' => 'integer',
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
        $category_job->update($req->all());
        return response()->json($category_job, 200);
         }
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function deleteCategoryJob(Request $req, Category_job $category_job){
       try {
        $category_job->delete();
        return response()->json(null, 204);
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
