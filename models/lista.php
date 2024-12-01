<?php
include 'absence.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new DataBase();
    $connexion = $db->connect();
    $absence = new Absence($connexion);

    // Handle the first form submission (Total absences by student)
    if (isset($_POST['submit'])) {
        $nom_etudiant = $_POST['nom_etudiant'];
        $prenom_etudiant = $_POST['prenom_etudiant'];
        $date_D = $_POST['date_D'];
        $date_f = $_POST['date_f'];
        $nom_class = $_POST['nom_class'];

        $absence->liste_absence_etudiant($nom_etudiant, $prenom_etudiant, $date_D, $date_f, $nom_class);
    }

    // Handle the second form submission (Absences by student and subject)
    if (isset($_POST['submit_matiere'])) {
        $code_etudiant = $_POST['code_etudiant'];
        $code_matiere = $_POST['code_matiere'];
        $date_D_matiere = $_POST['date_D_matiere'];
        $date_f_matiere = $_POST['date_f_matiere'];

        $absence->liste_absence_etudiant_par_matiere($code_etudiant, $code_matiere, $date_D_matiere, $date_f_matiere);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des Absences</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h2 {
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Formulaire de Recherche d'Absences</h2>
        <form method="post" action="">
            <div class="mb-3">
                <label for="nom_etudiant" class="form-label">Nom de l'Étudiant:</label>
                <input type="text" id="nom_etudiant" name="nom_etudiant" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="prenom_etudiant" class="form-label">Prénom de l'Étudiant:</label>
                <input type="text" id="prenom_etudiant" name="prenom_etudiant" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="date_D" class="form-label">Date de Début:</label>
                <input type="date" id="date_D" name="date_D" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="date_f" class="form-label">Date de Fin:</label>
                <input type="date" id="date_f" name="date_f" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="nom_class" class="form-label">Classe:</label>
                <input type="text" id="nom_class" name="nom_class" class="form-control" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary w-100">Afficher les Absences</button>
        </form>

        <h2 class="text-center mt-5">Formulaire de Recherche des Absences par Matière</h2>
        <form method="post" action="">
            <div class="mb-3">
                <label for="code_etudiant" class="form-label">Code de l'Étudiant:</label>
                <input type="text" id="code_etudiant" name="code_etudiant" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="code_matiere" class="form-label">Code de la Matière:</label>
                <input type="text" id="code_matiere" name="code_matiere" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="date_D_matiere" class="form-label">Date de Début:</label>
                <input type="date" id="date_D_matiere" name="date_D_matiere" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="date_f_matiere" class="form-label">Date de Fin:</label>
                <input type="date" id="date_f_matiere" name="date_f_matiere" class="form-control" required>
            </div>
            <button type="submit" name="submit_matiere" class="btn btn-primary w-100">Afficher les Absences par Matière</button>
        </form>
    </div>
</body>
</html>
v	Voir la structure de la table	absence t_classe
* codeClass : int(11)
* nomClasse : varchar(10)
* codeGroupe : int(100)
* CodeDepartment : int(100)
v	Voir la structure de la table	absence t_department
* codeDepartment : int(11)
* nomDepartment : varchar(20)
v	Voir la structure de la table	absence t_enseignant
* codeEnseignant : int(11)
* nom : varchar(20)
* prenom : varchar(20)
* dateRecrutement : date
* adresse : varchar(20)
* mail : varchar(20)
* codeDepartment : int(11)
* codeGrade : int(20)
* tel : int(20)
v	Voir la structure de la table	absence t_etudiant
* codeEtudiant : int(11)
* nom : varchar(20)
* prenom : varchar(20)
* dateNaissance : date
* codeClasse : varchar(35)
* numInscription : int(20)
* adresse : varchar(20)
* mail : int(11)
* tel : int(11)
v	Voir la structure de la table	absence t_ficheabsence
* codeFicheAbsence : int(11)
* dateJour : date
* codeMatiere : int(20)
* codeEnseignant : int(20)
* codeClasse : int(11)
v	Voir la structure de la table	absence t_ficheabsenceseance
* codeFicheAbsence : int(11)
* codeSeance : int(11)
v	Voir la structure de la table	absence t_groupe
* codeGroupe : int(11)
* nomGroupe : varchar(20)
v	Voir la structure de la table	absence t_ligneficheabsence
* codeFicheAbsence : int(11)
* codeEtudiant : int(11)
v	Voir la structure de la table	absence t_matiere
* codeMatiere : int(11)
* nomMatiere : varchar(10)
* nbHeureCoursParSemaine : varchar(20)
* nbHeureTdParSemaine : int(20)
* nbHeuretpParSemaine : int(20)
v	Voir la structure de la table	absence t_seance
* codeSeance : int(11)
* nomSeance : varchar(20)
* heureDebut : time(6)
* heureFin : time(6)
Travail demandé

1- Construire la base de données et remplir les tables nécessaires

2- Implémenter les classes PHP appelé C_Matière, C_Enseignant et C_Etudiant

3- Implémenter une classe PHP appelé C_Stat qui contient les méthodes suivantes :  
Liste_absence_etudiant_parMatière(code_etudiant, code_matiere, date_D, date_F) : qui permet d’afficher la liste détaillée (nom et prénom de l’enseignant, date d’absence et la séance d’absence) des absences d’un étudiant pour une matière donnée dans une période bien déterminée.  
Liste_absence_etudiant(nom_etudiant, prenom_etudiant, date_D, date_F, nom_classe) : qui permet d’afficher le nombre d’absences pour chaque matière d’un étudiant (nom et prénom) d’une classe donnée entre 2 dates données (date_D, date_F)

4- Concevoir et implémenter un formulaire web permettant de lister pour chaque étudiant le nombre total des séances d’absence selon une période de date choisie par l’internaute sous forme tabulaire.
5- concevoir et implémenter un formulaireweb permetan daffiche une liste detaillé dabcense dun etudiant pour une matiere donné 
6- Concevoir et implanter des pages permettant la faire des CRUD pour les matières, Enseignants et les Etudiants  
7- Concevoir et implanter une fenêtre Windows permettant d’informer l’administrateur pour chaque jour de la semaine tous les étudiants qui sont absents.  
8- Utiliser un Bootstrap pour le design  
9- La création d’autres fonctionnalités et interfaces est un plus.