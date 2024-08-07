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

            .welcome-container {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100%;
                /* Ensure it takes the full height of its container */
            }

            .welcome-text {
                font-size: 3rem;
                /* Adjust font size as needed */
                font-weight: bold;
                /* Adjust font weight as needed */
                text-align: center;
                color: #000;
                /* Dark black color */
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

        <!-- Alerts -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif (session('updated'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong>{{ session('updated') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session('removed'))
            <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                <strong>{{ session('removed') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session('deleted'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session('deleted') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

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
                <div class="card position-relative">
                    <div class="table-responsive">
                        <div class="container mt-4">
                            <div class="row">
                                <div class="col-md-12 welcome-container">
                                    <div class="welcome-text">
                                        Welcome
                                    </div>
                                </div>
                                <div class="col-md-12 welcome-container">
                                    <div class="welcome-text">
                                        {{ auth()->user()->name }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Button container -->
                        <div class="position-absolute bottom-0 end-0 p-3">
                            <button type="button" class="btn btn-primary">Your Button</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    @endsection('maincontent')
