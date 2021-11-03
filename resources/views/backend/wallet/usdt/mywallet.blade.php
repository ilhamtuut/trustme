@extends('layouts.backend',['page'=>'wallet','active'=>'dinasty_coin'])

@section('page-title')
<i class="fas fa-file-invoice-dollar text-success"></i>
Trustme Coin Address
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item">
      <a href="" class="text-white text-hover-dark">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
      <a href="#" class="text-white text-hover-dark">Trustme Coin Address</a>
  </li>
@endsection

@section('content')
<div class="card card-custom">
  <div class="card-body">
    @include('layouts.partials.alert')
    <div class="row">
      <div class="col-lg-6 @if($isShow == 0) hidden @endif">
        <div class="card card-success mb-5">
          <div class="card-header">
            <h5 class="card-title mb-0">
              <span class="font-weight-bolder text-dark">My Address</span>
            </h5>
          </div>
          <div class="card-body text-center">
            @if($address)
              <p>Your Address</p>
              <img class="mb-3" width="150px" src="{{\App\Facades\Eth::qrCode($address)}}"><br>
              <span>{{$address}} <i class="fa fa-copy text-success cursor-pointer" onclick="copyToClipboard('{{$address}}')"></i></span>
            @else
              <p>Please create your Trustme Coin Address, Click the button below.</p>
              <button type="submit" class="btn btn-success" id="btn_create">Create Address</button>
              <i class="hidden text-success" id="spinner_create"><span class="fa fa-spin fa-spinner"></span></i>
            @endif
          </div>
        </div>
      </div>
      <div class="@if($isShow == 0) col-lg-12 @else col-lg-6 @endif">
        <div class="card card-success mb-5">
          <div class="card-header">
            <h5 class="card-title mb-0">
              <span class="font-weight-bolder text-dark">Send Trustme Coin</span><br>
            </h5>
          </div>
          <div class="card-body">
                <form method="POST" action="{{route('dinasty_coin.send')}}">
                    {{ csrf_field() }}
                    @if(!Auth::user()->hasRole('member') && $isShow == 1)
                        <div class="form-group">
                            <label>Balance Eth</label>
                            <p class="text-muted font-weight-bold font-size-sm mb-0">{{$balanceEth}} ETH</p>
                        </div>
                        <div class="form-group">
                            <label>Balance DC</label>
                            <p class="text-muted font-weight-bold font-size-sm mb-0">{{$balanceErc}} DC</p>
                        </div>
                    @endif
                    <div class="form-group">
                        <label>Balance @if(!Auth::user()->hasRole('member')) Virtual @endif</label>
                        <p class="text-muted font-weight-bold font-size-sm mb-0">{{$saldo}} DC</p>
                    </div>
                    <div class="form-group">
                        <label>Trustme Coin Address</label>
                        <div class="input-group">
                            <input id="text-value" name="address" type="text" class="form-control" placeholder="Trustme Coin Address">
                            <div class="input-group-prepend" style="cursor: pointer;" onclick="pasteAddress()">
                                <span class="input-group-text bg-success">
                                <i class="la la-copy text-white"></i>
                                </span>
                            </div>
                        </div>
                        <p id="error-address" class="text-danger hidden">Address invalid</p>
                    </div>
                    <div class="form-group">
                        <label>Amount</label>
                        <input id="amount" type="text" name="amount" class="form-control" placeholder="Amount">
                        <p class="text-info">Minimal : {{$min}} TC <span id="fee-amount" class="text-info"></span></p>
                    </div>
                    <div class="form-group">
                        <label>Estimated DC</label>
                        <input id="estimated" type="text" class="form-control" placeholder="Estimated DC">
                    </div>
                    <div class="text-right">
                    <div id="action">
                        <button type="submit" class="btn btn-success" id="btn_submit" disabled>Send</button>
                        <button type="button" class="btn btn-danger" id="btn_cancel">Cancel</button>
                    </div>
                    <i class="hidden text-success" id="spinner"><span class="fa fa-spin fa-spinner"></span></i>
                    </div>
                </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<br>
<div class="card card-custom">
    <div class="card-body">
        <div class="mb-7">
            <div class="row align-items-center">
                <div class="col-lg-12 col-xl-12">
                    <form action="{{ route('dinasty_coin.myWallet') }}" method="get">
                      <div class="row align-items-center">
                          <div class="col-lg-8 my-2 my-md-0"></div>
                          <div class="col-lg-4 my-2 my-md-0">
                            <div class="input-group">
                                <input name="search" type="text" class="form-control" placeholder="Search TRXID">
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
                      <th>Date</th>
                      <th>TRXID</th>
                      <th class="text-center">Status</th>
                      <th class="text-right">Amount</th>
                    </tr>
                </thead>
                <tbody>
                  @if($data->count()>0)
                    @foreach ($data as $h)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{date('d F Y H:i:s', strtotime($h->created_at))}}</td>
                            <td>{{($h->trx_id) ? $h->trx_id : '-'}}</td>
                            <td class="text-center">
                              @if($h->status == 1)
                                  <span class="label label-md label-light-success label-inline">Success</span>
                              @else
                                  <span class="label label-md label-light-warning label-inline">Pending</span>
                              @endif
                            </td>
                            <td class="text-right">
                              @if($address == $h->from_address)
                                <span class="text-danger">-</span>{{($h->amount)}}
                              @else
                                <span class="text-success">+</span>{{($h->amount)}}
                              @endif

                            </td>
                        </tr>
                    @endforeach
                  @else
                      <tr>
                        <td colspan="5" class="text-center">No data available in table</td>
                      </tr>
                  @endif
                </tbody>
            </table>
            {!! $data->appends(['search'=>request()->search])->render() !!}
        </div>
        <!--end: Datatable-->
    </div>
</div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/web3/1.3.1/web3.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/ethereumjs/browser-builds/dist/ethereumjs-tx/ethereumjs-tx-1.3.3.min.js"></script>
<script type="text/javascript">
    var fee = 0;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // var web3 = new Web3(new Web3.providers.HttpProvider('{{env('APP_URL')}}'));
    // const weiValue = web3.utils.toWei('15', 'ether');

    $('#btn_create').on('click',function(){
        $(this).addClass('hidden');
        $('#spinner_create').removeClass('hidden');
        var web3 = new Web3(new Web3.providers.HttpProvider('{{env('APP_URL')}}'));
        var web3Data = web3.eth.accounts.create();
        var address = web3Data.address;
        var key = web3Data.privateKey;
        console.log(web3Data);
        $.ajax({
            url:'{{ route('dinasty_coin.addWallet') }}',
            type:'POST',
            data:{
                address:address,
                key:key
            },
            success:function(data) {
                console.log(data);
                location.reload();
            }
        });
    });

    $('#text-value').on('keyup change',function(){
        $('#btn_submit').attr('disabled','disabled');
        var address = $(this).val();
        $('#error-address').addClass('hidden');
        $('#fee-amount').html('');
        $('#amount').val('');
        $('#estimated').val('');
        if(address){
            checkAddress(address);
        }
    });

    function pasteAddress() {
        let pasteArea = document.getElementById('text-value');
        pasteArea.value = '';

        navigator.clipboard.readText()
        .then((text)=>{
            pasteArea.value = text;
            checkAddress(text);
        });
    }

    function checkAddress(address){
        $.ajax({
            url:'{{ url('dinasty_coin/check') }}/' + address,
            type:'GET',
            success:function(data) {
                console.log(data);
                if(data.success){
                    $('#btn_submit').removeAttr('disabled');
                    fee = data.data.fee;
                    if(fee > 0){
                        $('#fee-amount').html('Fee : ' + fee * 100 + ' %');
                    }
                }else{
                    $('#error-address').removeClass('hidden');
                    $('#btn_submit').attr('disabled','disabled');
                }
            }
        });
    }

    $('#amount').on('keyup change', function(){
        var amount = $(this).val();
        var amountFee = amount * fee;
        var  estimated = amount - amountFee;
        if(estimated > 0){
            $('#estimated').val(estimated);
        }else{
            $('#estimated').val('');
        }
    });

    $('#btn_submit').on('click',function(){
        $('#action').addClass('hidden');
        $('#spinner').removeClass('hidden');
    });

    $('#btn_cancel').on('click',function(){
        $('#btn_submit').attr('disabled','disabled');
        $('#error-address').addClass('hidden');
        $('#fee-amount').html('');
        $('#text-value').val('');
        $('#amount').val('');
        $('#estimated').val('');
    });
</script>
@endsection
