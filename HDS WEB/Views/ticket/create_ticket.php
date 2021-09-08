<?php
include ('../shared/header.php');

$secure = 0 ;
$date = date_create();

if(isset($_POST['title']) && !empty($_POST['title'])){
    $target_dir = "../../resource/";
    $name_file = basename($_FILES["file"]["name"]);
	$target_file = $target_dir.$name_file;
    if($_POST['type'] == 0){
		$secure = 1;
	}
    if(empty($_POST['desc'])){
		$secure = 2;
	}
}
if(isset($_POST['title']) && $secure == 0 ){

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
		//echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
	}else {
		//echo "Sorry, there was an error uploading your file.";
    }
    $new_name = $_SESSION['id'].date_timestamp_get($date).'.png';
    rename($target_file, $target_dir.$new_name);
    
    $url = "http://localhost/HelpdeskSolution/front/create_ticket/'".$_POST['title']."'/".$_POST['type']."/$new_name/'".$_POST['desc']."'/".$_SESSION['id'];
    $raw = file_get_contents($url);

    echo "
		<div class='bloc_central'>
			<h3>Creation avec succés</h3>
			Votre ticket à bien été envoyer chez HDS, vous pouvez surveiller son cours en allant dans l'espace Mes tickets<br/><br/>
			<a href='connexion.php' class='connexion'>Connection</a>
		</div>
    ";
}
if(!isset($_POST['title']) || $secure != 0 ){
    echo "
        <div class='bloc_central'>
            <form action='#' enctype='multipart/form-data' method='post' id='loginForm'>
            <br/><div class='bienvenue'>Création de ticket</div><br/>
            <br/><input type='text' name='title' placeholder='title' class='input_login_page'/><br/>
            <br/><select name='type' style='max-height: 250px;' class='selectpicker'>
                <option value='0'>Type ticket</option>
                <option value='1'>SAV</option>
                <option value='2'>Bug</option>
                <option value='3'>Evolution logiciel</option>
                <option value='4'>Maintenance</option>
            </select><br/>
            <br/><input type='file' name='file' placeholder='Captured'ecran' class='input_login_page'/><br/>
            <br/><textarea id = 'desc' name = 'desc' rows = '4' cols = '50'  placeholder='Please enter a description' class='input_login_page' style='width:80%' ></textarea><br/>";
            //----simple passage de login à autre chose que 0 selon le pb-----
			if($secure == 1 && isset($_POST['title'])){echo "<br/><div class='error'>Veuiller rentrer le type du ticket</div>";}
			if($secure == 2 && isset($_POST['title'])){echo "<br/><div class='error'>Veuiller rentrer une description</div>";}
            echo"
            <br/><input type='submit' value='Send' class='link_white'/><br/>
            </form>
		</div>
	";}
include ('../shared/footer.php');
?> 