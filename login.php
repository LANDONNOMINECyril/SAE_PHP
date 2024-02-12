<?php
$res = $_GET["res"];
?>
<!DOCTYPE html>
<link rel="stylesheet" href="login.css">
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Application spotify</title>
</head>
<body>
<main>
    <div id="centre">
        <form action="connexion.php" method="post">
            <p>Identifiant</p>
            <input type="text" name="identifiant">
            <p>Mot de passe</p>
            <input type="password" name="mdp">
            <?php if(isset($erreur)) { ?>
                <div><?php echo $erreur; ?></div>
            <?php } ?>
            <button type="submit" class="button">Se connecter</button>
        </form>
        <button type="button" class="button" onclick="window.location.href='inscription.php?res=debut'">S'inscrire</button>
    </div>
    <?php if($res == "identifiants_manquants"){?>
        <p>Veuillez remplir tous les champs</p>
    <?php } else if($res == "identifiants_invalides"){?>
        <p>Les identifiants sont invalides</p>
    <?php }?>
</main>
</body>
</html>
