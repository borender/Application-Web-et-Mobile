<?php
 require_once "models/front/HDS.DAL.php";
 require_once "models/Model.php";
 require_once "models/back/JsonService/Json.php";

 
    class APIController {
        private $apimanager;
    
        public function __construct(){
            $this->apimanager = new APIManager();
        }
        public function getRoles(){  
           $roles = $this->apimanager->getBdRoles();
            Json::sendJSON($roles);
        }
        public function postConnect($login,$mdp){ 
            $connect = $this->apimanager->connectBdUser($login,$mdp);
            Json::sendJSON($connect);
        }
        public function create_compte($nom,$prenom,$login,$mdp,$telephone,$mail,$id_entreprise,$id_role){ 
            $create_compte = $this->apimanager->createBDUser($nom,$prenom,$login,$mdp,$telephone,$mail,$id_entreprise,$id_role);
            Json::sendJSON($create_compte);
        }
        public function create_societe($name,$code,$ville){ 
            $create_societe = $this->apimanager->createbdsociete($name,$code,$ville);
            Json::sendJSON($create_societe);
        }
        public function create_ticket($title,$type,$target,$desc,$id){ 
            $create_ticket = $this->apimanager->createBDticket($title,$type,$target,$desc,$id);
            Json::sendJSON($create_ticket);
        }
        public function delet_ticket($id_ticket){
            $create_ticket = $this->apimanager->deletbdticket($id_ticket);
            Json::sendJSON($create_ticket);
        }
        public function GetTicketEntrepriseAndStatus($idsociete,$idstatus){
            $GetTicketEntreprise = $this->apimanager->getBDticketentrepriseandstatus($idstatus);
            Json::sendJSON($GetTicketEntreprise);
        }
        public function GetTicketAll(){ 
            $GetTicketall = $this->apimanager->getBDticketall();
            Json::sendJSON($GetTicketall);
        }
        public function GetTicketAllAndStatus($idstatus){ 
            $GetTicketall = $this->apimanager->GetbdTicketAllAndStatus($idstatus);
            Json::sendJSON($GetTicketall);
        }
        public function getcompte($login){
            $get_compte = $this->apimanager->getBdUser($login);
            Json::sendJSON($get_compte);
        }
        public function getUser($user_sonde){
            $sonde = $this->apimanager->getBDSonde($user_sonde);
            Json::sendJSON($sonde);
        }
        public function getStatus(){
            $status = $this->apimanager->getBdStatut();
            Json::sendJSON($status);
        }
        public function getusersrole($role){
            $usersbyrole = $this->apimanager->getbdusersrole($role);
            Json::sendJSON($usersbyrole);
        }
        public function distrib_ticket($id_ticket,$id_users){
            $distrib_ticket = $this->apimanager->distribbdticket($id_ticket,$id_users);
            Json::sendJSON($distrib_ticket);
        }        
        public function getticket($id){
            $ticket = $this->apimanager->getBdticket($id);
            Json::sendJSON($ticket);
        } 
        public function getTypeTicket(){
            $typeTicket = $this->apimanager->getBdTypeTicket();
            Json::sendJSON($typeTicket);
        }
        public function getticketbystatus($status){
            $statusTicket = $this->apimanager->getbdticketbystatus($status);
            Json::sendJSON($statusTicket);
        }
        public function getticketbyusers($id_users){
            $usersTicket = $this->apimanager->getbdticketbyusers($id_users);
            Json::sendJSON($usersTicket);
        }
        public function getticketbyidandstatus($id_user,$status){
            $roleTicket = $this->apimanager->getbdticketbyidandstatus($id_user,$status);
            Json::sendJSON($roleTicket);
        }
        public function Updatestatusticket($id_ticket,$status){
            $updatestatusTicket = $this->apimanager->Updatebdstatusticket($id_ticket,$status);
            Json::sendJSON($updatestatusTicket);
        }
        
        public function closeticket($id_ticket,$commentaire){
            $closeTicket = $this->apimanager->closebdticket($id_ticket,$commentaire);
            Json::sendJSON($closeTicket);
        }
        public function getSociete(){
            $societe = $this->apimanager->getBdSociete();
            Json::sendJSON($societe);
        }
        public function verifSociete($societe,$code){
            $verifsociete = $this->apimanager->verifBdSociete($societe,$code);
            Json::sendJSON($verifsociete);
        }
        public function GetTecht($id){
            $GetbdTecht = $this->apimanager->GetbdTecht($id);
            Json::sendJSON($GetbdTecht);
        }
        
        
    }
