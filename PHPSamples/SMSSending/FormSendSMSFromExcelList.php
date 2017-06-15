
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
	<h1>Send a message from a file(Excel, csv, tab)：</h1>
	<form action="sendSMSFromExcelList.php" method="post" enctype="multipart/form-data"　>
	
		Tracking ID:     <input type="text" name="trackingID" >
		<br><br>
		Recipient List file (xls, xlsx, csv, tab):  <input type="file" name="uploadFile">
		<br>
		By default "column1 = RecipientNumber, column2 = RecipientName, Column 3 and more = your personalized data.
		<br><br>
		Message:　
		 <br>
		 To personalized your message with specifics informations, write "`BCF1" Where 1 is the position of the column you want to send
		  <br>
		 For example, if you write the message "Hello `BCF1", your user will receive "Hello 06xxxxxxxx" (06xxxxxxxx being the phone number of your user.
		 <br><br> 
		 <textarea rows="10" cols="40" name="text" hint="Message contents"></textarea>
		<br><br>
		 <input type="submit"  value="Send">
	</form>

</body>

</html>