<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\School_level;
use App\Models\School;
use App\Models\Academy;


class SchoolController extends Controller
{
    
        //***********School
    public function create_school(Request $request)
    {
        try {
             //create validation
            $validate = Validator::make($request->all(), [
                'id_academy' => 'required|integer',
                'id_region' => 'required|integer',
                'id_school_level' => 'required|integer',
                'name' => 'required|string|max:255',
                'resume' => 'required|string|max:255',
                'website' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'city' => 'required|string|max:100',
                'phone' => 'required|string|max:20',
                'mobile' => 'required|string|max:20',
                'email' => 'required|string|max:100',
                'type' => 'required|string|max:255',
                'contact_name' => 'required|string|max:255',
                
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
                $school = School::create($request->all());
          
               if ($school)
               {
                    return response()->json([
                        'status' => true,
                        'message' => 'school created successfully',
                        'schools' => $school
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
    public function show_schools()
    {
        try {
            $school = School::orderBy('id', 'desc')->paginate(50);
            return response()->json([
                'status' => true,
                'schools' => $school
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function read_school($id)
    {
        try {
            $school = School::findOrFail($id);
            return response()->json([
                'status' => true,
                'school' => $school
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
   
    public function update_school(Request $request, School $School)
    {
        try {
             //create validation
            $validate = Validator::make($request->all(), [
                'id_academy' => 'integer',
                'id_region' => 'integer',
                'id_school_level' => 'integer',
                'name' => 'string|max:255',
                'resume' => 'string|max:255',
                'website' => 'string|max:255',
                'address' => 'string|max:255',
                'city' => 'string|max:100',
                'phone' => 'string|max:20',
                'mobile' => 'string|max:20',
                'email' => 'string|max:100',
                'type' => 'string|max:255',
                'contact_name' => 'string|max:255',
                
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
                $result = $School->update($request->all());
                if ($result) {
                    return response()->json([
                        'status' => true,
                        'message' => 'school updated successfully',
                        'school' => $School

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

    public function delete_school(Request $request, School $School)
    {
        try {
            
            $result = $School->delete();
            if ($result) {
                return response()->json([
                    'status' => true,
                    'message' => 'school deleted successfully',
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

            //***********School level

    public function create_school_level(Request $request)
    {
        try {
            //create validation
            $validate = Validator::make($request->all(), [
                'prescolaire' => 'required|boolean',
                'primaire' => 'required|boolean',
                'college' => 'required|boolean',
                'lycee' => 'required|boolean',                
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {

                $school_l = School_level::create($request->all());
          
               if ($school_l) {
                    return response()->json([
                        'status' => true,
                        'message' => 'school level created successfully',
                        'school levels' => $school_l
                    ]);
                } else {
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

    public function read_school_level($id)
    {
        try {
            $school_l = School_level::findOrFail($id);
            return response()->json([
                'status' => true,
                'school level' => $school_l
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function update_school_level(Request $request,School_level $School_level)
    {
        try {
            //create validation
            $validate = Validator::make($request->all(), [
                'prescolaire' => 'boolean',
                'primaire' => 'boolean',
                'college' => 'boolean',
                'lycee' => 'boolean',                
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {

            $result=$School_level->update($request->all());
            if ($result) {
                    return response()->json([
                        'status' => true,
                        'message' => 'school level updated successfully',
                        'school level' => $School_level

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

    public function delete_school_level(Request $req,School_level $School_level)
    {
        try {
            
            $result = $School_level->delete();
            if ($result) {
                return response()->json([
                    'status' => true,
                    'message' => 'school level deleted successfully',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Something went wrong',
                ]);
            }
        }catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
        }

            public function show_school_levels()
    {
        try {
            $school_l = School_level::orderBy('id', 'desc')->paginate(50);
            return response()->json([
                'status' => true,
                'school levels' => $school_l
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

            //***********Academy

    public function create_academy(Request $request)
    {
        try {
            //create validation
            $validate = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'resume' => 'required|string|max:255',
                'website' => 'required|string|max:255',
                'province' => 'required|string|max:255',
                'region' => 'required|string|max:255',
                'contact_name' => 'required|string|max:255',
                'contact_phone' => 'required|string|max:255',
                'contact_email' => 'required|string|max:255',
                
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
                $academy = Academy::create($request->all());          
               if ($academy) {
                    return response()->json([
                        'status' => true,
                        'message' => 'academy created successfully',
                        'academies' => $academy
                    ]);
                } else {
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

    public function read_academy($id)
    {
        try {
            $academy = Academy::findOrFail($id);
            return response()->json([
                'status' => true,
                'academy' => $academy
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
    public function update_academy(Request $request,Academy $Academy)
    {
        try {
             //create validation
            $validate = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'resume' => 'required|string|max:255',
                'website' => 'required|string|max:255',
                'province' => 'required|string|max:255',
                'region' => 'required|string|max:255',
                'contact_name' => 'required|string|max:255',
                'contact_phone' => 'required|string|max:255',
                'contact_email' => 'required|string|max:255',
                
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
            $result=$Academy->update($request->all());

            if ($result) {
                    return response()->json([
                        'status' => true,
                        'message' => 'school level updated successfully',
                        'school level' => $Academy

                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Something went wrong',
                    ]);
                }
            }        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
     
    public function show_academies()
    {
        try {
            $academy = Academy::orderBy('id', 'desc')->paginate(50);
            return response()->json([
                'status' => true,
                'academies' => $academy
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function delete_academy(Request $req,Academy $Academy)
    {
        try {
            
            $result = $Academy->delete();
            if ($result) {
                return response()->json([
                    'status' => true,
                    'message' => 'academy deleted successfully',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Something went wrong',
                ]);
            }}catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
        }
        
}
