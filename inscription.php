<?php 
$res = $_GET["res"];
?>

<!DOCTYPE html>
<link rel="stylesheet" href="inscription.css">
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Application spotify</title>
</head>
<body>
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
        <button type="button" class="button" onclick="window.location.href='login.php'">Se connecter</button>
        <?php if ($res == "identifiants_manquants"){?>
            <p>Veuillez remplir tous les champs</p>
        <?php } else if ($res == "identifiants_existants"){?>
            <p>Ces identifiants existent déjà</p>
        <?php } ?>
    </div>
    <?php } else {?>
        <p>Vous êtes inscrit</p>
        <button type="button" class="button" onclick="window.location.href='login.php'">Se connecter</button>
    <?php }?>
</main>
</body>
</html>
