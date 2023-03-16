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
                "birthdate" => "1990-01-15",
                "email" => "john.doe@example.com"
            ),
            array(
                "name" => "Jane Smith",
                "birthdate" => "1992-05-20",
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
            echo "<th>$day</th>";
        }
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($users as $user) {
            echo "<tr>";
            echo "<td>{$user['name']}</td>";
            for ($i = 0; $i < 7; $i++) {
                $day = date("Y-m-d", strtotime($today . " +$i day"));
                $data = ""; // Données à afficher pour ce jour
                // Récupération des données de l'utilisateur pour ce jour depuis une base de données ou autre source
                // Exemple :
                if ($day == $user['birthdate']) {
                    $data = "Anniversaire";
                }
                echo "<td><input type='text' name='data[$user[name]][$day]' value='$data'></td>";
            }
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    ?>

    <input type="submit" value="Enregistrer les données">
</body>
</html>
