@extends('layouts.backend')
@section('page-title')
<span class="svg-icon svg-icon-white svg-icon-sm">
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
        <g id="Stockholm-icons-/-General-/-User" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <polygon id="Shape" points="0 0 24 0 24 24 0 24"></polygon>
          <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" id="Mask" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
          <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" id="Mask-Copy" fill="#000000" fill-rule="nonzero"></path>
        </g>
  </svg>
</span>
Edit User
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">User</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Edit</a>
  </li>
@endsection

@section('content')
@include('layouts.partials.alert')
<div class="card card-custom">
    <div class="card-header bg-warning">
        <h3 class="card-title text-white"><i class="fa fa-edit text-white"></i> Form Edit</h3>
      </div>
    <div class="card-body">
        <form class="form-horizontal" action="{{route('user.updateData',$users->id)}}" method="POST">
            {{ csrf_field() }}
            <div class="form-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-form-label text-right col-md-3">Username</label>
                                <div class="col-md-9">
                                    <input type="text" name="username" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" readonly placeholder="Username" value="{{$users->username}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-form-label text-right col-md-3">Name</label>
                                <div class="col-md-9">
                                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" value="{{$users->name}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-form-label text-right col-md-3">Email</label>
                                <div class="col-md-9">
                                    <input type="text" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" value="{{$users->email}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-form-label text-right col-md-3">Phone Number</label>
                                <div class="col-md-9">
                                    <input type="text" name="phone_number" class="form-control {{ $errors->has('phone_number') ? ' is-invalid' : '' }}" placeholder="Phone Number" value="{{$users->phone_number}}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-form-label text-right col-md-3">Role</label>
                                <div class="col-md-9">
                                    <select name="role" class="form-control select2" style="width: 100%;height: 36px;">
                                        <option>Choose</option>
                                        @foreach ($roles as $role)
                                            @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('master_admin') && $role->id == 1 || $role->id == 4)
                                                <option value="{{$role->id}}"
                                                    @foreach ($users->roles as $r)
                                                        @if ($role->id == $r->id)
                                                            selected
                                                        @endif
                                                    @endforeach
                                                    >{{$role->display_name}}</option>
                                            @elseif(Auth::user()->hasRole('super_admin'))
                                                <option value="{{$role->id}}"
                                                    @foreach ($users->roles as $r)
                                                        @if ($role->id == $r->id)
                                                            selected
                                                        @endif
                                                    @endforeach
                                                    >{{$role->display_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row text-right">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-light-success"> <i class="fa fa-pencil"></i> Save Changes</button>
                        <a href="{{ route('user.list_user',$role_user) }}" class="btn btn-light-danger">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
