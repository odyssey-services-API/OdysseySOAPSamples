<?php
/**
 * Connect to the API
 * refer to our documentation to connect/get user password
 * @return the nusoap_client login
 */
function login(){
	$wsdl = 'http://ows.odyssey-messaging.fr/service.asmx?wsdl';
	$user = 'message\XXXXX.yyyyy';
	$pass = 'YourPassWord';
	
	/* Creation of the nusoap client*/
	$client = new nusoap_client($wsdl,'wsdl');
	$client->setCredentials($user,$pass);
	return $client;
}

/**
 * Create a soap fileReference from a file
 * @param Doc $file
 * @return string[]|boolean[]|unknown[]
 */
function create_FileReferencefromFile($file){
	move_uploaded_file ($_FILES['uploadFile']['tmp_name'],
			"temp/{$_FILES['uploadFile']['name']}");
	return create_FileReference("temp/",$_FILES['uploadFile']['name'],$_FILES['uploadFile']['type']);
}


/**
 * Create a soap file reference from a String text
 * @param String $text
 * @return string[]|boolean[]|unknown[]
 */
function create_FileReferenceFromText($text){
	$file = fopen("temp/sendSMS.txt","w") or die("unable to open file ! ");
	fwrite($file,$text);
	fclose($file);

	$encodedFile = create_FileReference("temp/","sendSMS.txt", "text/plain");

	return $encodedFile;
}

/**
 *Create a file reference from a file name and it's mimetype
 * @param $path "temp/"
 * @param unknown $name "XXX.txt" or "xxx.xslx
 * @param unknown $mimeType 
 * @return string[]|boolean[]|unknown[]
 */
function create_FileReference($path,$name,$mimeType){
	$result = array();
	$result["name"] = $name;
	$dirfile = $path.$name;

	
	if (file_exists($dirfile)){
		$myfile = fopen($dirfile,"r");
		$contenu = fread($myfile,filesize($dirfile));	
		$contenu = base64_encode($contenu); 
		$result["contents"] = $contenu;
		fclose($myfile);
	}
	else{
		$result["contents"] = "aG9zdGVk";
	}
	
	$result["hosted"] = false;
	$result["mimeType"] = $mimeType;
	$result["attachToEmail"] = false;
	
	return $result;	
}


/**
 * Create one AdHoc Recipient 
 * @param unknown $phoneNumber
 * @param unknown $name
 * @return unknown[][]
 */
function create_AdHoc_Recipient($phoneNumber,$name){
	$result = array();
	$result["address"] = $phoneNumber;
	$result["name"] = $name;
	
	return $result;
	
}


/**
 * Create a broadcast from a recipient list
 * @param unknown $doc
 * @param unknown $recipients
 * @param unknown $id
 * @return string[]|unknown[]
 */
function create_adHoc_Broadcast($doc, $recipients, $id, $job_type = "NO_JTYPE"){
	$result = array();
	$result["jobType"] = $job_type;
	$result["documents"] = $doc;
	$result["adhocs"] = $recipients;
	$result["trackingID"] = $id;

	return $result;
}


/**
 * Create a broadcast from a recipient list
 * @param unknown $doc
 * @param unknown $recipients => base64 encoded excelList
 * @param unknown $id
 * @return string[]|unknown[]
 */
function create_List_Broadcast($doc, $recipients, $id, $job_type = "NO_JTYPE"){
	$result = array();
	$result["jobType"] = $job_type;
	$result["documents"] = $doc;
	$result["lists"] = $recipients;
	$result["trackingID"] = $id;

	return $result;
}



?>