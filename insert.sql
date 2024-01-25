-- Inserts pour la table Artistes
INSERT INTO Artistes (nom, bio, image_url) VALUES
('Artiste1', 'Biographie de l''artiste 1', 'url_image_artiste1'),
('Artiste2', 'Biographie de l''artiste 2', 'url_image_artiste2'),
('Artiste3', 'Biographie de l''artiste 3', 'url_image_artiste3'),
('Artiste4', 'Biographie de l''artiste 4', 'url_image_artiste4'),
('Artiste5', 'Biographie de l''artiste 5', 'url_image_artiste5'),
('Artiste6', 'Biographie de l''artiste 6', 'url_image_artiste6'),


-- Inserts pour la table Albums
INSERT INTO Albums (titre, artist_id, annee, genre, image_url) VALUES
('Album1', 1, 2020, 'Rock', 'url_image_album1'),
('Album2', 1, 2022, 'Pop', 'url_image_album2'),
('Album3', 2, 2020, 'Rock', 'url_image_album3'),
('Album4', 2, 2022, 'Pop', 'url_image_album4'),
('Album5', 3, 2020, 'Rock', 'url_image_album5'),
('Album6', 4, 2020, 'Rock', 'url_image_album6'),
('Album7', 5, 2022, 'Pop', 'url_image_album7'),
('Album8', 6, 2020, 'Rock', 'url_image_album8'),
('Album9', 4, 2022, 'Pop', 'url_image_album9'),
('Album10', 5, 2020, 'Rock', 'url_image_album10'),


-- Inserts pour la table Utilisateurs
INSERT INTO Utilisateurs (nom_utilisateur, mot_de_passe, email) VALUES
('utilisateur1', 'mot_de_passe_securise1', 'utilisateur1@gmail.com'),
('utilisateur2', 'mot_de_passe_securise2', 'utilisateur2@gmail.com'),
('utilisateur3','mot_de_passe_securise3', 'utilisateur3@gmail.com'),
('utilisateur4','mot_de_passe_securise4', 'utilisateur4@gmail.com'),
('utilisateur5','mot_de_passe_securise5', 'utilisateur5@gmail.com'),
('utilisateur6','mot_de_passe_securise6', 'utilisateur6@gmail.com'),


-- Inserts pour la table Playlists
INSERT INTO Playlists (user_id, titre) VALUES
(1, 'Playlist1'),
(2, 'Playlist2'),
(3, 'Playlist3'),
(4, 'Playlist4'),
(5, 'Playlist5'),
(6, 'Playlist6'),
(7, 'Playlist7'),
(8, 'Playlist8'),


-- Inserts pour la table Playlist_Items
INSERT INTO Playlist_Items (playlist_id, album_id, ordre) VALUES
(1, 1, 1),
(1, 2, 2),
(1, 3, 3),
(1, 4, 4),
(1, 5, 5),
(1, 6, 6),


-- Inserts pour la table Notes_Albums
INSERT INTO Notes_Albums (user_id, album_id, note) VALUES
(1, 1, 4),
(2, 2, 5),
(3, 3, 6),
(4, 4, 7),
(5, 5, 8),
(6, 6, 9),

