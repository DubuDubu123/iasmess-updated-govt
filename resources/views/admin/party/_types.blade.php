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
                                                    <!-- <th> Tansport Type<span style="float: right;">
</span>
</th> -->
                                                    <th> Check-in 
                                                        <span style="float: right;"> </span>
                                                    </th> 
                                                    <th> Guest Type
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
    @if($results->isEmpty())
        <tr>
            <td colspan="6">
                <p id="no_data" class="lead no-data text-center">
                    <img src="{{ asset('assets/img/dark-data.svg') }}" style="width:150px;margin-top:25px;margin-bottom:25px;" alt="">
                    <h4 class="text-center" style="color:#333;font-size:25px;">@lang('view_pages.no_data_found')</h4>
                </p>
            </td>
        </tr>
    @else
        @php  $i = $results->firstItem(); @endphp

        @foreach($results as $result)
            <tr>
                <td>{{ $i++ }} </td>
                <td>{{ $result->booking_id }}</td>
                <td>{{ date('Y-m-d', strtotime($result->checkin_date)) }}</td>
                <td>{{ $result->guest_type }}</td>
                <td>
                    @if($result->status == 0)
                        <button class="btn btn-sm text-white" style="background: #ff9900; border-color: transparent;">Booked</button>
                    @elseif($result->status == 1)
                        <button class="btn btn-sm text-white" style="background: blue; border-color: transparent;">Checked In</button>
                    @elseif($result->status == 2)
                        <button class="btn btn-sm text-white" style="background: red; border-color: transparent;">Cancelled</button>
                    @else
                        <button class="btn btn-sm text-white" style="background: green; border-color: transparent;">Completed</button>
                    @endif
                </td>
                <td>
                    <a class="dropdown-item" href="{{ url('party/view', $result->id) }}"><span class="label label-success">View</span></a>
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
