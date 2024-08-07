@extends('backend.master_template')

@section('maincontent')
    <div class="container-fluid py-4">
        <div class="row">

            @can('purchased material report')
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card mb-4" style="width: 250; height: 140px;">
                        <div class="card-body p-3">

                            <form action="{{ route('exportpurchasedmaterial') }}" method="GET">
                                @csrf
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold mb-2">
                                                Purchased Material Report
                                            </p>
                                            <h5 class="font-weight-bolder">
                                                <select name="exportformat" id="exportformat" class="form-select form-select-sm"
                                                    aria-label=".form-select-sm example">
                                                    <option selected>Export format ..</option>
                                                    <option value="xlsx">.xlsx</option>
                                                    <option value="xls">.xls</option>
                                                    <option value="csv">.csv</option>
                                                </select>
                                            </h5>
                                            {{-- <p class="mb-0">
                                                <span class="text-success text-sm font-weight-bolder">+55%</span>
                                                since yesterday
                                            </p> --}}
                                        </div>
                                    </div>
                                    <div class="col-4 text-end ml-2">
                                        <button type="submit" class="btn btn-success">Export</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endcan

            @can('drivers report')
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card mb-4" style="width: 250; height: 140px;">
                        <div class="card-body p-3">
                            <form action="{{ route('exportdriver') }}" method="GET">
                                @csrf
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold mb-2">
                                                Drivers Report
                                            </p>
                                            <h5 class="font-weight-bolder">
                                                <select name="exportformat" id="exportformat" class="form-select form-select-sm"
                                                    aria-label=".form-select-sm example">
                                                    <option selected>Export format ..</option>
                                                    <option value="xlsx">.xlsx</option>
                                                    <option value="xls">.xls</option>
                                                    <option value="csv">.csv</option>
                                                </select>
                                            </h5>
                                            {{-- <p class="mb-0">
                                                <span class="text-success text-sm font-weight-bolder">+55%</span>
                                                since yesterday
                                            </p> --}}
                                        </div>
                                    </div>
                                    <div class="col-4 text-end ml-2">
                                        <button type="submit" class="btn btn-success">Export</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            @endcan

            @can('vehicles report')
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card mb-4" style="width: 250; height: 140px;">
                        <div class="card-body p-3">

                            <form action="{{ route('exportvehicle') }}" method="GET">
                                @csrf
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold mb-2">
                                                Vehicles Report
                                            </p>
                                            <h5 class="font-weight-bolder">
                                                <select name="exportformat" id="exportformat" class="form-select form-select-sm"
                                                    aria-label=".form-select-sm example">
                                                    <option selected>Export format ..</option>
                                                    <option value="xlsx">.xlsx</option>
                                                    <option value="xls">.xls</option>
                                                    <option value="csv">.csv</option>
                                                </select>
                                            </h5>
                                            {{-- <p class="mb-0">
                                                <span class="text-success text-sm font-weight-bolder">+55%</span>
                                                since yesterday
                                            </p> --}}
                                        </div>
                                    </div>
                                    <div class="col-4 text-end ml-2">
                                        <button type="submit" class="btn btn-success">Export</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endcan

            @can('labors report')
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card mb-4" style="width: 250; height: 140px;">
                        <div class="card-body p-3">

                            <form action="{{ route('exportlabortxn') }}" method="GET">
                                @csrf
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold mb-2">
                                                Labor Transactions Report
                                            </p>
                                            <h5 class="font-weight-bolder">
                                                <select name="exportformat" id="exportformat" class="form-select form-select-sm"
                                                    aria-label=".form-select-sm example">
                                                    <option selected>Export format ..</option>
                                                    <option value="xlsx">.xlsx</option>
                                                    <option value="xls">.xls</option>
                                                    <option value="csv">.csv</option>
                                                </select>
                                            </h5>
                                            {{-- <p class="mb-0">
                                                <span class="text-success text-sm font-weight-bolder">+55%</span>
                                                since yesterday
                                            </p> --}}
                                        </div>
                                    </div>
                                    <div class="col-4 text-end ml-2">
                                        <button type="submit" class="btn btn-success">Export</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endcan

            @can('replacements report')
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card mb-4" style="width: 250; height: 140px;">
                        <div class="card-body p-3">

                            <form action="{{ route('exportreplacementtxn') }}" method="GET">
                                @csrf
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold mb-2">
                                                Parts Replacement Transaction Report
                                            </p>
                                            <h5 class="font-weight-bolder">
                                                <select name="exportformat" id="exportformat" class="form-select form-select-sm"
                                                    aria-label=".form-select-sm example">
                                                    <option selected>Export format ..</option>
                                                    <option value="xlsx">.xlsx</option>
                                                    <option value="xls">.xls</option>
                                                    <option value="csv">.csv</option>
                                                </select>
                                            </h5>
                                            {{-- <p class="mb-0">
                                                <span class="text-success text-sm font-weight-bolder">+55%</span>
                                                since yesterday
                                            </p> --}}
                                        </div>
                                    </div>
                                    <div class="col-4 text-end ml-2">
                                        <button type="submit" class="btn btn-success">Export</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endcan


            @can('fuel requisition report')
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card mb-4" style="width: 250; height: 140px;">
                        <div class="card-body p-3">

                            <form action="{{ route('exportfuelrequisition') }}" method="GET">
                                @csrf
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold mb-2">
                                                Fuel Requisition Report
                                            </p>
                                            <h5 class="font-weight-bolder">
                                                <select name="exportformat" id="exportformat"
                                                    class="form-select form-select-sm" aria-label=".form-select-sm example">
                                                    <option selected>Export format ..</option>
                                                    <option value="xlsx">.xlsx</option>
                                                    <option value="xls">.xls</option>
                                                    <option value="csv">.csv</option>
                                                </select>
                                            </h5>
                                            {{-- <p class="mb-0">
                                                <span class="text-success text-sm font-weight-bolder">+55%</span>
                                                since yesterday
                                            </p> --}}
                                        </div>
                                    </div>
                                    <div class="col-4 text-end ml-2">
                                        <button type="submit" class="btn btn-success">Export</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endcan

        </div>
    </div>
@endsection('maincontent')
