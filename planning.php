<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>planning</title>
  </head>
  <body>
<style>

table {
  border: medium solid navy;
  text-align: center;
}
tr {
  border: medium solid navy;
}
td {
  border: medium solid navy;

}

</style>
<header>

</header>

<main>

  <a href="profil.php">mon profil</a>
  <a href="index.php">accueil</a>

<h1><center>Planning de la semaine</center></h1>

<?php

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=reservationsalles;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$req = $bdd->prepare('SELECT * FROM reservations INNER JOIN utilisateurs ON reservations.id_utilisateurs= utilisateurs.id');
$req->execute(array());
$resultat = $req->fetch();
var_dump($resultat);

echo '<table>';

echo '<thead><th></th><th>lundi</th><th>mardi</th><th>mercredi</th><th>jeudi</th><th>vendredi</th>';

$heure = 8;

while( $heure < 20 )
{
echo '<tr><td>'. $heure . '</td>';

$jour=0;

while( $jour< 5 )
{


echo '<td>'. "<a href=reservation_form.php> réserver le créneau </a>" . '</td>'; // affichage jours
$jour++;
}
$heure++;
echo "</tr>";
}


echo '</table>';
?>



</main>
</body>
</html>
