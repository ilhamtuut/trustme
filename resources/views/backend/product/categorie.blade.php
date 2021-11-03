@extends('layouts.backend',['active'=>'categorie','page'=>'categorie'])

@section('page-title')
<span class="svg-icon svg-icon-white svg-icon-sm">
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
        viewBox="0 0 24 24" version="1.1">
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <rect x="0" y="0" width="24" height="24"></rect>
            <rect fill="#000000" opacity="0.3" x="4" y="4" width="8" height="16"></rect>
            <path
                d="M6,18 L9,18 C9.66666667,18.1143819 10,18.4477153 10,19 C10,19.5522847 9.66666667,19.8856181 9,20 L4,20 L4,15 C4,14.3333333 4.33333333,14 5,14 C5.66666667,14 6,14.3333333 6,15 L6,18 Z M18,18 L18,15 C18.1143819,14.3333333 18.4477153,14 19,14 C19.5522847,14 19.8856181,14.3333333 20,15 L20,20 L15,20 C14.3333333,20 14,19.6666667 14,19 C14,18.3333333 14.3333333,18 15,18 L18,18 Z M18,6 L15,6 C14.3333333,5.88561808 14,5.55228475 14,5 C14,4.44771525 14.3333333,4.11438192 15,4 L20,4 L20,9 C20,9.66666667 19.6666667,10 19,10 C18.3333333,10 18,9.66666667 18,9 L18,6 Z M6,6 L6,9 C5.88561808,9.66666667 5.55228475,10 5,10 C4.44771525,10 4.11438192,9.66666667 4,9 L4,4 L9,4 C9.66666667,4 10,4.33333333 10,5 C10,5.66666667 9.66666667,6 9,6 L6,6 Z"
                fill="#000000" fill-rule="nonzero"></path>
        </g>
    </svg>
</span>
Categorie
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="" class="text-white text-hover-dark">Dashboard</a>
</li>
<li class="breadcrumb-item">
    <a href="" class="text-white text-hover-dark">Categorie</a>
</li>
@endsection

@section('content')
@include('layouts.partials.alert')
<div class="card card-custom">
    <div class="card-header align-items-center border-0 bg-success">
        <h3 class="card-title align-items-start flex-column">
            <span class="font-weight-bolder text-white">Categorie</span>
        </h3>
    </div>
    <form class="form" action="{{route('product.postProductCategorie')}}" method="POST">
        <div class="card-body">
            @csrf
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="name" class="form-control">
                <span class="form-text text-danger">{{ $errors->categorie->first('name') }}</span>
            </div>
        <div class="card-footer text-right">
            <div id="action">
                <button id="btn_action" type="submit" class="btn btn-light-success mr-2">Submit</button>
                <button id="btn_clear" type="reset" class="btn btn-light-danger">Cancel</button>
            </div>
            <div class="text-center hidden" id="loader">
                <i class="fa fa-spinner fa-spin"></i>
            </div>
        </div>
    </form>
    <!--end::Form-->
</div>
@endsection
