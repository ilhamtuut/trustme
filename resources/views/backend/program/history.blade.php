@extends('layouts.backend',['active'=>'my_plan','page'=>'program'])

@section('page-title')
<span class="svg-icon svg-icon-white svg-icon-sm">
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <rect x="0" y="0" width="24" height="24"/>
            <polygon fill="#000000" opacity="0.3" points="6 3 18 3 20 6.5 4 6.5"/>
            <path d="M6,5 L18,5 C19.1045695,5 20,5.8954305 20,7 L20,19 C20,20.1045695 19.1045695,21 18,21 L6,21 C4.8954305,21 4,20.1045695 4,19 L4,7 C4,5.8954305 4.8954305,5 6,5 Z M9,9 C8.44771525,9 8,9.44771525 8,10 C8,10.5522847 8.44771525,11 9,11 L15,11 C15.5522847,11 16,10.5522847 16,10 C16,9.44771525 15.5522847,9 15,9 L9,9 Z" fill="#000000"/>
        </g>
    </svg>
</span>
My Invest
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Investments</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">My Invest</a>
  </li>
@endsection

@section('content')
<div class="card card-custom">
    <div class="card-body">
        <!--begin: Datatable-->
        <div class="table-responsive">
            <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                <thead>
                    <tr class="text-left text-uppercase">
                        <th width="3%">#</th>
                        <th>Date</th>
                        {{-- <th>Plan</th> --}}
                        <th class="text-center">Status</th>
                        <th class="text-right">Amount ($)</th>
                        <th class="text-right">Maximum Income ($)</th>
                    </tr>
                </thead>
                <tbody>
                    @if($data->count()>0)
                        @foreach ($data as $h)
                          <tr>
                            <td>{{++$i}}</td>
                            <td>{{date('d F Y H:i:s', strtotime($h->created_at))}}</td>
                            {{-- <td>{{$h->package->name}}</td> --}}
                            <td class="text-center">
                              @if($h->status == 1)
                                <span class="label label-md label-light-success label-inline">Completed</span>
                              @elseif($h->status == 2)
                                <span class="label label-md label-light-danger label-inline">Stop Bonus</span>
                              @else
                                <span class="label label-md label-light-primary label-inline">On Process</span>
                              @endif
                            </td>
                            <td class="text-right">{{number_format($h->amount,2)}}</td>
                            <td class="text-right">{{number_format($h->max_profit,2)}}</td>
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
                    <td colspan="3">Total</td>
                    <td class="text-right">{{number_format($total,2)}}</td>
                    <td class="text-right">{{number_format($total_max,2)}}</td>
                  </tr>
                </tfoot>
            </table>
            {!! $data->render() !!}
        </div>
        <!--end: Datatable-->
    </div>
</div>
@endsection
