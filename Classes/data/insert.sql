INSERT INTO Utilisateurs (user_id, nom_utilisateur, mot_de_passe, email, image_url,type_uti) VALUES
(1, 'john_doe', 'mot_de_passe_secure', 'john.doe@example.com', null,1),
(2, 'jane_smith', 'secure_password123', 'jane.smith@example.com', null,1),
(3, 'bob_jones', 'strong_password', null, null,1),
(4, 'alice_wonderland', 'another_secure_password', 'alice.wonderland@example.com', null,1),
(5, 'samuel_lee', 'password123', 'samuel.lee@example.com', null,1),
(6, 'emily_white', 'white123', 'emily.white@example.com', null,1),
(7, 'david_miller', 'miller_pass', null, null,1),
(8, 'lisa_jackson', 'secure_lisa', 'lisa.jackson@example.com', null,1),
(9, 'alex_brown', 'brown_secure', 'alex.brown@example.com', null,1),
(10, 'sarah_adams', 'adams123', 'sarah.adams@example.com', null,1),
(11, 'i1','m1', 'i1', null,2);

INSERT INTO Artistes (artist_id, nom, artist_name, bio, image_url) VALUES
(40, 'Superdrag', 'Superdrag', 'Superdrag is an American alternative rock band from Knoxville, Tennessee, United States, consisting of John Davis (vocals, guitar), Brandon Fisher (guitar), Tom Pappas (bass), and Don Coffey Jr. (drums).', 'superdrag.jpg'),
(42, 'Taylor Swift', 'Taylor Swift', 'Taylor Alison Swift is an American singer-songwriter. Her narrative songwriting, which often takes inspiration from her personal life, has received widespread critical praise and media coverage.', 'taylor_swift.jpg'),
(43, 'Ryan Adams', 'Ryan Adams', 'David Ryan Adams is an American singer-songwriter, record producer, and poet. He has released 17 albums, as well as three studio albums as a former member of rock/alt-country band Whiskeytown.', 'ryan_adams.jpg'),
(44, 'Ryan Adams', 'Ryan Adams', 'David Ryan Adams is an American singer-songwriter, record producer, and poet. He has released 17 albums, as well as three studio albums as a former member of rock/alt-country band Whiskeytown.', 'ryan_adams.jpg'),
(45, 'Whiskeytown', 'Whiskeytown', 'Whiskeytown was an American rock/alternative country band formed in 1994 from Raleigh, North Carolina. The band s lineup fluctuated significantly over the years, with the only constant members being Ryan Adams and Caitlin Cary.', 'whiskeytown.jpg'),
(46, 'Jesse Malin', 'Jesse Malin', 'Jesse Malin is an American rock musician, guitarist, and songwriter. He has performed with his band D Generation as well as a solo artist.', 'jesse_malin.jpg'),
(47, 'The Sons of the Pioneers', 'The Sons of the Pioneers', 'The Sons of the Pioneers are one of the United States earliest Western singing groups. Known for their vocal performances, musicianship, and songwriting, they produced innovative recordings that have inspired many Western music performers and remained popular through the years.', 'sons_of_the_pioneers.jpg'),
(48, 'Ryan Adams', 'Ryan Adams', 'David Ryan Adams is an American singer-songwriter, record producer, and poet. He has released 17 albums, as well as three studio albums as a former member of rock/alt-country band Whiskeytown.', 'ryan_adams.jpg'),
(49, 'Steve Wariner', 'Steve Wariner', 'Steven Noel Wariner is an American country music singer, songwriter, and guitarist. He has released eighteen studio albums, including six on MCA Records, and three on Arista Nashville. He has also charted more than fifty singles on the Billboard country singles charts, including ten Number One hits.', 'steve_wariner.jpg'),
(50, 'Willie Nelson', 'Willie Nelson', 'Willie Hugh Nelson is an American musician, actor, and activist. The critical success of the album Shotgun Willie (1973), combined with the critical and commercial success of Red Headed Stranger (1975) and Stardust (1978), made Nelson one of the most recognized artists in country music.', 'willie_nelson.jpg');

INSERT INTO Albums (album_id, titre, artist_id, annee, image_url) VALUES
(1, 'Stereo 360 Sound', 40, 1998, 'Superdrag-Stereo_360_Sound.jpg'),
(2, 'Folklore', 42, 2002, '220px-Folklore_hp.jpg'),
(3, 'Heartbreaker', 43, 2000, '220px-RyanAdamsHeartbreaker.jpg'),
(4, 'Ryan Adams', 44, 2014, '220px-Ryanadamsselftitled.jpg'),
(5, 'Pneumonia', 45, 2001, '220px-WhiskeytownPneumonia.jpg'),
(6, 'The Fine Art of Self Destruction', 46, 2002, 'The_Fine_Art_of_Self_Destruction.jpg'),
(7, 'We Are Fuck You', 47, 2003, null),
(8, 'Love Is Hell', 48, 2004, '220px-Love_Is_Hell.jpg'),
(9, 'Dark Chords on a Big Guitar', 49, 2003, '220px-DarkChords.jpg'),
(10, 'Songbird', 50, 2006, '220px-Songbird_Willie_Nelson.jpg');

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