@extends('layouts.backend',['active'=>'order','page'=>'order'])

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
Order
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="" class="text-white text-hover-dark">Dashboard</a>
</li>
<li class="breadcrumb-item">
    <a href="" class="text-white text-hover-dark">Order</a>
</li>
@endsection

@section('content')
@include('layouts.partials.alert')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-custom card-stretch gutter-b">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label font-weight-bolder text-dark">
                        @foreach($data->product->image->take(1) as $useImage)
                        <img style="height: 50px" src="{{$useImage->path}}" alt="Product" />
                        @endforeach
                    </span>
                    <span class="text-muted mt-3 font-weight-bold font-size-sm">Product Name: {{$data->product->name}}</span>
                    <span class="text-muted mt-3 font-weight-bold font-size-sm">Status: {{$data->status}}</span>
                </h3>
            </div>
            <div class="card-body pt-8">
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <div class="d-flex align-items-center mb-5">
                            <div class="symbol symbol-40 symbol-light-primary mr-5">
                                <span class="symbol-label">
                                    <i class="fas fas fa-comments-dollar text-primary"></i>
                                </span>
                            </div>
                            <div class="d-flex flex-column font-weight-bold">
                                <span class="text-dark text-hover-primary mb-1 font-size-lg">Until Price</span>
                                <span class="text-muted"></i>Rp{{$data->product->price}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="d-flex align-items-center mb-5">
                            <div class="symbol symbol-40 symbol-light-success mr-5">
                                <span class="symbol-label">
                                    <i class="fas fas fa-funnel-dollar text-success"></i>
                                </span>
                            </div>
                            <div class="d-flex flex-column font-weight-bold">
                                <span class="text-dark text-hover-success mb-1 font-size-lg">Qty</span>
                                <span class="text-muted">{{$data->qyt}}</i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="d-flex align-items-center mb-5">
                            <div class="symbol symbol-40 symbol-light-danger mr-5">
                                <span class="symbol-label">
                                    <i class="fas fa-file-invoice-dollar text-danger"></i>
                                </span>
                            </div>
                            <div class="d-flex flex-column font-weight-bold">
                                <span class="text-dark text-hover-danger mb-1 font-size-lg">Cost</span>
                                <span class="text-muted">Rp{{$data->cost}}</i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="d-flex align-items-center mb-5">
                            <div class="symbol symbol-40 symbol-light-info mr-5">
                                <span class="symbol-label">
                                    <i class="fas fa-hand-holding-usd text-info"></i>
                                </span>
                            </div>
                            <div class="d-flex flex-column font-weight-bold">
                                <span class="text-dark text-hover-info mb-1 font-size-lg">Subtotal</span>
                                <span class="text-muted">Rp{{$data->total + $data->cost}}</i></span>
                            </div>
                        </div>
                    </div>
                </div>
                @if($data->status == "request")
                <form class="form text-right mt-10" action="{{route('product.postProductOrder')}}" method="POST">
                    <input type="hidden" name="id" value="{{$data->id}}" class="form-control">
                    <input type="hidden" name="status" value="sending" class="form-control">
                    @csrf
                    <button id="btn_action" type="submit" class="btn btn-light-success mr-2">Confirmation Sending</button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
