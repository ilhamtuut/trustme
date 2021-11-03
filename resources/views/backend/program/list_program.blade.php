@extends('layouts.backend',['active'=>$active,'page'=>'package'])

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
List Plan by {{ucfirst($regby)}}
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Plan</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">List Plan by {{ucfirst($regby)}}</a>
  </li>
@endsection

@section('content')
@include('layouts.partials.alert')

<div class="card card-custom">
    <div class="card-body">
        <div class="mb-7">
            <div class="row align-items-center">
                <div class="col-lg-12 col-xl-12">
                  <form action="{{ route('program.list',$regby) }}" method="get" id="form-search">
                    <div class="row align-items-center">
                        <div class="col-lg-3 my-2 my-md-0">
                          <input name="from_date" type="text" class="form-control singledate" placeholder="Search From Date">
                        </div>
                        <div class="col-lg-3 my-2 my-md-0">
                          <input name="to_date" type="text" class="form-control singledate" placeholder="Search To Date">
                        </div>
                        <div class="col-lg-3 my-2 my-md-0">
                          <select id="status" name="choose" class="form-control select2" style="width: 100%;">
                            <option value="">Choose Status</option>
                            <option @if($status == 2) selected @endif value="2">Completed</option>
                            <option @if($status == 1) selected @endif value="1">On Process</option>
                            <option @if($status == 3) selected @endif value="3">Stop Profit</option>
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
                      <th>No</th>
                      <th>Date</th>
                      <th>Username</th>
                      {{-- <th class="text-center">Package</th> --}}
                      <th class="text-center">Status</th>
                      <th class="text-right">Amount</th>
                      <th class="text-right">Max Income</th>
                      <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                  @if($data->count()>0)
                    @foreach ($data as $h)
                      <tr>
                        <td>{{++$i}}</td>
                        <td>{{date('d F Y H:i:s', strtotime($h->created_at))}}</td>
                        <td>{{ucfirst($h->user->username)}}</td>
                        {{-- <td class="text-center">{{$h->package->name}}</td> --}}
                        <td class="text-center">
                          @if($h->status == 0)
                            <span class="label label-md label-light-primary label-inline">On Process</span>
                          @elseif($h->status == 1)
                            <span class="label label-md label-light-success label-inline">Completed</span>
                          @elseif($h->status == 2)
                            <span class="label label-md label-light-danger label-inline">Stop Profit</span>
                          @endif
                        </td>
                        <td class="text-right">{{number_format($h->amount,2)}}</td>
                        <td class="text-right">{{number_format($h->max_profit,2)}}</td>
                        <td class="text-center">
                          @if($h->status == 0)
                            <a href="#" onclick="show_action({{$h->id}},'{{ucfirst($h->user->username)}}','profit','stop','Stop Profit');">
                            <span class="label label-md label-light-danger label-inline">Stop Profit</span></a>
                          @elseif($h->status == 2)
                            <a href="#" onclick="show_action({{$h->id}},'{{ucfirst($h->user->username)}}','profit','run','Run Profit');">
                            <span class="label label-md label-light-success label-inline">Run Profit</span></a>
                          @else
                            <span class="label label-md label-light-primary label-inline">No Action</span>
                          @endif
                          </div>
                        </td>
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
                    <td colspan="4">Total</td>
                    <td class="text-right">{{number_format($total_usd,2)}}</td>
                    <td class="text-right">{{number_format($total_profit,2)}}</td>
                    <td></td>
                  </tr>
                </tfoot>
            </table>
            {!! $data->appends(['status'=>$status,'from_date'=>$from_date,'to_date'=>$to_date,'search'=>$search])->render() !!}
        </div>
        <!--end: Datatable-->
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
  function submit() {
    $("#form-search").submit();
  }

  function show_action(id,username,type,desc,act) {
    Swal.fire({
      title: 'Are you sure?',
      text: act + " with username " + username,
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Submit",
      customClass: {
        confirmButton: "btn font-weight-bold btn-light-primary",
        cancelButton: "btn font-weight-bold btn-light-danger"
      }
    }).then(function(result) {
      if (result.value) {
        $.ajax({
            url:'{{ url('/plan/profit_capital') }}/'+type+'/'+desc+'/'+id,
            type:'GET',
            success:function(data) {
              location.reload();
            },
        });
      }
    });
  }
</script>
@endsection

