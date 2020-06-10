<?php
    session_start();
    if(isset($_POST['deconnexion']))
    {
        session_destroy();
    }
    $message = "";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Votre Profil</title>
</head>
<body>
    <header></header>
    <main>
        <?php
            if (isset($_SESSION['login']))
            {
                $bdd = mysqli_connect("localhost", "root", "", "reservationsalles");
                $infolog = "SELECT * FROM utilisateurs WHERE login = '".$_SESSION['login']."' ";
                $info_query = mysqli_query($bdd, $infolog);
                $info_utilisateur = mysqli_fetch_all($info_query, MYSQLI_ASSOC);
        ?>
                <form action="profil.php" method="POST">
                    <p>
                        <label for="login">Login</label>
                        <input type="text" name="login" id="login" value="<?php echo $info_utilisateur[0]['login']; ?>" required>
                        <label for="mdp_actuel">Mot de passe Actuel</label>
                        <input type="password" name="mdp_actuel" required>
                        <label for="new_mdp">Mot de passe Actuel</label>
                        <input type="password" name="new_mdp">
                        <label for="conf_new_mdp">Mot de passe Actuel</label>
                        <input type="password" name="conf_new_mdp">
                        <button type="submit" name="modifier" class="bouton">Modifier</button>
                    </p>
                </form>
        <?php
                if(isset($_POST['modifier']) && !empty($_POST['login']) && !empty($_POST['mdp_actuel']))
                {
                    if (password_verify($_POST['mdp_actuel'], $_SESSION['password']))
                    {
                        $login = $_POST['login'];
                        $id = $_SESSION['id'];

                        $verif_log = "SELECT count(*) as num WHERE login = '$login'"; // vérification si le login existe 
                        $verif_query = mysqli_query($bdd, $verif_log);
                        $info_log = mysqli_fetch_all($verif_query, MYSQLI_ASSOC);

                        if($info_log[0]['num'] == 0 || $login = $_SESSION['login'])
                        {
                            $update = "UPDATE utilisateurs SET login = '$login' WHERE id = '$id'";
                            $update_query = mysqli_query($bdd, $update);
                            $_SESSION['login'] = $_POST['login'];
                        }
                        else
                        {
                            $message = 'Login indisponible!';
                        }

                        if(isset($_POST['new_mdp']) && !empty($_POST['new_mdp']))
                        {
                            if($_POST['new_mdp'] == $_POST['conf_new_mdp'])
                            {
                                $mdpcrypt = password_hash($_POST['new_mdp'], PASSWORD_BCRYPT);
                                $mdp_update = "UPDATE utilisateurs SET password = '$mdpcrypt'";
                                $mdp_update_query = mysqli_query($bdd, $mdp_update_query);
                            }
                            else
                            {
                                $message = 'Les mots de passes ne correpondent pas l\'un à l\'autre';
                            }
                        }
                        header('location:profil.php');
                    }
                    else
                    {
                        $message = 'Mot de Passe Incorrect !!';
                    }
                }
            }
            else
            {
                $message = 'Il faut être inscrit et connecté pour avoir accès à cette page en totalité.';
            }
            mysqli_close($bdd);
        ?>
        <p class="message">
            <?php echo $message; ?>
        </p>
    </main>
    <footer></footer>
</body>
</html>