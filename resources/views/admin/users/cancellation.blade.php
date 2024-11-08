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
				<!-- <input type="text" name="search" class="form-control" placeholder="@lang('view_pages.enter_keyword')"> -->
				</div>
			</div>

			<div class="col-1">
				<!-- <button class="btn btn-success btn-outline btn-sm mt-5" type="submit">
				@lang('view_pages.search')
				</button> -->
			</div> 
			<div class="col-9 text-right">
			<a href="{{url('users')}}" class="btn btn-danger btn-sm">
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

				<th> @lang('view_pages.name')
				<span style="float: right;">
				</span>
				</th>

				<th> @lang('view_pages.request_number')
				<span style="float: right;">
				</span>
				</th>

				<th> @lang('view_pages.cancellation_fee')
				<span style="float: right;">
				</span>
				</th>

				<th> @lang('view_pages.cancellation_date')
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

				<td>
					{{$user->name}}
				</td>				
				<td> {{$result->request->request_number}}</td>

				<td> {{$result->amount}}</td>

				<td> {{$result->getConvertedCreatedAtAttribute() }}</td>

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

