@extends('layouts.backend',['active'=>'bonus_pasif','page'=>'program','type'=>'bonus'])

@section('page-title')
<span class="svg-icon svg-icon-white svg-icon-sm">
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <rect x="0" y="0" width="24" height="24"/>
            <path d="M3.5,21 L20.5,21 C21.3284271,21 22,20.3284271 22,19.5 L22,8.5 C22,7.67157288 21.3284271,7 20.5,7 L10,7 L7.43933983,4.43933983 C7.15803526,4.15803526 6.77650439,4 6.37867966,4 L3.5,4 C2.67157288,4 2,4.67157288 2,5.5 L2,19.5 C2,20.3284271 2.67157288,21 3.5,21 Z" fill="#000000" opacity="0.3"/>
            <path d="M11,13 L11,11 C11,10.4477153 11.4477153,10 12,10 C12.5522847,10 13,10.4477153 13,11 L13,13 L15,13 C15.5522847,13 16,13.4477153 16,14 C16,14.5522847 15.5522847,15 15,15 L13,15 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,15 L9,15 C8.44771525,15 8,14.5522847 8,14 C8,13.4477153 8.44771525,13 9,13 L11,13 Z" fill="#000000"/>
        </g>
    </svg>
</span>
Daily
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Investments</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Bonus Daily</a>
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
                            <form action="{{ route('program.bonus_profit') }}" method="get" id="form-search">
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
                      <th>Date</th>
                      <th>Description</th>
                      <th class="text-right">Amount ($)</th>
                      <th class="text-right">Percent(%)</th>
                      <th class="text-right">Bonus ($)</th>
                    </tr>
                </thead>
                <tbody>
                    @if($data->count()>0)
                      @foreach ($data as $h)
                        <tr>
                          <td>{{++$i}}</td>
                          <td>{{date('d F Y H:i:s', strtotime($h->created_at))}}</td>
                          <td>{{$h->description}}</td>
                          <td class="text-right">{{number_format($h->program->amount,2)}}</td>
                          <td class="text-right">{{$h->percent * 100}}</td>
                          <td class="text-right">{{number_format($h->bonus,2)}}</td>
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
                    <td class="text-right">{{number_format($total,2)}}</td>
                  </tr>
                </tfoot>
            </table>
            {!! $data->render() !!}
        </div>
        <!--end: Datatable-->
    </div>
</div>
@endsection
