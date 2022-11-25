<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;
use Illuminate\Support\Facades\Validator;

class PartnerController extends Controller
{
    //***********partner
    public function create_partner(Request $request)
    {
        try {
              //create validation
            $validate = Validator::make($request->all(), [
                'id_institution' => 'required|integer',
                'id_user' => 'required|integer',
                'occupation' => 'required|string|max:255',
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'city' => 'required|string|max:100',
                'country' => 'required|string|max:255',
                'mobile' => 'required|string|max:255',
                'email' => 'required|string|max:100',
                'detail' => 'required|string|max:255',
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
                $sc = Partner::create($request->all());
          
               if ($sc)
               {
                    return response()->json([
                        'status' => true,
                        'message' => 'partner meeting created successfully',
                        'partner' => $sc
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
    public function show_partners()
    {
        try {
            $sc= Partner::orderBy('id', 'desc')->paginate(50);
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

    public function read_partner($id)
    {
        try {
            $sc= Partner::findOrFail($id);
            return response()->json([
                'status' => true,
                'partner' => $sc
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
   
    public function update_partner(Request $request, Partner $Partner)
    {
        try {
              //create validation
            $validate = Validator::make($request->all(), [
                'id_institution' => 'integer',
                'id_user' => 'integer',
                'occupation' => 'string|max:255',
                'firstname' => 'string|max:255',
                'lastname' => 'string|max:255',
                'address' => 'string|max:255',
                'city' => 'string|max:100',
                'country' => 'string|max:255',
                'mobile' => 'string|max:255',
                'email' => 'string|max:100',
                'detail' => 'string|max:255',
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
                $result = $Partner->update($request->all());
                if ($result) {
                    return response()->json([
                        'status' => true,
                        'message' => 'Partner updated successfully',
                        'Partner' => $Partner

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

    public function delete_partner(Request $request, Partner $Partner)
    {
        try {
            
            $result = $Partner->delete();
            if ($result) {
                return response()->json([
                    'status' => true,
                    'message' => 'Partner deleted successfully',
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
