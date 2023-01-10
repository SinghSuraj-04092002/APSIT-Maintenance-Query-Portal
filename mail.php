<?php
//get data from form  
$floor=$POST['subject'];
$lab=$POST['lab'];
$user = $_POST['customer_id'];
$department= $_POST['department_id'];
$problem= $_POST['Problem'];
$priority=$_POST['Priority'];
$discription=$_POST['description'];

$to = "atharvatakleaat@mail.com";

$subject = "Mail From Apsit Query Department";
$txt ="Floor no. = ". $floor . "\r\n  
Lab no. = " . $lab . "\r\n 
user Name. = ". $user . "\r\n
Department = ". $department . "\r\n
Problem = ". $problem . "\r\n
Priority = ". $priority . "\r\n
Discription = ". $discription ;

$headers = "From: apsitqueryportal.com" . "\r\n" .
"CC: somebodyelse@example.com";
//if($email!=NULL){mail($to,$subject,$txt,$headers);}

//redirect
//header("Location:thankyou.html");
?>