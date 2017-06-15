
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
	<h1>Send a message to several recipient (AdHoc)：</h1>
	<form action="sendSMSToMultipleRecipient.php" method="post" 　>
			Tracking ID:     <input type="text" name="trackingID" >
	<br><br>
		Recipient 1:
		<br>
		Name:     <input type="text" name="name1" >
		<br><br>
		PhoneNumber: <input type="text"	name="phoneNumber1"  >
		<br><br>
		Recipient 2:
		 <br>
		Name:     <input type="text" name="name2" >
		<br><br>
		PhoneNumber <input type="text"	name="phoneNumber2"  >
		 <br><br>
		 Message:
		 	  You can personnalise your message using BCF values
	in that case `BCF1= Phone Number、`BCF2= RecipientName
		 <br><br> 
		 <textarea rows="10" cols="40" name="text" hint="Message content"></textarea>
		 
		<br><br>
		 <input type="submit"  value="Send">
	</form>

</body>

</html>