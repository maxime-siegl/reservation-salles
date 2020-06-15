<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
<link rel="stylesheet" href="style.css">
<link href="https://fonts.googleapis.com/css2?family=Scada&display=swap" rel="stylesheet">

</head>
<body>
  <header>
    <div class="index">

    <?php
  // Si s'utilisateur est loggé le header est personnalisé
  if (isset($_SESSION['login']))
  {
      echo '<a href="profil.php">   Tu es connecté(e)      ' . $_SESSION['login'] . '</a>' . '<a href="planning.php"> accéder au planning </a>' . '<a href="profil.php?deconnexion"> deconnexion </a>';
  }
  else
  { ?>

    <div class="header">
      <h2>Salle communale de la ville</h2>
    </div>

    <div class="row">
      <div class="column">

<a href="inscription.php">S'inscrire</a>
      </div>
      <div class="column"> Pour accéder au planning de la salle il faut
       vous connecter ou vous inscrire si vous n'avez pas de compte</div>
      <div class="column">
<a href="connexion.php">Se connecter</a>
      </div>
    </div>

    <div class="footer">
      <p>Footer</p>
    </div>

    <?php
  } ?>

  </header>

  <main>
<div class="">

</div>

  </main>

</div>

</body>
</html>
