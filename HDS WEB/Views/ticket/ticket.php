<?php
include ('../shared/header.php');

        //l'espace "Mes tickets" pour les utilisateur
        if($_SESSION["role"] == 1){
            echo"
                <div class='bienvenue_anim' style='margin-top:90px'>Tous vos ticket</div>
                <div class='project_foreach flex'>
            ";
                    //requette qui permet de recuperer les tickets lier a l'utilisateur
                    $url = "http://localhost/HelpdeskSolution/front/GetTicketbyusers/".$_SESSION['id'];
                    $raw = file_get_contents($url);
                    $json = json_decode($raw);
                    if(!empty($json[0] -> IDTICKETS)){
                        $nb = 0;
                        $nb_json = 0;
                        //boucle qui permet l'affichage des tickets
                        while ($nb <= 1) {
                            if(!empty($json[$nb_json] -> IDTICKETS)){
                                echo"
                                    <div class='bloc_ticket'>
                                        <text>Titre : ".$json[$nb_json] -> title."</text></br>
                                        <text>Date : ".date('d/m/Y h:i:s', $json[$nb_json] -> date)."</text></br>
                                        <text>Statut : ".$json[$nb_json] -> status."</text></br>";
                                        if($json[$nb_json] -> status == 5){
                                        
                                        }
                                        echo"
                                        </br><text><a href='detail_ticket.php?id=".$sess."&ticket=".$json[$nb_json] -> IDTICKETS."&distrib'>Detail</a></text></br></br>
                                    </div>
                                ";
                                $nb_json = $nb_json  + 1;
                            }else{
                                $nb = 10;
                            }
                        }
                    }else{
                        echo"
                            <text class='ticket_vide'>Votre espace ticket est vide</text>
                        ";
                    }
            echo"
                </div>
            ";
        }
        //affichage des ticket "non attribuer","En attentes","En cours" pour les manager et admin
        if($_SESSION["role"] >= 3){
            echo"
                <div class='bienvenue_anim' style='margin-top:90px'>Ticket encore non attribuer</div>
                <div class='project_foreach flex'>
            ";
                    //requette qui permet de recuperer les tickets qui ne sont pas encore attribué
                    $url = "http://localhost/HelpdeskSolution/front/GetTicketbystatus/9";
                    $raw = file_get_contents($url);
                    $json = json_decode($raw);
                    if(!empty($json[0] -> IDTICKETS)){
                        $nb = 0;
                        $nb_json = 0;
                        //boucle qui permet l'affichage des tickets
                        while ($nb <= 1) {
                            if(!empty($json[$nb_json] -> IDTICKETS)){
                                //requette qui permet de recuperer la liste des utilisateur avec le role technicien
                                $url3 = "http://localhost/HelpdeskSolution/front/getusersrole/4";
                                $raw3 = file_get_contents($url3);
                                $json3 = json_decode($raw3);
                                echo"
                                    <div id='".$json[$nb_json] -> IDTICKETS."' class='bloc_ticket'>
                                        <text>Titre : ".$json[$nb_json] -> title."</text></br>
                                        <text>Compte : ".$_SESSION['nom']."</text></br>
                                        <text>Telephone : ".$json[$nb_json] -> telephone."</text></br>
                                        <text>Date : ".date('d/m/Y h:i:s', $json[$nb_json] -> date)."</text></br>
                                        <text>Entreprise : ".$json[$nb_json] -> Nom_societe."</text></br>
                                        <select id='atribution_".$json[$nb_json] -> IDTICKETS."' style='max-height: 250px;' class='selectpicker'></br>
                                            <option value='0'>Technitien informatique</option>";
                                            $nb2 = 0;
                                            $nb2_json = 0;
                                            //boucle qui permet de faire la liste de tous les utilisateur technicien
                                            while ($nb2 <= 1) {
                                                if(!empty($json3[$nb2_json] -> IDUSERS)){
                                                    echo"
                                                        <option value='".$json3[$nb2_json] -> IDUSERS."'>".$json3[$nb2_json] -> login."</option>
                                                    ";
                                                    $nb2_json = $nb2_json  + 1;
                                                }else{
                                                    $nb2 = 10;
                                                }
                                            }
                                            echo"
                                        </select>
                                        <button type='button' class='ticket_delet' style='top: -62%;right: -11%;' onclick='delet(".$json[$nb_json] -> IDTICKETS.");'>&times</button>
                                        </br><button type='button' onclick='atrib(".$json[$nb_json] -> IDTICKETS.");'>Atribuer</button></br>
                                        </br><text><a href='detail_ticket.php?id=".$sess."&ticket=".$json[$nb_json] -> IDTICKETS."&distrib'>Detail</a></text></br></br>
                                    </div>
                                ";
                                $nb_json = $nb_json  + 1;
                            }else{
                                $nb = 10;
                            }
                        }
                    }else{
                        echo"
                            <text class='ticket_vide'>Aucun nouveau ticket recu</text>
                        ";
                    }
            echo"
                </div>
                <div class='bienvenue_anim' style='margin-top:90px'>Ticket en attente</div>
                <div class='project_foreach flex'>
            ";
                    //requette qui permet de recuperer les tickets qui sont en attente
                    $url = "http://localhost/HelpdeskSolution/front/GetTicketbystatus/6";
                    $raw = file_get_contents($url);
                    $json = json_decode($raw);
                    if(!empty($json[0] -> IDTICKETS)){
                        $nb = 0;
                        $nb_json = 0;
                        //boucle qui permet l'affichage des tickets
                        while ($nb <= 1) {
                            if(!empty($json[$nb_json] -> IDTICKETS)){
                                //requette qui permet de recuperer le compte qui est lié au ticket
                                $url2 = "http://localhost/HelpdeskSolution/front/GetTecht/".$json[$nb_json] -> IDTECH;
                                $raw2 = file_get_contents($url2);
                                $json2 = json_decode($raw2);
                                echo"
                                    <div id='".$json[$nb_json] -> IDTICKETS."' class='bloc_ticket'>
                                        <text>Titre : ".$json[$nb_json] -> title."</text></br>
                                        <text>Compte : ".$json[$nb_json] -> login."</text></br>
                                        <text>Telephone : ".$json[$nb_json] -> telephone."</text></br>
                                        <text>Technicien informatique: ".$json2[0] -> login."</text></br>
                                        <text>Date : ".date('d/m/Y h:i:s', $json[$nb_json] -> date)."</text></br>
                                        <text>Entreprise : ".$json[$nb_json] -> Nom_societe."</text></br>
                                        <button type='button' class='ticket_delet' onclick='delet(".$json[$nb_json] -> IDTICKETS.");'>&times</button>
                                        </br><text><a href='detail_ticket.php?id=".$sess."&ticket=".$json[$nb_json] -> IDTICKETS."'>Detail</a></text></br></br>
                                    </div>
                                ";
                                $nb_json = $nb_json  + 1;
                            }else{
                                $nb = 10;
                            }
                        }
                    }else{
                        echo"
                            <text class='ticket_vide'>Aucun ticket n'est disponible</text>
                        ";
                    }
            echo"
                </div>
                <div class='bienvenue_anim' style='margin-top:90px'>Ticket en cours</div>
                <div class='project_foreach flex'>";
                    //requette qui permet de recuperer les tickets qui sont en cours
                    $url = "http://localhost/HelpdeskSolution/front/GetTicketbystatus/7";
                    $raw = file_get_contents($url);
                    $json = json_decode($raw);
                    if(!empty($json[0] -> IDTICKETS)){
                        $nb = 0;
                        $nb_json = 0;
                        //boucle qui permet l'affichage des tickets
                        while ($nb <= 1) {
                            if(!empty($json[$nb_json] -> IDTICKETS)){
                                //requette qui permet de recuperer le compte qui est lié au ticket
                                $url2 = "http://localhost/HelpdeskSolution/front/GetTecht/".$json[$nb_json] -> IDTECH;
                                $raw2 = file_get_contents($url2);
                                $json2 = json_decode($raw2);
                                echo"
                                   <div id='".$json[$nb_json] -> IDTICKETS."' class='bloc_ticket'>
                                      <text>Titre : ".$json[$nb_json] -> title."</text></br>
                                      <text>Compte : ".$_SESSION['nom']."</text></br>
                                      <text>Telephone : ".$json[$nb_json] -> telephone."</text></br>
                                      <text>Technicien informatique: ".$json2[0] -> login."</text></br>
                                      <text>Date : ".date('d/m/Y h:i:s', $json[$nb_json] -> date)."</text></br>
                                      <text>Entreprise : ".$json[$nb_json] -> Nom_societe."</text></br>
                                      <button type='button' class='ticket_delet' onclick='delet(".$json[$nb_json] -> IDTICKETS.");'>&times</button>
                                      </br><text><a href='detail_ticket.php?id=".$sess."&ticket=".$json[$nb_json] -> IDTICKETS."'>Detail</a></text></br></br>
                                   </div>
                                ";
                                $nb_json = $nb_json  + 1;
                            }else{
                                $nb = 10;
                            }
                        }
                    }else{
                        echo"
                            <text class='ticket_vide'>Tous les tickets ont été fermé</text>
                        ";
                    }
            echo"
                </div>
            ";
        }
        //affichage des ticket "En attentes","En cours" pour les techniciens
        if($_SESSION["role"] == 2){
            echo"
                <div class='bienvenue_anim' style='margin-top:90px'>Ticket en attente</div>
                <div class='project_foreach flex'>";
                    //requette qui permet de recuperer les tickets en attente attribuer au technicien 
                    $url = "http://localhost/HelpdeskSolution/front/GetTicketbyidandstatus/".$_SESSION['id']."/6";
                    $raw = file_get_contents($url);
                    $json = json_decode($raw);
                    if(!empty($json[0] -> IDTICKETS)){
                        $nb = 0;
                        $nb_json = 0;
                        //boucle qui permet l'affichage des tickets
                        while ($nb <= 1) {
                            if(!empty($json[$nb_json] -> IDTICKETS)){
                                echo"
                                    <div class='bloc_ticket'>
                                        <text>Titre : ".$json[$nb_json] -> title."</text></br>
                                        <text>Compte : ".$_SESSION['nom']."</text></br>
                                        <text>Telephone : ".$json[$nb_json] -> telephone."</text></br>
                                        <text>Date : ".date('d/m/Y h:i:s', $json[$nb_json] -> date)."</text></br>
                                        <text>Entreprise : ".$json[$nb_json] -> Nom_societe."</text></br>
                                        </br><text><a href='detail_ticket.php?id=".$sess."&ticket=".$json[$nb_json] -> IDTICKETS."&activation'>Detail</a></text></br></br>
                                    </div>
                                ";
                                $nb_json = $nb_json  + 1;
                            }else{
                                $nb = 10;
                            }
                        }
                    }else{
                        echo"
                            <text class='ticket_vide'>Aucun ticket n'est disponible</text>
                        ";
                    }
            echo"
                </div>
                <div class='bienvenue_anim' style='margin-top:90px'>Ticket en cours</div>
                <div class='project_foreach flex'>";
                //requette qui permet de recuperer les tickets en cours attribuer au technicien 
                    $url = "http://localhost/HelpdeskSolution/front/GetTicketbyidandstatus/".$_SESSION['id']."/7";
                    $raw = file_get_contents($url);
                    $json = json_decode($raw);
                    if(!empty($json[0] -> IDTICKETS)){
                        $nb = 0;
                        $nb_json = 0;
                        //boucle qui permet l'affichage des tickets
                        while ($nb <= 1) {
                            if(!empty($json[$nb_json] -> IDTICKETS)){
                                echo"
                                    <div class='bloc_ticket'>
                                        <text>Titre : ".$json[$nb_json] -> title."</text></br>
                                        <text>Compte : ".$_SESSION['nom']."</text></br>
                                        <text>Telephone : ".$json[$nb_json] -> telephone."</text></br>
                                        <text>Date : ".date('d/m/Y h:i:s', $json[$nb_json] -> date)."</text></br>
                                        <text>Entreprise : ".$json[$nb_json] -> Nom_societe."</text></br>
                                        </br><text><a href='detail_ticket.php?id=".$sess."&ticket=".$json[$nb_json] -> IDTICKETS."&tech'>Detail</a></text></br></br>
                                    </div>
                                ";
                                $nb_json = $nb_json  + 1;
                            }else{
                                $nb = 10;
                            }
                        }
                    }else{
                        echo"
                            <text class='ticket_vide'>Tous les tickets ont été fermé</text>
                        ";
                    }
            echo"
                </div>
            ";
        }
?><script src='../../service/jquery.js'></script>
<script>
	function atrib(id_ticket){
        var id_users = document.getElementById("atribution_"+id_ticket).value;
		$.ajax({
		    type:'post',
		    url:'../../service/ajax api.php',
		    data:'id_api=' + 1 +'&id_ticket=' + id_ticket + '&id_users=' + id_users,
		    dataType:'json'
		});
        window.location.reload();
	}
    //function pour delet un ticket en passant par la page ajax api.php
    function delet(id_ticket){
		$.ajax({
		    type:'post',
		    url:'../../service/ajax api.php',
		    data:'id_api=' + 4 +'&id_ticket=' + id_ticket,
		    dataType:'json'
		});
        document.getElementById(id_ticket).remove();
	}
</script>
<?php
include ('../shared/footer.php');
?>