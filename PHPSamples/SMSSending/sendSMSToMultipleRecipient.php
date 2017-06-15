<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>

<?php
require_once("../lib/nusoap-0.9.5/nusoap.php");

require_once("functionsodyssey.php");

$client = login(); //Login to odysseySystem (functionsodyssey.php)
/* Cherche erreur */
$err = $client->getError();
if ($err) {
	echo 'Erreur du constructeur: ' . $err;
}

echo "<h1>Job Content</h1><br><b>Name1 :</b> ".$_POST["name1"]." <b>number1</b>: ".$_POST["phoneNumber1"]." <br><b>name2:</b> ".$_POST["name2"]." <b>Number2</b>: ".$_POST["phoneNumber2"]." <br> <b>Message: </b>".$_POST["text"];

//variables
$fileReference = array();
$docArray = array();
$doc1 = array();
$recipients = array();
$myBroadCast = array();

//Create the document
$doc1 = create_FileReferenceFromText($_POST["text"]);
// Create soap <FileReference> <doc></doc><doc></doc></FileReference>
$docArray[0] = $doc1;
$fileReference = array('FileReference' => $docArray);

//Create AdhocList
$recipients[0] = create_AdHoc_Recipient($_POST["phoneNumber1"], $_POST["name1"]);
$recipients[1] = create_AdHoc_Recipient($_POST["phoneNumber2"], $_POST["name2"]);
$recipientArray = array('Recipient'=>$recipients);

//Create the arraylist
$myBroadCast = create_adHoc_Broadcast($fileReference,$recipientArray,$_POST["trackingID"],"SMS");

$result = $client->call('StartBroadcast',array("b"=>$myBroadCast));

echo "<h2> Created job :  </h2>";

$err = $client->getError();
if ($err) {
	echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
}else{
	//print_r($result);
	echo '<b> JobNumber : </b> '.$result['StartBroadcastResult']['outcome'];
	echo '<b> Message : </b> '.$result['StartBroadcastResult']['messages']['string'];
}
?>
</body>

</html>