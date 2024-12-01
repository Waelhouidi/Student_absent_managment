<?php
class C_Stat {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Method to list absences for a specific student within a date range
    public function Liste_absence_etudiant($nom, $prenom, $dateDebut, $dateFin) {
        $query = "SELECT e.nom, e.prenom, m.nomMatiere, COUNT(f.codeFicheAbsence) AS nombre_absences
                  FROM t_ficheabsence f
                  JOIN t_matiere m ON f.codeMatiere = m.codeMatiere
                  JOIN t_etudiant e ON f.codeClasse = e.codeClasse
                  WHERE e.nom = ? AND e.prenom = ? AND f.dateJour BETWEEN ? AND ?
                  GROUP BY e.nom, e.prenom, m.nomMatiere";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssss", $nom, $prenom, $dateDebut, $dateFin);
        return $stmt->execute() ? $stmt->get_result() : false;
    }

    // Method to list absences for all students within a date range, grouped by student and subject
    public function Liste_absence_etudiant_par_periode($dateDebut, $dateFin) {
        $query = "SELECT e.nom, e.prenom, m.nomMatiere, COUNT(f.codeFicheAbsence) AS nombre_absences
                  FROM t_ficheabsence f
                  JOIN t_matiere m ON f.codeMatiere = m.codeMatiere
                  JOIN t_etudiant e ON f.codeClasse = e.codeClasse
                  WHERE f.dateJour BETWEEN ? AND ?
                  GROUP BY e.nom, e.prenom, m.nomMatiere";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $dateDebut, $dateFin);
        return $stmt->execute() ? $stmt->get_result() : false;
    }
}
?>
