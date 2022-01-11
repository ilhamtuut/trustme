@extends('layouts.backend',['active'=>'history_convert','page'=>'convert'])

@section('page-title')
<i class="flaticon2-hourglass text-white"></i>
History Convert
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Wallets</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">History Convert</a>
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
                            <form action="{{ route('convert.history') }}" method="get" id="form-search">
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
                      <th>Date</th>
                      {{-- <th>Description</th> --}}
                      <th class="text-center">Status</th>
                      <th class="text-right">Amount ($)</th>
                      <th class="text-right">Fee ($)</th>
                      <th class="text-right">Total ($)</th>
                      <th class="text-right">Price ($)</th>
                      <th class="text-right">Recieve (TMC)</th>
                    </tr>
                </thead>
                <tbody>
                  @if($data->count()>0)
                    @foreach ($data as $h)
                      <tr>
                        <td>{{++$i}}</td>
                        <td>{{$h->invoice}}</td>
                        <td>{{date('d F Y H:i:s', strtotime($h->created_at))}}</td>
                        {{-- <td>{{$h->description}}</td> --}}
                        <td class="text-center">
                          @if($h->status == 0)
                            <span class="label label-md label-light-warning label-inline">Pending</span>
                          @elseif($h->status == 1)
                            <span class="label label-md label-light-success label-inline">Success</span>
                          @endif
                        </td>
                        <td class="text-right">{{number_format($h->amount,2)}}</td>
                        <td class="text-right">{{number_format($h->fee,2)}}</td>
                        <td class="text-right">{{number_format($h->total,2)}}</td>
                        <td class="text-right">{{number_format($h->price,2)}}</td>
                        <td class="text-right">{{number_format($h->receive,8)}}</td>
                      </tr>
                      @foreach($h->detail()->get() as $value)
                        <tr>
                          <td colspan="6"></td>
                          <td class="text-right">{{number_format($value->total,2)}}</td>
                          <td class="text-right">{{number_format($value->price,2)}}</td>
                          <td class="text-right">{{number_format($value->receive,8)}}</td>
                        </tr>
                      @endforeach
                    @endforeach
                  @else
                    <tr>
                      <td colspan="9" class="text-center">No data available in table</td>
                    </tr>
                  @endif
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="4">Total</td>
                    <td class="text-right">{{number_format($usd,2)}}</td>
                    <td colspan="3"></td>
                    <td class="text-right">{{number_format($idr,8)}}</td>
                  </tr>
                </tfoot>
            </table>
            {!! $data->render() !!}
        </div>
        <!--end: Datatable-->
    </div>
</div>
@endsection

