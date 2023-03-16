<?php
// Tableau contenant les jours de la semaine
$jours_semaine = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');

// Tableau contenant les demi-journées
$demi_journees = array('Matin', 'Après-midi');

// Tableau multidimensionnel contenant les données du calendrier
$calendrier = array(
    array('Lundi', array('', '')),
    array('Mardi', array('', '')),
    array('Mercredi', array('', '')),
    array('Jeudi', array('', '')),
    array('Vendredi', array('', '')),
    array('Samedi', array('', '')),
    array('Dimanche', array('', ''))
);

// Traitement du formulaire
if (isset($_POST['enregistrer'])) {
    // Récupération des données du formulaire
    $jour = $_POST['jour'];
    $demi_journee = $_POST['demi_journee'];
    $donnees = $_POST['donnees'];
    // Mise à jour du tableau multidimensionnel
    $calendrier[$jour][1][$demi_journee] = $donnees;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Calendrier dynamique</title>
</head>
<body>
    <h1>Calendrier dynamique</h1>
    <form method="post">
        <table border="1">
            <tr>
                <th>Jour</th>
                <th>Matin</th>
                <th>Après-midi</th>
            </tr>
            <?php foreach ($calendrier as $index => $ligne): ?>
                <tr>
                    <td><?php echo $ligne[0]; ?></td>
                    <?php foreach ($demi_journees as $demi_journee): ?>
                        <td>
                            <select name="donnees">
                                <option value="Teletravail">Teletravail</option>
                                <option value="Conges">Conges</option>
                                <option value="Maladie">Maladie</option>
                                <option value="Formation">Formation</option>
                                <option value="RTT">RTT</option>
                                <option value="SurSite">Sur Site</option>
                            </select>
                            <input type="hidden" name="jour" value="<?php echo $index; ?>">
                            <input type="hidden" name="demi_journee" value="<?php echo $demi_journee; ?>">
                            <input type="submit" name="enregistrer" value="Enregistrer">
                            <?php if(isset($calendrier[$index][1][$demi_journee])): ?>
                                <?php echo $calendrier[$index][1][$demi_journee]; ?>
                            <?php endif; ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    </form>
</body>
</html>
