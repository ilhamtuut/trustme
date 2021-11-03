@extends('layouts.backend',['active'=>'harvest_wallet','page'=>'wallet'])

@section('page-title')
<span class="svg-icon svg-icon-white svg-icon-sm">
  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <rect x="0" y="0" width="24" height="24"/>
          <circle fill="#000000" cx="12" cy="12" r="8"/>
      </g>
  </svg>
</span>
Trustme Coin
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Wallets</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Trustme Coin</a>
  </li>
@endsection

@section('content')
<div class="col bg-warning px-6 py-3 rounded-sm mb-5">
  <span class="svg-icon svg-icon-3x svg-icon-white d-block my-2">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <rect x="0" y="0" width="24" height="24"/>
            <circle fill="#000000" cx="12" cy="12" r="8"/>
        </g>
    </svg>
  </span>
  <span href="#" class="text-white font-weight-bold font-size-h6 mt-2">Trustme Coin <br><i class="fas fa-circle text-white"></i> {{number_format($saldo,8)}}</span>
    @if(is_null($id))
    <p class="pt-5">
      <a href="{{route('transfer.wallet','trustme_coin')}}" class="btn btn-light-warning mr-3">
      <i class="far fa-share-square"></i>Transfer</a>
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
                        <form action="{{ route('balance.harvest_member',$id) }}" method="get">
                      @else
                        <form action="{{ route('balance.harvest') }}" method="get">
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
                      <th class="text-right">Amount</th>
                    </tr>
                </thead>
                <tbody>
                  @if($data->count()>0)
                    @foreach ($data as $h)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{date('d F Y H:i:s', strtotime($h->created_at))}}</td>
                            <td>
                                @if(preg_match('/Transfer/',$h->description))
                                  @if($h->type == 'OUT')
                                    {{$h->description}} to {{ucfirst($h->to->username)}}
                                  @else
                                    {{$h->description}} from {{ucfirst($h->from->username)}}
                                  @endif
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
                                {{number_format($h->amount,8)}}
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
                    <td class="text-right">{{number_format($total,8)}}</td>
                  </tr>
                </tfoot>
            </table>
            {!! $data->appends(['from_date'=>$from_date,'to_date'=>$to_date])->render() !!}
        </div>
        <!--end: Datatable-->
    </div>
</div>
@endsection
