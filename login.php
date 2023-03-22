<?php
session_start();

// Connexion à la base de données
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'root';
$dbname = 'cra';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Vérifie si le formulaire a été soumis
if (isset($_POST['submit'])) {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  // Insère les données de connexion dans la base de données
  $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
  mysqli_query($conn, $sql);

  // Vérifie si l'utilisateur est autorisé
  if ($username === 'user1' && $password === 'password1') {
    $_SESSION['username'] = $username;
    header('Location: index.php');
    exit();
  } else {
    $error = "Nom d'utilisateur ou mot de passe incorrect";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Connexion</title>
</head>
<body>
  <h2>Connexion</h2>
  <?php if (isset($error)): ?>
    <p><?php echo $error ?></p>
  <?php endif; ?>
  <form method="POST" action="">
    <label>Nom d'utilisateur:</label>
    <select name="username">
      <option value="user1">Utilisateur 1</option>
      <option value="user2">Utilisateur 2</option>
      <option value="user3">Utilisateur 3</option>
    </select>
    <br>
    <label>Mot de passe:</label>
    <input type="password" name="password">
    <br>
    <input type="submit" name="submit" value="Se connecter">
  </form>
</body>
</html>
