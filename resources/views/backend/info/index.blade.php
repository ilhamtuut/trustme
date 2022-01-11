@extends('layouts.backend',['active'=>'info','page'=>'info'])

@section('page-title')
<span class="svg-icon svg-icon-white svg-icon-sm">
    <i class="fa fa-info text-white"></i>
</span>
Information
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Information</a>
  </li>
@endsection

@section('content')
@include('layouts.partials.alert')
<div class="card card-custom">
  <div class="card-header bg-warning">
    <h3 class="card-title text-white">
        <span class="svg-icon svg-icon-white svg-icon-sm mr-1">
            <i class="fa fa-info text-white"></i>
        </span>
        Information
    </h3>
  </div>
  <!--begin::Form-->
  <form class="form" action="{{route('info.save')}}" method="POST">
    <div class="card-body">
      @csrf
      <div class="form-group">
          <label>Content</label>
          <textarea type="text" name="content" placeholder="Content" class="form-control" cols="30" rows="20">{{$data ? $data->content : ''}}</textarea>
      </div>
    </div>
    <div class="card-footer text-right">
      <div id="buypackage">
        <button id="btn_buypackage" type="submit" class="btn btn-light-success mr-2">Submit</button>
        <button id="btn_clear" type="button" class="btn btn-light-danger">Cancel</button>
      </div>
      <div class="text-center hidden" id="loader">
        <i class="fa fa-spinner fa-spin"></i>
      </div>
    </div>
  </form>
  <!--end::Form-->
</div>
@endsection

@section('script')
<script type="text/javascript">

</script>
@endsection
