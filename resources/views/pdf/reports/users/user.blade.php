<!DOCTYPE html>
<html>
<head>
    <title>IAS Mess - Admin App</title>
    <!-- App favicon -->
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 0;
        }
        p {
            font-size: .7em;
            color: #666;
        }
        #invoiceholder {
            width: 100%;
            height: 100%;
        }
        #invoice {
            position: relative;
            margin: 0 auto;
            width: 90%;
            background: #FFF;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        #invoice1 {
            padding: 20px;
        }
        .info {
            display: block;
            text-align: center;
            width: 100%;
        }
        .info h2 {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
            font-size: 8px;
        }
        th {
            background: #0eb7cc;
            color: white;
        }
        .label {
            padding: 5px;
            border-radius: 3px;
        }
        .label-success {
            background-color: #28a745;
            color: white;
        }
        .header {
            text-align: center;
        }
        .header img {
            width: 90px;
            margin-bottom: 10px;
        }
        .header h2 {
            line-height: 1.2;
        }
        .header p {
            font-size: 9px;
            line-height: 1.2;
            margin: 2px 0;
        }
        .table-hover td {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</head>
<body>
<div id="invoiceholder">
    <div id="invoice" class="effect2">
        <div id="invoice1" class="effect3">
            <div class="header">
                <img src="http://iasmess.dubudubutechnologies.com/assets/img/logo.png" alt="logo">
                <h2><b>IAS Officer's Mess</b></h2>
                <p>jsprotocol@tn.gov.in</p>
                <p>289-335-6503</p>
            </div>
            <div class="info">
                <h3><b>Officer's List</b></h3>
            </div>
           <table class="table table-hover">
    <thead>
        <tr>
            <th>S.No</th>
            <th>User ID</th>
            <th>Officer's Name</th>
            <th>Email address</th>
            <th>Mobile Number</th>
            <th>Address</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $k => $val)
            <tr>
                <td>{{ $k + 1 }}</td>
                <td>{{ $val->userid }}</td>
                <td>{{ $val->name }}</td>
                <td>{{ $val->email }}</td>
                <td>{{ $val->mobile }}</td>
                <td>{{ $val->address }}</td>
                @if ($val->is_approve == 0 && $val->is_deleted == false)
                    <td><span class="label label-warning">Pending</span></td>
                @elseif ($val->is_approve == 1 && $val->is_deleted == false)
                    <td><span class="label label-success">Approved</span></td>
                @elseif($val->is_deleted == true)
                    <td><span class="label label-danger">Deceased</span></td>
                @endif
            </tr>
        @empty
            <tr>
                <td colspan="7">
                    <h4 class="text-center" style="color:#333;font-size:25px;">No records found</h4>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

        </div>
    </div>
</div>
</body>
</html>
