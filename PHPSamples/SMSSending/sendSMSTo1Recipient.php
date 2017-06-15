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

echo "<h1>Job contents</h1><br><b>Name:</b> ".$_POST["name"]." <b>Number</b>: ".$_POST["phoneNumber"]." <br> <b>Message:</b>".$_POST["text"];

//variables
$fileReference = array();
$docArray = array();
$doc1 = array();
$recipients = array();
$myBroadCast = array();

// Create the doc
$doc1 = create_FileReferenceFromText($_POST["text"]);
// Create soap <FileReference> <doc></doc><doc></doc>
$docArray[0] = $doc1;
$fileReference = array('FileReference' => $docArray);

//Create AdhocList
$recipients[0] = create_AdHoc_Recipient($_POST["phoneNumber"], $_POST["name"]);
$recipientArray = array('Recipient'=>$recipients);
$myBroadCast = create_adHoc_Broadcast($fileReference,$recipientArray,$_POST["trackingID"],"SMS");

//Sending
$result = $client->call('StartBroadcast',array("b"=>$myBroadCast));

echo "<h2> Created Job :  </h2>";
//print_r($client->debug);
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