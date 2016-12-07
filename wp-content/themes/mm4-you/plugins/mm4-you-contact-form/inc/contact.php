<?php

//session_start();
include 'akismet.class.php';

if(!$_POST) {
	echo 'This page cannot be accessed directly.';
	exit();
}
	
// HIDDEN HONEYPOT
$spa = $_POST["spam"];
	
if (!empty($spa) && !($spa == "7" || $spa == "seven")) {
	echo "We're sorry, but you appear to be a spambot";
    exit ();
}
	
if($_SERVER['REQUEST_METHOD']=="POST") {
	$WordPressAPIKey = 'c32918c5e5bc';
	$MyBlogURL = 'http://www.mm4solutions.com/';
	
	$recipients=$_POST["recipients"];
	$to = str_replace("_AT_","@",$recipients);
	//$to='chris@mm4solutions.com';
	
	$names=strip_tags($_POST["contact-names"]);
	$company=strip_tags($_POST["contact-company"]);
	$add1=strip_tags($_POST["contact-add1"]);
	$add2=strip_tags($_POST["contact-add2"]);
	$email=strip_tags($_POST["contact-email"]);
	$phone=$_POST["contact-phone"];
	$comments=strip_tags($_POST["contact-comments"]);
	$sbjct=strip_tags($_POST["subject"]);
	
	$comment = array(
		'author' => $names,
		'email' => $email,
		'website' => $MyBlogURL,
		'body' => $comments
	);
	 
	$akismet = new Akismet($MyBlogURL, $WordPressAPIKey, $comment);
	
	$from="do-not-reply@mm4solutions.com";
	$subject=$sbjct;
	$message="Name: " . $names . "<br>" . "Company: " . $company . "<br>" . "Address 1: " . $add1 . "<br>" . "Address 2: " . $add2 . "<br>" . "Email: " . $email . "<br>" . "Phone: " . $phone . "<br>" . "Comments: " . $comments;
	$header='From: '.$from."\r\n".'Reply-To: '.$from."\r\n".'MIME-Version: 1.0'."\r\n".'Content-type: text/html; charser=iso-8859-1'."\r\n".'X-Mailer: PHP/'.phpversion();
	
	if ($akismet->isSpam()) {
		//-- THIS IS SPAM, YO!!!!!
		echo "We're sorry, but you appear to be a spambot";
		exit();
	} else {
		@mail($to,$subject,$message,$header);
	}
}
?>