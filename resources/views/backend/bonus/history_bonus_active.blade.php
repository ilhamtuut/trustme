@extends('layouts.backend',['active'=>$active,'page'=>'bonus_active'])

@section('page-title')
<span class="svg-icon svg-icon-white svg-icon-sm">
  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <rect x="0" y="0" width="24" height="24" />
          <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000" />
          <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3" />
      </g>
  </svg>
</span>
List Bonus {{ucfirst($desc)}}
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
      <a href="#" class="text-white text-hover-dark">List Bonus {{ucfirst($desc)}}</a>
  </li>
@endsection

@section('content')
<div class="card card-custom">
    <div class="card-body">
        <div class="mb-7">
            <div class="row align-items-center">
                <div class="col-lg-12 col-xl-12">
                  <form action="{{ route('program.list_bonus_active',$desc) }}" method="get" id="form-search">
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
                      <th>#</th>
                      <th>Date</th>
                      <th>Username</th>
                      <th>Description</th>
                      @if($desc != 'weekly')
                      <th class="text-center">Amount ($)</th>
                      <th class="text-center">Percent(%)</th>
                      @endif
                      <th class="text-right">Bonus ($)</th>
                    </tr>
                </thead>
                <tbody>
                  @if($data->count()>0)
                    @foreach ($data as $h)
                        <tr>
                          <td>{{++$i}}</td>
                          <td>{{date('d F Y H:i:s', strtotime($h->created_at))}}</td>
                          <td>{{ucfirst($h->user->username)}}</td>
                          <td>
                            {{$h->description}}
                            @if($desc == 'sponsor') from {{ucfirst($h->from->username)}} @endif
                          </td>
                          @if($desc != 'weekly')
                          <td class="text-center">{{number_format($h->amount,2)}}</td>
                          <td class="text-center">{{$h->percent * 100}}</td>
                          @endif
                          <td class="text-right">{{number_format($h->bonus,2)}}</td>
                        </tr>
                    @endforeach
                  @else
                      <tr>
                        @if($desc != 'weekly')
                          <td colspan="7" class="text-center">No data available in table</td>
                        @else
                          <td colspan="5" class="text-center">No data available in table</td>
                        @endif
                      </tr>
                  @endif
                </tbody>
                <tfoot>
                  <tr>
                    @if($desc != 'weekly')
                      <td colspan="6">Total</td>
                    @else
                      <td colspan="4">Total</td>
                    @endif
                    <td class="text-right">{{number_format($total,2)}}</td>
                  </tr>
                </tfoot>
            </table>
            {!! $data->appends(['desc'=>$desc,'from_date'=>$from_date,'to_date'=>$to_date,'search'=>$search])->render() !!}
        </div>
        <!--end: Datatable-->
    </div>
</div>
@endsection
