<?php

require_once 'vendor/autoload.php';
use Symfony\Component\Yaml\Yaml;

function createBD(){
    try{
        $file_db = new PDO('sqlite:bdd.sqlite3');
        $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        
        $sqlFile = __DIR__ . "/create.sql";
        $sqlContent = file_get_contents($sqlFile);

        // Exécuter le contenu du fichier SQL
        $file_db->exec($sqlContent);
        
        #les insert de extrait.yaml
        $products = Yaml::parseFile(__DIR__."/extrait.yaml");


        foreach ($products as $product) {
            $insert = "INSERT INTO Albums (album_id, titre, artist_id, annee, image_url) VALUES (:a, :b, :c, :d, :f)";
            $stmt = $file_db->prepare($insert);
            $stmt->bindParam(':a', $product['entryId']);
            $stmt->bindParam(':b', $product['title']);
            
            # on vérifie si l'artiste existe lorsque l'on ajoute un de ses albums
            $verif = $file_db->prepare("SELECT artist_id FROM Artistes WHERE artist_name = :an");          
            $verif->bindParam(':an', $product['parent']);
            $verif->execute();
            $res = $verif->fetch(PDO::FETCH_ASSOC);
            
            #si il existe pas alors on en crée un nouveau
            if($res == null){
                $nvinsert = "INSERT INTO Artistes (nom, artist_name) VALUES (:w, :x)";
                $crea = $file_db->prepare($nvinsert);
                $crea->bindParam(':w', $product['parent']);
                $crea->bindParam(':x', $product['parent']);
                $crea->execute();
            }
            #sinon on continue juste
            $artiste = $file_db->prepare("SELECT artist_id FROM Artistes WHERE artist_name = :artiste");
            $artiste->bindParam(':artiste', $product['parent']);
            $artiste->execute();
            $res = $artiste->fetch(PDO::FETCH_ASSOC);
            $stmt->bindParam(':c', $res['artist_id']);
            $stmt->bindParam(':d', $product['releaseYear']);
            $stmt->bindParam(':f', $product['img']);
            $stmt->execute();

            #création des genres
            foreach($product['genre'] as $genre){
                $verif = $file_db->prepare("SELECT nom_genre FROM Genre WHERE nom_genre = :an");          
                $verif->bindParam(':an', $genre);
                $verif->execute();
                $res = $verif->fetch(PDO::FETCH_ASSOC);
                if ($res==null){
                    $insertGenre = "INSERT INTO Genre (nom_genre) VALUES (:e)";
                    $stmt = $file_db->prepare($insertGenre);
                    $stmt->bindParam(':e', $genre);
                    $stmt->execute();
                }


                #relation entre genre et albums
                $insert = "INSERT INTO Types_albums (album_id, nom_genre) VALUES(:u, :v);";
                $stmt = $file_db->prepare($insert);
                $stmt->bindParam(':u', $product['entryId']);
                $stmt->bindParam(':v', $genre);
                $stmt->execute();
            }
        }

        $sqlFile = __DIR__ . "/insert.sql";
        $sqlContent = file_get_contents($sqlFile);

        // Exécuter le contenu du fichier SQL
        $file_db->exec($sqlContent);

    }
    catch(PDOException $ex) {
        // Gestion des exceptions
        echo $ex->getMessage();
        return null;
    }
}
?>