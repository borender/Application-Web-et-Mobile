<?php
//variable empeche la redirection du system de connexion
$page_no_redirection = '1';
include ('Views/shared/header.php');

//si la connexion a été établi alors l'affichage du tableau
if($_SESSION['login'] == TRUE){
    include ('../HDS2/Views/ticket/tableau_ticket.php');
}

include ('Views/shared/footer.php');
?>