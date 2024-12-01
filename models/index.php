<?php  
include 'C_Matiere.php';  
include 'C_Enseingnant.php';  
include 'C_Etudiant.php';  
include 'C_Stat.php';  
require_once 'config.php';

// Créer une instance de DataBase et se connecter
$db = new DataBase();
$conn = $db->connect();

// Formulaire et logique de traitement
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Gestion des Absences</title>
    <style>
        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .navbar {
            margin-bottom: 20px;
        }
        .container {
            max-width: 1200px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Gestion des Absences</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="listerEtudiant.php">Lister les Étudiants</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="list_absences.php">Lister les absences</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Aide</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


    <!-- Container -->
    <div class="container">
        <!-- Add Matière Form -->
        <div class="mb-4">
            <h2>Ajouter une Matière</h2>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="nomMatiere" class="form-label">Nom de la matière:</label>
                    <input type="text" class="form-control" id="nomMatiere" name="nomMatiere" required>
                </div>
                <button type="submit" name="ajouterMatiere" class="btn btn-primary">Ajouter Matière</button>
            </form>
        </div>

        <?php
        $matiere = new C_Matiere($conn);
        if (isset($_POST['ajouterMatiere'])) {
            $matiere->ajouterMatiere($_POST['nomMatiere']);
        }
        ?>

        <!-- List Matières -->
        <div class="mb-4">
            <h2>Liste des Matières</h2>
            <div class="row">
                <?php
                $matieres = $matiere->listerMatieres();
                while ($row = mysqli_fetch_assoc($matieres)) {
                    echo '
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Matière</h5>
                                <p class="card-text">' . htmlspecialchars($row['nomMatiere']) . '</p>
                            </div>
                        </div>
                    </div>';
                }
                ?>
            </div>
        </div>

        <!-- Add Enseignant Form -->
        <div class="mb-4">
            <h2>Ajouter un Enseignant</h2>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="nomEnseignant" class="form-label">Nom:</label>
                    <input type="text" class="form-control" id="nomEnseignant" name="nomEnseignant" required>
                </div>
                <div class="mb-3">
                    <label for="prenomEnseignant" class="form-label">Prénom:</label>
                    <input type="text" class="form-control" id="prenomEnseignant" name="prenomEnseignant" required>
                </div>
                <div class="mb-3">
                    <label for="emailEnseignant" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="emailEnseignant" name="emailEnseignant" required>
                </div>
                <div class="mb-3">
                    <label for="telEnseignant" class="form-label">Téléphone:</label>
                    <input type="text" class="form-control" id="telEnseignant" name="telEnseignant" required>
                </div>
                <button type="submit" name="ajouterEnseignant" class="btn btn-primary">Ajouter Enseignant</button>
            </form>
        </div>

        <?php
        $enseignant = new C_Enseignant($conn);
        if (isset($_POST['ajouterEnseignant'])) {
            $enseignant->ajouterEnseignant($_POST['nomEnseignant'], $_POST['prenomEnseignant'], $_POST['emailEnseignant'], $_POST['telEnseignant']);
        }
        ?>

        <!-- List Enseignants -->
        <div class="mb-4">
            <h2>Liste des Enseignants</h2>
            <div class="row">
                <?php
                $enseignants = $enseignant->listerEnseignants();
                while ($row = mysqli_fetch_assoc($enseignants)) {
                    echo '
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Enseignant</h5>
                                <p class="card-text">' . htmlspecialchars($row['nom']) . ' ' . htmlspecialchars($row['prenom']) . '</p>
                            </div>
                        </div>
                    </div>';
                }
                ?>
            </div>
        </div>

        <!-- Add Étudiant Form -->
        <div class="mb-4">
            <h2>Ajouter un Étudiant</h2>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="nomEtudiant" class="form-label">Nom:</label>
                    <input type="text" class="form-control" id="nomEtudiant" name="nomEtudiant" required>
                </div>
                <div class="mb-3">
                    <label for="prenomEtudiant" class="form-label">Prénom:</label>
                    <input type="text" class="form-control" id="prenomEtudiant" name="prenomEtudiant" required>
                </div>
                <div class="mb-3">
                    <label for="emailEtudiant" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="emailEtudiant" name="emailEtudiant" required>
                </div>
                <div class="mb-3">
                    <label for="classeID" class="form-label">Classe ID:</label>
                    <input type="text" class="form-control" id="classeID" name="classeID" required>
                </div>
                <button type="submit" name="ajouterEtudiant" class="btn btn-primary">Ajouter Étudiant</button>
            </form>
        </div>

        <?php
        $etudiant = new C_Etudiant($conn);
        if (isset($_POST['ajouterEtudiant'])) {
            $etudiant->ajouterEtudiant($_POST['nomEtudiant'], $_POST['prenomEtudiant'], $_POST['emailEtudiant'], $_POST['classeID']);
        }
        ?>

        <!-- List Étudiants -->
        <div class="mb-4">
            <h2>Liste des Étudiants</h2>
            <div class="row">
                <?php
                $etudiants = $etudiant->listerEtudiants();
                while ($row = mysqli_fetch_assoc($etudiants)) {
                    echo '
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Étudiant</h5>
                                <p class="card-text">' . htmlspecialchars($row['nom']) . ' ' . htmlspecialchars($row['prenom']) . '</p>
                            </div>
                        </div>
                    </div>';
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
