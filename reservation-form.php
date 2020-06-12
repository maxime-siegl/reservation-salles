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
                        <textarea name="description" id="description" cols="30" rows="10" placeholder="Décrivez un peu votre évènement..."></textarea>
                        <label for="debut">Date du début de l'évènement:</label>
                        <input type="date" name="debut" id="debut" min="<?php echo date('Y-m-d'); ?>" required>
                        <select name="heure_debut" id="heure_debut" required>
                            <option value="">Choisissez une heure de début...</option>
                            <option value="8">8h</option>
                            <option value="9">9h</option>
                            <option value="10">10h</option>
                            <option value="11">11h</option>
                            <option value="12">12h</option>
                            <option value="13">13h</option>
                            <option value="14">14h</option>
                            <option value="15">15h</option>
                            <option value="16">16h</option>
                            <option value="17">17h</option>
                            <option value="18">18h</option>
                            <option value="19">19h</option>
                        </select>
                        <label for="fin">Date de fin de l'évènement</label>
                        <input type="date" name="fin" id="fin" min="<?php echo date('Y-m-d'); ?>" required>
                        <select name="heure_fin" id="heure_fin" required>
                            <option value="">Choisissez une heure de fin...</option>
                            <option value="9">9h</option>
                            <option value="10">10h</option>
                            <option value="11">11h</option>
                            <option value="12">12h</option>
                            <option value="13">13h</option>
                            <option value="14">14h</option>
                            <option value="15">15h</option>
                            <option value="16">16h</option>
                            <option value="17">17h</option>
                            <option value="18">18h</option>
                            <option value="19">19h</option>
                            <option value="20">20h</option>
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

                    
                    if () // date début == date fin
                    if () // heure de début doit se trouver apres heure now?
                    if () // heure de fin - heure de début == 1
                    if () // Pas résa weekend
                    if () // créneau déjà occupé


                    $ajout_event = "INSERT INTO reservations VALUES (null, '$titre', '$description', '$debut', '$fin', '$utilisateur')";
                    $ajout_query = mysqli_query($bdd, $ajout_event);
                    header('location:reservation-form.php');
                }
                mysqli_close($bdd);
            }
        ?>
    </main>
    <footer></footer>
</body>
</html>