<?php
session_start();
if(isset($_SESSION['user_id'])) {
  header("Location: dashboard.php");
  exit();
}

$errors = array();

if(isset($_POST['submit'])) {
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

  // Vérification des champs requis
  if(empty($email)) {
    $errors[] = "Veuillez entrer votre adresse email.";
  }
  if(empty($password)) {
    $errors[] = "Veuillez entrer votre mot de passe.";
  }

  // Vérification des identifiants de connexion
  if(empty($errors)) {
    $user = getUserByEmail($email);
    if($user && password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      header("Location: dashboard.php");
      exit();
    } else {
      $errors[] = "Adresse email ou mot de passe incorrect.";
    }
  }
}

function getUserByEmail($email) {
  // Remplacez cette fonction par votre propre fonction de récupération de l'utilisateur à partir de la base de données
  $users = array(
    array('id' => 1, 'email' => 'user1@example.com', 'password' => '$2y$10$SPKrQ2S9Z9zlfZ0i5O5BL.mq3lBeytXT5Q5ADzIfCgjvPPpF9kE5O'),
    array('id' => 2, 'email' => 'user2@example.com', 'password' => '$2y$10$G8fz0n6yPxjLsV7GnRDK/uEazn01sZtT3V7KjM2XnV7IuTHAWjGGG'),
    array('id' => 3, 'email' => 'user3@example.com', 'password' => '$2y$10$NJM/PWCBN8ZdOa/n/y/2JOYbKkPfH4cN.4N4a70G7Vcm0JjOGOUq')
  );

  foreach($users as $user) {
    if(strtolower($user['email']) == strtolower($email)) {
      return $user;
    }
  }

  return null;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Connexion utilisateur</title>
</head>
<body>
  <?php if(!empty($errors)) { ?>
    <div class="errors">
      <?php foreach($errors as $error) { ?>
        <p><?php echo $error; ?></p>
      <?php } ?>
    </div>
  <?php } ?>

  <h1>Connexion utilisateur</h1>

  <form method="post">
    <div>
      <label for="email">Adresse email :</label>
      <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required>
    </div>
    <div>
      <label for="password">Mot de passe :</label>
      <input type="password" id="password" name="password" required>
    </div>
    <div>
      <button type="submit" name="submit">Se connecter</button>
    </div>
  </form>
</body>



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
echo '<option value="AM">AM</option>';
echo '<option value="Conges">Conges</option>';
echo '<option value="Maladie">Maladie</option>';
echo '<option value="Teletravail">Teletravail</option>';
echo '<option value="Formation">Formation</option>';
echo '<option value="RTT">RTT</option>';
echo '<option value="SurSite">Sur Site</option>';
echo '</select>';
echo '<br>';
echo '<select name="data[' . $year . '-' . $month . '-' . $numDay . '_apresmidi]">';
echo '<option value="PM">PM</option>';
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

// Fin de la boucle pour chaque jour de la semaine
}

echo '</tr>';
}

echo '</table>';

// Boutons pour afficher le mois suivant ou précédent
echo '<form method="get">';
echo '<input type="hidden" name="year" value="' . $year . '">';
echo '<input type="hidden" name="month" value="' . ($month - 1) . '">';
echo '<input type="submit" value="Mois precedent">';
echo '</form>';

echo '<form method="get">';
echo '<input type="hidden" name="year" value="' . $year . '">';
echo '<input type="hidden" name="month" value="' . ($month + 1) . '">';
echo '<input type="submit" value="Mois suivant">';
echo '</form>';
?>
