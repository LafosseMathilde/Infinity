<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Calendrier dynamique avec PHP et HTML</title>
</head>
<body>
    <h1>Calendrier dynamique avec PHP et HTML</h1>

    <?php
        // Récupération des données des utilisateurs depuis une base de données ou autre source
        // Exemple :
        $users = array(
            array(
                "name" => "John Doe",
                "email" => "john.doe@example.com"
            ),
            array(
                "name" => "Jane Smith",
                "email" => "jane.smith@example.com"
            )
        );

        // Récupération de la date actuelle
        $today = date("Y-m-d");

        // Affichage du calendrier
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<th></th>";
        for ($i = 0; $i < 7; $i++) {
            $day = date("Y-m-d", strtotime($today . " +$i day"));
            echo "<th colspan='2'>$day</th>";
        }
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($users as $user) {
            echo "<tr>";
            echo "<td>{$user['name']}</td>";
            for ($i = 0; $i < 7; $i++) {
                $day = date("Y-m-d", strtotime($today . " +$i day"));
                $data_am = ""; // Données à afficher pour la demi-journée du matin pour ce jour
                $data_pm = ""; // Données à afficher pour la demi-journée de l'après-midi pour ce jour
                // Récupération des données de l'utilisateur pour ce jour depuis une base de données ou autre source
                // Exemple :
                // $data_am = ...;
                // $data_pm = ...;
                echo "<td><input type='text' name='data_am[$user[name]][$day]' value='$data_am'></td>";
                echo "<td><input type='text' name='data_pm[$user[name]][$day]' value='$data_pm'></td>";
            }
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    ?>

    <input type="submit" value="Enregistrer les données">
</body>
</html>
