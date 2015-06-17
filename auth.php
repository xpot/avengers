<?php
//echo "wdfwredfwr";

function authorize(){
$dataToSign;
$HTTP_verb="GET";
$Content_MD5;
$Content_Type="pdf";
$TimeStamp="2015-04-27T08:40:57+00:00";
$ResourceURI="/docs";
$authorization;
$Signature;
$ASCII_encoded;
$clientID="20";
$secretAccessKEY="007";


if($HTTP_verb == "GET")
	$Content_MD5="";

else{
	ksort($_POST);
	
	foreach($_POST as $key => $value)
		$value=str_replace(" ", "%20", $value);

	$FinalString;
	foreach($_POST as $key => $value)
		$FinalString=$key."=".$value."&";


	$md5Hash=md5($FinalString);
	$HexCode=String2Hex($FinalString);
	$Content_MD5=strtolower($HexCode);

	}


$dataToSign=$HTTP_verb . "\n" . $Content_MD5 . "\n" . $Content_Type . "\n" . $TimeStamp . "\n" . $ResourceURI;
$ASCII_encoded = mb_convert_encoding($dataToSign,"ASCII");
//echo "ASCII_encoded  ----> " .$ASCII_encoded."<br>";

$SHA256Code=hash_hmac ( "sha256" , $secretAccessKEY , $ASCII_encoded);
//echo "SHA256Code ----> " .$SHA256Code."<br>";

$Signature=base64_encode($SHA256Code);
//echo "Signature ----> " .$Signature ."<br>";

$authorization="Talview"."".$clientID.":".$Signature;
//echo "authorization ----> " .$authorization ."<br>";

return $authorization;
}


$response=authorize();
echo $response;








