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
                            <h6 class="col">{{ $name }} : {{ $user->username }} </h6>
                            <a href="{{ route('admin') }}" type="button"
                                class="col btn btn-outline-danger btn-xs float-end">Back</a>
                        </div>


                    </div>
                    <div class="card-body">
                        {{-- <form id="addpermissionform" action="{{ url('permissions') }}" method="POST">
                            @csrf --}}
                        <form id="editpermissionform" action="{{ url('users/' . $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <p class="text-uppercase text-sm">User Information</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email" class="form-control-label">Email</label>
                                        <i class="fa-solid fa-inbox"></i>
                                        <input class="form-control" name="email" id="email" type="email" value="{{ $user->email }}">
                                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="roles" class="form-control-label">Roles</label>
                                        <i class="fa-solid fa-gavel"></i>
                                        <select class="form-select" name="roles[]" class="form-control" id="roles" multiple>
                                            <option value=""> Select Role .. </option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role }}"
                                                    {{ in_array($role, $userRoles) ? 'selected':'' }}
                                                >
                                                    {{ $role }}
                                                </option>
                                            @endforeach
                                        </select>
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

