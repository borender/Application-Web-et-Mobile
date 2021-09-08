<?php 
require_once "models/Model.php";
//$date = date_create();
//$timestamp = date_timestamp_get($date);

class APIManager extends Model {

    //A l'initialisation 
    public function getBdRoles(){
        $req = "SELECT * FROM role";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $roles;
    } 
    public function connectBDUser($login,$mdp){
        $req = "SELECT users.IDUSERS, users.login, users.Password, users.IDSOCIETE, users.IDROLE, role.Privilege
        FROM `users` 
        INNER JOIN `societe` ON users.IDSOCIETE = societe.IDSOCIETE 
        INNER JOIN `role` ON users.IDROLE = role.IDROLE 
        WHERE users.login  = $login AND users.password = $mdp";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $lignesSonde = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $lignesSonde;
    }
    public function createBDUser($nom,$prenom,$login,$mdp,$telephone,$mail,$id_entreprise,$id_role){
        $req = "INSERT INTO `users` (`nom`, `prenom`, `login`, `Password`, `telephone`,`mail`, `IDSOCIETE`, `IDROLE`) VALUES ($nom, $prenom, $login, $mdp, $telephone, $mail, $id_entreprise, $id_role)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $lignesSonde = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $lignesSonde;
    }
    public function createbdsociete($name,$code,$ville){
        $req = "INSERT INTO `societe`(`Nom_societe`, `code`, `Ville`) VALUES ($name,$code,$ville)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $lignesSonde = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $lignesSonde;
    }
    public function createBDticket($title,$type,$target,$desc,$id){
        $req = "INSERT INTO `ticket` (`title`, `image`, `Description`,`IDUSERS`, `IDstatus`, `IDType_ticket`) VALUES ($title,'resource/$target',$desc,$id,9,$type)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
    }
    public function deletbdticket($id_ticket){
        $req = "DELETE FROM `ticket` WHERE IDTICKETS = $id_ticket";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
    }
    public function getBDticketentrepriseandstatus($idsociete,$idstatus){
        $req = "SELECT * FROM `ticket` INNER JOIN `users` ON users.IDUSERS = ticket.IDUSERS INNER JOIN `societe` ON societe.IDSOCIETE = users.IDSOCIETE INNER JOIN `statut` ON statut.IDSTATUS = ticket.IDstatus WHERE users.IDSOCIETE = $idsociete AND ticket.IDstatus != $idstatus";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $lignesSonde = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $lignesSonde;
    }
    public function getBDticketall(){
        $req = "SELECT * FROM `ticket` INNER JOIN `users` ON users.IDUSERS = ticket.IDUSERS INNER JOIN `societe` ON societe.IDSOCIETE = users.IDSOCIETE INNER JOIN `statut` ON statut.IDSTATUS = ticket.IDstatus";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $lignesSonde = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $lignesSonde;
    }
    public function GetbdTicketAllAndStatus($idstatus){
        $req = "SELECT * FROM `ticket` INNER JOIN `users` ON users.IDUSERS = ticket.IDUSERS INNER JOIN `societe` ON societe.IDSOCIETE = users.IDSOCIETE INNER JOIN `statut` ON statut.IDSTATUS = ticket.IDstatus WHERE ticket.IDstatus != $idstatus";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $lignesSonde = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $lignesSonde;
    }
    public function getBDUser($login){
        $req = "SELECT users.IDUSERS FROM `users` WHERE users.login = $login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $lignesSonde = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $lignesSonde;
    }
    public function GetbdTecht($id){
        $req = "SELECT users.login FROM `users` WHERE users.IDUSERS = $id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $lignesSonde = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $lignesSonde;
    }
    // POUR LA PAGE ADMIN
    public function getBdSociete(){
        $req = "SELECT * from societe";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $societe = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return  $societe;
    }
    public function verifBdSociete($societe,$code){
        $req = "SELECT IDSOCIETE from societe WHERE Nom_societe = $societe AND code = $code";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $societe = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return  $societe;
    }
    // 
    public function getBdTypeTicket(){
        $req = "SELECT *  from type_ticket";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
         $typeTicket = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $typeTicket;
    }

    // Tous les releves POUR ADMIN
    public function getBdStatut(){
        $req = "SELECT *  from statut";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $status = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $status;
    }
    public function getBdticket($id){
        $req = "SELECT * from ticket  INNER JOIN `users` ON users.IDUSERS = ticket.IDUSERS INNER JOIN `societe` ON societe.IDSOCIETE = users.IDSOCIETE INNER JOIN `statut` ON statut.IDSTATUS = ticket.IDstatus WHERE IDTICKETS = '$id'";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $status = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $status;
    }
    public function getbdticketbystatus($status){
        $req = "SELECT * from ticket  INNER JOIN `users` ON users.IDUSERS = ticket.IDUSERS INNER JOIN `societe` ON societe.IDSOCIETE = users.IDSOCIETE INNER JOIN `statut` ON statut.IDSTATUS = ticket.IDstatus WHERE statut.IDSTATUS = '$status'";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $status = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $status;
    }
    public function getbdticketbyusers($id_users){
        $req = "SELECT * from ticket  INNER JOIN `users` ON users.IDUSERS = ticket.IDUSERS INNER JOIN `societe` ON societe.IDSOCIETE = users.IDSOCIETE INNER JOIN `statut` ON statut.IDSTATUS = ticket.IDstatus WHERE ticket.IDUSERS = '$id_users'";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $status = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $status;
    }
    public function getbdticketbyidandstatus($id_user,$status){
        $req = "SELECT * from ticket  INNER JOIN `users` ON users.IDUSERS = ticket.IDUSERS INNER JOIN `societe` ON societe.IDSOCIETE = users.IDSOCIETE INNER JOIN `statut` ON statut.IDSTATUS = ticket.IDstatus WHERE statut.IDSTATUS = '$status' AND ticket.IDTECH = '$id_user'";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $status = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $status;
    }
    public function Updatebdstatusticket($id_ticket,$status){
        $req = "UPDATE `ticket` SET `IDstatus`= '$status' WHERE IDTICKETS = $id_ticket";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $status = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $status;
    }
    public function closebdticket($id_ticket,$commentaire){
        $req = "UPDATE `ticket` SET `Commentaire`= $commentaire, `IDstatus`= '5' WHERE IDTICKETS = $id_ticket";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $status = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $status;
    }
    public function getbdusersrole($role){
        $req = "SELECT * FROM `users` WHERE IDROLE = $role";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $lignesSonde = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $lignesSonde;
    }
    public function distribbdticket($id_ticket,$id_users){
        $req = "UPDATE `ticket` SET `IDTECH`= '$id_users', `IDstatus`= '6' WHERE IDTICKETS = $id_ticket";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $lignesSonde = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $lignesSonde;
    }
    
}