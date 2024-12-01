<?php
include 'C_Stat.php'; // Include your class definition
include 'config.php'; // Include database configuration

// Create an instance of the C_Stat class
$db = new DataBase();
$conn = $db->connect();
$stat = new C_Stat($conn);

// Fetch classes from the database to populate the select dropdown
$query = "SELECT DISTINCT codeClass, nomClasse FROM t_Classe"; // Adjust table and column names as needed
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lister les Étudiants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Lister les Absences des Étudiants</h1>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="dateDebut" class="form-label">Date de Début</label>
            <input type="date" class="form-control" id="dateDebut" name="dateDebut" required>
        </div>
        <div class="mb-3">
            <label for="dateFin" class="form-label">Date de Fin</label>
            <input type="date" class="form-control" id="dateFin" name="dateFin" required>
        </div>
        <div class="mb-3">
            <label for="classe" class="form-label">Classe</label>
            <select class="form-select" id="classe" name="classe" required>
                <option value="">Sélectionnez une classe</option>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <option value="<?php echo htmlspecialchars($row['codeClass']); ?>">
                        <?php echo htmlspecialchars($row['nomClasse']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <button type="submit" name="search" class="btn btn-primary">Rechercher</button>
    </form>

    <?php
    if (isset($_POST['search'])) {
        $dateDebut = $_POST['dateDebut'];
        $dateFin = $_POST['dateFin'];
        $classe = $_POST['classe'];

        // Call the method to get absences based on date and class
        $result = $stat->Liste_absence_etudiant_par_periode($dateDebut, $dateFin);

        // Display results in a table
        if ($result && $result->num_rows > 0) {
            echo '<h2 class="mt-4">Résultats</h2>';
            echo '<table class="table table-bordered">';
            echo '<thead><tr><th>Nom</th><th>Prénom</th><th>Matière</th><th>Nombre d\'Absences</th></tr></thead>';
            echo '<tbody>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['nom']) . '</td>';
                echo '<td>' . htmlspecialchars($row['prenom']) . '</td>';
                echo '<td>' . htmlspecialchars($row['nomMatiere']) . '</td>';
                echo '<td>' . htmlspecialchars($row['nombre_absences']) . '</td>';
                echo '</tr>';
            }

            echo '</tbody></table>';
        } else {
            echo '<p>Aucune donnée trouvée pour cette période et cette classe.</p>';
        }
    }
    ?>
</div>
</body>
</html>
