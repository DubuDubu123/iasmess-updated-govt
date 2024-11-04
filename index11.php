<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


/*
Sample SBI EPay
*/
echo "<b><center>Payment Model Status</center></b><br/><br/>";

include('AES128_php.php');

//encryption key
$key = "MBxNMjIUnjl6H6B6XPEuJCppBxt8lwX9F4rH2Jxhglg=";
//requestparameter
$requestParameter  = "|1000356|OD34395DHEN442CO4|100|https://iasmess.dubudubutechnologies.com/success.php";
echo '<b>Requestparameter:-</b> '.$requestParameter.'<br/><br/>';

$aes = new AESEncDec();


$EncryptTrans = $aes->encrypt($requestParameter, $key);


?>

<form name="ecomStatus" method="post" action="https://test.sbiepay.sbi/secure/aggMerchantStatusQueryWithAmountAction">
    <input type="hidden" name="encryptQuery" value="<?php echo $EncryptTrans; ?>">
    <input type="hidden" name="merchIdVal" value ="1000356"/>
    <input type="hidden" name="aggIdVal" value ="SBIEPAY"/>
    <input type="submit" name="submit" value="Submit">
</form>

















