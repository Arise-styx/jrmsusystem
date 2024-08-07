@extends('backend.master_template')

@section('maincontent')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="row">
                            <h6 class="col">{{ $name }}</h6>
                            <a href="{{ route('addmaterialpage') }}" type="button" class="col btn btn-outline-primary btn-xs float-end">Add</a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">

                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Requisitioner
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Material Code
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Description
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Brand
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Model #
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Supplier
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Amount
                                        </th>
                                        <th class="text-secondary opacity-7"></th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($purchases as $purchase)
                                        <tr>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $purchase->requisitioner }}</h6>
                                                    {{-- <p class="text-xs text-secondary mb-0">john@creative-tim.com</p> --}}
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <p class="text-xs font-weight-bold mb-0">Manager</p>
                                            <p class="text-xs text-secondary mb-0">Organization</p> --}}
                                                <p class="text-xs font-weight-bold mb-0">{{ $purchase->material_code }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{-- <span class="badge badge-sm bg-gradient-success">Online</span> --}}
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $purchase->material_description }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                {{-- <span class="text-secondary text-xs font-weight-bold">23/04/18</span> --}}
                                                <p class="text-xs font-weight-bold mb-0">{{ $purchase->brand }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                {{-- <span class="text-secondary text-xs font-weight-bold">23/04/18</span> --}}
                                                <p class="text-xs font-weight-bold mb-0">{{ $purchase->model_no }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                {{-- <span class="text-secondary text-xs font-weight-bold">23/04/18</span> --}}
                                                <p class="text-xs font-weight-bold mb-0">{{ $purchase->supplier }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                {{-- <span class="text-secondary text-xs font-weight-bold">23/04/18</span> --}}
                                                <p class="text-xs font-weight-bold mb-0">{{ $purchase->amount }}</p>
                                            </td>

                                            {{-- <a href="{{ url('/pizza/edit/'.$pizza->id) }}" class="btn btn-primary">Edit</a>
                                        <a href="{{ url('/pizza/delete/'.$pizza->id) }}" class="btn btn-outline-danger" onclick="return confirm('Are you sure to delete this Item?')">Delete</a> --}}

                                            <td class="align-middle">
                                                <a href="{{ url('/admin/material/edit/'.$purchase->id) }}" class="text-info font-weight-bold text-xs"
                                                    data-toggle="tooltip" data-original-title="Edit Material">
                                                    Edit
                                                </a>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ url('/admin/material/delete/'.$purchase->id) }}" class="text-danger font-weight-bold text-xs" onclick="return confirm('Are you sure to delete this Item?')" data-toggle="tooltip" data-original-title="Delete Material">
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>
@endsection('maincontent')
