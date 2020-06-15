<?php
session_start();
 ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réservation</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Scada&display=swap" rel="stylesheet">

</head>
<body>
  <header>
    <?php

// si l'utilisateur est connecté le header est personnalisé

    if(isset($_SESSION['login'])){
      echo '<div class="sidenav"> <a href="index.php">Accueil</a></li>'.'<a href="profil.php">   Vous êtes connecté(e)     '.$_SESSION['login'].'</a>'.'<a href="profil.php"> votre profil </a>'.'<a href="planning.php">
          Retour au planning </a></div>' ;
    }
    else { ?>
      <ul>
      <li><a href="index.php">accueil</a></li>
      <li><a href="inscription.php">inscription</a></li>
      </ul>
    <?php  }?>

  </header>
    <main>
      <div class="content_reservation">

      <?php
      // on se connecte à notre base
      $bdd = mysqli_connect("127.0.0.1", "root", "", "reservationsalles");

      $requete = 'SELECT * FROM reservations';
      $resultat = $bdd->query($requete);

$id=$_GET['id'];

      		while ($ligne = $resultat->fetch_assoc()) {

echo '<h1>'. $ligne['titre']. '</h1>';

      			echo '<p>'.$ligne['description'].'</p>heure de début<p>' .$ligne['debut']. '</p>heure de fin<p>' .$ligne['fin'].'</p>';
      		}
      		$bdd->close();
          //$id_resa = $info_reservation[0]['id'];

      		?>
        </div>

    </main>
    <footer></footer>
</body>
</html>
