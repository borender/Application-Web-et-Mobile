<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//page qui me permet d'envoyer une requete a l'api en appuyant sur un bouton

if($_POST['id_api'] == 1){
    $url = "http://localhost/HelpdeskSolution/front/distrib_ticket/".$_POST['id_ticket']."/".$_POST['id_users'];
    $raw = file_get_contents($url);
}
if($_POST['id_api'] == 2){
    $url = "http://localhost/HelpdeskSolution/front/closeticket/".$_POST['id_ticket']."/'".$_POST['commentaire']."'";
    $raw = file_get_contents($url);
    //$email = $_POST['mail'];
    //$headers = "From: Helpdesk <web@hds.com>\r\n".
	//	   "MIME-Version: 1.0" . "\r\n" .
    //       "Content-type: text/html; charset=UTF-8" . "\r\n";
	//$message = "L'un de vos tickets que vous avez envoyer sur le site HDS vient d'etre finalisé, vous pouvez le consulter sur le site grace a au bouton 'Mes tickets'"
	//
	//\n\n";
	//mail($email, '[Helpdesk] - Ticket terminé', $message, $headers);
}
if($_POST['id_api'] == 3){
    $url = "http://localhost/HelpdeskSolution/front/Updatestatusticket/".$_POST['id_ticket']."/".$_POST['status'];
    $raw = file_get_contents($url);
}
if($_POST['id_api'] == 4){
    $url = "http://localhost/HelpdeskSolution/front/delet_ticket/".$_POST['id_ticket'];
    $raw = file_get_contents($url);
}
?>