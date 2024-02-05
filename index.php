
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Votre Page</title>
  <!-- Inclure Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="index.css">
</head>
<body>

<header>
    <h3><input type="text" placeholder="Rechercher un album..."></h3>
</header>

<aside>
  <nav>
    <ul>
      <li><a href="index.php">Explorer la liste d'album</a></li>
      <li><a href="#">Mes favoris</a></li>
      <li><a href="#">Mon historique</a></li>
      <li><a href="monCompte.php">Mon Compte</a></li>
      <li id="bot1" ><a href="#">Déconnexion</a></li>
      <li id="bot2" ><a href="#">Quitter l'application</a></li>

    </ul>
  </nav>
</aside>

<main>
  <!-- Contenu principal de votre page -->
  <h2>Contenu principal</h2>
  <p>Bienvenue sur votre page. Vous pouvez ajouter votre contenu ici.</p>
  <?php 
    require "Classes/data/bd.php";

    $db = new SQLite3('bdd.sqlite3');

    $query = "SELECT * FROM Albums";
    $result = $db->query($query);
    print_r("wshh", $result);

    
    if ($result === false) {
        die("Erreur lors de l'exécution de la requête SQL : " . $db->lastErrorMsg());
    }

?>
</main>

<!-- Inclure Bootstrap JS (jQuery et Popper.js doivent être inclus avant) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
