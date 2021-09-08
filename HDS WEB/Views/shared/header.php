<?php
session_start();

if(!isset($_SESSION["login"])){
	$_SESSION["login"]=false;
}
if(!isset($_SESSION["error"])){
	$_SESSION["error"]=false;
}

if(!isset($_GET['id'])){
	$_GET['id']= null;
}

//system de connexion securisé
if($_SESSION["error"] == TRUE){
	session_regenerate_id(true);
}
if(session_id() != $_GET['id']){
	if($_SESSION["login"] == TRUE){
		session_destroy();
		header('Location: index.php');
		session_start();
		$_SESSION["error"] = TRUE;
	}else{
		if(!isset($page_no_redirection)){
			header('Location: index.php');
		}
	}
}else{
	$_SESSION["error"] = FALSE;
}
if(isset($bouton_deconnection)){
	session_destroy();
	header('Location: index.php');
	session_start();
	$_SESSION["error"] = TRUE;
}
if($_SESSION["login"] == FALSE){
	if($_GET['id'] != null){
		header('Location: index.php');
	}
}



//id utiliser pour le system de connexion
$sess = session_id();


if($_SESSION["login"] == "true"){
	if($_SESSION["role"] >= 2 ){
		echo"
			<style>
				#topnav_menu {
					margin-left: calc(100% - 646px)!important;
				}
			</style>
		";
	}
}
echo "
<!DOCTYPE HTML>
<html>
	<head>
		<title>HDS</title>
		<meta name='viewport' content='width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0'>
		<link rel='stylesheet' href='http://localhost/HDS2/Views/shared/styles_new.css' type='text/css' media='screen' />
	</head>
	<body>
		<div id='root'>
			<div id='topnav' class='topnav'>
				<text class='title'>HDS</text>";
				if ($_SESSION["login"] == "true"){
					echo"
			    	<nav role='navigation' id='topnav_menu' class='button_header'>
			    	    <a id='home_link' class='home' href='http://localhost/HDS2/index.php?id=".$sess."'>Accueil</a>";
						if($_SESSION["role"] == 1 ){
							echo"
								<a class='home' href='http://localhost/HDS2/Views/ticket/create_ticket.php?id=".$sess."'>Creation Ticket</a>
								<a class='home' href='http://localhost/HDS2/Views/ticket/ticket.php?id=".$sess."'>Mes ticket</a>
							";
						}elseif($_SESSION["role"] == 2 ){
							echo"<a class='home' href='http://localhost/HDS2/Views/ticket/ticket.php?id=".$sess."'>Mes ticket</a>";
						}elseif($_SESSION["role"] >= 3 ){
							echo"
								<a class='home' href='http://localhost/HDS2/Views/ticket/ticket.php?id=".$sess."'>Ticket</a>
								<div class='menu_deroulant'>
								    <nav class='nav_bar'>
								      	<ul class='ul_bar'>
								        	<li class='deroulant li_bar'><a href='#' class='a_bar'>Ajout</a>
								          		<ul class='sous ul_bar'>
								            		<li class='li_bar' style='margin-left:-8px'><a href='http://localhost/HDS2/Views/societe/create_societe.php?id=".$sess."' class='a_bar'>Societe</a></li>
													<li class='li_bar' style='margin-left:-8px'><a href='http://localhost/HDS2/Views/compte/creation_compte.php?id=".$sess."' class='a_bar'>Compte</a></li>
								          		</ul>
								        	</li>
								      	</ul>
								    </nav>
			    	    		</div>
							";
						}
						echo"
			    	    <div class='menu_deroulant'>
						    <nav class='nav_bar'>
						      	<ul class='ul_bar'>
						        	<li class='deroulant li_bar'><a href='#' class='a_bar'>".$_SESSION['nom']."</a>
						          		<ul class='sous ul_bar'>
						            		<li class='li_bar' style='margin-left:-8px'><a href='http://localhost/HDS2/service/deconnexion.php?id=".$sess."' class='a_bar'>Disconnect</a></li>
						          		</ul>
						        	</li>
						      	</ul>
						    </nav>
			    	    </div>
			    	</nav>
			    	<a id='topnav_hamburger_icon' href='javascript:void(0);' onclick='showResponsiveMenu()'>
			    	    <!-- Some spans to act as a hamburger -->
			    	    <span></span>
			    	    <span></span>
			    	    <span></span>
			    	</a>
			    	<!-- Responsive Menu -->
			    	<nav role='navigation' id='topnav_responsive_menu'>
			    	    <ul>
			    	        <h2><a href='http://localhost/HDS2/index.php?id=".$sess."' class='home'>Accueil</a></h2>
							<a class='home' href='http://localhost/HDS2/Views/ticket/ticket.php?id=".$sess."'>Creation Ticket</a>
			    	        <h1><li>Account</li></h1>
			    	        <a href='http://localhost/HDS2/service/deconnexion.php?id=".$sess."' class='home'>Disconnect</a>
			    	    </ul>
			    	</nav>";
				}else{
					echo"
					<style>
					#topnav_menu {
						margin-left: calc(100% - 533px);
						margin-top: 21px;
					}
					</style>
			    	<nav role='navigation' id='topnav_menu' class='button_header'>
			    	    <a id='home_link' class='home' href='http://localhost/HDS2/index.php'>Accueil</a>
						<a id='home_link' class='home' href='http://localhost/HDS2/Views/compte/connexion.php'>Connexion</a>
			    	</nav>
			    	<a id='topnav_hamburger_icon' href='javascript:void(0);' onclick='showResponsiveMenu()'>
			    	    <!-- Some spans to act as a hamburger -->
			    	    <span></span>
			    	    <span></span>
			    	    <span></span>
			    	</a>
			    	<!-- Responsive Menu -->
			    	<nav role='navigation' id='topnav_responsive_menu'>
			    	    <ul>
							<a id='home_link' class='home' href='http://localhost/HDS2/index.php'>Accueil</a>
							<a id='home_link' class='home' href='http://localhost/HDS2/Views/compte/connexion.php'>Connexion</a>
			    	    </ul>
			    	</nav>";
				}
			echo"
			</div>
		</div>
		<div class='parent_links'>";
?>	