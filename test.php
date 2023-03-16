<?php
// Définition des mois et des jours de la semaine
$mois = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
$jours = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");

// Récupération de la date actuelle
$annee_en_cours = date("Y");
$mois_en_cours = date("n");

// Calcul du nombre de jours dans le mois en cours
$nb_jours_dans_mois = cal_days_in_month(CAL_GREGORIAN, $mois_en_cours, $annee_en_cours);

// Définition du tableau de données vide
$calendrier = array_fill(1, $nb_jours_dans_mois, array_fill(0, 7, ""));

// Traitement des données saisies
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    for ($jour = 1; $jour <= $nb_jours_dans_mois; $jour++) {
        if (!empty($_POST["activite"][$jour])) {
            $calendrier[$jour][date("w", strtotime($annee_en_cours."-".$mois_en_cours."-".$jour))] = $_POST["activite"][$jour];
        }
    }
}

// Affichage du tableau sous forme de calendrier
echo "<table>
        <caption>".$mois[$mois_en_cours - 1]." ".$annee_en_cours."</caption>
        <thead>
            <tr>";
foreach ($jours as $jour) {
    echo "<th>".$jour."</th>";
}
echo "</tr>
        </thead>
        <tbody>";
for ($jour = 1; $jour <= $nb_jours_dans_mois; $jour++) {
    if ($jour == 1 || date("w", strtotime($annee_en_cours."-".$mois_en_cours."-".$jour)) == 0) {
        echo "<tr>";
    }
    echo "<td>".$jour."<br>";
    echo "<form method='post' action='".$_SERVER["PHP_SELF"]."'>";
    echo "<input type='text' name='activite[".$jour."]' value='".$calendrier[$jour][date("w", strtotime($annee_en_cours."-".$mois_en_cours."-".$jour))]."'>";
    echo "<input type='submit' value='Valider'>";
    echo "</form>";
    echo "</td>";
    if ($jour == $nb_jours_dans_mois || date("w", strtotime($annee_en_cours."-".$mois_en_cours."-".$jour)) == 6) {
        echo "</tr>";
    }
}
echo "</tbody></table>";
?>
