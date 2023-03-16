<?php
// Définition du fuseau horaire
date_default_timezone_set('Europe/Paris');

// Récupération de la date actuelle
$date = new DateTime();
$year = $date->format('Y');
$month = $date->format('n');

// Nombre de jours dans le mois en cours
$numDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);

// Jour de la semaine du premier jour du mois
$firstDay = date('N', strtotime($year . '-' . $month . '-01'));

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
            echo '<select name="data[' . $year . '-' . $month . '-' . $numDay . ']">';
            echo '<option value=""></option>';
            echo '<option value="option1">Option 1</option>';
            echo '<option value="option2">Option 2</option>';
            echo '<option value="option3">Option 3</option>';
            echo '</select>';
            echo '<br>';
            echo $numDay;
            echo '</td>';
        } else {
            echo '<td></td>';
        }
    }

    echo '</tr>';
}

echo '</table>';
?>
