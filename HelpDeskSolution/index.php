<?php 
//http://localhost/...
//https://www.h2prog.com/...
define("URL", str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" : "http").
"://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

require_once "controllers/front/HDS.controller.php";
$apicontroller = new APIController();

try{
    
    if(empty($_GET['page'])){
       echo"la page n'existe pas";
    } else {
        
        $url = explode("/",filter_var($_GET['page'],FILTER_SANITIZE_URL));
        if(empty($url[0]) || empty($url[1])) throw new Exception ("La page n'existe pas 1");
        switch($url[0]){
            case "front" : 
                switch($url[1]){
                    case "roles":$apicontroller -> getRoles();
                    break;
                    case "user": 
                        if(empty($url[2])) throw new Exception ("l'identifiant de l'utilisateur est manquante");
                        $apicontroller -> getUser($url[2]);
                    break;
                    case "societe":$apicontroller -> getSociete();
                    break;
                    case "statut": $apicontroller -> getStatus();
                    break;
                    case "connect": 
                        $apicontroller -> postConnect($url[2],$url[3]);
                    break;
                    case "create_compte": 
                        $apicontroller -> create_compte($url[2],$url[3],$url[4],$url[5],$url[6],$url[7],$url[8],$url[9]);
                    break;
                    case "create_societe": 
                        $apicontroller -> create_societe($url[2],$url[3],$url[4]);
                    break;
                    case "create_ticket": 
                        $apicontroller -> create_ticket($url[2],$url[3],$url[4],$url[5],$url[6]);
                    break;
                    case "delet_ticket": 
                        $apicontroller -> delet_ticket($url[2]);
                    break;
                    case "GetTicketEntrepriseAndStatus": 
                        $apicontroller -> GetTicketEntrepriseandstatus($url[2],$url[3]);
                    break;
                    case "GetTicketAll": 
                        $apicontroller -> GetTicketAll();
                    break;
                    case "GetTicketAllAndStatus": 
                        $apicontroller -> GetTicketAllAndStatus($url[2]);
                    break;
                    case "get_compte": 
                        $apicontroller -> getcompte($url[2]);
                    break;
                    case "getusersrole": 
                        $apicontroller -> getusersrole($url[2]);
                    break;
                    case "distrib_ticket": 
                        $apicontroller -> distrib_ticket($url[2],$url[3]);
                    break;
                    case "verif_compte": 
                        $apicontroller -> getcompte($url[2]);
                    break;
                    case "verif_entreprise": 
                        $apicontroller -> verifSociete($url[2],$url[3]);
                    break;
                    case "type": 
                        $apicontroller -> getTypeTicket();
                    break;
                    case "ticket": 
                        $apicontroller -> getticket($url[2]);
                    break;
                    case "GetTicketbystatus": 
                        $apicontroller -> getticketbystatus($url[2]);
                    break;
                    case "GetTicketbyusers": 
                        $apicontroller -> getticketbyusers($url[2]);
                    break;
                    case "GetTicketbyidandstatus": 
                        $apicontroller -> getticketbyidandstatus($url[2],$url[3]);
                    break;
                    case "Updatestatusticket": 
                        $apicontroller -> Updatestatusticket($url[2],$url[3]);
                    break;
                    case "closeticket": 
                        $apicontroller -> closeticket($url[2],$url[3]);
                    break;
                    case "GetTecht": 
                        $apicontroller -> GetTecht($url[2]);
                    break;
                    
                    
                    default : throw new Exception ("La page n'existe pas 2");
                }
            break;
            case "back" : echo "page back end demandée";
            break;
            default : throw new Exception ("La page n'existe pas 3");
        }
        //test affichage
        // echo "<pre>";
        // print_r($url);
        // echo "<pre>";
        // echo "la page demandé est : ".$_GET['page'];
    }
}catch(Exception $e){
    $msg = $e->getMessage();
    echo $msg;
}