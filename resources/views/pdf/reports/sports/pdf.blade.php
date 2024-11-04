<!DOCTYPE html>
<html><head> 
    <title>IAS Mess - Admin App</title> 
    <!-- App favicon --> 
    <style>
    body {
            font-family: 'DejaVu Sans', sans-serif;
        }
p{
  font-size: .7em;
  color: #666; 
} 
#invoiceholder {
  width: 100%;
  height: 100%;
} 

#invoice1 {
  position: relative;
  margin: 0 auto;
  width: 100%; 
  background: #FFF;
}

[id*='invoice-'] {
  padding: 0px 30px 6px 30px;
}

 

.info {
  display: block;
  margin-top: 1px;
  text-align: center;
  width: 100%;
}

.info1 {
  margin-top: 10px;
}

table {
  width: 100%;
  border-collapse: collapse;
}

td {
  padding: 5px 15px; 
}

.tabletitle {
  padding: 5px;
  /* background: #EEE; */
}

.itemtext {
  font-size: .9em;
}

#legalcopy {
  margin-top: 30px;
}

form {
  float: right;
  margin-top: 30px;
  text-align: right;
}

.effect2 {
  position: relative;
} 

.legal {
  width: 70%;
}

h2 {
  font-size: .9em;
  padding: 0px !important;
  margin: 0px; 
}

.table > tbody > tr > td,
.table > tbody > tr > th,
.table > tfoot > tr > td,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > thead > tr > th {
  padding: 6px 0px 3px 0px !important;
}

table.table.border-gray-200.mt-3 tr td {
  border: none;
}

#invoice {
  position: relative;
  margin: 0 auto;
  width: 100%;
}

.content {
  margin-top: 0px !important;
}
table#room-tariff thead tr td{
    background:#0eb7cc;
    color:white
} 
table.table.table-hover thead th, table.table.table-hover tr td {
    border: 1px solid #d8d8d8;
    padding: 15px !important;
}
.table .total-row td {
  font-weight: bold;
}

.table .total-row td:first-child {
    text-align: right;
}
</style>
</head> 
<body>
<div id="invoiceholder">
  <div id="invoice" class="effect2">
   
    
    <div id="invoice1" class="effect3">
      <table>
    <thead>
        <tr>
            <th>S.No</th>
            <th>Booking Type</th>
            <th>Booking ID</th>
            <th>Officer's ID</th>
            <th>Officer's Name</th>
            <th>Check-in</th>
            <th>Guest Type</th>
            <th>Details</th> <!-- Sports Type or other details -->
            <th>Status</th>
            <th>Payment Status</th>
            <th>Price</th>
            <th>Check-out</th>
            <th>Actual Check-in</th>
            <th>Actual Check-out</th>
            <th>No Of Days Booked</th>
            <th>No Of Rooms Booked</th>
            <th>Booking Count</th>
            <th>Booked By</th>
            <th>Restaurant Charges</th>
        </tr>
    </thead>
    <tbody>
        @php $i = 1; @endphp
        @foreach($results as $type => $data)
            @foreach($data as $result)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ ucfirst($type) }}</td>
                    <td>{{ $result->booking_id }}</td>
                    <td>{{ $result->user->userid ?? '----' }}</td>
                    <td>{{ $result->user->name ?? '----' }}</td>
                    <td>{{ $result->checkin_date ? date('Y-m-d', strtotime($result->checkin_date)) : '----' }}</td>
                    <td>{{ ucfirst($result->guest_type ?? '----') }}</td>
                    <td>
                        @if($type == 'sports')
                            @foreach($result->details as $k => $v)
                                {{ $v->tariff->name }}@if($k != (count($result->details)-1)), @endif
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
                    <!-- Set check-out date to check-in date for party bookings -->
                    <td>{{ $result->checkin_date ? date('Y-m-d', strtotime($result->checkin_date)) : '----' }}</td>
                    <!-- Actual check-in date -->
                    <td>
                        @if($type == 'room' && $result->actual_checkin_date)
                            {{ date('Y-m-d H:i:s', strtotime($result->actual_checkin_date)) }}
                        @else
                            ----
                        @endif
                    </td>
                    <!-- Actual check-out date -->
                    <td>
                        @if($type == 'room' && $result->actual_checkout_date)
                            {{ date('Y-m-d H:i:s', strtotime($result->actual_checkout_date)) }}
                        @else
                            ----
                        @endif
                    </td>
                    <td>{{ $result->no_of_days ?? '----' }}</td>
                    <td>{{ $result->no_of_rooms ?? '----' }}</td>
                    <td>{{ $result->booking_count ?? '----' }}</td>
                    <td>{{ $result->booked_user->name ?? '----' }}</td>
                    <td>{{ isset($result->invoice) ? $result->invoice->additional_charge : '----' }}</td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>

          
        
      
    </div>
  </div>
</div>

   



</body></html>