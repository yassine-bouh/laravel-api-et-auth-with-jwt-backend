<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\formation_recommendation;

class FormationRecommendation extends Controller
{
     //***********Formation_recommendation
    public function create_formation_recommendation(Request $request)
    {
        try {
                   //create validation
            $validate = Validator::make($request->all(), [
                'id_student_test' => 'required|integer',
                'id_formation' => 'required|integer',
                'id_coach' => 'required|integer',
                
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
                $sc= Formation_recommendation::create($request->all());
          
               if ($sc)
               {
                    return response()->json([
                        'status' => true,
                        'message' => 'formation recommendation created successfully',
                        'formation recommendation' => $sc
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
    public function show_formation_recommendations()
    {
        try {
            $sc= Formation_recommendation::orderBy('id', 'desc')->paginate(50);
            return response()->json([
                'status' => true,
                'formation recommendations' => $sc
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function read_formation_recommendation($id)
    {
        try {
            $sc= Formation_recommendation::findOrFail($id);
            return response()->json([
                'status' => true,
                'formation recommendation' => $sc
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
   
    public function update_formation_recommendation(Request $request, Formation_recommendation $formation_recommendation)
    {
        try {
             //create validation
            $validate = Validator::make($request->all(), [
                'id_student_test' => 'integer',
                'id_formation' => 'integer',
                'id_coach' => 'integer',
                
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
                $result = $formation_recommendation->update($request->all());
                if ($result) {
                    return response()->json([
                        'status' => true,
                        'message' => 'formation recommendation updated successfully',
                        'formation recommendation' => $formation_recommendation

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

    public function delete_formation_recommendation(Request $request, Formation_recommendation $formation_recommendation)
    {
        try {
            
            $result = $formation_recommendation->delete();
            if ($result) {
                return response()->json([
                    'status' => true,
                    'message' => 'formation recommendation deleted successfully',
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
