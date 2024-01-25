CREATE TABLE Artistes (
    artist_id INTEGER PRIMARY KEY,
    nom TEXT NOT NULL,
    bio TEXT,
    image_url TEXT
);

CREATE TABLE Albums (
    album_id INTEGER PRIMARY KEY,
    titre TEXT NOT NULL,
    artist_id INTEGER,
    annee INTEGER,
    genre TEXT,
    image_url TEXT,
    FOREIGN KEY (artist_id) REFERENCES Artistes(artist_id)
);

CREATE TABLE Utilisateurs (
    user_id INTEGER PRIMARY KEY,
    nom_utilisateur TEXT NOT NULL,
    mot_de_passe TEXT NOT NULL,
    email TEXT
);

CREATE TABLE Playlists (
    playlist_id INTEGER PRIMARY KEY,
    user_id INTEGER,
    titre TEXT,
    FOREIGN KEY (user_id) REFERENCES Utilisateurs(user_id)
);

CREATE TABLE Playlist_Items (
    playlist_item_id INTEGER PRIMARY KEY,
    playlist_id INTEGER,
    album_id INTEGER,
    ordre INTEGER,
    FOREIGN KEY (playlist_id) REFERENCES Playlists(playlist_id),
    FOREIGN KEY (album_id) REFERENCES Albums(album_id)
);

CREATE TABLE Notes_Albums (
    note_id INTEGER PRIMARY KEY,
    user_id INTEGER,
    album_id INTEGER,
    note INTEGER CHECK(note >= 1 AND note <= 5),
    FOREIGN KEY (user_id) REFERENCES Utilisateurs(user_id),
    FOREIGN KEY (album_id) REFERENCES Albums(album_id)
);
