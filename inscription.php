<?php 
$res = $_GET["res"];
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Votre Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="index.css">
  <link rel ="stylesheet" href="static/album.css">
  <link rel = "stylesheet" href="login.css">
</head>
<body>

<header>
    <form action="" method="GET">
        <h1>S'inscrire</h1>
    </form>
</header>


<main>
    <?php if($res != "valide"){?>
    <div id="centre">
        <form action="signup.php" method="post">
            <p>Identifiant</p>
            <input type="text" name="identifiant">
            <p>Adresse mail</p>
            <input type="text" name="email">
            <p>Mot de passe</p>
            <input type="password" name="mdp">
            <?php if(isset($erreur)) { ?>
                <div><?php echo $erreur; ?></div>
            <?php } ?>
            <button type="submit" class="button">S'inscrire</button>
        </form>
        <button type="button" class="button" onclick="window.location.href='login.php?res=debut'">Se connecter</button>
        <?php if ($res == "identifiants_manquants"){?>
            <p>Veuillez remplir tous les champs</p>
        <?php } else if ($res == "identifiants_existants"){?>
            <p>Ces identifiants existent déjà</p>
        <?php } ?>
    </div>
    <?php } else {?>
        <p>Vous êtes inscrit</p>
        <button type="button" class="button" onclick="window.location.href='login.php?res=debut'">Se connecter</button>
    <?php }?>
</main>
<!-- Inclure Bootstrap JS (jQuery et Popper.js doivent être inclus avant) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>