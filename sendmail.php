<?php

if (isset($_POST['submit'])) {
	// Get the recipient email from the form data
	$to = $_POST['email'];
//
// *** To Email ***
// $to = 'dilip8884357790@gmail.com';
//
// *** Subject Email ***
$subject = 'hello';
//
// *** Content Email ***
$content = 'good day';
//
//*** Head Email ***
$headers = "From: dilip290266@gmail.com";
//
//*** Show the result... ***
if (mail($to, $subject, $content, $headers))
{
	echo "Success !!!";
} 
else 
{
   	echo "ERROR";
}
}
