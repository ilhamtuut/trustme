@extends('layouts.backend',['active'=>'list_convert','page'=>'convert'])

@section('page-title')
<span class="svg-icon svg-icon-white svg-icon-sm">
  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
      <rect x="0" y="0" width="24" height="24"></rect>
      <path d="M5.5,4 L9.5,4 C10.3284271,4 11,4.67157288 11,5.5 L11,6.5 C11,7.32842712 10.3284271,8 9.5,8 L5.5,8 C4.67157288,8 4,7.32842712 4,6.5 L4,5.5 C4,4.67157288 4.67157288,4 5.5,4 Z M14.5,16 L18.5,16 C19.3284271,16 20,16.6715729 20,17.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,17.5 C13,16.6715729 13.6715729,16 14.5,16 Z" fill="#000000"></path>
      <path d="M5.5,10 L9.5,10 C10.3284271,10 11,10.6715729 11,11.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,12.5 C20,13.3284271 19.3284271,14 18.5,14 L14.5,14 C13.6715729,14 13,13.3284271 13,12.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z" fill="#000000" opacity="0.3"></path>
    </g>
  </svg>
</span>
List Convert
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
      <a href="#" class="text-white text-hover-dark">List Convert</a>
  </li>
@endsection

@section('content')
<div class="card card-custom">
    <div class="card-body">
        <div class="mb-7">
            <div class="row align-items-center">
                <div class="col-lg-12 col-xl-12">
                  <form action="{{ route('convert.list') }}" method="get" id="form-search">
                    <div class="row align-items-center">
                        <div class="col-lg-4 my-2 my-md-0">
                          <input name="from_date" type="text" class="form-control singledate" placeholder="Search From Date">
                        </div>
                        <div class="col-lg-4 my-2 my-md-0">
                          <input name="to_date" type="text" class="form-control singledate" placeholder="Search To Date">
                        </div>
                        <div class="col-lg-4 my-2 my-md-0">
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
                      <th>Inv</th>
                      <th>Username</th>
                      <th>Date</th>
                      {{-- <th>Description</th> --}}
                      <th class="text-center">Status</th>
                      <th class="text-right">Amount ($)</th>
                      <th class="text-right">Fee ($)</th>
                      <th class="text-right">Total ($)</th>
                      <th class="text-right">Price ($)</th>
                      <th class="text-right">Recieve (DC)</th>
                    </tr>
                </thead>
                <tbody>
                  @if($data->count()>0)
                      @foreach ($data as $h)
                        <tr>
                          <td>{{++$i}}</td>
                          <td>{{$h->invoice}}</td>
                          <td>{{ucfirst($h->user->username)}}</td>
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
                            <td colspan="7"></td>
                            <td class="text-right">{{number_format($value->total,2)}}</td>
                            <td class="text-right">{{number_format($value->price,2)}}</td>
                            <td class="text-right">{{number_format($value->receive,8)}}</td>
                          </tr>
                        @endforeach
                      @endforeach
                  @else
                    <tr>
                      <td colspan="10" class="text-center">No data available in table</td>
                    </tr>
                  @endif
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="5">Total</td>
                    <td class="text-right">{{number_format($total_usd,2)}}</td>
                    <td colspan="3"></td>
                    <td class="text-right">{{number_format($total_idr,8)}}</td>
                  </tr>
                </tfoot>
            </table>
            {!! $data->appends(['from_date'=>$from_date,'to_date'=>$to_date,'search'=>$search,'choose'=>$choose])->render() !!}
        </div>
        <!--end: Datatable-->
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
  $('#choose').change(function() {
    var value = $(this).val();
    if(value == 1){
      window.location.href = '?choose=1';
    }else if(value == 2){
      window.location.href = '?choose=2';
    }else if(value == 3){
      window.location.href = '?choose=3';
    }else if(value == 4){
      window.location.href = '?choose=4';
    }
  });
</script>
@endsection
