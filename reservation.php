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
      echo '<div class="sidenav"> <a href="index.php"><center>Accueil</center></a>'.
      '<a href="profil.php">  <img src="https://img.icons8.com/officexs/30/000000/user-menu-female.png"/> Votre profil    '.$_SESSION['login'].'</a>'.
      '<a href="planning.php"><img src="https://img.icons8.com/offices/30/000000/planner.png"/> le planning  </a>'.'<a href="profil.php?deconnexion">
        <center><img src="https://img.icons8.com/fluent/48/000000/shutdown.png"/></center> </a></div>' ;
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
      if(isset($_GET['evenement']))
      {
        $id_event = $_GET['evenement'];
        // on se connecte à notre base
        $bdd = mysqli_connect("127.0.0.1", "root", "", "reservationsalles");
        $requete = "SELECT utilisateurs.login, titre, description, debut, fin FROM reservations INNER JOIN utilisateurs ON utilisateurs.id = reservations.id_utilisateur WHERE reservations.id = '$id_event'";
        $resultat = $bdd->query($requete);
      }

    		while ($ligne = $resultat->fetch_assoc()) {
            echo '<h1>'.$ligne['login'].'</h1>';
            echo '<h3>'. $ligne['titre']. '</h3>';
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
