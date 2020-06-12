<?php
    session_start();
    if(isset($_POST['deconnexion']))
    {
        session_destroy();
    }
    $message="";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réservation d'un créneau</title>
</head>
<body>
    <header></header>
    <main>
        <?php
            if (isset($_SESSION['login']))
            {
                $bdd = mysqli_connect("localhost", "root", "", "reservationsalles");
        ?>
                <form action="reservation-form.php" method="POST">
                    <p>
                        <label for="titre">Titre</label>
                        <input type="text" name="titre" id="titre" required>
                        <label for="description">Description</label>
                        <textarea name="description" id="description" cols="30" rows="10" placeholder="Décrivez un peu votre évènement..." required></textarea>
                        <label for="debut">Date du début de l'évènement:</label>
                        <input type="date" name="debut" id="debut" min="<?php echo date('Y-m-d'); ?>" required>
                        <select name="heure_debut" id="heure_debut" required>
                            <?php
                                for($horaire_debut = 8; $horaire_debut <=19; $horaire_debut++)
                                {
                                    if ($horaire_debut < 10)
                                    {
                            ?>
                                        <option value="<?php echo '0'.$horaire_debut.':00'; ?>"><?php echo $horaire_debut.'h' ?></option>       
                            <?php            
                                    }
                                    else
                                    {
                            ?>
                                        <option value="<?php echo $horaire_debut.':00'; ?>"><?php echo $horaire_debut.'h'; ?></option>
                            <?php
                                    }
                                }
                            ?>  
                        </select>
                        <label for="fin">Date de fin de l'évènement</label>
                        <input type="date" name="fin" id="fin" min="<?php echo date('Y-m-d'); ?>" required>
                        <select name="heure_fin" id="heure_fin" required>
                            <?php
                                for($horaire_fin = 9; $horaire_fin <=20; $horaire_fin++)
                                {
                                    if ($horaire_fin < 10)
                                    {
                            ?>      
                                        <option value="<?php echo '0'.$horaire_fin.':00'; ?>"><?php echo '0'.$horaire_fin.'h'; ?></option>
                            <?php        
                                    }
                                    else
                                    {
                            ?>
                                        <option value="<?php echo $horaire_fin.':00'; ?>"><?php echo $horaire_fin.'h'; ?></option>
                            <?php
                                    }
                                }
                            ?>
                        </select>
                        <button type="submit" name="creer" class="bouton">Créer</button>
                </p>
            </form>

        <?php
                if(isset($_POST['creer']) && !empty($_POST['titre']) && !empty($_POST['description']) && !empty($_POST['debut']) && !empty($_POST['fin']) && !empty($_POST['heure_debut']) && !empty($_POST['heure_fin']))
                {
                    $titre = $_POST['titre'];
                    $description = $_POST['description'];
                    $debut = $_POST['debut']. " " .$_POST['heure_debut'];
                    $fin = $_POST['fin']. " " .$_POST['heure_fin'];
                    $utilisateur = $_SESSION['id'];

                    
                    $jour_debut_explode = explode("-", $_POST['debut']);
                    $jour_debut_week_num = date("N", mktime(0, 0, 0, $jour_debut_explode[1], $jour_debut_explode[2], $jour_debut_explode[0])); //jour du debut de l'event semaine en numerique

                    $jour_fin_eplxode = explode("-", $_POST['fin']);
                    $jour_fin_week_num = date("N", mktime(0,0,0, $jour_fin_eplxode[1], $jour_fin_eplxode[2], $jour_fin_eplxode[0])); //jour de la fin de l'event semaine en numerique

                    if ($_POST['debut'] == $_POST['fin']) // date de début == fin
                    {
                        $aujourdhui = date('Y-m-d H'); //recup nombre heure de l'heure actuel

                        $heure_debut_explode = explode(":", $_POST['heure_debut']); // exploser heure début
                        $heure_debut_only = date("G", mktime($heure_debut_explode[0], $heure_debut_explode[1], 0, 0, 0, 0)); // recup uniquement le nombre heure
                        $heure_fin_explode = explode(":", $_POST['heure_fin']); // exploser heure fin
                        $heure_fin_only = date("G", mktime($heure_fin_explode[0], $heure_fin_explode[1], 0, 0, 0, 0)); // recup uniquement le nombre heure
                        
                        $jour_resa = $_POST['debut'].' '.$heure_debut_only;


                        if ($jour_resa > $aujourdhui) // heure de début doit se trouver apres heure now?
                        {
                            if ($heure_fin_only - $heure_debut_only == 1) // heure de fin - heure de début == 1
                            {
                                if ($jour_debut_week_num <= 5) // Pas résa weekend
                                {
                                    $event = "SELECT * FROM reservations WHERE debut = '$debut' "; // recup info si date correspond a quelques cose déjà créé
                                    $event_query = mysqli_query($bdd, $event);
                                    $info_event = mysqli_fetch_all($event_query, MYSQLI_ASSOC); //info event deja créé
                                    
                                    if (empty($info_event)) // créneau déjà occupé
                                    {
                                        $ajout_event = "INSERT INTO reservations VALUES (null, '$titre', '$description', '$debut', '$fin', '$utilisateur')";
                                        $ajout_query = mysqli_query($bdd, $ajout_event);
                                    }
                                    else
                                    {
                                        echo 'créneau indisponible';
                                    }
                                }
                                else
                                {
                                    echo 'Le week-end la salle n\'est pas disponible';
                                }
                            }
                            else
                            {
                                echo 'on ne peut réserver une heure seule';
                            }
                        }
                        else
                        {
                            echo 'heure déjà passée';
                        }
                    }
                    else
                    {
                        echo 'les reservations se font le même jour';
                    }
                }
                mysqli_close($bdd);
            }
        ?>
    </main>
    <footer></footer>
</body>
</html>