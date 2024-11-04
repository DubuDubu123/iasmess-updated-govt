<html>
<head>
    <title>Encrypt Data Form</title>
</head>
<body>
   
 <form name="ecom" method="post" action="https://test.sbiepay.sbi/secure/AggregatorHostedListener">
<input type="text" name="EncryptTrans" value="<?php echo $EncryptTrans; ?>">
<input type="text" name="MultiAccountInstructionDtls" value="<?php echo $MultiAccountInstructionDtls; ?>">
<input type="text" name="merchIdVal" value ="1000356"/>
<input type="submit" name="submit" value="Submit">
</form>
</body>
</html>
