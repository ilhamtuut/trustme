@extends('layouts.backend',['active'=>'balance','page'=>'balance'])

@section('page-title')
<span class="svg-icon svg-icon-white svg-icon-sm">
    <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <g id="Stockholm-icons-/-Shopping-/-Money" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <rect id="bound" x="0" y="0" width="24" height="24"></rect>
            <path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z" id="Combined-Shape-Copy" fill="#000000" opacity="0.3" transform="translate(11.500000, 12.000000) rotate(-345.000000) translate(-11.500000, -12.000000) "></path>
            <path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z M11.5,14 C12.6045695,14 13.5,13.1045695 13.5,12 C13.5,10.8954305 12.6045695,10 11.5,10 C10.3954305,10 9.5,10.8954305 9.5,12 C9.5,13.1045695 10.3954305,14 11.5,14 Z" id="Combined-Shape" fill="#000000"></path>
        </g>
    </svg>
</span>
Balance
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
      <a href="#" class="text-white text-hover-dark">Balance</a>
  </li>
@endsection

@section('content')
<div class="card card-custom">
    <div class="card-body">
        <div class="mb-7">
            <div class="row align-items-center">
                <div class="col-lg-12 col-xl-12">
                    <form action="{{ route('balance.user') }}" method="get">
                      <div class="row align-items-center">
                          <div class="col-lg-6 my-2 my-md-0">
                            <select id="wallet" name="wallet" class="form-control select2" style="width: 100%;">
                              <option value="">Choose</option>
                              <option @if($wallet == 'USD Wallet') selected @endif value="USD Wallet">USD Wallet</option>
                              <option @if($wallet == 'Trustme Coin') selected @endif value="Trustme Coin">Trustme Coin</option>
                              <option @if($wallet == 'Spartan Coin') selected @endif value="Spartan Coin">Spartan Coin</option>
                              <option @if($wallet == 'Register Wallet') selected @endif value="Register Wallet">Register Wallet</option>
                            </select>
                          </div>
                          <div class="col-lg-6 my-2 my-md-0">
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
                      <th>Username</th>
                      <th>Description</th>
                      <th class="text-right">Balance ($)</th>
                    </tr>
                </thead>
                <tbody>
                  @if($data->count()>0)
                      @foreach ($data as $h)
                          <tr>
                              <td>{{++$i}}</td>
                              <td>
                                @if($h->description == 'Trustme Coin')
                                    <a class="text-hover-warning text-warning" href="{{ route('balance.harvest_member',$h->user_id) }}">{{ucfirst($h->user->username)}}</a>
                                @elseif($h->description == 'Spartan Coin')
                                    <a class="text-hover-warning text-warning" href="{{ route('balance.spartan_member',$h->user_id) }}">{{ucfirst($h->user->username)}}</a>
                                @elseif($h->description == 'USD Wallet')
                                    <a class="text-hover-warning text-warning" href="{{ route('balance.my_member',$h->user_id) }}">{{ucfirst($h->user->username)}}</a>
                                @elseif($h->description == 'Register Wallet')
                                    <a class="text-hover-warning text-warning" href="{{ route('balance.register_member',$h->user_id) }}">{{ucfirst($h->user->username)}}</a>
                                @endif
                              </td>
                              <td>{{$h->description}}</td>
                              <td class="text-right">
                                  {{number_format($h->balance,2)}}
                              </td>
                          </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="4" class="text-center">No data available in table</td>
                      </tr>
                  @endif
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="3">Total</td>
                    <td class="text-right">{{number_format($total,2)}}</td>
                  </tr>
                </tfoot>
            </table>
            {!! $data->appends(['wallet'=>$wallet,'search'=>$search])->render() !!}
        </div>
        <!--end: Datatable-->
    </div>
</div>
@endsection
