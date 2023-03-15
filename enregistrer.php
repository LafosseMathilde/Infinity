<?php
// Connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "root";
$nom_base_de_donnees = "cra";
$connexion = new mysqli($serveur, $utilisateur, $mot_de_passe, $nom_base_de_donnees);

// Vérification de la connexion
if ($connexion->connect_error) {
    die("La connexion a échoué : " . $connexion->connect_error);
}

// Récupération des données envoyées par le formulaire
$date = $_POST['date'];
$am = $_POST['am'];
$pm = $_POST['pm'];

// Insertion d'une nouvelle ligne dans la table DayType
$insertion = "INSERT INTO DayType (Date, AM, PM) VALUES ('$date', '$am', '$pm')";
if ($connexion->query($insertion) === TRUE) {
    echo "Nouvelle ligne insérée avec succès";
} else {
    echo "Erreur lors de l'insertion : " . $connexion->error;
}

// Fermeture de la connexion à la base de données
$connexion->close();
?>
