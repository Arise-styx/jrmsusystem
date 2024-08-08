@extends('backend.master_template')

@section('maincontent')
    <div class="container-fluid py-4">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>


        <style>
            .search-container {
                margin: 20px;
            }

            .search-input {
                width: 200%;
                max-width: 400px;
                padding: 10px 15px;
                border: 1px solid #ccc;
                border-radius: 7px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                font-size: 16px;
                transition: all 0.3s ease;
            }

            .search-input:focus {
                border-color: #007BFF;
                box-shadow: 0 4px 8px rgba(0, 123, 255, 0.2);
                outline: none;
            }

            .search-input::placeholder {
                color: #aaa;
                font-style: italic;
            }
        </style>
        <style>
            /* .container {
                                                                                                                align-items: center;
                                                                                                            } */
            .image-container {
                flex: 1;
                /* This will allow the image container to take up 1/4 of the line */
                max-width: 25%;
                /* Ensures the image container does not exceed 25% of the width */
                margin-right: 260px;
                /* Space between image and text */
            }

            .image-container img {
                width: 300%;
                /* Adjust width as needed */
                max-width: 500px;
                /* Maximum width of the image */
                height: auto;
                /* Maintain aspect ratio */
            }

            .text-container {
                flex: 3;
                /* This will allow the text container to take up 3/4 of the line */
                display: flex;
                flex-direction: column;
                /* Arrange form fields vertically */
            }

            .form-inline {
                display: flex;
                align-items: center;
                margin-bottom: 1rem;
                /* Adjust spacing between rows here */
            }

            .form-inline .form-control {
                margin-left: 1rem;
                /* Adjust spacing between label and input */
                width: 100rem;
                /* Prevents form control from stretching too much */
            }

            .form-inline .col-form-label {
                white-space: nowrap;
                /* Prevents label from wrapping */
            }

            .custom-btn {
                width: 500px;
                /* Adjust the width as needed */
                font-size: 1rem;
                /* Adjust the font size as needed */
                /* Adjust padding to make the button larger */
                background: linear-gradient(45deg, #007bff, #0056b3);
                /* Gradient background */
                border: none;
                /* Remove default border */
                border-radius: 20px;
                /* Rounded corners */
                color: white;
                /* Text color */
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                /* Shadow */
                transition: all 0.3s ease;
                /* Smooth transition */
            }

            .custom-btn:hover {
                background: linear-gradient(45deg, #0056b3, #007bff);
                /* Reverse gradient on hover */
                box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
                /* Slightly larger shadow on hover */
                transform: translateY(-2px);
                /* Lift the button slightly */
            }
        </style>



        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif


        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="search-container">
                    <select id="studentDropdown" class="form-control" onchange="fetchStudentDetails()">
                        <option value="">Select Student ID</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->student_id }}">{{ $student->student_id }}</option>
                        @endforeach
                    </select>

                </div>
            </div>
        </div>



        <div class="row mt-4">
            <div class="col-lg-12 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">PERSONAL PROFILE</h6>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="container mt-4">
                            <div class="row">
                                <div class="col-md-3 image-container">
                                    <img src="{{ $imageUrl }}" alt="Your Image" class="img-fluid">
                                    <a href="{{ route('studentsemester') }}">View Semester
                                        Info</a>
                                </div>


                                <div class="col-md-6 text-container">
                                    <div class="form-inline">
                                        <label for="student_id" class="col-form-label">Student ID</label>
                                        <input class="form-control" name="students_id" id="students_id" type="text"
                                        readonly>
                                    </div>
                                    <div class="form-inline">
                                        <label for="fullname" class="col-form-label">Complete Full Name</label>
                                        <input class="form-control" name="fullname" id="fullname" type="text" readonly>
                                    </div>

                                    <div class="form-inline">
                                        <label for="datebirth" class="col-form-label">Date of Birth</label>
                                        <input class="form-control" name="datebirth" id="datebirth" type="text" readonly>

                                        <label for="gender" class="col-form-label">Gender</label>
                                        <input class="form-control" name="gender" id="gender" type="text" readonly>
                                    </div>
                                    <div class="form-inline">
                                        <label for="reason4" class="col-form-label">Home Address</label>
                                        <input class="form-control" name="address" id="address" type="text" required>
                                    </div>
                                    <div class="form-inline">
                                        <label for="reason5" class="col-form-label">Personal Contact Number</label>
                                        <input class="form-control" name="contact" id="contact" type="text" required>
                                    </div>
                                    <div class="form-inline">
                                        <label for="reason5" class="col-form-label">Email/Gmail</label>
                                        <input class="form-control" name="email" id="email" type="text" required>
                                    </div>
                                    <div class="form-inline">
                                        <label for="reason5" class="col-form-label">What Sports Had You Play In?</label>
                                        <input class="form-control" name="sports" id="sports" type="text" required>
                                    </div>
                                    <div class="form-inline">
                                        <label for="reason5" class="col-form-label">What Technological Skills Are You
                                            Known To Specialize In?</label>
                                        <input class="form-control" name="techskill" id="techskill" type="text" required>
                                    </div>
                                    <div class="form-inline">
                                        <label for="reason5" class="col-form-label">What Is Your Parent's or Guardian's
                                            FullName?</label>
                                        <input class="form-control" name="guardian" id="guardian" type="text"
                                            required>
                                    </div>
                                    <div class="form-inline">
                                        <label for="reason5" class="col-form-label">Parent/Guardian Relationship</label>
                                        <input class="form-control" name="guardianrelation" id="guardianrelation" type="text"
                                            required>
                                    </div>
                                    <div class="form-inline">
                                        <label for="reason5" class="col-form-label">Parent/Guardian Contact
                                            Number</label>
                                        <input class="form-control" name="guardiannum" id="guardiannum" type="text"
                                            required>
                                    </div>
                                    <div class="form-inline">
                                        <label for="reason5" class="col-form-label">Address</label>
                                        <input class="form-control" name="guardianaddress" id="guardianaddress" type="text"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="horizontal dark">

                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">EDUCATIONAL BACKGROUND</h6>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="container mt-4">
                            <div class="row">

                                <div class="col-md-6 text-container ">
                                    <div class="form-inline">
                                        <label for="reason1" class="col-form-label">What is the Name of the Elementary
                                            School Where you Attend?</label>
                                        <input class="form-control" name="elemschool" id="elemschool" type="text"
                                            required>
                                    </div>
                                    <div class="form-inline">
                                        <label for="reason2" class="col-form-label">Have you Received any Highest Awards?
                                        </label>
                                        <input class="form-control" name="award" id="award" type="text"
                                            required>
                                        <label for="reason3" class="col-form-label">Year Graduated</label>
                                        <input class="form-control" name="yrgraduate" id="yrgraduate" type="text"
                                            required>
                                    </div>
                                    <div class="form-inline">
                                        <label for="reason3" class="col-form-label">What is the name of the junior high
                                            school where you attend?</label>
                                        <input class="form-control" name="juniorhigh" id="juniorhigh" type="text"
                                            required>
                                    </div>
                                    <div class="form-inline">
                                        <label for="reason2" class="col-form-label">Have you Received any Highest Awards?
                                        </label>
                                        <input class="form-control" name="juniorhighaward" id="juniorhighaward" type="text"
                                            required>
                                        <label for="reason3" class="col-form-label">Year Graduated</label>
                                        <input class="form-control" name="juniorhighgraduatedyear" id="juniorhighgraduatedyear" type="text"
                                            required>
                                    </div>
                                    <div class="form-inline">
                                        <label for="reason3" class="col-form-label">What is the senior high school name
                                            of your institution?</label>
                                        <input class="form-control" name="seniorhigh" id="seniorhigh" type="text"
                                            required>
                                    </div>
                                    <div class="form-inline">
                                        <label for="reason2" class="col-form-label">Have you Received any Highest Awards?
                                        </label>
                                        <input class="form-control" name="seniorhighaward" id="seniorhighaward" type="text"
                                            required>
                                        <label for="reason3" class="col-form-label">Year Graduated</label>
                                        <input class="form-control" name="seniorhighgradyear" id="seniorhighgradyear" type="text"
                                            required>
                                    </div>
                                    <div class="form-inline">
                                        <label for="reason4" class="col-form-label">Academic Track</label>
                                        <input class="form-control" name="academictrack" id="academictrack" type="text"
                                            required>
                                    </div>
                                    <div class="form-inline">
                                        <label for="reason5" class="col-form-label">TESDA Assessment?</label>
                                        <input class="form-control" name="tesdaAsses" id="tesdaAsses" type="text"
                                            required>
                                        <label for="reason5" class="col-form-label">Year Graduated</label>
                                        <input class="form-control" name="yrGraduated" id="yrGraduated" type="text"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="horizontal dark">
                    <hr class="horizontal dark">

                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">ENTRANCE RESULT</h6>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="container mt-4">
                            <div class="row">

                                <div class="col-md-6 text-container ">
                                    <div class="form-inline">
                                        <label for="reason1" class="col-form-label">What are Courses Did you Select from
                                            the Portal?</label>
                                        <input class="form-control" name="courseselected" id="courseselected" type="text"
                                            required>
                                    </div>
                                    <div class="form-inline">
                                        <label for="reason2" class="col-form-label">General Average on your Report Card?
                                        </label>
                                        <input class="form-control" name="genAve" id="genAve" type="text"
                                            required>
                                    </div>
                                    <div class="form-inline">
                                        <label for="reason3" class="col-form-label">Admissions Test?</label>
                                        <input class="form-control" name="Admissiontest" id="Admissiontest" type="text"
                                            required>
                                        <label for="reason3" class="col-form-label">Interview Rating?</label>
                                        <input class="form-control" name="interviewRating" id="interviewRating" type="text"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="horizontal dark">
                    <hr class="horizontal dark">

                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">BOARDING HOUSE INFORMATION</h6>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="container mt-4">
                            <div class="row">

                                <div class="col-md-6 text-container ">
                                    <div class="form-inline">
                                        <label for="reason1" class="col-form-label">Who is your landlord/landlady
                                            (complete name)?</label>
                                        <input class="form-control" name="bhowner" id="bhowner" type="text"
                                            required>
                                    </div>
                                    <div class="form-inline">
                                        <label for="reason2" class="col-form-label">What is the name of your boarding
                                            house?
                                        </label>
                                        <input class="form-control" name="bhname" id="bhname" type="text"
                                            required>
                                    </div>
                                    <div class="form-inline">
                                        <label for="reason2" class="col-form-label">What is the address of your Boarding
                                            House?
                                        </label>
                                        <input class="form-control" name="bhaddress" id="bhaddress" type="text"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="horizontal dark">
                    <hr class="horizontal dark">

                    {{-- <div class="table-responsive">
                        <div class="container mt-4">
                            <div class="row">

                                <div class="col-md-6 text-container">
                                    <div class="form-inline">
                                        <div class="row">
                                            <div class="col-auto">
                                                <button type="button" class="btn btn-primary me-3">Your Button</button>
                                            </div>
                                            <div class="col-auto">
                                                <button type="button" class="btn btn-primary">Your Button</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div> --}}

                    <div class="row mt-4">




                    </div>

                    <script>
                        $(function() {
                            // Set up the autocomplete
                            $('#student_id').autocomplete({
                                source: function(request, response) {
                                    $.ajax({
                                        url: '{{ route('fetchStudentFullName') }}',
                                        type: 'POST',
                                        data: {
                                            student_ID_Number: request.term,
                                            _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                                        },
                                        success: function(data) {
                                            response(data);
                                        },
                                        error: function(xhr, status, error) {
                                            console.log("Error:", error); // Log error for debugging
                                        }
                                    });
                                },
                                minLength: 2,
                                select: function(event, ui) {
                                    $('#fullname').val(ui.item.full_name);
                                    $('#datebirth').val(ui.item.date_of_birth);
                                    $('#gender').val(ui.item.gender);
                                    $('#students_id').val(ui.item.students_id);
                                    $('#gender').val(ui.item.students_id);
                                    $('#students_id').val(ui.item.students_id);
                                    $('#students_id').val(ui.item.students_id);
                                    $('#students_id').val(ui.item.students_id);
                                    $('#students_id').val(ui.item.students_id);
                                    $('#students_id').val(ui.item.students_id);
                                    $('#students_id').val(ui.item.students_id);


                                }
                            });
                        });
                    </script>

                    <script>
                        function fetchStudentDetails() {
                            const studentId = document.getElementById('studentDropdown').value;
                            if (studentId) {
                                const url = `{{ route('fetchStudentDetails', ':studentId') }}`.replace(':studentId', studentId);
                                fetch(url)
                                    .then(response => response.json())
                                    .then(data => {
                                        console.log('AJAX Response:', data); // Add this line to debug
                                        if (data) {
                                            document.getElementById('fullname').value = data.full_name || '';
                                            document.getElementById('datebirth').value = data.date_of_birth || '';
                                            document.getElementById('gender').value = data.gender || '';
                                            document.getElementById('students_id').value = data.students_id || '';
                                        }
                                    })
                                    .catch(error => console.error('Error fetching student details:', error));
                            }
                        }
                    </script>



                </div>
            @endsection('maincontent')
