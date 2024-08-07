<?php

namespace App\Http\Controllers;

// use Log;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Employee;
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


        return view('backend.studentmanagement.studentdashboard', compact('name', 'imageUrl'));
    }

    public function studentsemester()
    {
        $name = "Admin Page";

        $imageUrl = asset('images/primrose.jpg'); // Generate the URL for the image


        return view('backend.studentmanagement.studentsemesterinfo', compact('name', 'imageUrl'));
    }
}
