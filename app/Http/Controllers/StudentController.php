<?php

namespace App\Http\Controllers;

// use Log;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Employee;
use App\Models\PersonalProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use setasign\Fpdi\Fpdi;
use mikehaertl\pdftk\Pdf;
use setasign\Fpdi\PdfReader\PdfReader;



class StudentController extends Controller
{
    public function studentdashboard()
    {
        $name = "Admin Page";
        $imageUrl = asset('images/primrose.jpg'); // Generate the URL for the image

        // Fetch all students
        $students = PersonalProfile::all();

        return view('backend.studentmanagement.studentdashboard', compact('name', 'imageUrl', 'students'));
    }


    public function fetchStudentDetails($studentId)
    {
        $student = PersonalProfile::where('student_id', $studentId)->first();

        if ($student) {
            return response()->json([
                'student_id' => $student->student_id,
                'full_name' => $student->full_Name,
                'date_of_birth' => $student->date_of_Birth,
                'gender' => $student->gender,
                'full_name' => $student->full_Name,
                'full_name' => $student->full_Name,
                'date_of_birth' => $student->date_of_Birth,
                'gender' => $student->gender
            ]);
        } else {
            return response()->json([]);
        }
    }



    public function studentsemester()
    {
        $name = "Admin Page";

        $imageUrl = asset('images/primrose.jpg'); // Generate the URL for the image


        return view('backend.studentmanagement.studentsemesterinfo', compact('name', 'imageUrl'));
    }

    public function studentreport()
    {
        $name = "Admin Page";

        return view('backend.studentmanagement.studentreports', compact('name'));
    }
}
