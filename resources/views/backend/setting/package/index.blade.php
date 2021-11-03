@extends('layouts.backend',['active'=>'roi','page'=>'setting'])

@section('page-title')
<span class="svg-icon svg-icon-white svg-icon-sm">
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
        <g id="Stockholm-icons-/-Shopping-/-Settings" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <rect id="Bound" opacity="0.200000003" x="0" y="0" width="24" height="24"></rect>
            <path d="M4.5,7 L9.5,7 C10.3284271,7 11,7.67157288 11,8.5 C11,9.32842712 10.3284271,10 9.5,10 L4.5,10 C3.67157288,10 3,9.32842712 3,8.5 C3,7.67157288 3.67157288,7 4.5,7 Z M13.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L13.5,18 C12.6715729,18 12,17.3284271 12,16.5 C12,15.6715729 12.6715729,15 13.5,15 Z" id="Combined-Shape" fill="#000000" opacity="0.3"></path>
            <path d="M17,11 C15.3431458,11 14,9.65685425 14,8 C14,6.34314575 15.3431458,5 17,5 C18.6568542,5 20,6.34314575 20,8 C20,9.65685425 18.6568542,11 17,11 Z M6,19 C4.34314575,19 3,17.6568542 3,16 C3,14.3431458 4.34314575,13 6,13 C7.65685425,13 9,14.3431458 9,16 C9,17.6568542 7.65685425,19 6,19 Z" id="Combined-Shape" fill="#000000"></path>
        </g>
    </svg>
</span>
Plan
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Settings</a>
  </li>
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Plan</a>
  </li>
@endsection

@section('content')
@include('layouts.partials.alert')
<div class="card card-custom">
    <div class="card-body">
        <!--begin: Datatable-->
        <div class="table-responsive">
            <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                <thead>
                    <tr class="text-left text-uppercase">
                      <th width="3%">#</th>
                      <th class="text-left">Percent</th>
                      <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                  @if($data->count()>0)
                    @foreach ($data as $key => $h)
                      <tr>
                        <td>{{++$key}}</td>
                        <td class="text-left">{{$h->percent * 100}}%</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-light-success call_modal" data-id="{{$h->id}}" data-value="{{$h->percent*100}}" data-desc="{{$h->name}}" data-toggle="modal" data-target="#responsive-modal" type="button">Update</button>
                        </td>
                      </tr>
                    @endforeach
                  @else
                      <tr>
                        <td colspan="3" class="text-center">No data available in table</td>
                      </tr>
                  @endif
                </tbody>
            </table>
            {!! $data->render() !!}
        </div>
        <!--end: Datatable-->
    </div>
</div>

<div class="modal fade" id="responsive-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header bg-success">
            <h4 class="modal-title text-white" id="title-modal"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('setting.updatePackage') }}" method="POST">
              {{ csrf_field() }}
              <div class="modal-body">
                  <div class="form-group">
                      <label class="col-form-label">Percent</label>
                      <input id="value" type="text" name="percent" class="form-control" placeholder="Percent">
                      <input id="id" type="text" name="id" class="form-control hidden">
                  </div>
                  <div class="form-group">
                      <label class="col-form-label">Security Password</label>
                      <input type="password" name="password" class="form-control" placeholder="Security Password">
                  </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-light-success">Submit</button>
                <button type="button" class="btn btn-light-danger" data-dismiss="modal">Cancel</button>
              </div>
          </form>
      </div>
  </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(function(){
        $('.call_modal').on('click',function(){
            var title = $(this).data('desc');
            $('#id').val($(this).data('id'));
            $('#value').val($(this).data('value'));
            $('#title-modal').html('Update ' + title.replace(/_/g,' '));
        });
    });
</script>
@endsection

