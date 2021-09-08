<?php
include ('../shared/header.php');
echo"<style>.parent_links{min-height: calc(100% - 70px);}</style>";

//permet de recuperer toutes les informations
$url = "http://localhost/HelpdeskSolution/front/ticket/".$_GET['ticket'];
$raw = file_get_contents($url);
$json = json_decode($raw);
echo"
    <div class='bloc_central_detail'>
        </br><text class='left_detail_ticket'>Compte : ".$json[0] -> login."</text></br>
        </br><text class='left_detail_ticket'>Entreprise : ".$json[0] -> Nom_societe."</text></br>
        </br><text class='right_detail_ticket'>Date : ".date('d/m/Y h:i:s', $json[0] -> date)."</text></br>
        </br><text class='right_detail_ticket'>Title : ".$json[0] -> title."</text></br>
        </br><img src='".$json[0] -> image."' class='title'></br>
        </br><text>Description : ".$json[0] -> Description."</text></br>";
        //permet au utilisateur de voir la reponse du technicien informatique
        if($_SESSION['role'] == 1 && $json[0] -> IDstatus == 5){
            echo"
            </br><text class='date_detail_ticket'>Commentaire : ".$json[0] -> Commentaire."</text></br>
            ";
        }
        //permet au compte HDS de voir la reponse du technicien informatique en charge du ticket
        if($_SESSION['role'] >= 2 && $json[0] -> IDstatus == 7){
            echo"
            </br><text>Commentaire : ".$json[0] -> Commentaire."</text></br>
            ";
        }
        //permet au manager et a l'admin d'attribuer le ticket a un technicien'
        if($_SESSION['role'] >= 3 && isset($_GET['distrib'])){
            $url2 = "http://localhost/HelpdeskSolution/front/getusersrole/4";
            $raw2 = file_get_contents($url2);
            $json2 = json_decode($raw2);
            echo"
                </br><select id='atribution' style='max-height: 250px;' class='selectpicker'></br>";
                    $nb = 0;
                    $nb_json = 0;
                    //boucle qui permet de faire la liste de tous les utilisateur technicien
                    while ($nb <= 1) {
                        if(!empty($json2[$nb_json] -> IDUSERS)){
                            echo"
                                <option value='".$json2[$nb_json] -> IDUSERS."'>".$json2[$nb_json] -> login."</option>
                            ";
                            $nb_json = $nb_json  + 1;
                        }else{
                            $nb = 10;
                        }
                    }
                    echo"
                </select>
                </br><button type='button' id='atrib' onclick='atrib();'>Atribuer</button></br>
            ";
        }
        //permet au technicien de basculer le status d'un de ces tickets pour le metre en "En cours"'
        if($_SESSION['role'] >= 2 && isset($_GET['activation'])){
            echo"
                </br><button type='button' id='activation' onclick='activation();'>Commencer le ticket</button></br>
            ";
        }
        //permet au technicien de terminer un ticket
        if($_SESSION['role'] >= 2 && isset($_GET['tech'])){
            echo"
                </br><button type='button' id='final' onclick='final();'>Finaliser le ticket</button></br>
            ";
        }
        echo"
    </div>
";
?><script src='../../service/jquery.js'></script>
<script>//fonction js qui permet de contacter le ficher ajax api.php pour envoyer des requette a l'api
    var sess = <?php echo json_encode($sess); ?>;
    //fonction js pour attribuer un ticket a un technicien
	function atrib(){
        var id_ticket = <?php echo json_encode($_GET['ticket']); ?>;
        var id_users = document.getElementById("atribution").value;
		$.ajax({     
		    type:'post',
		    url:'../../service/ajax api.php',
		    data:'id_api=' + 1 +'&id_ticket=' + id_ticket + '&id_users=' + id_users,
		    dataType:'json'
		});
        document.location.href="ticket.php?id="+sess;
	}
    //fonction js pour changer le status du ticket
    function activation(){
        var id_ticket = <?php echo json_encode($_GET['ticket']); ?>;
		$.ajax({
		    type:'post',
		    url:'../../service/ajax api.php',
		    data:'id_api=' + 3 +'&id_ticket=' + id_ticket + '&status=' + 7,
		    dataType:'json'
		});
        document.location.href="ticket.php?id="+sess;
	}
    //fonction js pour changer le status du ticket et lui metre un commentaire
    function final(){
        var id_ticket = <?php echo json_encode($_GET['ticket']); ?>;
        var commentaire = document.getElementById("commentaire").value;
		$.ajax({
		    type:'post',
		    url:'../../service/ajax api.php',
		    data:'id_api=' + 2 +'&id_ticket=' + id_ticket + '&commentaire=' + commentaire,
		    dataType:'json'
		});
        document.location.href="ticket.php?id="+sess;
	}
</script>
<?php
include ('../shared/footer.php');
?>
