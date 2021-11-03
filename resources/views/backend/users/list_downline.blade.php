@extends('layouts.backend',['active' => 'members','page'=>'team'])

@section('page-title')
<span class="svg-icon svg-icon-white svg-icon-sm">
    <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
      <g id="Stockholm-icons-/-Communication-/-Group" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <polygon id="Shape" points="0 0 24 0 24 24 0 24"></polygon>
          <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
          <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero"></path>
      </g>
    </svg>
</span>
My Team
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Membership</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">My Team</a>
  </li>
@endsection

@section('content')
<div class="card card-custom">
    <div class="card-body">
        <!--begin: Search Form-->
        <!--begin::Search Form-->
        <div class="mb-7">
            <div class="row align-items-center">
                <div class="col-lg-12 col-xl-12">
                    <div class="row align-items-center">
                        <div class="col-md-8 my-2 my-md-0">
                            <h3>
                                @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('super_admin'))
                                    <a class="text-warning" href="{{ (Auth::user()->id == $id) ? '#' : route('user.list_donwline_user',\App\User::where('id',$id)->first()->parent->id) }}"><i style="font-size: 20px;" class="fas fa-user-alt text-warning"></i> {{ucfirst($username)}}</a>
                                @else
                                    <a class="text-warning" href="{{ (Auth::user()->id == $id) ? '#' : route('user.list_donwline_user',\App\User::where('id',$id)->first()->parent->id) }}"><i style="font-size: 20px;" class="fas fa-user-alt text-warning"></i> {{ucfirst($username)}}</a>
                                @endif
                            </h3>
                        </div>
                        <div class="col-md-4 my-2 my-md-0">
                            @if($id)
                                <form action="{{ route('user.list_donwline_user',$id) }}" method="get" id="form-search">
                            @else
                                <form action="{{ route('user.list_donwline') }}" method="get" id="form-search">
                            @endif
                                <div class="input-group">
                                    <input name="search" type="text" class="form-control" placeholder="Search for...">
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
        <!--end::Search Form-->
        <!--end: Search Form-->
        <!--begin: Datatable-->
        <div class="table-responsive">
            <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                <thead>
                    <tr class="text-left text-uppercase">
                        <th>#</th>
                        <th>username</th>
                        <th>name</th>
                        <th>email</th>
                        <th>Phone Number</th>
                        <th class="text-right">Invest ($)</th>
                        <th class="text-right">Omset ($)</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; $omset = 0; @endphp
                    @if($data->count()>0)
                        @foreach ($data as $h)
                            @php
                                $omset += $h->omset();
                                $total += $h->program()->where('registered_by','!=',0)->sum('amount');
                            @endphp
                            <tr>
                                <td>{{++$i}}</td>
                                <td><a class="text-hover-success" href="{{route('user.list_donwline_user',$h->id)}}">{{ucfirst($h->username)}}</a></td>
                                <td>{{ucfirst($h->name)}}</td>
                                <td>{{($h->email)}}</td>
                                <td>{{($h->phone_number)}}</td>
                                <td class="text-right">{{(number_format($h->program()->where('registered_by','!=',0)->sum('amount'),2))}}</td>
                                <td class="text-right">{{number_format($h->omset(),2)}}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                          <td colspan="7" class="text-center">No data available in table</td>
                        </tr>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                      <td colspan="5">Total</td>
                      <td class="text-right">{{number_format($total,2)}}</td>
                      <td class="text-right">{{number_format($omset,2)}}</td>
                    </tr>
                  </tfoot>
            </table>
            {!! $data->render() !!}
        </div>
        <!--end: Datatable-->
    </div>
</div>
@endsection
