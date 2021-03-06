@extends('layouts.backend',['active'=>'my_wallet','page'=>'wallet'])

@section('page-title')
<span class="svg-icon svg-icon-white svg-icon-sm">
  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <rect x="0" y="0" width="24" height="24"/>
          <path d="M18,16 L9,16 C8.44771525,16 8,15.5522847 8,15 C8,14.4477153 8.44771525,14 9,14 L17,14 C17.5522847,14 18,13.5522847 18,13 C18,12.4477153 17.5522847,12 17,12 L9,12 C7.34314575,12 6,13.3431458 6,15 C6,16.6568542 7.34314575,18 9,18 L19.5,18 C21,18 21,18.5 21,19 C21,19.5 21,20 19.5,20 L7,20 C4.790861,20 3,18.209139 3,16 L3,8 C3,5.790861 4.790861,4 7,4 L17,4 C19.209139,4 21,5.790861 21,8 L21,13.0000005 C21,14.6568542 19.6568542,16 18,16 Z" fill="#000000"/>
      </g>
  </svg>
</span>
USD Wallet
@endsection
@section('breadcrumb')
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Wallets</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">USD Wallet</a>
  </li>
@endsection

@section('content')
<div class="col bg-primary px-6 py-3 rounded-sm mb-5">
    <span class="svg-icon svg-icon-3x svg-icon-white d-block my-2">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
              <rect x="0" y="0" width="24" height="24"/>
              <path d="M18,16 L9,16 C8.44771525,16 8,15.5522847 8,15 C8,14.4477153 8.44771525,14 9,14 L17,14 C17.5522847,14 18,13.5522847 18,13 C18,12.4477153 17.5522847,12 17,12 L9,12 C7.34314575,12 6,13.3431458 6,15 C6,16.6568542 7.34314575,18 9,18 L19.5,18 C21,18 21,18.5 21,19 C21,19.5 21,20 19.5,20 L7,20 C4.790861,20 3,18.209139 3,16 L3,8 C3,5.790861 4.790861,4 7,4 L17,4 C19.209139,4 21,5.790861 21,8 L21,13.0000005 C21,14.6568542 19.6568542,16 18,16 Z" fill="#000000"/>
          </g>
      </svg>
    </span>
    <span href="#" class="text-white font-weight-bold font-size-h6">USD Wallet <br><i class="fas fa-dollar-sign text-white"></i> {{number_format($saldo,2)}}</span>
    @if(is_null($id))
        <p class="pt-5">
            @role('member')
                <a href="{{route('convert.index')}}" class="btn btn-light-primary mr-3"><i class="flaticon2-hourglass"></i>Convert</a>
            @endrole
        </p>
    @else
        <p class="pt-3 text-white">
            [{{strtoupper($balance->user->username)}}]
        </p>
    @endif
</div>
<div class="card card-custom">
    <div class="card-body">
        <div class="mb-7">
            <div class="row align-items-center">
                <div class="col-lg-12 col-xl-12">
                      @if($id)
                        <form action="{{ route('balance.my_member',$id) }}" method="get">
                      @else
                        <form action="{{ route('balance.my') }}" method="get">
                      @endif
                      <div class="row align-items-center">
                          <div class="col-lg-6 my-2 my-md-0">
                            <input name="from_date" type="text" class="form-control singledate" placeholder="Search From Date">
                          </div>
                          <div class="col-lg-6 my-2 my-md-0">
                            <div class="input-group">
                                <input name="to_date" type="text" class="form-control singledate" placeholder="Search To Date">
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
                      <th>Description</th>
                      <th class="text-center">Type</th>
                      <th class="text-right">Amount (???)</th>
                    </tr>
                </thead>
                <tbody>
                  @if($data->count()>0)
                    @foreach ($data as $h)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{date('d F Y H:i:s', strtotime($h->created_at))}}</td>
                            <td>
                                @if(preg_match('/Sponsor/',$h->description))
                                    {{$h->description}} from {{ucfirst($h->from->username)}}
                                @else
                                    {{$h->description}}
                                @endif
                            </td>
                            <td class="text-center">
                              @if($h->type == 'IN')
                                  <span class="label label-success">IN</span>
                              @else
                                  <span class="label label-danger">OUT</span>
                              @endif
                            </td>
                            <td class="text-right">
                                {{number_format($h->amount,2)}}
                            </td>
                        </tr>
                    @endforeach
                  @else
                      <tr>
                        <td colspan="5" class="text-center">No data available in table</td>
                      </tr>
                  @endif
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="4">Total</td>
                    <td class="text-right">{{number_format($total,2)}}</td>
                  </tr>
                </tfoot>
            </table>
            {!! $data->appends(['from_date'=>$from_date,'to_date'=>$to_date])->render() !!}
        </div>
        <!--end: Datatable-->
    </div>
</div>
@endsection
