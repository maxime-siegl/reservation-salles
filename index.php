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
    <section class="index">

    <?php
  // Si s'utilisateur est loggé le header est personnalisé
  if (isset($_SESSION['login']))
  {
      echo '<a href="profil.php">   Tu es connecté(e)      ' . $_SESSION['login'] . '</a>' . '<a href="planning.php"> accéder au planning </a>' . '<a href="profil.php?deconnexion"> deconnexion </a>';
  }
  else
  { ?>
    <?php
  } ?>

  </header>


  <main>
    <section class="main">

    <section class="header">
      <h2>Salle communale de la ville de Springfield</h2>
      <p>Associations, particuliers, réservez la salle pour toutes vos activités</p>
    </section>

    <section class="row2">
      <section class="column">

<a href="inscription.php">S'inscrire</a>
</section>
      <section class="column">
<a href="connexion.php">Se connecter</a>
</section>
</section>
</section>
</section>

  </main>


</body>
</html>
