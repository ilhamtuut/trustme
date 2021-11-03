@extends('layouts.backend',['active'=>'list_sponsor','page'=>'users'])

@section('page-title')
<h3><i class="fa fa-user"></i> List Sponsor</h3>
@endsection

@section('content')
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
          <div class="x_content">
            <div class="row">
                <form action="{{ route('user.list_sponsor') }}" method="get" id="form-search">
                  <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                      <input type="text" class="form-control singledate" placeholder="From Date" name="from_date">
                    </div>
                  </div>
                  <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                      <input type="text" class="form-control singledate" placeholder="To Date" name="to_date">
                    </div>
                  </div>
                  <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                    <div class="input-group">
                      <input name="search" class="form-control" type="text" placeholder="Search" required>
                      <div class="input-group-addon" style="cursor: pointer;" onclick="submit();"><i class="fa fa-search"></i>
                      </div>
                    </div>
                  </div>
                </form>
            </div>
            <div class="table-responsive">
              <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Username</th>
                      <th>Name</th>
                      <th class="text-right">Total Sponsor</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($data->count()>0)
                      @foreach ($data as $h)
                        @php
                          if($from_date && $to_date){
                              $from = date('Y-m-d',strtotime($from_date));
                              $to = date('Y-m-d',strtotime($to_date));
                          }else{
                              $from = date('Y-01-01');
                              $to = date('Y-m-d');
                          }
                          $downline = $h->childs()->pluck('id');
                          $totalprogram = \App\Program::whereIn('user_id',$downline)
                                      ->where('registered_by','>',0)
                                      ->whereDate('created_at','>=',$from)
                                      ->whereDate('created_at','<=',$to)
                                      ->sum('amount');
                        @endphp
                          <tr>
                            <td>{{++$i}}</td>
                            <td>{{$h->username}}</td>
                            <td>{{$h->name}}</td>
                            <td class="text-right">{{number_format($totalprogram,2)}}</td>
                          </tr>
                      @endforeach
                    @else
                        <tr>
                          <td colspan="4" class="text-center">No data available in table</td>
                        </tr>
                    @endif
                  </tbody>
              </table>
              <div class="text-center">
                {!! $data->appends(['from_date'=>$from_date,'to_date'=>$to_date,'search'=>$search])->render() !!}  
              </div>
            </div>
          </div>
        </div>
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