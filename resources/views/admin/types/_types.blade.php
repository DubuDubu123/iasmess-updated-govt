<div class="box-body no-padding">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>


                                                    <th> S.No
                                                        <span style="float: right;"></span>
                                                    </th>

                                                    <th> Booking ID
                                                        <span style="float: right;"></span>
                                                    </th>
                                                    @if(auth()->user()->hasRole("super-user"))
                                                       <th> User Name
                                                        <span style="float: right;"></span>
                                                    </th>
                                                    @endif
                                                    <!-- <th> Tansport Type<span style="float: right;">
</span>
</th> -->
                                                    <th> Check-in 
                                                        <span style="float: right;"> </span>
                                                    </th>
                                                    <th> check-out
                                                        <span style="float: right;"></span>
                                                    </th>
                                                 
                                                    <th> Status
                                                        <span style="float: right;"></span>
                                                    </th>

                                                    <th> Action<span style="float: right;">
</span>
                                                    </th>

                                                </tr>
                                            </thead>
                                       
<tbody>
    @if(count($results) < 1)
        <tr>
            <td colspan="8">
                <p id="no_data" class="lead no-data text-center">
                    <img src="{{ asset('assets/img/dark-data.svg') }}" style="width:150px;margin-top:25px;margin-bottom:25px;" alt="">
                    <h4 class="text-center" style="color:#333;font-size:25px;">@lang('view_pages.no_data_found')</h4>
                </p>
            </td>
        </tr>
    @else
        @php  $i = $results->firstItem(); @endphp
        @foreach($results as $key => $result)
            <tr>
                <td>{{ $i++ }} </td>
                <td>{{ $result->booking_id }}</td> 
                @if(auth()->user()->hasRole("super-user"))
                    <td>{{ $result->user_name }}</td> 
                @endif
                <td>{{ date('Y-m-d', strtotime($result->checkin_date)) }}</td>
                <td>{{ date('Y-m-d', strtotime($result->checkout_date)) }}</td> 
                <td>
                    @if($result->status == 0)
                        @if($result->is_admin_approve == 0)
                            <button class="btn btn-sm" style="background: #ff9900; border-color: transparent;color:white;">Waiting for admin approval</button>
                        @else
                            <button class="btn btn-sm" style="background: #ff9900; border-color: transparent;color:white;">Booked</button>
                        @endif
                    @elseif($result->status == 1)
                        <button class="btn btn-sm" style="background: blue; border-color: transparent;color:white;">Checked In</button>
                    @elseif($result->status == 2)
                        <button class="btn btn-sm" style="background: red; border-color: transparent;color:white;">Cancelled</button>
                    @else
                        <button class="btn btn-sm" style="background: green; border-color: transparent;color:white;">Completed</button>
                    @endif
                </td>   
                <td>
                    <a class="dropdown-item" href="{{ url('types/view', $result->id) }}">
                        <span class="label label-success">View</span>
                    </a>
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
</div></div></div>
