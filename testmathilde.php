<?php
// Définition du fuseau horaire
date_default_timezone_set('Europe/Paris');

// Récupération de la date actuelle ou de la date passée en paramètre "date"
if (isset($_GET['date'])) {
    $date = new DateTime($_GET['date']);
} else {
    $date = new DateTime();
}

$year = $date->format('Y');
$month = $date->format('n');

// Nombre de jours dans le mois en cours
$numDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);

// Jour de la semaine du premier jour du mois
$firstDay = date('N', strtotime($year . '-' . $month . '-01'));

// Affichage du mois et de l'année avec boutons pour passer au mois précédent et suivant
echo '<h1>';
echo '<a href="?date=' . $date->modify('-1 month')->format('Y-m-d') . '">&lt;</a> ';
echo date('F Y', strtotime($year . '-' . $month . '-01'));
echo ' <a href="?date=' . $date->modify('+2 months')->format('Y-m-d') . '">&gt;</a>';
echo '</h1>';

// Réinitialisation de la date
$date->modify('-1 month');

// Création du tableau HTML
echo '<table>';
echo '<tr><th>Lun</th><th>Mar</th><th>Mer</th><th>Jeu</th><th>Ven</th><th>Sam</th><th>Dim</th></tr>';

// Boucle pour chaque semaine
for ($week = 1; $week <= ceil(($numDays + $firstDay - 1) / 7); $week++) {
    echo '<tr>';

    // Boucle pour chaque jour de la semaine
    for ($day = 1; $day <= 7; $day++) {
        // Calcul du numéro de jour dans le mois
        $numDay = ($week - 1) * 7 + $day - $firstDay + 1;

        // Si le numéro de jour est compris entre 1 et le nombre de jours dans le mois, on affiche le jour
        if ($numDay >= 1 && $numDay <= $numDays) {
            echo '<td>';
echo '<select name="data[' . $year . '-' . $month . '-' . $numDay . '_matin]">';
echo '<option value="" disabled selected>Sur Site</option>';
echo '<option value="Conges">Conges</option>';
echo '<option value="Maladie">Maladie</option>';
echo '<option value="Teletravail">Teletravail</option>';
echo '<option value="Formation">Formation</option>';
echo '<option value="RTT">RTT</option>';
echo '<option value="SurSite">Sur Site</option>';
echo '</select>';
echo '<br>';
echo '<select name="data[' . $year . '-' . $month . '-' . $numDay . '_apresmidi]">';
echo '<option value="" disabled selected>Sur Site</option>';
echo '<option value="Conges">Conges</option>';
echo '<option value="Maladie">Maladie</option>';
echo '<option value="Teletravail">Teletravail</option>';
echo '<option value="Formation">Formation</option>';
echo '<option value="RTT">RTT</option>';
echo '<option value="SurSite">Sur Site</option>';
echo '</select>';
echo '<br>';
echo $numDay;
echo '</td>';
} else {
echo '<td></td>';
}
// Si on est arrivé au dernier jour de la semaine, on ferme la ligne du tableau
if ($day == 7) {
echo '</tr>';
}
// Fin de la boucle pour chaque jour de la semaine
}
// Fin de la boucle pour chaque semaine
}

echo '</table>';


// Ajout d'un bouton de soumission pour envoyer uniquement les cases remplies
echo '<input type="submit" value="Envoyer">';
echo '</form>';

// Vérification de la connexion
$conn = new mysqli("localhost", "root", "root", "cra");
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Récupération des données envoyées via le formulaire
if(isset($_POST['data'])) {
    $data = $_POST['data'];

    // Boucle pour insérer chaque ligne dans la base de données
    foreach ($data as $date => $values) {
        $matin = $values['_matin'];
        $apresmidi = $values['_apresmidi'];
          // Insère les données de connexion dans la base de données
        $sql = "INSERT INTO statut (Conges, Maladie, Teletravail, Formation, RTT, SurSite) VALUES ('$Conges', '$Maladie', '$Teletravail', '$Formation', '$RTT', '$SurSite')";
         mysqli_query($conn, $sql);
        }
    }

    // Fermeture de la connexion
    $conn->close();

?>
