<?php
include ('../shared/header.php');

$secure = 0 ;
$date = date_create();

if(isset($_POST['name']) && !empty($_POST['name'])){
    
    if(empty($_POST['code'])){
		$secure = 1;
	}
    if(empty($_POST['ville'])){
		$secure = 2;
	}
}
if(isset($_POST['name']) && $secure == 0 ){
    
    $url = "http://localhost/HelpdeskSolution/front/create_societe/'".$_POST['name']."'/".$_POST['code']."/'".$_POST['ville']."'";
    $raw = file_get_contents($url);

    echo "
		<div class='bloc_central'>
			<h3>Creation avec succés</h3>
			L'entreprise a bien été enregistré<br/><br/>
			<a href='../../index.php?id=$sess' class='connexion'>Accueil</a>
		</div>
    ";
}
if(!isset($_POST['name']) || $secure != 0 ){
    echo "
        <div class='bloc_central'>
            <form action='#' enctype='multipart/form-data' method='post' id='loginForm'>
            <br/><div class='bienvenue'>Création de societe</div><br/>
            <br/><input type='text' name='name' placeholder='Nom de societe' class='input_login_page'/><br/>
            <br/><input type='text' name='code' placeholder='Code lié a la societe' class='input_login_page'/><br/>
            <br/><input type='text' name='ville' placeholder='Ville' class='input_login_page'/><br/>";
            //----simple passage de login à autre chose que 0 selon le pb-----
			if($secure == 1 && isset($_POST['name'])){echo "<br/><div class='error'>Veuiller rentrer un code de sécuriter pour la societe</div>";}
            if($secure == 2 && isset($_POST['name'])){echo "<br/><div class='error'>Veuiller rentrer la ville de localization de la societe</div>";}
            echo"
            <br/><input type='submit' value='Send' class='link_white'/><br/>
            </form>
		</div>
	";}
include ('../shared/footer.php');
?> 