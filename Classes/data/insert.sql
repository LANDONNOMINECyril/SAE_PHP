INSERT INTO Utilisateurs (user_id, nom_utilisateur, mot_de_passe, email, image_url) VALUES
(1, 'john_doe', 'mot_de_passe_secure', 'john.doe@example.com', null),
(2, 'jane_smith', 'secure_password123', 'jane.smith@example.com', null),
(3, 'bob_jones', 'strong_password', null, null),
(4, 'alice_wonderland', 'another_secure_password', 'alice.wonderland@example.com', null),
(5, 'samuel_lee', 'password123', 'samuel.lee@example.com', null),
(6, 'emily_white', 'white123', 'emily.white@example.com', null),
(7, 'david_miller', 'miller_pass', null, null),
(8, 'lisa_jackson', 'secure_lisa', 'lisa.jackson@example.com', null),
(9, 'alex_brown', 'brown_secure', 'alex.brown@example.com', null),
(10, 'sarah_adams', 'adams123', 'sarah.adams@example.com', null);

INSERT INTO Albums (album_id, titre, artist_id, annee, genre, image_url) VALUES
(1, 'Stereo 360 Sound', 1, 1998, 'Rock, Punk', 'Superdrag-Stereo_360_Sound.jpg'),
(2, 'Folklore', 2, 2002, 'Alternative country, neofolk', '220px-Folklore_hp.jpg'),
(3, 'Heartbreaker', 3, 2000, 'Alternative country, country', '220px-RyanAdamsHeartbreaker.jpg'),
(4, 'Ryan Adams', 4, 2014, 'Rock, alternative country, pop rock', '220px-Ryanadamsselftitled.jpg'),
(5, 'Pneumonia', 5, 2001, 'Alternative country', '220px-WhiskeytownPneumonia.jpg'),
(6, 'The Fine Art of Self Destruction', 6, 2002, "rap", 'The_Fine_Art_of_Self_Destruction.jpg'),
(7, 'We Are Fuck You', 7, 2003, "pasnullsinonErreur", "img.jpg"),
(8, 'Love Is Hell', 8, 2004, 'Alternative country', '220px-Love_Is_Hell.jpg'),
(9, 'Dark Chords on a Big Guitar', 9, 2003, 'Folk', '220px-DarkChords.jpg'),
(10, 'Songbird', 10, 2006, 'Alternative country', '220px-Songbird_Willie_Nelson.jpg');

INSERT INTO Playlists (playlist_id, nom_playlist, user_id) VALUES
(1, 'Ma Playlist 1', 1),
(2, 'Playlist Rock', 2),
(3, 'Favoris', 3),
(4, 'Best of', 4),
(5, 'Road Trip', 5),
(6, 'Chill Vibes', 6),
(7, 'Gym Beats', 7),
(8, 'Study Jams', 8),
(9, 'Country Classics', 9),
(10, 'Top Hits', 10);

INSERT INTO Playlist_Items (playlist_item_id, playlist_id, album_id, ordre) VALUES
(1, 1, 1, 1),
(2, 1, 2, 2),
(3, 2, 3, 1),
(4, 2, 4, 2),
(5, 3, 5, 1),
(6, 3, 6, 2),
(7, 4, 7, 1),
(8, 4, 8, 2),
(9, 5, 9, 1),
(10, 5, 10, 2);

INSERT INTO Notes_Albums (note_id, user_id, album_id, note) VALUES
(1, 1, 1, 8),
(2, 1, 2, 9),
(3, 2, 3, 7),
(4, 2, 4, 6),
(5, 3, 5, 8),
(6, 3, 6, 10),
(7, 4, 7, 9),
(8, 4, 8, 7),
(9, 5, 9, 8),
(10, 5, 10, 10);
