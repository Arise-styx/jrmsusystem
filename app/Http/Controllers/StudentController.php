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
                'students_id' => $student->student_id,
                'full_name' => $student->full_Name,
                'date_of_birth' => $student->date_of_Birth,
                'gender' => $student->gender,
                'full_name' => $student->home_address,
                'full_name' => $student->contact_num,
                'date_of_birth' => $student->email_add,
                'gender' => $student->sports,
                'gender' => $student->tech_skills,
                'gender' => $student->languages_prof,
                'gender' => $student->guardian_full_name,
                'gender' => $student->guardian_rel,
                'gender' => $student->guardian_contact_num,
                'gender' => $student->address,
                'gender' => $student->elem_School,
                'gender' => $student->e_Highest_Award,
                'gender' => $student->e_Yr_Graduated,
                'gender' => $student->junior_High_School,
                'gender' => $student->j_highest_Award,
                'gender' => $student->j_Yr_Graduated,
                'gender' => $student->senior_High_School,
                'gender' => $student->s_Highest_award,
                'gender' => $student->s_Yr_Graduated,
                'gender' => $student->landlord,
                'gender' => $student->name_Bh,
                'gender' => $student->add_Bh,
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
