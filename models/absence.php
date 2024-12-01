<?php
class Absence {
    private $connexion;
    private $table_absence = "absence"; // Nom de la table pour les enregistrements d'absences

    public function __construct($connexion) {
        $this->connexion = $connexion;
    }

    public function liste_absence_etudiant_par_matiere($code_etudiant, $code_matiere, $date_D, $date_f) {
        $query = "SELECT e.nom AS nom_enseignant, a.date_absence, a.seance 
                  FROM " . $this->table_absence . " a
                  JOIN t_Enseignant e ON a.code_enseignant = e.code
                  WHERE a.code_etudiant = ? AND a.code_matiere = ? AND a.date_absence BETWEEN ? AND ?";

        $stmt = $this->connexion->prepare($query);
        if (!$stmt) {
            die("Erreur de préparation de la requête : " . $this->connexion->error);
        }
        $stmt->bind_param("iiss", $code_etudiant, $code_matiere, $date_D, $date_f);
        $stmt->execute();
        $result = $stmt->get_result();

        $absences = [];
        while ($row = $result->fetch_assoc()) {
            $absences[] = $row;
        }
        $stmt->close();
        return $absences;
    }

    public function liste_absence_etudiant($nom_etudiant, $prenom_etudiant, $date_D, $date_f, $nom_class) {
        $query = "SELECT m.nomMatiere, COUNT(a.id_absence) AS nombre_absences
                  FROM " . $this->table_absence . " a
                  JOIN t_Matiere m ON a.code_matiere = m.codeMtiere
                  JOIN t_Etudiant e ON a.code_etudiant = e.code
                  WHERE e.nom = ? AND e.prenom = ? AND a.date_absence BETWEEN ? AND ? AND e.nomClass = ?
                  GROUP BY m.nomMatiere";

        $stmt = $this->connexion->prepare($query);
        if (!$stmt) {
            die("Erreur de préparation de la requête : " . $this->connexion->error);
        }
        $stmt->bind_param("sssss", $nom_etudiant, $prenom_etudiant, $date_D, $date_f, $nom_class);
        $stmt->execute();
        $result = $stmt->get_result();

        $absencesParMatiere = [];
        while ($row = $result->fetch_assoc()) {
            $absencesParMatiere[] = $row;
        }
        $stmt->close();
        return $absencesParMatiere;
    }
}
?>
