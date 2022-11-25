<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\level_recommendation;
use Illuminate\Support\Facades\Validator;


class LevelRecommendation extends Controller
{
      //***********Level_recommendation
    public function create_level_recommendation(Request $request)
    {
        try {
                //create validation
            $validate = Validator::make($request->all(), [
                'id_student_test' => 'required|integer',
                'id_level' => 'required|integer',
                'id_coach' => 'required|integer',
                
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
                $sc = Level_recommendation::create($request->all());
          
               if ($sc)
               {
                    return response()->json([
                        'status' => true,
                        'message' => 'level recommendation created successfully',
                        'level recommendation' => $sc
                    ]);
                }
                else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Smoething went wrong'
                    ]);
                }
            }
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function show_level_recommendations()
    {
        try {
            $sc= Level_recommendation::orderBy('id', 'desc')->paginate(50);
            return response()->json([
                'status' => true,
                'level recommendations' => $sc
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function read_level_recommendation($id)
    {
        try {
            $sc= Level_recommendation::findOrFail($id);
            return response()->json([
                'status' => true,
                'level recommendation' => $sc
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
   
    public function update_level_recommendation(Request $request, Level_recommendation $Level_recommendation)
    {
        try {
            //create validation
            $validate = Validator::make($request->all(), [
                'id_student_test' => 'integer',
                'id_level' => 'integer',
                'id_coach' => 'integer',
                
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
                $result = $Level_recommendation->update($request->all());
                if ($result) {
                    return response()->json([
                        'status' => true,
                        'message' => 'level recommendation updated successfully',
                        'level recommendation' => $Level_recommendation

                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Something went wrong',
                    ]);
                }
            }
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function delete_level_recommendation(Request $request, Level_recommendation $Level_recommendation)
    {
        try {
            
            $result = $Level_recommendation->delete();
            if ($result) {
                return response()->json([
                    'status' => true,
                    'message' => 'level recommendation deleted successfully',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Something went wrong',
                ]);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
