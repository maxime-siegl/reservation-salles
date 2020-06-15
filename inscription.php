<?php
    session_start();
    if (isset($_POST['deconnexion']))
    {
        session_destroy();
    }
    $message = "";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Inscription</title>
</head>
<body>
<?php
      if(isset($_SESSION['login'])){
        echo '<div class="sidenav"> <a href="index.php"><center>Accueil</center></a>'.
        '<a href="profil.php">  <img src="https://img.icons8.com/officexs/30/000000/user-menu-female.png"/> Votre profil    '.$_SESSION['login'].'</a>'.
        '<a href="planning.php"><img src="https://img.icons8.com/offices/30/000000/planner.png"/> le planning  </a>'.'<a href="profil.php?deconnexion">
          <center><img src="https://img.icons8.com/fluent/48/000000/shutdown.png"/></center> </a></div>' ;
      }
      else { ?>
        <div class="sidenav">
        <?php  }?>


        <a href="index.php">accueil</a>
        <a href="connexion.php">connexion</a>
    </div>
    <main>
      <div class="content-inscription">

        <?php
            if(isset($_SESSION['login']) == false)
            {
                $bdd = mysqli_connect("localhost", "root", "", "reservationsalles");
        ?>
        <div class="container">

                <form action="inscription.php" method="POST">
                  <div class="row">

                    <p>
                      <div class="style_label">
                        <label for="login">Login</label>
                      </div>
                      <div class="style_input">
                        <input type="text" name="login" id="login" required>

                      </div>
                      <div class="style_label">
                        <label for="password">Mot de Passe</label>

                      </div>
                      <div class="style_input">
                        <input type="password" name="password" id="password" required>

                      </div>
                      <div class="style_label">
                        <label for="confirmation_pw">Confirmation du mot de passe</label>

                      </div>
                      <div class="style_input">
                        <input type="password" name="confirmation_pw" id="confpw" required>

                      </div>

                        <button type="submit" name="inscription">S'inscrire</button>
                    </p>
                  </div>
                </form>
              </div>

        <?php
                if(isset($_POST['inscription']))
                {
                    $login = $_POST['login'];
                    $mdp = $_POST['password'];

                    $checklogin = "SELECT login FROM utilisateurs WHERE login ='$login'"; //Vérification que le login qu'on rentre n'est pas déjà dans la bdd !!
                    $checkquery = mysqli_query($bdd, $checklogin);
                    $verif_log = mysqli_fetch_all($checkquery, MYSQLI_ASSOC);

                    if (empty($verif_log))
                    {
                        if ($_POST['password'] == $_POST['confirmation_pw'])
                        {
                            $mdpcrypt = password_hash($mdp, PASSWORD_BCRYPT);
                            $ajout = "INSERT INTO utilisateurs VALUES (null, '$login', '$mdpcrypt')";
                            $ajoutquery = mysqli_query($bdd, $ajout);
                            header('location:connexion.php');
                        }
                        else
                        {
                            $message = 'Les mot de passes rentrés ne sont pas idnetiques, Try Again!!';
                        }
                    }
                    else
                    {
                        $message = 'Le login rentré n\'est pas disponible pour le moment merci de modifier votre login afin de demeurer un utilisateur unique sur notre site.';
                    }
                }
                mysqli_close($bdd);
            }
            else
            {
                $message = 'Vous êtes déjà connecté, pas besoin de vous inscrire de nouveau. Allez plutôt sur notre planning pour y réserver votre créneau avant qu\'il n\'y est plus de place!!';
            }
        ?>
        <p class="message">
            <?php echo $message;?>
        </p>
    </main>
</div>
</body>
</html>
