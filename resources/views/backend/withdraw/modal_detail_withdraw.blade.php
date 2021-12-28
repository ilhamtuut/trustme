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
				      		<p class="mb-1">Name : {{ucfirst($wd->user->name)}}</p>
				      		<p class="mb-1">Username : {{ucfirst($wd->user->username)}}</p>
				      		<p class="mb-1">Amount : {{number_format($wd->amount,8)}} {{($type == 'spartan')?'SPARTAN':'TMC'}}</p>
                            @if($type == 'trustme')
                                <p class="mb-1">Exchange Rate : {{number_format($wd->price,2)}} USD</p>
                                <p class="mb-1">Total : {{number_format($wd->total,2)}} USD</p>
                            @endif
				      		<p class="mb-1">Fee : {{number_format($wd->fee,8)}} {{($type == 'spartan')?'SPARTAN':'TMC'}}</p>
				      		<p class="mb-1">Receive : {{number_format($wd->receive,8)}} {{($type == 'spartan')?'SPARTAN':'TMC'}}</p>
				      		<p class="mb-1">Status :
				      			@if($wd->status == 1)
			                    	<span class="label label-md label-light-success label-inline">Success</span>
				                @elseif($wd->status == 2)
				                    <span class="label label-md label-light-danger label-inline">Canceled</span>
				                @else
				                    <span class="label label-md label-light-warning label-inline">Pending</span>
				                @endif
			                </p>
				      		<p class="mb-1">Description : {{$wd->description}}</p>
				      		<p class="mb-1">Date : {{$wd->created_at}}</p>
		              	</div>
		            </div>
	      		</div>
	      		<div class="col-md-6">
	      			<div class="panel panel-primary">
	      				<div class="panel-heading">
		                    <div class="pull-left">
		                        <h6 class="panel-title txt-light">{{($wd->type == 'Bank') ? 'Account Bank' : ucfirst($type).' Coin Address' }}</h6>
		                    </div>
		                    <div class="clearfix"></div>
		                </div>
		              	<div class="panel-body">
		              		@php
		              			$json = json_decode($wd->json);
		              		@endphp
		              		@if($wd->type == 'bank')
					      		<p class="mb-1">Bank Name : {{$json->bank_name}}</p>
					      		<p class="mb-1">Bank Username : {{$json->account_name}}</p>
					      		<p class="mb-1">Bank Account : {{$json->account_number}} <span class="label label-md label-light-primary label-inline cursor-pointer"  onclick="copyToClipboard('{{$json->account_number}}')">Copy <i class="la la-copy icon-sm text-primary"></i></span></p>
				      			@if(isset($json->txid))
					      			<p class="mb-1">Ref : {{$json->txid}} <span class="label label-md label-light-primary label-inline cursor-pointer" onclick="copyToClipboard('{{$json->txid}}')">Copy <i class="la la-copy icon-sm text-primary"></i></span></p>
				      			@endif
				      		@else
				      			<p class="mb-1">{{ucfirst($type)}} Coin Address : </p>
				      			<p class="mb-1">{{$json->address}} <br> <span class="label label-md label-light-primary label-inline cursor-pointer" onclick="copyToClipboard('{{$json->address}}')">Copy <i class="la la-copy icon-sm text-primary" ></i></span></p>
				      			@if(isset($json->txid))
					      			<p class="mb-1">Txid : </p>
					      			<p class="mb-1">{{$json->txid}} <br> <span class="label label-md label-light-primary label-inline cursor-pointer" onclick="copyToClipboard('{{$json->txid}}')">Copy <i class="la la-copy icon-sm text-primary"></i></span></p>
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
