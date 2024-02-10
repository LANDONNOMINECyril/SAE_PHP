DROP TABLE IF EXISTS Types_Albums;
DROP TABLE IF EXISTS Genre;
DROP TABLE IF EXISTS Notes_Albums;
DROP TABLE IF EXISTS Playlist_Items;
DROP TABLE IF EXISTS Playlists;
DROP TABLE IF EXISTS Utilisateurs;
DROP TABLE IF EXISTS Albums;
DROP TABLE IF EXISTS Artistes;

CREATE TABLE IF NOT EXISTS Artistes (
    artist_id INTEGER PRIMARY KEY,
    nom TEXT NOT NULL,
    artist_name TEXT NOT NULL,
    bio TEXT,
    image_url TEXT
);

CREATE TABLE IF NOT EXISTS Utilisateurs (
    user_id INTEGER PRIMARY KEY,
    nom_utilisateur TEXT NOT NULL,
    mot_de_passe TEXT NOT NULL,
    email TEXT,
    image_url TEXT
);

CREATE TABLE IF NOT EXISTS Albums (
    album_id INTEGER PRIMARY KEY,
    titre TEXT NOT NULL,
    artist_id INTEGER NOT NULL,
    annee INTEGER,
    image_url TEXT,
    FOREIGN KEY (artist_id) REFERENCES Artistes(artist_id)
);

CREATE TABLE IF NOT EXISTS Playlists (   
    playlist_id INTEGER PRIMARY KEY,
    nom_playlist TEXT NOT NULL,
    user_id INTEGER,
    FOREIGN KEY (user_id) REFERENCES Utilisateurs(user_id)
);

CREATE TABLE IF NOT EXISTS Playlist_Items (
    playlist_item_id INTEGER PRIMARY KEY,
    playlist_id INTEGER,
    album_id INTEGER,
    ordre INTEGER,
    FOREIGN KEY (playlist_id) REFERENCES Playlists(playlist_id),
    FOREIGN KEY (album_id) REFERENCES Albums(album_id)
);

CREATE TABLE IF NOT EXISTS Notes_Albums (
    note_id INTEGER PRIMARY KEY,
    user_id INTEGER,
    album_id INTEGER,
    note INTEGER CHECK(note >= 1 AND note <= 10),
    FOREIGN KEY (user_id) REFERENCES Utilisateurs(user_id),
    FOREIGN KEY (album_id) REFERENCES Albums(album_id)
);

CREATE TABLE IF NOT EXISTS Genre (
    nom_genre VARCHAR(255) PRIMARY KEY
);

CREATE TABLE IF NOT EXISTS Types_Albums (
    album_id INTEGER NOT NULL, 
    nom_genre VARCHAR(255) NOT NULL, -- Adjust the length as needed
    FOREIGN KEY (album_id) REFERENCES Albums(album_id),
    FOREIGN KEY (nom_genre) REFERENCES Genre(nom_genre), -- Corrected the table name to match the actual one
    PRIMARY KEY (album_id, nom_genre)
);