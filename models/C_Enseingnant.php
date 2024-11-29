<?php
class Enseignant{
    private $nom;
    private $prenom;
    private $dateRecrutement;
    private $adresse;
    private $mail ;
    private $codeDepartment;
    private $codeGrade;
    private $tel;
   private $connexion;
    private $table_name="t_Enseignant";
    public function __construct($nom,$prenom,$dateRecrutement,$adresse,$mail,$code){
        $this->nom=$nom;
        
    }
}
?>