@extends('layouts.backend',['active'=>'bonus','page'=>'generate'])

@section('page-title')
<span class="svg-icon svg-icon-white svg-icon-sm">
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <polygon points="0 0 24 0 24 24 0 24"></polygon>
          <path d="M18.5,8 C17.1192881,8 16,6.88071187 16,5.5 C16,4.11928813 17.1192881,3 18.5,3 C19.8807119,3 21,4.11928813 21,5.5 C21,6.88071187 19.8807119,8 18.5,8 Z M18.5,21 C17.1192881,21 16,19.8807119 16,18.5 C16,17.1192881 17.1192881,16 18.5,16 C19.8807119,16 21,17.1192881 21,18.5 C21,19.8807119 19.8807119,21 18.5,21 Z M5.5,21 C4.11928813,21 3,19.8807119 3,18.5 C3,17.1192881 4.11928813,16 5.5,16 C6.88071187,16 8,17.1192881 8,18.5 C8,19.8807119 6.88071187,21 5.5,21 Z" fill="#000000" opacity="0.3"></path>
          <path d="M5.5,8 C4.11928813,8 3,6.88071187 3,5.5 C3,4.11928813 4.11928813,3 5.5,3 C6.88071187,3 8,4.11928813 8,5.5 C8,6.88071187 6.88071187,8 5.5,8 Z M11,4 L13,4 C13.5522847,4 14,4.44771525 14,5 C14,5.55228475 13.5522847,6 13,6 L11,6 C10.4477153,6 10,5.55228475 10,5 C10,4.44771525 10.4477153,4 11,4 Z M11,18 L13,18 C13.5522847,18 14,18.4477153 14,19 C14,19.5522847 13.5522847,20 13,20 L11,20 C10.4477153,20 10,19.5522847 10,19 C10,18.4477153 10.4477153,18 11,18 Z M5,10 C5.55228475,10 6,10.4477153 6,11 L6,13 C6,13.5522847 5.55228475,14 5,14 C4.44771525,14 4,13.5522847 4,13 L4,11 C4,10.4477153 4.44771525,10 5,10 Z M19,10 C19.5522847,10 20,10.4477153 20,11 L20,13 C20,13.5522847 19.5522847,14 19,14 C18.4477153,14 18,13.5522847 18,13 L18,11 C18,10.4477153 18.4477153,10 19,10 Z" fill="#000000"></path>
        </g>
      </svg>
</span>
Bonus
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Generate</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Bonus</a>
  </li>
@endsection

@section('content')
<div class="card card-custom">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <form action="{{route('generate.bonus_pasif')}}" method="get" id="form-search">
                    <div class="form-group text-center">
                        <div id="loader1" class="fa fa-spinner fa-spin hidden" style="font-size: 30px;"></div>
                        <button id="btn_generate_bonus1" type="submit" class="btn btn-light-success waves-effect waves-light w-100">Generate Bonus Daily</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $('#btn_generate_bonus1').on('click',function () {
        $(this).addClass('hidden');
        $('#loader1').removeClass('hidden');
    });
    $('#btn_generate_bonus2').on('click',function () {
        $(this).addClass('hidden');
        $('#loader2').removeClass('hidden');
    });
</script>
@endsection


