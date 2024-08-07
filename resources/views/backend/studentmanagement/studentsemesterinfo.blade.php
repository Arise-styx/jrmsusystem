@extends('backend.master_template')

@section('maincontent')
    <div class="container-fluid py-4">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">



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





        <div class="row mt-4">
            <div class="col-lg-12 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">LAST SEMESTER ENROLLED</h6>
                            <a style="margin: 10px;" href="{{ route('studentdashboard') }}" type="button"
                                class="btn btn-md btn-outline-warning">
                                <i class="fa-solid fa-left-long m-1"></i>
                                BACK
                            </a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <div class="container mt-4">
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-striped table-bordered shadow-sm">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Units</th>
                                                <th>M-Grade</th>
                                                <th>1st</th>
                                                <th>2nd</th>
                                                <th>3rd</th>
                                                <th>4th</th>

                                                <th>Course No.</th>
                                                <th>Descriptive Title</th>
                                                <th>Units</th>
                                                <th>Pre-Requisite/Co-Requisite</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>

                                            </tr>
                                            <tr>

                                            </tr>
                                            <tr>
                                                <td colspan="2" class="text-end fw-bold text-center">GPA</td>
                                            </tr>
                                            <!-- Add more rows as needed -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="row mt-4">




                    </div>
                </div>
            @endsection('maincontent')
