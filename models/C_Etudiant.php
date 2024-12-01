<?php
class C_Etudiant {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function ajouterEtudiant($nom, $prenom, $mail, $classeID) {
        $query = "INSERT INTO t_etudiant (nom, prenom, mail, codeClasse) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssss", $nom, $prenom, $mail, $classeID);
        return $stmt->execute();
    }

    public function listerEtudiants() {
        $query = "SELECT * FROM t_etudiant";
        return $this->conn->query($query);
    }
}
?>
