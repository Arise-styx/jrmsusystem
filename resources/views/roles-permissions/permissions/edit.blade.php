@extends('backend.master_template')

@section('maincontent')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">

                <!-- Alerts -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
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

                <div class="card">
                    <div class="card-header pb-0">
                        <div class="row">
                            <h6 class="col">{{ $name }}</h6>
                            <a href="{{ route('admin') }}" type="button"
                                class="col btn btn-outline-danger btn-xs float-end">Back</a>
                        </div>


                    </div>
                    <div class="card-body">
                        {{-- <form id="addpermissionform" action="{{ url('permissions') }}" method="POST">
                            @csrf --}}
                        <form id="editpermissionform" action="{{ url('permissions/' . $permission->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <p class="text-uppercase text-sm">Permission Information</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name" class="form-control-label">Permission Name</label>
                                        <i class="fa-solid fa-gavel"></i>
                                        <input class="form-control" name="name" id="name" type="text" value="{{ $permission->name }}">

                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <button class="btn btn-outline-primary text-center" type="submit">
                                Update
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection('maincontent')


{{-- <x-app-layout>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

                @if ($errors->any())
                <ul class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4>Edit Permission
                            <a href="{{ url('permissions') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('permissions/'.$permission->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="">Permission Name</label>
                                <input type="text" name="name" value="{{ $permission->name }}" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout> --}}
