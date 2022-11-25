<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Validator;

class DocumentController extends Controller
{
     //***********document
    public function create_document(Request $request)
    {
        try {
             //create validation
            $validate = Validator::make($request->all(), [
                'type' => 'required|string|max:255',
                'path' => 'required|string|max:255',
                'detail' => 'required|string|max:255',
                'resume' => 'required|string|max:255',
                
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
                
                $sc = Document::create($request->all());
          
               if ($sc)
               {
                    return response()->json([
                        'status' => true,
                        'message' => 'document meeting created successfully',
                        'document' => $sc
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
    public function show_documents()
    {
        try {
            $sc= Document::orderBy('id', 'desc')->paginate(50);
            return response()->json([
                'status' => true,
                'Documents' => $sc
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function read_document($id)
    {
        try {
            $sc= Document::findOrFail($id);
            return response()->json([
                'status' => true,
                'document' => $sc
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
   
    public function update_document(Request $request, Document $Document)
    {
        try {
            //create validation
            $validate = Validator::make($request->all(), [
                'type' => 'string|max:255',
                'path' => 'string|max:255',
                'detail' => 'string|max:255',
                'resume' => 'string|max:255',
                
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
                
                $result = $Document->update($request->all());
                if ($result) {
                    return response()->json([
                        'status' => true,
                        'message' => 'Document updated successfully',
                        'Document' => $Document

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

    public function delete_document(Request $request, Document $Document)
    {
        try {
            
            $result = $Document->delete();
            if ($result) {
                return response()->json([
                    'status' => true,
                    'message' => 'Document deleted successfully',
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
