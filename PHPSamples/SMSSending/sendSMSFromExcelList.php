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

echo "<h1>job content</h1><b> File name :</b> ".$_FILES["uploadFile"]["name"]." <br> <b>Message:</b>".$_POST["text"];

//variables
$fileReference = array();
$docArray = array();
$doc1 = array();
$listArray = array();
$recipients = array();
$myBroadCast = array();


// Create the doc
$doc1 = create_FileReferenceFromText($_POST["text"]);
// Create soap <FileReference> <doc></doc><doc></doc>
$docArray[0] = $doc1;
$fileReference = array('FileReference' => $docArray);




$list1 =  create_FileReferencefromFile($_FILES["uploadFile"]);
//put the file reference in an array, you can add several files.
$listArray[0] = $list1;

//Create a fileReference Tab.
$listReference = array('FileReference' => $listArray);

//Create final arrayList
$myBroadCast = create_list_Broadcast($fileReference,$listReference,$_POST["trackingID"],"SMS");

print_r($myBroadCast);
//SEND
//$result = $client->call('StartBroadcast',array("b"=>$myBroadCast));

echo "<h2> Created Job number :  </h2>";
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