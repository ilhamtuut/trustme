@extends('layouts.backend',['page'=>'home'])

@section('page-title')
<span class="svg-icon svg-icon-white svg-icon-sm">
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"/>
        <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero"/>
        <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3"/>
    </g>
    </svg>
</span>
Dashboard
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="col bg-warning px-6 py-3 rounded-sm mb-5">
            <span class="svg-icon svg-icon-3x svg-icon-white d-block my-2">
                <img src="{{asset('images/trust-icon.png')}}" width="40px" height="40px">
            </span>
            <span href="#" class="text-white font-weight-bold font-size-h6 mt-2">TRUSTME COIN <br>{{$trustme}}</span>
            <br><a class="text-white text-hover-white" href="{{route('balance.harvest')}}">More <i class="flaticon-shapes icon-xs text-white"></i></a>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="col bg-primary px-6 py-3 rounded-sm mb-5">
            <span class="svg-icon svg-icon-3x svg-icon-white d-block my-2">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path d="M18,16 L9,16 C8.44771525,16 8,15.5522847 8,15 C8,14.4477153 8.44771525,14 9,14 L17,14 C17.5522847,14 18,13.5522847 18,13 C18,12.4477153 17.5522847,12 17,12 L9,12 C7.34314575,12 6,13.3431458 6,15 C6,16.6568542 7.34314575,18 9,18 L19.5,18 C21,18 21,18.5 21,19 C21,19.5 21,20 19.5,20 L7,20 C4.790861,20 3,18.209139 3,16 L3,8 C3,5.790861 4.790861,4 7,4 L17,4 C19.209139,4 21,5.790861 21,8 L21,13.0000005 C21,14.6568542 19.6568542,16 18,16 Z" fill="#000000"/>
                    </g>
                </svg>
            </span>
            <span href="#" class="text-white font-weight-bold font-size-h6">USD WALLET<br><i class="fas fa-dollar-sign text-white"></i> {{$usd}}</span>
            <br><a class="text-white text-hover-white" href="{{route('balance.my')}}">More <i class="flaticon-shapes icon-xs text-white"></i></a>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="col bg-success px-6 py-3 rounded-sm mb-5">
            <span class="svg-icon svg-icon-3x svg-icon-white d-block my-2">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path d="M18,16 L9,16 C8.44771525,16 8,15.5522847 8,15 C8,14.4477153 8.44771525,14 9,14 L17,14 C17.5522847,14 18,13.5522847 18,13 C18,12.4477153 17.5522847,12 17,12 L9,12 C7.34314575,12 6,13.3431458 6,15 C6,16.6568542 7.34314575,18 9,18 L19.5,18 C21,18 21,18.5 21,19 C21,19.5 21,20 19.5,20 L7,20 C4.790861,20 3,18.209139 3,16 L3,8 C3,5.790861 4.790861,4 7,4 L17,4 C19.209139,4 21,5.790861 21,8 L21,13.0000005 C21,14.6568542 19.6568542,16 18,16 Z" fill="#000000"/>
                    </g>
                </svg>
            </span>
            <span href="#" class="text-white font-weight-bold font-size-h6">REGISTER WALLET<br><i class="fas fa-dollar-sign text-white"></i> {{$register}}</span>
            <br><a class="text-white text-hover-white" href="{{route('balance.register')}}">More <i class="flaticon-shapes icon-xs text-white"></i></a>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="col bg-danger px-6 py-3 rounded-sm mb-5">
            <span class="svg-icon svg-icon-3x svg-icon-white d-block my-2">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <polygon fill="#000000" opacity="0.3" points="6 3 18 3 20 6.5 4 6.5"/>
                        <path d="M6,5 L18,5 C19.1045695,5 20,5.8954305 20,7 L20,19 C20,20.1045695 19.1045695,21 18,21 L6,21 C4.8954305,21 4,20.1045695 4,19 L4,7 C4,5.8954305 4.8954305,5 6,5 Z M9,9 C8.44771525,9 8,9.44771525 8,10 C8,10.5522847 8.44771525,11 9,11 L15,11 C15.5522847,11 16,10.5522847 16,10 C16,9.44771525 15.5522847,9 15,9 L9,9 Z" fill="#000000"/>
                    </g>
                </svg>
            </span>
            <span class="text-white font-weight-bold font-size-h6 mt-2">INVESTMENT <br><i class="fas fa-dollar-sign text-white"></i> {{$package}}</span>
            <br><a class="text-white text-hover-white" href="{{(Auth::user()->hasRole('member') ? route('program.index') : route('program.by_admin'))}}">Invest <i class="flaticon-shapes icon-xs text-white"></i></a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-custom card-stretch gutter-b">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label font-weight-bolder text-dark">Sales Stat</span>
                    <span class="text-muted mt-3 font-weight-bold font-size-sm">My Income</span>
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
                                <span class="text-dark text-hover-primary mb-1 font-size-lg">Active Income</span>
                                <span class="text-muted"><i class="fas fa-dollar-sign"></i> {{number_format($bonus_aktif,2)}}</span>
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
                                <span class="text-dark text-hover-success mb-1 font-size-lg">Passive Income</span>
                                <span class="text-muted"><i class="fas fa-dollar-sign"></i> {{number_format($bonus_pasif,2)}}</span>
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
                                <span class="text-dark text-hover-danger mb-1 font-size-lg">Today Income</span>
                                <span class="text-muted"><i class="fas fa-dollar-sign"></i> {{$todayEarn}}</span>
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
                                <span class="text-dark text-hover-info mb-1 font-size-lg">Total Income</span>
                                <span class="text-muted"><i class="fas fa-dollar-sign"></i> {{$totalEarn}} / {{number_format($max_profit,2)}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: {{$percent}}%;" aria-valuenow="{{$percent}}" aria-valuemin="0" aria-valuemax="100">{{$percent}}%</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-custom card-stretch gutter-b">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label font-weight-bolder text-dark">Pre Sales</span>
                    <span class="text-muted mt-3 font-weight-bold font-size-sm">Trustme Coin</span>
                </h3>
            </div>
            <div class="card-body pt-8">
                @foreach($price as $value)
                    @php
                        $percentase = round(($value->amount - $value->rest)/$value->amount * 100,2);
                    @endphp
                    <div class="form-group">
                        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap mb-2">
                            <div class="d-flex align-items-center flex-wrap mr-1">
                                <div class="d-flex align-items-baseline flex-wrap mr-5">
                                    <h5 class="text-dark font-weight-bold my-1 mr-5">Step {{$value->id}} : {{number_format($value->amount)}} TC @if($value->rest == 0) <span class="label label-xl label-inline label-light-danger">Sold</span> @endif</h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <span>${{$value->price}}</span>
                            </div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: {{$percentase}}%;" aria-valuenow="{{$percentase}}" aria-valuemin="0" aria-valuemax="100">{{$percentase}}%</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .apexcharts-active{
        display: none;
    }
    .modal {
        text-align: center;
    }

    @media screen and (min-width: 768px) {
        .modal:before {
            display: inline-block;
            vertical-align: middle;
            content: " ";
            height: 100%;
        }
    }

    .modal-dialog {
        display: inline-block;
        text-align: left;
        vertical-align: middle;
    }
</style>
@endsection
