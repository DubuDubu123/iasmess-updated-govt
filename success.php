<?php
error_reporting(0);
print_r($_REQUEST);

include('AES128_php.php');

$AESobj = new AESEncDec();

$key = "MBxNMjIUnjl6H6B6XPEuJCppBxt8lwX9F4rH2Jxhglg=";



echo "<pre>"; print_r($_REQUEST); echo "</pre>";







if($_REQUEST['encStatusData'] && $_REQUEST['encStatusData']!="")
{
// print_r($_REQUEST['encData']);
// exit;

echo "Transactions Fetched Successfully";
echo "<br>";

echo "<br> Encrypted data = ".$_REQUEST['encStatusData'];

echo "<br> Decrypted data = ". $encData = $AESobj->decrypt($_REQUEST['encStatusData'], $key);
include('DV.php');

}
else
{
die("Please try again...");
}






?>



<!DOCTYPE html>
<html>
<head>
<title>Success Page</title>
</head>
<body>

<h1 style="color: green;">Transaction Success</h1>


</body>
</html>
