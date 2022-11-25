<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student_document;
use Illuminate\Support\Facades\Validator;

class StudentDocument extends Controller
{
      
     //***********student_document
    public function create_student_document(Request $request)
    {
        try {
                //create validation
            $validate = Validator::make($request->all(), [
                'id_student' => 'required|integer',
                'id_document' => 'required|integer',
                
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
                $sc = Student_document::create($request->all());
          
               if ($sc)
               {
                    return response()->json([
                        'status' => true,
                        'message' => 'student document meeting created successfully',
                        'student document' => $sc
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
    public function show_student_documents()
    {
        try {
            $sc= Student_document::orderBy('id', 'desc')->paginate(50);
            return response()->json([
                'status' => true,
                'student_document' => $sc
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function read_student_document($id)
    {
        try {
            $sc= Student_document::findOrFail($id);
            return response()->json([
                'status' => true,
                'student_document' => $sc
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
   
    public function update_student_document(Request $request, Student_document $Student_document)
    {
        try {
             //create validation
            $validate = Validator::make($request->all(), [
                'id_student' => 'integer',
                'id_document' => 'integer',
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
                $result = $Student_document->update($request->all());
                if ($result) {
                    return response()->json([
                        'status' => true,
                        'message' => 'Student document updated successfully',
                        'Student document' => $Student_document

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

    public function delete_student_document(Request $request, Student_document $Student_document)
    {
        try {
            
            $result = $Student_document->delete();
            if ($result) {
                return response()->json([
                    'status' => true,
                    'message' => 'Student document deleted successfully',
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
