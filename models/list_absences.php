<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "absence";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dateDebut = $_POST['dateDebut'];
    $dateFin = $_POST['dateFin'];

    $query = "SELECT e.nom, e.prenom, COUNT(f.codeFicheAbsence) AS nombre_absences
              FROM t_ficheabsence f
              JOIN t_etudiant e ON f.codeClasse = e.codeClasse
              WHERE f.dateJour BETWEEN ? AND ?
              GROUP BY e.nom, e.prenom";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $dateDebut, $dateFin);
    $stmt->execute();
    $result = $stmt->get_result();

    echo '<div class="container mt-4">';
    echo '<h3>Absences de ' . $dateDebut . ' à ' . $dateFin . '</h3>';
    echo '<table class="table table-bordered">';
    echo '<thead><tr><th>Nom</th><th>Prénom</th><th>Nombre d\'absences</th></tr></thead>';
    echo '<tbody>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr><td>' . htmlspecialchars($row['nom']) . '</td><td>' . htmlspecialchars($row['prenom']) . '</td><td>' . $row['nombre_absences'] . '</td></tr>';
    }
    echo '</tbody></table>';
    echo '</div>';
}
?>

<form method="POST" action="" class="container mt-4">
    <div class="mb-3">
        <label for="dateDebut" class="form-label">Date de début</label>
        <input type="date" id="dateDebut" name="dateDebut" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="dateFin" class="form-label">Date de fin</label>
        <input type="date" id="dateFin" name="dateFin" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Afficher</button>
</form>
