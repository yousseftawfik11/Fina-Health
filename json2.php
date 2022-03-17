<?php

// include Imap.Class
include_once('class.imapB.php');

$email = new Imap();
$connect = $email->connect(
	'{imap.gmail.com:993/imap/ssl}INBOX', //host
	'finahealthcare123@gmail.com', //username
	'T1e2s3t4' //password
);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
if($connect){
	if(isset($_POST['inbox'])){
		// inbox array
		$inbox = $email->getMessages('html');
		echo json_encode($inbox, JSON_PRETTY_PRINT);
	}else if(!empty($_POST['uid']) && !empty($_POST['part']) && !empty($_POST['file']) && !empty($_POST['encoding'])){
		// attachments
		$inbox = $email->getFiles($_POST);
		echo json_encode($inbox, JSON_PRETTY_PRINT);
	}else {
		echo json_encode(array("status" => "error", "message" => "Not connect."), JSON_PRETTY_PRINT);
	}
}else{
	echo json_encode(array("status" => "error", "message" => "Not connect."), JSON_PRETTY_PRINT);
}