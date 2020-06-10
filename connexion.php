
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
    <title>Connexion</title>
</head>
<body>
    <header></header>
    <main>
        <?php
            if (isset($_SESSION['login']) == false)
            {
                $bdd = mysqli_connect("localhost", "root", "", "reservationsalles");
        ?>
                <form action="connexion.php" method="POST">
                    <p>
                        <label for="login">Login</label>
                        <input type="text" name="login" id="login" required>
                        <label for="password">Mot de Passe</label>
                        <input type="password" name="password" id="password" required>
                        <button type="submit" name="connexion" class="bouton">Se Connecter</button>
                    </p>
                </form>
        <?php
                if(isset($_POST['connexion']))
                {
                    $login = $_POST['login'];
                    $mdp = $_POST['password'];
                    
                    $info_log = "SELECT * FROM utilisateurs WHERE login = '$login'";
                    $info_query = mysqli_query($bdd, $info_log);
                    $infos = mysqli_fetch_all($info_query, MYSQLI_ASSOC);

                    $mdpbdd = $infos[0]['password'];

                    if(!empty($infos))
                    {
                        if(password_verify($mdp, $mdpbdd))
                        {
                            session_start();
                            $_SESSION['login'] = $infos[0]['login'];
                            $_SESSION['id'] = $infos[0]['id'];
                            header('location:index.php');
                        }
                        else
                        {
                            $message = 'Le mot de passe ne correspond pas au login rentré!';
                        }
                    }
                    else
                    {
                        $message = 'login inexistant !!';
                    }
                }
                mysqli_close($bdd);
            }
            else
            {
                $message = 'Vous êtes déjà connecté(e) '.$_SESSION['login'];
            }
        ?>
        <p class="message">
            <?php echo $message; ?>
        </p>
    </main>
    <footer></footer>
</body>
</html>