<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
    
 //***********invoice
    public function create_invoice(Request $request)
    {
        try {
             //create validation
            $validate = Validator::make($request->all(), [
                'status' => 'required|string|max:255',
                'total' => 'required|numeric|min:0',
                'tva' => 'required|numeric|min:0',
                'description' => 'required|string|max:255',
                'ivoice_date' => 'required|date',
                'validation_date' => 'required|date',
                
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
                
                $sc = Invoice::create($request->all());
          
               if ($sc)
               {
                    return response()->json([
                        'status' => true,
                        'message' => 'invoice meeting created successfully',
                        'invoice' => $sc
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
    public function show_invoices()
    {
        try {
            $sc= Invoice::orderBy('id', 'desc')->paginate(50);
            return response()->json([
                'status' => true,
                'invoices' => $sc
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function read_invoice($id)
    {
        try {
            $sc= Invoice::findOrFail($id);
            return response()->json([
                'status' => true,
                'invoice' => $sc
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
   
    public function update_invoice(Request $request, Invoice $Invoice)
    {
        try {
            //create validation
            $validate = Validator::make($request->all(), [
                'status' => 'string|max:255',
                'total' => 'numeric|min:0',
                'tva' => 'numeric|min:0',
                'description' => 'string|max:255',
                'ivoice_date' => 'date',
                'validation_date' => 'date',
                
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
                $result = $Invoice->update($request->all());
                if ($result) {
                    return response()->json([
                        'status' => true,
                        'message' => 'Invoice updated successfully',
                        'Invoice' => $Invoice

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

    public function delete_invoice(Request $request, Invoice $Invoice)
    {
        try {
            
            $result = $Invoice->delete();
            if ($result) {
                return response()->json([
                    'status' => true,
                    'message' => 'Invoice deleted successfully',
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
