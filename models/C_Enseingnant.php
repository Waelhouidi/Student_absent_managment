<?php
class C_Enseignant {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function ajouterEnseignant($nom, $prenom, $mail, $tel) {
        $query = "INSERT INTO t_Enseignant (nom, prenom, mail, tel) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssss", $nom, $prenom, $mail, $tel);
        return $stmt->execute();
    }

    public function listerEnseignants() {
        $query = "SELECT * FROM t_Enseignant";
        return $this->conn->query($query);
    }
}
?>
