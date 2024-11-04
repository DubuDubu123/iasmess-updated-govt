<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f7f7f7;
        }
        .container {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container" style=" width: 450px;">
        <table style="width: 100%; margin-bottom: 0px;">
            <tr>
                <td style="text-align: center;">
                    <img src="{{ asset('assets/img/logo.png') }}"  alt="Success" style="width: 100px;height: 100px;">
                </td>
            </tr>
        </table>
        <!--<h2 style="margin: 0px;margin-bottom: 20px;"> Online Payment</h2>-->
        <div style="text-align:left !important;font-weight:600;font-size:18px;margin-top:25px">Hi {{$user->name}},</div>
         <p style="text-align:left !important;margin-top: 20px;">To proceed with the payment, Click below to our secure online payment gateway.</p> 
        <table style="
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        /* background-color: #ebebeb; */
        ">
            <tbody>
                <tr> 
                    <!--<td style="padding: 10px;border: 1px solid #ddd;background: none !important;">Hi {{$user->name}}</td> -->
                </tr>
                <tr>
                
                <td style="padding: 10px;border: 1px solid #ddd;background: none !important;">Booking Id</td>
                <td style="padding: 10px;border: 1px solid #ddd;text-align: right;">{{$booking->booking_id}}</td>
            </tr>
            <tr>
                
                <td style="padding: 10px;border: 1px solid #ddd;background: none !important;">Booking Type</td>
                <td style="padding: 10px;border: 1px solid #ddd;text-align: right;">Party</td>
            </tr>
            <tr>
                @if($booking->status == 3)
                  @if($invoice->amount_need_to_paid > 0)
                    <td style="padding: 10px; border: 1px solid #ddd;">Amount To be Paid</td>
                    <td style="padding: 10px;border: 1px solid #ddd;text-align: right;font-size: 15px;font-weight: bold;">₹ {{$invoice->amount_need_to_paid}}</td>
                  @else
                    <td style="padding: 10px; border: 1px solid #ddd;">Amount To be Paid</td>
                <td style="padding: 10px;border: 1px solid #ddd;text-align: right;font-size: 15px;font-weight: bold;">₹ {{$invoice->total_amount}}</td>
                  @endif
              
                @else
                <td style="padding: 10px; border: 1px solid #ddd;">Amount To be Paid (Advance Amount)</td>
                <td style="padding: 10px;border: 1px solid #ddd;text-align: right;font-size: 15px;font-weight: bold;">₹ {{$booking->advance_amount}}</td>
                @endif
                
            </tr>
        </tbody></table>
        <!-- <p>Please wait for some time for the amount to show up in your Canvera account.</p>
        <p>Please contact us at 1800- or email to care@canvera.com for any query.</p> -->
        <form name="ecom" method="post" action="https://test.sbiepay.sbi/secure/AggregatorHostedListener">
            <input type="hidden" name="EncryptTrans" value="<?php echo $EncryptTrans; ?>">
            <input type="hidden" name="MultiAccountInstructionDtls" value="<?php echo $MultiAccountInstructionDtls; ?>">
            <input type="hidden" name="merchIdVal" value ="1000356"/>   
            <a class="button">
                <button type="submit" style=" 
                background: none;
                border: none;
                color: white; 
            ">Pay the Amount</button>
                </a> 
            </form>
    </div>
</body>
</html>