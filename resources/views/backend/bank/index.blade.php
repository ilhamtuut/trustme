@extends('layouts.backend',['active'=>'index_bank','page'=>'account'])

@section('page-title')
<span class="svg-icon svg-icon-white svg-icon-sm">
  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <rect x="0" y="0" width="24" height="24"/>
          <rect fill="#000000" opacity="0.3" x="2" y="4" width="20" height="5" rx="1"/>
          <path d="M5,7 L8,7 L8,21 L7,21 C5.8954305,21 5,20.1045695 5,19 L5,7 Z M19,7 L19,19 C19,20.1045695 18.1045695,21 17,21 L11,21 L11,7 L19,7 Z" fill="#000000"/>
      </g>
  </svg>
</span>
List Bank
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
      <a href="#" class="text-white text-hover-dark">List Bank</a>
  </li>
@endsection

@section('content')
@include('layouts.partials.alert')
<div class="card card-custom">
    <div class="card-body">
        <div class="mb-7">
            <div class="row align-items-left">
                <div class="col-lg-12 col-xl-12">
                  <button class="btn btn-sm btn-light-success call_modal_s" data-type="create" data-title="Add Bank" data-url="{{ route('bank.store') }}" data-toggle="modal" data-target="#responsive-modal" type="button"><i class="fa fa-plus"></i> Add Bank</button>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                <thead>
                    <tr class="text-left text-uppercase">
                      <th width="3%">#</th>
                      <th>Code</th>
                      <th>Name</th>
                      <th>Country</th>
                      <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                  @if($data->count()>0)
                    @foreach ($data as $key => $h)
                        <tr>
                          <td>{{++$i}}</td>
                          <td>{{$h->code}}</td>
                          <td>{{$h->name}}</td>
                          <td>{{$h->country}}</td>
                          <td class="text-center">
                              <button class="btn btn-sm btn-light-success call_modal_s" data-type="update" data-title="Update Bank" data-id="{{$h->id}}" data-name="{{$h->name}}" data-code="{{$h->code}}" data-country="{{$h->country}}" data-url="{{ route('bank.update',$h->id) }}" data-toggle="modal" data-target="#responsive-modal" type="button"><i class="fa fa-edit"></i> Update</button>
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
<div class="modal fade" id="responsive-modal" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header bg-success">
            <h5 class="modal-title text-white" id="title-modal"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="POST" id="form_update">
              {{ csrf_field() }}
              <div class="modal-body">
                  <div class="form-group">
                      <label class="text-muted">Code</label>
                      <input id="code" type="text" name="code" class="form-control" placeholder="Code">
                  </div>
                  <div class="form-group">
                      <label class="text-muted">Name</label>
                      <input id="name" type="text" name="name" class="form-control" placeholder="Name">
                  </div>
                  <div class="form-group">
                      <label class="text-muted">Country</label>
                      <select name="country" id="country" data-live-search="true" class="form-control select" style="width: 100%;">
                        <option value="">Choose Country</option>
                      </select>
                  </div>
              </div>
              <div class="modal-footer">
                <div id="action">
                  <button type="submit" class="btn btn-light-success" id="btn_submit">Submit</button>
                  <button type="button" class="btn btn-light-danger" data-dismiss="modal">Cancel</button>
                </div>
                <i class="hidden text-success" id="spinner"><span class="fa fa-spin fa-spinner"></span></i>
              </div>
          </form>
      </div>
  </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
  var country = [];
  $.ajax({
    url: '{{ url('/countries.json') }}',
    type: 'get',
    dataType: 'html',
    success: function(json){
        var data = JSON.parse(json)
        $.each(data, function(i, item) {
            country[i] = "<option value='" + item.country + "'>" + item.country + "</option>";
        });
        $('#country').append(country);
        $('#country').selectpicker('refresh');
    },
    error: function(data){}
  });

  $('.call_modal_s').on('click',function(){
    var title = $(this).data('title');
    var type = $(this).data('type');
    var url = $(this).data('url');
    $('#form_update').attr('action', url);
    $('#title-modal').html(title);
    if(type == 'update'){
      $('#name').val($(this).data('name'));
      $('#code').val($(this).data('code'));
      $('#country').val($(this).data('country')).trigger('change');
    }else{
      $('#name').val('');
      $('#code').val('');
      $('#country').val('').trigger('change');
    }
  });

  $('#btn_submit').on('click',function(){
    $('#action').addClass('hidden');
    $('#spinner').removeClass('hidden');
  });
</script>
@endsection
