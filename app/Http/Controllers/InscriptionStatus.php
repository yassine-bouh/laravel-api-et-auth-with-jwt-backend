<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscription_status;
use Illuminate\Support\Facades\Validator;

class InscriptionStatus extends Controller
{
    
     //***********inscription_status
    public function create_inscription_status(Request $request)
    {
        try {
              //create validation
            $validate = Validator::make($request->all(), [
                'id_inscription' => 'required|integer',
                'status' => 'required|string|max:255',
                'date' => 'required|date',
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
                $sc = Inscription_status::create($request->all());
          
               if ($sc)
               {
                    return response()->json([
                        'status' => true,
                        'message' => 'inscription status meeting created successfully',
                        'inscription status' => $sc
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
    public function show_inscription_status()
    {
        try {
            $sc= Inscription_status::orderBy('id', 'desc')->paginate(50);
            return response()->json([
                'status' => true,
                'inscription status' => $sc
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function read_inscription_status($id)
    {
        try {
            $sc= Inscription_status::findOrFail($id);
            return response()->json([
                'status' => true,
                'inscription status' => $sc
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
   
    public function update_inscription_status(Request $request, Inscription_status $Inscription_status)
    {
        try {
             //create validation
            $validate = Validator::make($request->all(), [
                'id_inscription' => 'integer',
                'status' => 'string|max:255',
                'date' => 'date',
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
                $result = $Inscription_status->update($request->all());
                if ($result) {
                    return response()->json([
                        'status' => true,
                        'message' => 'Inscription status updated successfully',
                        'Inscription status' => $Program

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

    public function delete_inscription_status(Request $request, Inscription_status $Inscription_status)
    {
        try {
            
            $result = $Inscription_status->delete();
            if ($result) {
                return response()->json([
                    'status' => true,
                    'message' => 'Inscription status deleted successfully',
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
