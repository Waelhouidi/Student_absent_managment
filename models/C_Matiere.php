<?php
class C_Matiere {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function ajouterMatiere($nomMatiere) {
        $query = "INSERT INTO t_Matiere (nomMatiere) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $nomMatiere);
        return $stmt->execute();
    }

    public function listerMatieres() {
        $query = "SELECT * FROM t_Matiere";
        return $this->conn->query($query);
    }
}
?>
