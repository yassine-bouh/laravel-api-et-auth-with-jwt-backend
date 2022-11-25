<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function index()
    {
        try {
            $students = Student::orderBy('id', 'desc')->paginate(50);
            return response()->json([
                'status' => true,
                'students' => $students
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function store(Request $request)
    {
        try {
            //create validation
            $validate = Validator::make($request->all(), [
                'record_number' => 'required|string|max:20',
                'civility' => 'required|string|max:20',
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'birth_date' => 'required|date',
                'nationality' => 'required|string|max:50',
                'address' => 'required|string|max:255',
                'city' => 'required|string|max:100',
                'postal_code' => 'required|string|max:10',
                'phone' => 'required|string|max:20',
                'parent_phone' => 'required|string|max:20',
                'email' => 'required|string|max:100',
                'school_level' => 'required|string|max:255',
                'school' => 'required|string|max:255',
                'opned_date' => 'required|date',
                'photo' => 'required',
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
                $folderPath = 'assets/students_photos/';
                $base64Image = explode(";base64,", $request->photo);
                $explodeImage = explode("image/", $base64Image[0]);
                $imageType = $explodeImage[1];
                $image_base64 = base64_decode($base64Image[1]);
                $imageName = Str::random(40) . '.' . $imageType;

                Storage::disk('public')->put($folderPath . $imageName, $image_base64);

                $student = Student::create([
                    'record_number' => $request->record_number,
                    'civility' => $request->civility,
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'birth_date' => $request->birth_date,
                    'nationality' => $request->nationality,
                    'address' => $request->address,
                    'city' => $request->city,
                    'postal_code' => $request->postal_code,
                    'phone' => $request->phone,
                    'parent_phone' => $request->parent_phone,
                    'email' => $request->email,
                    'school_level' => $request->school_level,
                    'school' => $request->school,
                    'opned_date' => $request->opned_date,
                    'photo' => $folderPath . $imageName,
                ]);
                if ($student) {
                    return response()->json([
                        'status' => true,
                        'message' => 'Student created successfully',
                        'student' => $student
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

    public function show($id)
    {
        try {
            $student = Student::findOrFail($id);
            return response()->json([
                'status' => true,
                'student' => $student
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
    public function detailStudent($record_number)
    {
        try {
            $student = Student::where('record_number', $record_number)
                ->first();
            return response()->json([
                'status' => true,
                'student' => $student
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $student = Student::findOrFail($id);
            $validate = Validator::make($request->all(), [
                'record_number' => 'required|string|max:20',
                'civility' => 'required|string|max:20',
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'birth_date' => 'required|date',
                'nationality' => 'required|string|max:50',
                'address' => 'required|string|max:255',
                'city' => 'required|string|max:100',
                'postal_code' => 'required|string|max:10',
                'phone' => 'required|string|max:20',
                'parent_phone' => 'required|string|max:20',
                'email' => 'required|string|max:100',
                'school_level' => 'required|string|max:255',
                'school' => 'required|string|max:255',
                'opned_date' => 'required|date',
                'photo' => 'required',
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors(),
                ]);
            } else {
                if (request('photo')) {
                    Storage::disk('public')->delete($student->getRawOriginal('photo'));
                    $folderPath = 'assets/students_photos/';
                    $base64Image = explode(";base64,", $request->photo);
                    $explodeImage = explode("image/", $base64Image[0]);
                    $imageType = $explodeImage[1];
                    $image_base64 = base64_decode($base64Image[1]);
                    $imageName = Str::random(40) . '.' . $imageType;
                    $image_path = $folderPath . $imageName;
                    Storage::disk('public')->put($folderPath . $imageName, $image_base64);
                } elseif ($student->photo) {
                    $image_path = $student->getRawOriginal('photo');
                } else {
                    $image_path = null;
                }
                $result = $student->update([
                    'record_number' => $request->record_number,
                    'civility' => $request->civility,
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'birth_date' => $request->birth_date,
                    'nationality' => $request->nationality,
                    'address' => $request->address,
                    'city' => $request->city,
                    'postal_code' => $request->postal_code,
                    'phone' => $request->phone,
                    'parent_phone' => $request->parent_phone,
                    'email' => $request->email,
                    'school_level' => $request->school_level,
                    'school' => $request->school,
                    'opned_date' => $request->opned_date,
                    'photo' => $image_path,
                ]);
                if ($result) {
                    return response()->json([
                        'status' => true,
                        'message' => 'Student updated successfully',
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

    public function destroy($id)
    {
        try {
            $student = Student::find($id);
            if ($student->photo) {
                Storage::disk('public')->delete($student->photo);
            }
            $result = $student->delete();
            if ($result) {
                return response()->json([
                    'status' => true,
                    'message' => 'Student deleted successfully',
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

    public function searchStudent(Request $request, $search)
    {
        try {
            $student = Student::where('record_number', 'like', '%' . $search . '%')
                ->orWhere('firstname', 'like', '%' . $search . '%')
                ->orWhere('lastname', 'like', '%' . $search . '%')
                ->orWhere('city', 'like', '%' . $search . '%')
                ->orWhere('opned_date', '=', '%' . $search . '%')
                ->paginate(50);
            return response()->json([
                'status' => true,
                'students' => $student
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}

