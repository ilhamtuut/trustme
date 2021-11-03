@extends('layouts.backend',['active'=>'list_bank','page'=>'account'])

@section('page-title')
<span class="svg-icon svg-icon-white svg-icon-sm">
  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <rect x="0" y="0" width="24" height="24"/>
          <rect fill="#000000" opacity="0.3" x="2" y="4" width="20" height="5" rx="1"/>
          <path d="M5,7 L8,7 L8,21 L7,21 C5.8954305,21 5,20.1045695 5,19 L5,7 Z M19,7 L19,19 C19,20.1045695 18.1045695,21 17,21 L11,21 L11,7 L19,7 Z" fill="#000000"/>
      </g>
  </svg>
</span>
List Bank Members
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
      <a href="#" class="text-white text-hover-dark">List Bank Members</a>
  </li>
@endsection

@section('content')
<div class="card card-custom">
    <div class="card-body">
        <div class="mb-7">
            <div class="row align-items-center">
                <div class="col-lg-12 col-xl-12">
                    <form action="{{ route('bank.list') }}" method="get">
                      <div class="row align-items-center">
                          <div class="col-lg-8 my-2 my-md-0">
                          </div>
                          <div class="col-lg-4 my-2 my-md-0">
                            <div class="input-group">
                                <input name="search" type="text" class="form-control" placeholder="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="submit"><i class="flaticon2-search-1 text-white"></i></button>
                                </div>
                            </div>
                          </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                <thead>
                    <tr class="text-left text-uppercase">
                      <th width="3%">#</th>
                      <th>Username</th>
                      <th>Bank Name</th>
                      <th>Bank Account</th>
                      <th>Bank Username</th>
                      <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                  @if($data->count()>0)
                      @foreach ($data as $key => $h)
                          <tr>
                            <td>{{++$i}}</td>
                            <td>{{ucfirst($h->user->username)}}</td>
                            <td>{{$h->bank->name}} {{$h->bank->code}}</td>
                            <td>{{$h->account}}</td>
                            <td>{{strtoupper($h->username)}}</td>
                            <td class="text-center">
                              @if($h->status)
                                <span class="label label-lg label-light-success label-inline">Active</span>
                              @else
                                <span class="label label-lg label-light-danger label-inline">Non Active</span>
                              @endif
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
            {!! $data->render() !!}
        </div>
        <!--end: Datatable-->
    </div>
</div>
@endsection
