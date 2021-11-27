@extends('layouts.backend',['active'=>'list_deposit','page'=>'deposit'])

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
List Deposit
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
      <a href="#" class="text-white text-hover-dark">List Deposit</a>
  </li>
@endsection

@section('content')
@include('layouts.partials.alert')
<div class="card card-custom">
    <div class="card-body">
        <div class="mb-7">
            <div class="row align-items-center">
                <div class="col-lg-12 col-xl-12">
                  <form action="{{ route('deposit.list') }}" method="get" id="form-search">
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
                            <option @if($choose == 1) selected @endif value="1">Pending</option>
                            <option @if($choose == 2) selected @endif value="2">Success</option>
                            <option @if($choose == 3) selected @endif value="3">Canceled</option>
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
                      <th>Txid/Hash</th>
                      <th>Username</th>
                      <th class="text-center">Status</th>
                      <th class="text-right">Amount (TC)</th>
                      <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                  @if($data->count()>0)
                      @foreach ($data as $h)
                        <tr>
                          <td>{{++$i}}</td>
                          <td>{{date('d F Y H:i:s', strtotime($h->created_at))}}</td>
                          <td>{{$h->invoice}}</td>
                          <td>{{$h->txid}}</td>
                          <td>{{ucfirst($h->user->username)}}</td>
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
                          <td class="text-center">
                            @if($h->status == 0)
                                <span class="label label-md label-light-success label-inline cursor-pointer" onclick="accept({{$h->id}},'{{$h->user->username}}')">Accept</span>
                                <span class="label label-md label-light-danger label-inline cursor-pointer" onclick="reject({{$h->id}},'{{$h->user->username}}')">Reject</span>
                            @elseif($h->status == 1)
                                <span class="label label-md label-light-default label-inline">-</span>
                            @endif
                          </td>
                        </tr>
                      @endforeach
                  @else
                    <tr>
                      <td colspan="8" class="text-center">No data available in table</td>
                    </tr>
                  @endif
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="6">Total</td>
                    <td class="text-right">{{number_format($total,8)}}</td>
                    <td></td>
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
    function accept(id,username) {
        Swal.fire({
        title: 'Are you sure?',
        text: "Accept Deposit with username "+username,
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
                url:'{{ url('/deposit/confirm/accept') }}/'+id,
                type:'GET',
                success:function(data) {
                    location.reload();
                },
            });
        }
        });
    }
    function reject(id,username) {
        Swal.fire({
        title: 'Are you sure?',
        text: "Reject Deposit with username "+username,
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
                url:'{{ url('/deposit/confirm/reject') }}/'+id,
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
