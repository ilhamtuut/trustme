@extends('layouts.backend',['active'=>'list_wallet','page'=>'account'])

@section('page-title')
<i class="fas fa-file-invoice-dollar text-white"></i>
List Trustme Coin Address
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
      <a href="#" class="text-white text-hover-dark">List Trustme Coin Address</a>
  </li>
@endsection

@section('content')
<div class="card card-custom">
    <div class="card-body">
        <div class="mb-7">
            <div class="row align-items-center">
                <div class="col-lg-12 col-xl-12">
                    <form action="{{ route('trustme_coin.list') }}" method="get">
                      <div class="row align-items-center">
                          <div class="col-lg-8 my-2 my-md-0">
                          </div>
                          <div class="col-lg-4 my-2 my-md-0">
                            <div class="input-group">
                                <input name="search" type="text" class="form-control" placeholder="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="submit"><i class="flaticon2-search-1 text-white"></i></button>
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
                      <th>Username</th>
                      <th>Name</th>
                      <th>Currency</th>
                      <th>USDT Address</th>
                      <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                  @if($data->count()>0)
                      @foreach ($data as $key => $h)
                          <tr>
                            <td>{{++$i}}</td>
                            <td>{{$h->user->username}}</td>
                            <td>{{$h->name}}</td>
                            <td>{{$h->currency}}</td>
                            <td>{{$h->address}}</td>
                            <td class="text-center">
                              @if($h->status)
                                <span class="label label-lg label-light-success label-inline">Active</span>
                              @else
                                <span class="label label-lg label-light-danger label-inline">Non Active</span>
                              @endif
                            </td>
                          </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="6" class="text-center">No data available in table</td>
                      </tr>
                  @endif
                </tbody>
            </table>
            {!! $data->render() !!}
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
</script>
@endsection
