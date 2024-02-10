<!DOCTYPE html>
<link rel="stylesheet" href="inscription.css">
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Application spotify</title>
</head>
<body>
<main>
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
    </div>
</main>
</body>
</html>
