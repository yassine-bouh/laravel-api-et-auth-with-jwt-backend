<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student_coach_meeting;
use Illuminate\Support\Facades\Validator;

class StudentCoachMeeting extends Controller
{
    
     //***********student_coach_meeting
    public function create_student_coach_meeting(Request $request)
    {
        try {
                 //create validation
            $validate = Validator::make($request->all(), [
                'id_student_coach' => 'required|integer',
                'resume' => 'required|string|max:255',
                'detail' => 'required|string|max:255',
                'type' => 'required|string|max:255',
                'meeting_date' => 'required|date',
                
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
                $sc = Student_coach_meeting::create($request->all());
          
               if ($sc)
               {
                    return response()->json([
                        'status' => true,
                        'message' => 'student coach meeting created successfully',
                        'student coach meeting' => $sc
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
    public function show_student_coach_meetings()
    {
        try {
            $sc= Student_coach_meeting::orderBy('id', 'desc')->paginate(50);
            return response()->json([
                'status' => true,
                'student coach meetings' => $sc
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function read_student_coach_meeting($id)
    {
        try {
            $sc= Student_coach_meeting::findOrFail($id);
            return response()->json([
                'status' => true,
                'student coach meeting' => $sc
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
   
    public function update_student_coach_meeting(Request $request, Student_coach_meeting $Student_coach_meeting)
    {
        try {
            //create validation
            $validate = Validator::make($request->all(), [
                'id_student_coach' => 'integer',
                'resume' => 'string|max:255',
                'detail' => 'string|max:255',
                'type' => 'string|max:255',
                'meeting_date' => 'date',
                
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
                $result = $Student_coach_meeting->update($request->all());
                if ($result) {
                    return response()->json([
                        'status' => true,
                        'message' => 'Student coach meeting updated successfully',
                        'Student coach meeting' => $Student_coach_meeting

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

    public function delete_student_coach_meeting(Request $request, Student_coach_meeting $Student_coach_meeting)
    {
        try {
            
            $result = $Student_coach_meeting->delete();
            if ($result) {
                return response()->json([
                    'status' => true,
                    'message' => 'Student coach meeting deleted successfully',
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
