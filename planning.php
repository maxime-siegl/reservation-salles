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
    $bdd = mysqli_connect("localhost", "root", "", "reservationsalles");

echo '<table>';

echo '<thead><th></th><th>lundi</th><th>mardi</th><th>mercredi</th><th>jeudi</th><th>vendredi</th>';

$heure = 8;

while( $heure < 20 )
{
echo '<tr><td>'. $heure . '</td>';

$jour=0;

while( $jour< 5 )
{
    $event = "SELECT titre, description, debut, fin FROM reservations INNER JOIN utilisateurs ON utilisateurs.id = reservations.id_utilisateur";
    $event_query = mysqli_query($bdd, $event);
    $recup_event = mysqli_fetch_all($event_query, MYSQLI_ASSOC);
    //var_dump($recup_event);
    //var_dump($recup_event[0]['debut']);
    foreach ($recup_event as $categorie => $valeur)
    {
        $jour_heure_event = $valeur['debut'];
        $explode_event = explode(" ", $jour_heure_event); //array jour heure du début

        $event_jour = $explode_event[0]; //date de l'event
        $jour_explode = explode("-", $event_jour);
        $jour_week_num = date("N", mktime(0, 0, 0, $jour_explode[1], $jour_explode[2], $jour_explode[0])); //jour semaine en numerique
        

        
        $event_heure = $explode_event[1]; // heure de l'évent
        $heure_explode = explode(":", $event_heure);
        $heure_only = date("G", mktime($heure_explode[0], $heure_explode[1], $heure_explode[2], 0,0,0)); //recup seulement le nombre des heures de l'évènement

    }
    var_dump($heure_only);
    var_dump($jour_week_num);

    
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
