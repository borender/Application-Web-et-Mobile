<?php
echo"
    <div class='bloc_tick_entreprise'>
        <table class='table_ticket'>";
            //Tableau pour les utilisateurs normaux
            if($_SESSION['role'] == 1){
                $url = "http://localhost/HelpdeskSolution/front/GetTicketEntrepriseAndStatus/'".$_SESSION['societe']."'/5";
                $raw = file_get_contents($url);
                $json = json_decode($raw);
                echo"
                    <tr class='ligne_principale_tableau'>
                        <td>Title ticket</td>
                        <td>Users</td>
                        <td>Date</td>
                        <td>Statut</td>
                        <td>Détails</td>
                    </tr>
                ";
                //si il y a des ticket donc ...
                if(!empty($json[0] -> IDTICKETS)){
                    $nb = 0;
                    $nb_json = 0;
                    //boucle permettant de creer toutes les lignes du tableau grace aux tikets
                    while ($nb <= 1) {
                        if(!empty($json[$nb_json] -> IDTICKETS)){
                            echo"
                               <tr>
                                  <td>".$json[$nb_json] -> title."</td>
                                  <td>".$json[$nb_json] -> login."</td>
                                  <td>".date('d/m/Y h:i:s', $json[$nb_json] -> date)."</td>
                                  <td>".$json[$nb_json] -> status."</td>
                                  <td><a href='detail_ticket.php?id=".$sess."&ticket=".$json[$nb_json] -> IDTICKETS."'>Detail</a></td>
                               </tr>
                            ";
                            $nb_json = $nb_json  + 1;
                        }else{
                            $nb = 10;
                        }
                    }
                }else{
                    echo"
                        <div class='tableau_ticket_vide'>Votre entreprise n'a aucun ticket en attente</div>
                    ";
                }
            //Tableau pour les technitien,manager ou admin
            }else{
                //requette api me permettant de recuperer tous les tickets qui n'ont pas encore été traité
                $url = "http://localhost/HelpdeskSolution/front/GetTicketAllAndStatus/5";
                $raw = file_get_contents($url);
                $json = json_decode($raw);
                echo" 
                    <tr class='ligne_principale_tableau'>
                        <td>Title ticket</td>
                        <td>Users</td>
                        <td>Entreprise</td>
                        <td>Date</td>
                        <td>Statut</td>
                        <td>Détails</td>
                    </tr>
                ";
                //si il y a des ticket donc ...
                if(!empty($json[0] -> IDTICKETS)){
                    $nb = 0;
                    $nb_json = 0;
                    //boucle permettant de creer toutes les lignes du tableau grace aux tikets
                    while ($nb <= 1) {
                        if(!empty($json[$nb_json] -> IDTICKETS)){
                            echo"
                               <tr>
                                  <td>".$json[$nb_json] -> title."</td>
                                  <td>".$json[$nb_json] -> login."</td>
                                  <td>".$json[$nb_json] -> Nom_societe."</td>
                                  <td>".date('d/m/Y h:i:s', $json[$nb_json] -> date)."</td>
                                  <td>".$json[$nb_json] -> status."</td>
                                  <td><a href='detail_ticket.php?id=".$sess."&ticket=".$json[$nb_json] -> IDTICKETS."'>Detail</a></td>
                               </tr>
                            ";
                            $nb_json = $nb_json  + 1;
                        }else{
                            $nb = 10;
                        }
                    }
                }else{
                    echo"
                        <div class='tableau_ticket_vide'>Aucun entreprise n'a de ticket en attente</div>
                    ";
                }
            }
            echo"
            </tr>
        </table>
    </div>
";
?>