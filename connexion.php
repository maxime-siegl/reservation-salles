<?php
    session_start();
    if(isset($_POST['deconnexion']))
    {
        session_destroy();
        header('index.php');
    }
    $message = "";

    if(isset($_SESSION['login'])){
      echo '<div class="sidenav"> <a href="index.php"><center>Accueil</center></a>'.
      '<a href="profil.php">  <img src="https://img.icons8.com/officexs/30/000000/user-menu-female.png"/> Votre profil    '.$_SESSION['login'].'</a>'.
      '<a href="planning.php"><img src="https://img.icons8.com/offices/30/000000/planner.png"/> le planning  </a>'.'<a href="profil.php?deconnexion">
        <center><img src="https://img.icons8.com/fluent/48/000000/shutdown.png"/></center> </a></div>' ;
    }
    else { ?>
      <div class="sidenav">

      <a href="index.php">accueil</a>
      <a href="inscription.php">inscription</a>

  </div>
    <?php  }?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Scada&display=swap" rel="stylesheet">

    <title>Connexion</title>
</head>
<body>

<div class="content-connexion">

    <main>
        <?php
            if (isset($_SESSION['login']) == false)
            {
                $bdd = mysqli_connect("localhost", "root", "", "reservationsalles");
        ?>
        <div class="container">

                <form action="connexion.php" method="POST">
                    <p>
<div class="row">

                      <div class="style_label">

                        <label for="login">Login</label>
                      </div>
<div class="style_input">
  <input type="text" name="login" id="login" required>

</div>
</div>

<div class="row">
  <div class="style_label">

  <label for="password">Mot de Passe</label>
</div>

<div class="style_input">
  <input type="password" name="password" id="password" required>

</div>

</div>
<div class="row">
  <button type="submit" name="connexion" class="bouton">Se Connecter</button>
</div>
                    </p>
                  </div>

                </form>

                <img src="img/connexion.jpg" alt="">
              </div>

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
                            header('location:profil.php');
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
                $message = 'Vous êtes déjà connecté(e) '.$_SESSION['login'].". <br/>Vous devez choisir ce que vous voulez faire, soit
                créer un événement soit consulter le planning.";
            }
        ?>
        <p class="message">
            <?php echo $message; ?>
        </p>
    </main>
  </div>

</body>
</html>
