<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <?php
  // Si s'utilisateur est loggé le header est personnalisé
  if (isset($_SESSION['login']))
  {
      echo '<ul> <li><a href="profil.php">   Tu es connecté(e)      ' . $_SESSION['login'] . '</a></li>' . '<li><a href="planning.php"> accéder au planning </a></li>' . '<li><a href="profil.php?deconnexion"> deconnexion </a></li></ul>';
  }
  else
  { ?>
      <ul>
      <li><a href="connexion.php">connexion</a></li>
      <li><a href="inscription.php">inscription</a></li>
      </ul>
    <?php
  } ?>

  </header>    <main></main>
    <footer></footer>
</body>
</html>
