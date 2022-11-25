<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use Illuminate\Support\Facades\Validator;

class ProgramController extends Controller
{
    //***********program
    public function create_program(Request $request)
    {
        try {
             //create validation
            $validate = Validator::make($request->all(), [
                'id_partner' => 'required|integer',
                'resume' => 'required|string|max:255',
                'conditions' => 'required|string|max:255',
                'details' => 'required|string|max:255',
                'cost' => 'required|numeric|min:0',
                
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
                
                $sc = Program::create($request->all());
          
               if ($sc)
               {
                    return response()->json([
                        'status' => true,
                        'message' => 'program meeting created successfully',
                        'program' => $sc
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
    public function show_programs()
    {
        try {
            $sc= Program::orderBy('id', 'desc')->paginate(50);
            return response()->json([
                'status' => true,
                'programs' => $sc
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function read_program($id)
    {
        try {
            $sc= Program::findOrFail($id);
            return response()->json([
                'status' => true,
                'program' => $sc
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
   
    public function update_program(Request $request, Program $Program)
    {
        try {
            //create validation
            $validate = Validator::make($request->all(), [
                'id_partner' => 'integer',
                'resume' => 'string|max:255',
                'conditions' => 'string|max:255',
                'details' => 'string|max:255',
                'cost' => 'numeric|min:0',
                
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
                
                $result = $Program->update($request->all());
                if ($result) {
                    return response()->json([
                        'status' => true,
                        'message' => 'Program updated successfully',
                        'Program' => $Program

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

    public function delete_program(Request $request, Program $Program)
    {
        try {
            
            $result = $Program->delete();
            if ($result) {
                return response()->json([
                    'status' => true,
                    'message' => 'Program deleted successfully',
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
