@extends('layouts.backend',['active'=>$role,'page'=>'users'])
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
List {{ucfirst($role)}}
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">User</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">List {{ucfirst($role)}}</a>
  </li>
@endsection

@section('content')
@include('layouts.partials.alert')
<div class="card card-custom">
    <div class="card-body">
        <div class="mb-7">
            <div class="row align-items-center">
                <div class="col-lg-12 col-xl-12">
                    <div class="row align-items-center">
                        <div class="col-md-8 my-2 my-md-0"></div>
                        <div class="col-md-4 my-2 my-md-0">
                            <form action="{{ route('user.list_user',$role) }}" method="get" id="form-search">
                              <div class="input-group">
                                  <input name="search" type="text" class="form-control" placeholder="Search">
                                  <div class="input-group-append">
                                      <button class="btn btn-warning" type="submit"><i class="flaticon2-search-1 text-white"></i></button>
                                  </div>
                              </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                <thead>
                    <tr class="text-left text-uppercase">
                      <th width="3%">#</th>
                      <th>Username</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone Number</th>
                      <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                  @if($data->count()>0)
                      @foreach ($data as $h)
                          <tr>
                              <td>{{++$i}}</td>
                              <td>{{ucfirst($h->username)}}</td>
                              <td>{{ucfirst($h->name)}}</td>
                              <td>{{$h->email}}</td>
                              <td>{{$h->phone_number}}</td>
                              <td class="text-center">
                                  <a href="{{ route('user.edit', $h->id) }}" class="btn btn-sm btn-light-info">Edit</a>
                                  <a href="#" data-target="#bd-user-modal-lg" data-toggle="modal" class="btn btn-sm btn-light-primary call_modal_user"
                                    data-sponsor="{{($h->parent)? $h->parent->username: '-'}}"
                                    data-username="{{$h->username}}"
                                    data-name="{{$h->name}}"
                                    data-email="{{$h->email}}"
                                    data-phone_number="{{$h->phone_number}}"
                                    data-date="{{$h->created_at}}"
                                    data-reg="{{number_format($h->balance->where('description','Register Wallet')->first()->balance,2)}}"
                                    data-active="{{number_format($h->balance->where('description','USD Wallet')->first()->balance,2)}}"
                                    data-pasif="{{number_format($h->balance->where('description','Trustme Coin')->first()->balance,2)}}">Detail</a>
                                  <a href="{{ route('user.list_donwline_user', $h->id) }}" class="btn btn-sm btn-light-success">View Downline</a>
                                  <a href="{{ route('user.block_unclock', $h->id) }}" class="btn btn-sm btn-light-{{($h->status == 1 || $h->status == 0)?'danger':'success'}}">{{($h->status == 1 || $h->status == 0)?'Block':'Unblock'}}</a>
                              </td>
                          </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="6" class="text-center">No data available in table</td>
                      </tr>
                  @endif
                </tbody>
            </table>
            {!! $data->appends(['search'=>$search])->render() !!}
        </div>
        <!--end: Datatable-->
    </div>
</div>
@include('backend.users.modal_detail_user')
@endsection
@section('script')
<script type="text/javascript">
  function submit() {
    $("#form-search").submit();
  }

  $(function(){
    $('.call_modal_user').on('click',function(){
      $('#modal_user_sponsor').html($(this).data('sponsor'));
      $('#modal_user_username').html($(this).data('username'));
      $('#modal_user_name').html($(this).data('name'));
      $('#modal_user_email').html($(this).data('email'));
      $('#modal_user_date').html($(this).data('date'));
      $('#modal_user_active').html($(this).data('active'));
      $('#modal_user_pasif').html($(this).data('pasif'));
      $('#modal_user_reg').html($(this).data('reg'));
      $('#modal_user_phone_number').html($(this).data('phone_number'));
    });
  });
</script>
@endsection
