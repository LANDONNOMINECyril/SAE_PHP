<?php

require_once 'vendor/autoload.php';
use Symfony\Component\Yaml\Yaml;

function createBD(){
    try{
        $file_db = new PDO('sqlite:bdd.sqlite3');
        $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

        $file_db->exec("CREATE TABLE IF NOT EXISTS Artistes (
            artist_id INTEGER PRIMARY KEY,
            nom TEXT NOT NULL,
            artist_name TEXT NOT NULL,
            bio TEXT,
            image_url TEXT
        )");

        $file_db->exec("CREATE TABLE IF NOT EXISTS Utilisateurs (
            user_id INTEGER PRIMARY KEY,
            nom_utilisateur TEXT NOT NULL,
            mot_de_passe TEXT NOT NULL,
            email TEXT,
            image_url TEXT
        )");

        $file_db->exec("CREATE TABLE IF NOT EXISTS Albums (
            album_id INTEGER PRIMARY KEY,
            titre TEXT NOT NULL,
            artist_id INTEGER NOT NULL,
            annee INTEGER,
            genre TEXT,
            image_url TEXT,
            FOREIGN KEY (artist_id) REFERENCES Artistes(artist_id)
        )");

        $file_db->exec("CREATE TABLE IF NOT EXISTS Playlists (   
            playlist_id INTEGER PRIMARY KEY,
            nom_playlist TEXT NOT NULL,
            user_id INTEGER,
            FOREIGN KEY (user_id) REFERENCES Utilisateurs(user_id)
        )");

        $file_db->exec("CREATE TABLE IF NOT EXISTS Playlist_Items (
            playlist_item_id INTEGER PRIMARY KEY,
            playlist_id INTEGER,
            album_id INTEGER,
            ordre INTEGER,
            FOREIGN KEY (playlist_id) REFERENCES Playlists(playlist_id),
            FOREIGN KEY (album_id) REFERENCES Albums(album_id)
        )");

        $file_db->exec("CREATE TABLE IF NOT EXISTS Notes_Albums (
            note_id INTEGER PRIMARY KEY,
            user_id INTEGER,
            album_id INTEGER,
            note INTEGER CHECK(note >= 1 AND note <= 10),
            FOREIGN KEY (user_id) REFERENCES Utilisateurs(user_id),
            FOREIGN KEY (album_id) REFERENCES Albums(album_id)
        )");

        print_r("Base de données créée");
        
        #les insert de extrait.yaml
        $products = Yaml::parseFile(__DIR__."/extrait.yaml");


        foreach ($products as $product) {
            $insert = "INSERT INTO Albums (album_id, titre, artist_id, annee, genre, image_url) VALUES (:a, :b, :c, :d, :e, :f);";
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
            $stmt->bindParam(':e', $product['genre']);
            $stmt->bindParam(':f', $product['img']);
            $stmt->execute();
        }

        print_r("Insert ajoutés");
    }
    catch(PDOException $ex) {
        // Gestion des exceptions
        echo $ex->getMessage();
        return null;
    }
}
?>