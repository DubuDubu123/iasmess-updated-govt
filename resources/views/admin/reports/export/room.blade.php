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
                                case 2: $statusText = 'Completed'; break;
                                case 3: $statusText = 'Cancelled'; break;
                            }
                        @endphp
                        {{ $statusText }}
                    </td>
                    <td>{{ $result->is_paid == 1 ? 'Paid' : 'Unpaid' }}</td>
                    <td>₹{{ $result->booked_price->total_price ?? ($result->tariff ?? '----') }}</td>
                    <td>
                        @if($type == 'party' || $type == 'sports')
                            {{ $result->checkin_date ? date('Y-m-d', strtotime($result->checkin_date)) : '----' }}
                        @else
                            {{ $result->checkout_date ? date('Y-m-d', strtotime($result->checkout_date)) : '----' }}
                        @endif
                    </td>
                    <td>
                        @if($type == 'room' && $result->actual_checkin_date)
                            {{ date('Y-m-d H:i:s', strtotime($result->actual_checkin_date)) }}
                        @else
                            {{ $result->checkin_date ? date('Y-m-d', strtotime($result->checkin_date)) : '----' }}
                        @endif
                    </td>
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
