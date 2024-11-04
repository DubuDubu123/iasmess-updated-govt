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
        
        
        
        
        ._failed{ border-bottom: solid 4px red !important; }
._failed i{  color:red !important;  }

._success {
    box-shadow: 0 15px 25px #00000019;
    padding: 45px;
    width: 100%;
    text-align: center;
    margin: 40px auto;
    border-bottom: solid 4px #28a745;
}

._success i {
    font-size: 55px;
    color: #28a745;
}

._success h2 {
    margin-bottom: 12px;
    font-size: 40px;
    font-weight: 500;
    line-height: 1.2;
    margin-top: 10px;
}

._success p {
    margin-bottom: 0px;
    font-size: 18px;
    color: #495057;
    font-weight: 500;
}
p{
    line-height: 27px;
}

    </style>
</head>
<body>
    <div class="container" style=" width: 500px;">
         <img src="{{ asset('assets/images/success.jpeg') }}"  alt="Success" style="width: 100px;height: 100px;">
        
        
        <div>
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div clas>
                     <i class="fa fa-check-circle" aria-hidden="true"></i>
                    <h2> Your payment was successful </h2>
                   <p> Thank you for your payment. we will <br>
be in contact with more details shortly </p>     
<p>
     <a class="button" href="{{url('/')}}/" style="cursor:pointer">
                <button type="submit" style=" 
                background: none;
                border: none;
                color: white; cursor:pointer
            ">Back To Home</button>
     </a> 
    
</p>
            </div> 
        </div> 
    </div> 
  
  
</div> 


    </div>
    <script> 
    // setTimeout(() => {window.location.href = "{{url('/')}}"}, 3000);
    </script>
</body>
</html>