@extends('layouts.backend',['active'=>'index','page'=>'users'])
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
Create User
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">User</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Create</a>
  </li>
@endsection

@section('content')
@include('layouts.partials.alert')
<div class="card card-custom">
    <div class="card-header bg-warning">
        <h3 class="card-title text-white"><i class="fa fa-pencil"></i> Form Input</h3>
      </div>
    <div class="card-body">
        <form class="form-horizontal" action="{{route('user.create')}}" method="POST">
            {{ csrf_field() }}
            <div class="form-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-form-label text-right col-md-3">Sponsor</label>
                                <div class="col-md-9">
                                    <input id="sponsor_user" type="text" name="sponsor" class="form-control {{ $errors->has('sponsor') ? ' is-invalid' : '' }}" placeholder="Sponsor">
                                    <ul class="list-gpfrm" id="hdTuto_search"></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-form-label text-right col-md-3">Username</label>
                                <div class="col-md-9">
                                    <input type="text" name="username" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" placeholder="Username">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-form-label text-right col-md-3">Name</label>
                                <div class="col-md-9">
                                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-form-label text-right col-md-3">Email</label>
                                <div class="col-md-9">
                                    <input type="text" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-form-label text-right col-md-3">Phone Number</label>
                                <div class="col-md-9">
                                    <input type="text" name="phone_number" class="form-control {{ $errors->has('phone_number') ? ' is-invalid' : '' }}" placeholder="Phone Number">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-form-label text-right col-md-3">Role</label>
                                <div class="col-md-9">
                                    <select name="role" class="form-control select2 {{ $errors->has('role') ? ' is-invalid' : '' }}" style="width: 100%;height: 36px;">
                                        <option value="">Choose</option>
                                        @foreach ($roles as $role)
                                            @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('master_admin') && $role->id == 1 || $role->id == 4)
                                                <option value="{{$role->id}}">{{$role->display_name}}</option>
                                            @elseif(Auth::user()->hasRole('super_admin'))
                                                <option value="{{$role->id}}">{{$role->display_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-form-label text-right col-md-3"> Password</label>
                                <div class="col-md-9">
                                    <input type="password" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-form-label text-right col-md-3"> Security Password</label>
                                <div class="col-md-9">
                                    <input type="password" name="security_password" class="form-control {{ $errors->has('security_password') ? ' is-invalid' : '' }}" placeholder="Security Password">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <button type="submit" class="btn btn-light-success w-100"> <i class="fa fa-pencil"></i> Save</button>
            </div>
        </form>
    </div>
</div>
<style type="text/css">
    #hdTuto_search{
        display: none;
        padding-inline-start: 10px;
    }
    .list-gpfrm-list a{
        text-decoration: none !important;
    }
    .list-gpfrm li{
        color: #fff;
        cursor: pointer;
        padding: 10px;
    }
    .list-gpfrm{
        list-style-type: none;
        background: #40c5bd;
    }
    .list-gpfrm li:hover{
        color: #fff;
        background-color: #40c5bd;
    }
</style>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        $('#sponsor_user').keyup(function(e){
            e.preventDefault();
            if(this.value == ''){
                $('#hdTuto_search').hide();
            }else{
                $.ajax({
                  type: 'GET',
                  url: '{{ route('user.get_user') }}',
                  data: {search : this.value},
                  dataType: 'json',
                  success: function(response){
                    if(response.error){
                    }else{
                      $('#hdTuto_search').show().html(response.data);
                    }
                  }
                });
            }
        });

        $(document).on('click', '.list-gpfrm-list', function(e){
            e.preventDefault();
            $('#hdTuto_search').hide();
            var fullname = $(this).data('fullname');
            var id = $(this).data('id');
            $('#sponsor_user').val(fullname);
        });
    });
</script>
@endsection
