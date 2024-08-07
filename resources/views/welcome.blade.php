@extends('master_template')
@section('maincontent')
    <div class="form-detail">

        @if (session('success'))
            <div class="alert alert-info alert-dismissible fade show mb-2" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form id="reportform" action="{{ route('generatereport') }}" method="get">
            @csrf
            <button type="button" class="btn btn-outline-primary float-start" data-bs-toggle="modal"
                data-bs-target="#reportmodal">
                Generate Report
            </button>

            <!-- Modal -->
            <div class="modal fade" id="reportmodal" tabindex="-1" aria-labelledby="reportmodallabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="reportmodallabel">Select Date</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>
                                <strong>Month:</strong>
                                <select class="form-select" id="month-dropdown" name="month"
                                    aria-label="Default select example">
                                    @for ($month = 1; $month <= 12; $month++)
                                        <option value="{{ $month }}">
                                            {{ DateTime::createFromFormat('!m', $month)->format('F') }}</option>
                                    @endfor
                                </select>
                            </p>
                            <p class="mt-2">
                                <strong>Year:</strong>
                                <select class="form-select" id="year-dropdown" name="year"
                                    aria-label="Default select example">
                                    <!-- Dynamically Added Year in Javascript Below -->
                                </select>
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="sumbit" class="btn btn-primary">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form id="logoutform" action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-outline-danger float-end">Log out</button>
        </form>

    </div>

    <form id="addpurchaseform" class="form-detail" action="{{ route('addpurchase') }}" method="post">
        @csrf
        <h2>Add Purchased Material</h2>
        <div class="form-row">
            <label for="requisitioner">Requisitioner</label>
            <input type="text" name="requisitioner" id="requisitioner" class="input-text" placeholder="Requisitioner"
                required>
            <i class="input-icon fas fa-user"></i>
        </div>
        <div class="form-row">
            <label for="material_code">Material Code</label>
            <input type="text" name="material_code" id="material_code" class="input-text" placeholder="Material Code">
            <i class="input-icon fa-solid fa-laptop-code"></i>
        </div>
        <div class="form-row">
            <label for="material_description">Material Description</label>
            <input type="text" name="material_description" id="material_description" class="input-text" placeholder="Material Description" required>
            <i class="input-icon fa-solid fa-file"></i>
        </div>
        <div class="form-row">
            <label for="brand">Brand</label>
            <input type="text" name="brand" id="brand" class="input-text" placeholder="Brand" required>
            <i class="input-icon fa-solid fa-file"></i>
        </div>
        <div class="form-row">
            <label for="model_no">Model Number</label>
            <input type="text" name="model_no" id="model_no" class="input-text" placeholder="Model Number">
            <i class="input-icon fa-solid fa-hashtag"></i>
        </div>
        <div class="form-row">
            <label for="serial_no">Serial Number</label>
            <input type="text" name="serial_no" id="serial_no" class="input-text" placeholder="Serial Number">
            <i class="input-icon fa-solid fa-hashtag"></i>
        </div>
        <div class="form-row">
            <label for="supplier">Supplier</label>
            <input type="text" name="supplier" id="supplier" class="input-text" placeholder="Supplier">
            <i class="input-icon fa-solid fa-truck-field"></i>
        </div>
        <div class="form-row">
            <label for="amount">Amount</label>
            <input type="number" step="0.01" name="amount" id="amount" class="input-text" placeholder="Amount">
            <i class="input-icon fa-solid fa-money-bills"></i>
        </div>
        <div class="form-row">
            <label for="date_of_purchase">Date of Purchase</label>
            <input type="date" name="date_of_purchase" id="date_of_purchase" class="input-text"
                placeholder="Date of Purchase">
        </div>
        <div class="form-row">
            <label for="date_of_delivery">Date of Delivery</label>
            <input type="date" name="date_of_delivery" id="date_of_delivery" class="input-text"
                placeholder="Date of Purchase" required>
        </div>
        <div class="form-row">
            <label for="issued_to">Issued to</label>
            <input type="text" name="issued_to" id="issued_to" class="input-text" placeholder="Issued to">
            <i class="input-icon fa-solid fa-passport"></i>
        </div>
        <div class="form-row">
            <label for="purpose">Purpose</label>
            <input type="text" name="purpose" id="purpose" class="input-text" placeholder="Purpose">
            <i class="input-icon fa-solid fa-passport"></i>
        </div>
        <div class="form-row">
            <label for="remarks">Remarks</label>
            {{-- <input type="textarea" name="remarks" id="remarks" class="input-text" placeholder="Remarks"> --}}
            <textarea name="remarks" id="remarks" class="input-text form-control" placeholder="Remarks"></textarea>
            <i class="input-icon fa-solid fa-circle-question"></i>
        </div>
        <div class="form-row-last">
            <button type="submit" name="submit_button" class="btn btn-lg btn-info">Submit</button>
        </div>
    </form>


    <script>
        let dateDropdown = document.getElementById('year-dropdown');

        let currentYear = new Date().getFullYear();
        let earliestYear = 1970;
        while (currentYear >= earliestYear) {
            let dateOption = document.createElement('option');
            dateOption.text = currentYear;
            dateOption.value = currentYear;
            dateDropdown.add(dateOption);
            currentYear -= 1;
        }
    </script>

@endsection('maincontent')
