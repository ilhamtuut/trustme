<div aria-labelledby="mySmallModalLabel" data-keyboard="false" data-backdrop="static" class="modal fade detail-modal-{{$wd->id}}" role="dialog" tabindex="-1" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      	<div class="modal-header bg-success">
	        <h3 class="modal-title text-white"><i class="fa fa-info-circle text-white"></i> Information</h3>
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	    </div>
	    <div class="modal-body">
	      	<div class="row">
	      		<div class="col-md-6">
	      			<div class="panel panel-primary">
	      				<div class="panel-heading">
		                    <div class="pull-left">
		                        <h6 class="panel-title txt-light">Detail Withdrawal</h6>
		                    </div>
		                    <div class="clearfix"></div>
		                </div>
		              	<div class="panel-body">
				      		<p>Name : {{ucfirst($wd->user->name)}}</p>
				      		<p>Username : {{ucfirst($wd->user->username)}}</p>
				      		<p>Amount ($) : {{number_format($wd->amount,2)}}</p>
				      		<p>Exchange Rate : {{number_format($wd->price,2)}}</p>
				      		<p>Total : {{number_format($wd->total,8)}}</p>
				      		<p>Fee : {{number_format($wd->fee,8)}}</p>
				      		<p>Receive : {{number_format($wd->receive,8)}}</p>
				      		<p>Status :
				      			@if($wd->status == 1)
			                    	<span class="label label-md label-light-success label-inline">Success</span>
				                @elseif($wd->status == 2)
				                    <span class="label label-md label-light-danger label-inline">Canceled</span>
				                @else
				                    <span class="label label-md label-light-warning label-inline">Pending</span>
				                @endif
			                </p>
				      		<p>Description : {{$wd->description}}</p>
				      		<p>Date : {{$wd->created_at}}</p>
		              	</div>
		            </div>
	      		</div>
	      		<div class="col-md-6">
	      			<div class="panel panel-primary">
	      				<div class="panel-heading">
		                    <div class="pull-left">
		                        <h6 class="panel-title txt-light">{{($wd->type == 'Bank') ? 'Account Bank' : 'Trustme Coin Address' }}</h6>
		                    </div>
		                    <div class="clearfix"></div>
		                </div>
		              	<div class="panel-body">
		              		@php
		              			$json = json_decode($wd->json);
		              		@endphp
		              		@if($wd->type == 'bank')
					      		<p>Bank Name : {{$json->bank_name}}</p>
					      		<p>Bank Username : {{$json->account_name}}</p>
					      		<p>Bank Account : {{$json->account_number}} <span class="label label-md label-light-primary label-inline cursor-pointer"  onclick="copyToClipboard('{{$json->account_number}}')">Copy <i class="la la-copy icon-sm text-primary"></i></span></p>
				      			@if(isset($json->txid))
					      			<p>Ref : {{$json->txid}} <span class="label label-md label-light-primary label-inline cursor-pointer" onclick="copyToClipboard('{{$json->txid}}')">Copy <i class="la la-copy icon-sm text-primary"></i></span></p>
				      			@endif
				      		@else
				      			<p>Trustme Coin Address : </p>
				      			<p>{{$json->address}} <span class="label label-md label-light-primary label-inline cursor-pointer" onclick="copyToClipboard('{{$json->address}}')">Copy <i class="la la-copy icon-sm text-primary" ></i></span></p>
				      			@if(isset($json->txid))
					      			<p>Txid : </p>
					      			<p>{{$json->txid}} <span class="label label-md label-light-primary label-inline cursor-pointer" onclick="copyToClipboard('{{$json->txid}}')">Copy <i class="la la-copy icon-sm text-primary"></i></span></p>
					      		@endif
				      		@endif
		              	</div>
		            </div>
	      		</div>
	      		<hr>
			</div>
	    </div>
	    <div class="modal-footer" id="footer-md">
	    	@if($wd->status == 0)
        	<button class="btn btn-light-success" type="button" onclick="accept('{{$wd->id}}','{{ucfirst($wd->user->username)}}');"> Accept</button>
			<button class="btn btn-light-warning" type="button" onclick="reject('{{$wd->id}}','{{ucfirst($wd->user->username)}}');"> Reject</button>
			@endif
			<button class="btn btn-light-danger" data-dismiss="modal" type="button"> Close</button>
	  	</div>
    </div>
  </div>
</div>
