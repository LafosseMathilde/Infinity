<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "cra";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Récupération des données de la table DayType
$sql_daytype = "SELECT * FROM DayType";
$result_daytype = mysqli_query($conn, $sql_daytype);

// Affichage des données dans un tableau
echo "<table>";
echo "<tr><th>Id</th><th>Nom</th><th>Prenom</th><th>Email</th><th>Date</th><th>AM</th><th>PM</th></tr>";
while ($row = mysqli_fetch_assoc($result_daytype)) {
    echo "<tr><td>" . $row["Id"] . "</td><td>" . $row["Nom"] . "</td><td>" . $row["Prenom"] . "</td><td>" . $row["Email"] . "</td><td>" . $row["date"] . "</td><td>" . $row["AM"] . "</td><td>" . $row["PM"] . "</td></tr>";
}
echo "</table>";

// Fermeture de la connexion
mysqli_close($conn);
?>

<html>
    <body>
        <a href="index.html">Formulaire</a>
        <link rel="stylesheet" href="tableau.css">
    </body>
</html>
