@extends('layouts.backend',['active'=>'list','page'=>'bounty'])

@section('page-title')
<span class="svg-icon svg-icon-white svg-icon-sm">
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <polygon points="0 0 24 0 24 24 0 24"/>
          <rect fill="#000000" opacity="0.3" transform="translate(13.000000, 6.000000) rotate(-450.000000) translate(-13.000000, -6.000000) " x="12" y="8.8817842e-16" width="2" height="12" rx="1"/>
          <path d="M9.79289322,3.79289322 C10.1834175,3.40236893 10.8165825,3.40236893 11.2071068,3.79289322 C11.5976311,4.18341751 11.5976311,4.81658249 11.2071068,5.20710678 L8.20710678,8.20710678 C7.81658249,8.59763107 7.18341751,8.59763107 6.79289322,8.20710678 L3.79289322,5.20710678 C3.40236893,4.81658249 3.40236893,4.18341751 3.79289322,3.79289322 C4.18341751,3.40236893 4.81658249,3.40236893 5.20710678,3.79289322 L7.5,6.08578644 L9.79289322,3.79289322 Z" fill="#000000" fill-rule="nonzero" transform="translate(7.500000, 6.000000) rotate(-270.000000) translate(-7.500000, -6.000000) "/>
          <rect fill="#000000" opacity="0.3" transform="translate(11.000000, 18.000000) scale(1, -1) rotate(90.000000) translate(-11.000000, -18.000000) " x="10" y="12" width="2" height="12" rx="1"/>
          <path d="M18.7928932,15.7928932 C19.1834175,15.4023689 19.8165825,15.4023689 20.2071068,15.7928932 C20.5976311,16.1834175 20.5976311,16.8165825 20.2071068,17.2071068 L17.2071068,20.2071068 C16.8165825,20.5976311 16.1834175,20.5976311 15.7928932,20.2071068 L12.7928932,17.2071068 C12.4023689,16.8165825 12.4023689,16.1834175 12.7928932,15.7928932 C13.1834175,15.4023689 13.8165825,15.4023689 14.2071068,15.7928932 L16.5,18.0857864 L18.7928932,15.7928932 Z" fill="#000000" fill-rule="nonzero" transform="translate(16.500000, 18.000000) scale(1, -1) rotate(270.000000) translate(-16.500000, -18.000000) "/>
      </g>
  </svg>
</span>
List Bounty Spartan Coin
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
      <a href="#" class="text-white text-hover-dark">List Bounty Spartan Coin</a>
  </li>
@endsection

@section('content')
@include('layouts.partials.alert')
<div class="card card-custom">
    <div class="card-body">
        <div class="mb-7">
            <div class="row align-items-center">
                <div class="col-lg-12 col-xl-12">
                  <form action="{{ route('bounty.list') }}" method="get" id="form-search">
                    <div class="row align-items-center">
                        <div class="col-lg-3 my-2 my-md-0">
                          <input name="from_date" type="text" class="form-control singledate" placeholder="Search From Date">
                        </div>
                        <div class="col-lg-3 my-2 my-md-0">
                          <input name="to_date" type="text" class="form-control singledate" placeholder="Search To Date">
                        </div>
                        <div class="col-lg-3 my-2 my-md-0">
                          <select name="choose" class="form-control select2" style="width: 100%;">
                            <option value="">Choose Status</option>
                            <option @if($choose == 1) selected @endif value="1">On Process</option>
                            <option @if($choose == 2) selected @endif value="2">Completed</option>
                          </select>
                        </div>
                        <div class="col-lg-3 my-2 my-md-0">
                          <div class="input-group">
                              <input name="search" type="text" class="form-control" placeholder="Search">
                              <div class="input-group-append">
                                  <button class="btn btn-warning" type="submit"><i class="flaticon2-search-1 text-white"></i></button>
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
                      <th>Date</th>
                      <th>Inv</th>
                      <th>Username</th>
                      <th>Expired Date</th>
                      <th class="text-center">Status</th>
                      <th class="text-right">Amount (TMC)</th>
                      <th class="text-right">Rate</th>
                      <th class="text-right">Total (SPARTAN)</th>
                    </tr>
                </thead>
                <tbody>
                  @if($data->count()>0)
                      @foreach ($data as $h)
                        <tr>
                          <td>{{++$i}}</td>
                          <td>{{date('d F Y H:i:s', strtotime($h->created_at))}}</td>
                          <td>{{$h->invoice}}</td>
                          <td>{{ucfirst($h->user->username)}}</td>
                          <td>{{date('d F Y', strtotime($h->expired_at))}}</td>
                          <td class="text-center">
                            @if($h->status == 0)
                              <span class="label label-md label-light-warning label-inline">On Process</span>
                            @elseif($h->status == 1)
                              <span class="label label-md label-light-success label-inline">Completed</span>
                            @endif
                          </td>
                          <td class="text-right">{{number_format($h->amount,8)}}</td>
                          <td class="text-right">{{number_format($h->rate,8)}}</td>
                          <td class="text-right">{{number_format($h->total,8)}}</td>
                        </tr>
                      @endforeach
                  @else
                    <tr>
                      <td colspan="9" class="text-center">No data available in table</td>
                    </tr>
                  @endif
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="6">Total</td>
                    <td class="text-right">{{number_format($amount,8)}}</td>
                    <td></td>
                    <td class="text-right">{{number_format($total,8)}}</td>
                  </tr>
                </tfoot>
            </table>
            {!! $data->appends(['from_date'=>$from_date,'to_date'=>$to_date,'search'=>$search,'choose'=>$choose])->render() !!}
        </div>
        <!--end: Datatable-->
    </div>
</div>
@endsection
