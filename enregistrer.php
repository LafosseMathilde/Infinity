<?php
// Connexion à la base de données
$conn = new mysqli("localhost", "root", "root", "cra");

// Vérification de la connexion
if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
}

// Récupération des données du formulaire
$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$email = $_POST["email"];
$evenement = $_POST["evenement"];
//$Client = $_POST["Client"];
$date = $_POST["date"];

// Préparation de la requête SQL
$sql = "INSERT INTO Utilisateur (Nom, Prenom, Email, Date) VALUES ('$nom', '$prenom', '$email', NOW())";
$conn->query($sql);

$utilisateur_id = $conn->insert_id;

$sql = "INSERT INTO Evenement (Télétravail, Présentiel, Client, Date) VALUES ('$evenement' = 'Télétravail', '$evenement' = 'Présentiel', '$date')";
$conn->query($sql);

$evenement_id = $conn->insert_id;

$sql = "INSERT INTO Inscription (Id_utilisateur, Id_evenement) VALUES ($utilisateur_id, $evenement_id)";
$conn->query($sql);

$conn->close();


?>
