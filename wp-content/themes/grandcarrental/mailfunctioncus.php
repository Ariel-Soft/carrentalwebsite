<?php 
$new = explode(",",$_POST["resnumid"] );
$resnumberid = $new[0];
$frtnme =explode('=',$new[1]);
$resfrstname = $frtnme[1];
$lastnme= explode('=',$new[2]);
$reslatname = $lastnme[1];
$phne = explode('=',$new[3]);
$resphone = $phne[1];
$eml= explode('=',$new[4]);
$resemail = $eml[1]; 
$to = $resemail;
$subject = "Confirmation Email for reservation";
$txt = "Reservation Number ".$resnumberid."\n First Name ".$resfrstname."\n Last Name ".$reslatname."\n Phone ".$resphone;
$headers = "From: alex@carrentalwebsite.biz" . "\r\n" .
"CC: somebodyelse@carrentalwebsite.biz";
if( mail($to,$subject,$txt,$headers)){			
	echo 'Mail Send Successfully';
}else{
	echo  'Mail not send';
}   
?> 

