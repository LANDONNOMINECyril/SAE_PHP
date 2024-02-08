
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

    </ul>
  </nav>
</aside>

<main>
  <!-- Contenu principal de votre page -->
  <h2 class="titre-page">Contenu principal</h2>
  <p></p>
  <?php 
    require_once 'Classes/Autoloader.php';
    Autoloader::register();

    require_once 'Classes/data/bd.php';
    createBD();

    $db = new SQLite3('bdd.sqlite3');

    $query = "SELECT * FROM Albums";
    $result = $db->query($query);
    print_r($result);
    while ($row = $result->fetchArray()) {
      echo "<p>" . $row['titre'] . "</p>";
    }
?>
      <div class="liste-artiste">
        
            <div class="artiste">
              <img src="{{ artiste.image }}" alt="artiste1" />
              <div class="contenu">
                <a href="/programme/detail-artiste/{{ artiste.id }}"><h3 class="test-arrow"><span>{{ artiste.nomArtiste }}</span></h3></a>
                <p>{{ artiste.categorie }}</p>
              </div>
            </div>
        {% endfor %}
      </div>
</main>

<!-- Inclure Bootstrap JS (jQuery et Popper.js doivent être inclus avant) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
