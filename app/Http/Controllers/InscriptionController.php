<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscription;
use Illuminate\Support\Facades\Validator;

class InscriptionController extends Controller
{
    
     //***********inscription
    public function create_inscription(Request $request)
    {
        try {
              //create validation
            $validate = Validator::make($request->all(), [
                'id_invoice' => 'required|integer',
                'id_student_coach' => 'required|integer',
                'id_program'=> 'required|integer',
                'last_status' => 'required|string',
                'last_status_date' => 'required|date',
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {   
                $sc = Inscription::create($request->all());
          
               if ($sc)
               {
                    return response()->json([
                        'status' => true,
                        'message' => 'inscription meeting created successfully',
                        'inscription' => $sc
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
    public function show_inscriptions()
    {
        try {
            $sc= Inscription::orderBy('id', 'desc')->paginate(50);
            return response()->json([
                'status' => true,
                'inscriptions' => $sc
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function read_inscription($id)
    {
        try {
            $sc= Inscription::findOrFail($id);
            return response()->json([
                'status' => true,
                'inscription' => $sc
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
   
    public function update_inscription(Request $request, Inscription $Inscription)
    {
        try {
               //create validation
            $validate = Validator::make($request->all(), [
                'id_invoice' => 'integer',
                'id_student_coach' => 'integer',
                'id_program'=> 'integer',
                'last_status' => 'string',
                'last_status_date' => 'date',
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {   
             
                $result = $Inscription->update($request->all());
                if ($result) {
                    return response()->json([
                        'status' => true,
                        'message' => 'Inscription updated successfully',
                        'Inscription' => $Inscription

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

    public function delete_inscription(Request $request, Inscription $Inscription)
    {
        try {
            
            $result = $Inscription->delete();
            if ($result) {
                return response()->json([
                    'status' => true,
                    'message' => 'Inscription deleted successfully',
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
