<?php
class Etudiant{
    private $connexion;
    private $table_name="t_Etudiant";
    private $nom;
    private $prenom;
    private $adresse;
    private $tel;
    private $mail;
    private $dateNaissance;
    private $codeClass;
    private $numInscription;
    public function __construct($bs) {
        $this->connexion = $bs;
    }
    public function addEtudiant($nom, $prenom, $dateNaissance, $codeClass,$numInscription,$adresse,$mail,$tel) {
        $query = "INSERT INTO " . $this->table_name . " (nom, Prenom, age, id_region) VALUES ('$nom', '$prenom', $age, '$id_region')";
        return $this->conn->query($query);
    }
}
public function getEtudiant($numInscription){
    $query = "SELECT * FROM " . $this->table_name . " WHERE numInscription"=$numInscription;
}

?>