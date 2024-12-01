<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "absence");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $matiere = $_POST['matiere'];

    $query = "SELECT f.dateJour, f.codeFicheAbsence
              FROM t_ficheabsence f
              JOIN t_etudiant e ON f.codeClasse = e.codeClasse
              JOIN t_matiere m ON f.codeMatiere = m.codeMatiere
              WHERE e.nom = ? AND e.prenom = ? AND m.nomMatiere = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $nom, $prenom, $matiere);
    $stmt->execute();
    $result = $stmt->get_result();

    echo '<div class="container mt-4">';
    echo '<h3>Absences de ' . htmlspecialchars($nom) . ' ' . htmlspecialchars($prenom) . ' pour la matière ' . htmlspecialchars($matiere) . '</h3>';
    echo '<table class="table table-bordered">';
    echo '<thead><tr><th>Date</th><th>Code Fiche Absence</th></tr></thead>';
    echo '<tbody>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr><td>' . $row['dateJour'] . '</td><td>' . $row['codeFicheAbsence'] . '</td></tr>';
    }
    echo '</tbody></table>';
    echo '</div>';
}
?>

<form method="POST" action="" class="container mt-4">
    <div class="mb-3">
        <label for="nom" class="form-label">Nom de l'étudiant</label>
        <input type="text" id="nom" name="nom" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="prenom" class="form-label">Prénom de l'étudiant</label>
        <input type="text" id="prenom" name="prenom" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="matiere" class="form-label">Matière</label>
        <input type="text" id="matiere" name="matiere" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Afficher</button>
</form>
