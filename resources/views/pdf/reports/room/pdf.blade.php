<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IAS Mess - Admin App</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 0;
            font-size: 8px; /* Reduced font size for better fit */
        }
        p {
            font-size: 8px;
            color: #666;
        }
        #invoiceholder {
            width: 100%;
            height: 100%;
            overflow: hidden; /* Prevent overflow */
        }
        #invoice {
            width: 100%;
            margin: 0;
            background: #FFF;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        #invoice1 {
            padding: 10px; /* Reduced padding for more space */
            width: 100%;
            box-sizing: border-box;
        }
        .info {
            text-align: center;
            width: 100%;
        }
        .info h3 {
            margin: 10px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px; /* Reduced margin */
            table-layout: fixed; /* Fixed layout to control column widths */
            word-wrap: break-word;
        }
        th, td {
            padding: 4px; /* Reduced padding for more space */
            border: 1px solid #ddd;
            text-align: left;
            font-size: 8px; /* Reduced font size */
        }
        th {
            background: #0eb7cc;
            color: white;
        }
        .header {
            text-align: center;
        }
        .header img {
            width: 40px; /* Reduced logo size */
            margin-bottom: 5px; /* Reduced margin */
        }
        .header h2 {
            line-height: 1.2;
            font-size: 10px; /* Reduced font size */
        }
        .header p {
            font-size: 8px;
            line-height: 1.2;
            margin: 2px 0;
        }
        .table-hover td {
            white-space: normal;
            word-break: break-word;
        }
    </style>
</head>
<body>
<div id="invoiceholder">
    <div id="invoice" class="effect2">
        <div id="invoice1" class="effect3">
            <div class="header">
                <img src="{{url('/')}}/assets/img/logo.png" alt="logo">
                <h2><b>IAS Officer's Mess</b></h2>
                <p>jsprotocol@tn.gov.in</p>
                <p>289-335-6503</p>
            </div>
            <div class="info">
                <h3><b>Booking Report</b></h3>
            </div>
            <table>
                <thead>
                    <tr>
                        <th style="width: 3%;">S.No</th>
                        <th style="width: 7%;">Booking Type</th>
                        <th style="width: 7%;">Booking ID</th>
                        <th style="width: 7%;">Officer's ID</th>
                        <th style="width: 8%;">Officer's Name</th>
                        <th style="width: 7%;">Check-in</th>
                        <th style="width: 7%;">Guest Type</th>
                        <th style="width:8%;">Details</th> <!-- Sports Type or other details -->
                        <th style="width: 7%;">Status</th>
                        <th style="width: 7%;">Payment Status</th>
                        <th style="width: 7%;">Price</th> <!-- Corrected Price Field -->
                        <th style="width: 7%;">Check-out</th>
                        <!--<th style="width: 6%;">Actual Check-in</th>-->
                        <!--<th style="width: 6%;">Actual Check-out</th>-->
                        <th style="width: 5%;">No Of Days</th>
                        <th style="width: 5%;">No Of Rooms</th>
                        <!--<th style="width: 6%;">Booking Count</th>-->
                        <th style="width: 7%;">Booked By</th>
                        <th style="width: 6%;">Restaurant Charges</th>
                    </tr>
                </thead>
               <tbody>
    @php $i = 1; @endphp
    @php $hasData = false; @endphp
    @foreach($results as $type => $data)
        @if (count($data) > 0)
            @php $hasData = true; @endphp
            @foreach($data as $result)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ ucfirst($type) }}</td>
                    <td>{{ $result->booking_id }}</td>
                    <td>{{ $result->user->userid ?? '----' }}</td>
                    <td>{{ $result->user->name ?? '----' }}</td>
                    <td>{{ $result->checkin_date ? date('Y-m-d', strtotime($result->checkin_date)) : '----' }}</td>

                    <!-- Corrected Guest Type Field -->
                    <td>
                        @if($type == 'room' && isset($result->booking_guest_details))
                            {{ ucfirst($result->booking_guest_details->first()->guest_type ?? '----') }}
                        @else
                            {{ ucfirst($result->guest_type ?? '----') }}
                        @endif
                    </td>

                    <td>
                        @if($type == 'sports')
                            @foreach($result->details as $k => $v)
                                {{ $v->tariff->name }}@if($k != (count($result->details) - 1)), @endif
                            @endforeach
                        @else
                            ----
                        @endif
                    </td>

                    <td>
                        @php
                            $statusText = '----';
                            switch($result->status) {
                                case 0: $statusText = 'Booked'; break;
                                case 1: $statusText = 'Checked-in'; break;
                                case 3: $statusText = 'Completed'; break;
                                case 2: $statusText = 'Cancelled'; break;
                            }
                        @endphp
                        {{ $statusText }}
                    </td>
                    <td>{{ $result->is_paid == 1 ? 'Paid' : 'Unpaid' }}</td>

                    <!-- Corrected Price Field -->
                    <td>₹{{ $result->booked_price->total_price ?? ($result->tariff ?? '----') }}</td>


                    <td>{{ $result->checkin_date ? date('Y-m-d', strtotime($result->checkin_date)) : '----' }}</td>
                    <!--<td>-->
                    <!--    @if($type == 'room' && $result->actual_checkin_date)-->
                    <!--        {{ date('Y-m-d H:i:s', strtotime($result->actual_checkin_date)) }}-->
                    <!--    @else-->
                    <!--        ------>
                    <!--    @endif-->
                    <!--</td>-->
                    <!--<td>-->
                    <!--    @if($type == 'room' && $result->actual_checkout_date)-->
                    <!--        {{ date('Y-m-d H:i:s', strtotime($result->actual_checkout_date)) }}-->
                    <!--    @else-->
                    <!--        ------>
                    <!--    @endif-->
                    <!--</td>-->
                    <td>{{ $result->no_of_days ?? '----' }}</td>
                    <td>{{ $result->no_of_rooms ?? '----' }}</td>
                    <!--<td>{{ $result->booking_count ?? '----' }}</td>-->
                    <td>{{ $result->booked_user->name ?? '----' }}</td>
                    <td>{{ $result->invoice->additional_charge ?? '----' }}</td>
                </tr>
            @endforeach
        @endif
    @endforeach
    @if (!$hasData)
        <tr>
            <td colspan="20">
                <h4 class="text-center" style="color:#333;font-size:20px;text-align:center">@lang('view_pages.no_data_found')</h4>
            </td>
        </tr>
    @endif
</tbody>



            </table>
        </div>
    </div>
</div>
</body>
</html>
