@extends('layouts.backend',['active'=>'history_deposit','page'=>'deposit'])

@section('page-title')
<i class="flaticon2-hourglass text-white"></i>
History Deposit
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Wallets</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">History Deposit</a>
  </li>
@endsection

@section('content')
<div class="card card-custom">
    <div class="card-body">
        <div class="mb-7">
            <div class="row align-items-center">
                <div class="col-lg-12 col-xl-12">
                    <div class="row align-items-center">
                        <div class="col-md-8 my-2 my-md-0"></div>
                        <div class="col-md-4 my-2 my-md-0">
                            <form action="{{ route('deposit.history') }}" method="get" id="form-search">
                              <div class="input-group">
                                  <input name="date" type="text" class="form-control singledate" placeholder="Search date">
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
                      <th>Inv</th>
                      <th>TXID</th>
                      <th>Date</th>
                      <th class="text-center">Status</th>
                      <th class="text-right">Amount (TC)</th>
                    </tr>
                </thead>
                <tbody>
                  @if($data->count()>0)
                    @foreach ($data as $h)
                      <tr>
                        <td>{{++$i}}</td>
                        <td>{{$h->invoice}}</td>
                        <td>{{$h->txid}}</td>
                        <td>{{date('d F Y H:i:s', strtotime($h->created_at))}}</td>
                        <td class="text-center">
                            @if($h->status == 0)
                                <span class="label label-md label-light-warning label-inline">Pending</span>
                            @elseif($h->status == 1)
                                <span class="label label-md label-light-success label-inline">Success</span>
                            @elseif($h->status == 2)
                                <span class="label label-md label-light-danger label-inline">Canceled</span>
                            @endif
                        </td>
                        <td class="text-right">{{number_format($h->amount,8)}}</td>
                      </tr>
                    @endforeach
                  @else
                    <tr>
                      <td colspan="6" class="text-center">No data available in table</td>
                    </tr>
                  @endif
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="5">Total</td>
                    <td class="text-right">{{number_format($total,8)}}</td>
                  </tr>
                </tfoot>
            </table>
            {!! $data->render() !!}
        </div>
        <!--end: Datatable-->
    </div>
</div>
@endsection

