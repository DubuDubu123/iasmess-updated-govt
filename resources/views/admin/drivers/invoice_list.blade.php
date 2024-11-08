@extends('admin.layouts.app')


@section('title', 'Main page')

@section('content')

<!-- Start Page content -->
<section class="content">

<div class="row">
<div class="col-12">
<div class="box">

	<div class="box-header with-border">
        <div class="row text-right">
           <div class="col-2">
				<div class="form-group">
				<input type="text" name="search" class="form-control" placeholder="@lang('view_pages.enter_keyword')">
				</div>
			</div>

			<div class="col-1">
				<button class="btn btn-success btn-outline btn-sm mt-5" type="submit">
				@lang('view_pages.search')
				</button>
			</div> 
			<div class="col-9 text-right">
			<a href="{{url('drivers')}}" class="btn btn-danger btn-sm">
			<i class="mdi mdi-keyboard-backspace mr-2"></i>@lang('view_pages.back')</a>
			</div>
		</div>
	</div>

		<div class="box-body no-padding">
		    <div class="table-responsive">
		      <table class="table table-hover">
				<thead>
				<tr>


				<th> @lang('view_pages.s_no')
				<span style="float: right;">

				</span>
				</th>
				<th> @lang('view_pages.invoice_number')
				<span style="float: right;">
				</span>
				</th>
				<th> @lang('view_pages.invoice_type')
				<span style="float: right;">
				</span>
				</th>				
				<th> @lang('view_pages.name')
				<span style="float: right;">
				</span>
				</th>
				<th> @lang('view_pages.invoice_amount')
				<span style="float: right;">
				</span>
				</th>
				<th> @lang('view_pages.invoice_date')
				<span style="float: right;">
				</span>
				</th>		
				<th> @lang('view_pages.from')
				<span style="float: right;">
				</span>
				</th>		
			     <th> @lang('view_pages.to')
				<span style="float: right;">
				</span>
				</th>	
				<th> @lang('view_pages.status')
				<span style="float: right;">
				</span>
				</th>
				<th> @lang('view_pages.action')
				<span style="float: right;">
				</span>
				</th>
				</tr>
				</thead>
				<tbody>
				@if(count($results)<1)
				    <tr>
				        <td colspan="11">
				        <p id="no_data" class="lead no-data text-center">
				        <img src="{{asset('assets/img/dark-data.svg')}}" style="width:150px;margin-top:25px;margin-bottom:25px;" alt="">
				     <h4 class="text-center" style="color:#333;font-size:25px;">@lang('view_pages.no_data_found')</h4>
				 </p>
				    </tr>
				    @else

				@php  $i= 1; @endphp

				@foreach($results as $key => $result)
				<tr>
				<td>{{ $i++ }} </td>
				<td> {{$result->invoice_number}}</td>

				<td> 
					@if ($result->driverSubscription)
						@if($result->driverSubscription->subscription_type=="monthly")
				        	{{ "Monthly"  }} {{"Subscription"}}
				        @elseif($result->driverSubscription->subscription_type=="daily")
				           {{ "Daily"  }} {{"Subscription"}}
				        @elseif($result->driverSubscription->subscription_type=="weekly")
				           {{ "Weekly"  }} {{"Subscription"}}	
				        @else
				           {{ "Yearly"  }} {{"Subscription"}}
				        @endif
					@else
					{{ "Normal" }}</td>
					@endif

				<td>
					{{$driver->name}}
				</td>
				<td> {{$result->amount}}</td>
				<td> {{$result->getConvertedCreatedAtAttribute()}}</td>

				@if($result->is_subscription_invoice==true)
				<td> {{$result->driverSubscription->getConvertedCreatedAtYearAttribute() ?? '-'}}</td>
				<td> {{$result->driverSubscription->getConvertedExpiredAtAttribute() ?? '-'}}</td>

				@else
				<td> {{$result->getConvertedFromAttribute() ?? '-'}}</td>
				<td> {{$result->getConvertedToAttribute() ?? '-'}}</td>
				@endif

				@if($result->is_paid)
				<td><button class="btn btn-success btn-sm">@lang('view_pages.paid')</button></td>
				@else
				<td><button class="btn btn-danger btn-sm">@lang('view_pages.un_paid')</button></td>
				@endif
				<td>

				<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('view_pages.action')
				</button>

			        
				    <div class="dropdown-menu" x-placement="bottom-start">	
				      <a class="dropdown-item" href="{{url('drivers/invoice',$result->id)}}">
				            <i class="fa fa-pencil"></i>@lang('view_pages.view')
				      </a>

				        <a class="dropdown-item sweet-delete" href="{{url('drivers/invoice/delete',$result->id)}}"><i class="fa fa-trash-o"></i>@lang('view_pages.delete')</a>				        
				    </div>

				</td>
				</tr>
				@endforeach
				@endif
				</tbody>
				</table>
				<div class="text-right">
					<span  style="float:right">
					{{$results->links()}}
					</span>
				</div>
			</div>
		</div>
</div>

</div>
</div>
<!-- content -->
{{--</div>--}}
<script>
	
$('.sweet-delete').click(function(e){
    button=$(this);
    e.preventDefault();

        swal({
            title: "Are you sure to delete ?",
            type: "error",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Delete",
            cancelButtonText: "No! Keep it",
            closeOnConfirm: false,
            closeOnCancel: true
        }, function(isConfirm){
            if (isConfirm) {
                button.unbind();
                button[0].click();
            }
        });
    });
</script>
@endsection

