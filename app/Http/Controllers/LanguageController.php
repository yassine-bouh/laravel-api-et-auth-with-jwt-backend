<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\language;
use Illuminate\Support\Facades\Validator;

class LanguageController extends Controller
{
  //creer language
  public function index(Request $req){
       try {
         $rules=[
            'iso_code' => 'required|string|max:255',
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
         $language = language::create($req->all());
         return response()->json($language);
         }
       }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
     }

  //lister language
  public function showLanguage(Request $req){
       try {
        return response()->json(language::orderBy('id', 'desc')->paginate(50));
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

  //modifier langague
  public function updateLanguage(Request $req, language $language){
       try {
         $rules=[
            'iso_code' => 'string|max:255',
       ];
         $validator = Validator::make($req->all(),$rules);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }else{
        $language->update($req->all());
        return response()->json($language, 200);
         }
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }

    }

  //supprimer language
  public function deleteLanguage(Request $req, language $language){
       try {
        $language->delete();
        return response()->json(null, 204);
       }catch(\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
