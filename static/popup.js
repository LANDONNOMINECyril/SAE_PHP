function showPopupDelAlb(album) {
    const r = confirm("Voulez-vous vraiment supprimer l'album " + album + " ?");
    if (r === true) {
        $.ajax({
            url: 'delete_album.php',
            type: 'POST',
            data: {albumTitle: album},
            success: function (data) {
                alert(data);
                location.assign("http://127.0.0.1:5000/accueil.php"); // Reload the page to see the changes
            },
            error: function () {
                alert('An error occurred while deleting the album.');
            }
        });

    }
}

function showPopupDelArt(artiste) {
    const r = confirm("Voulez-vous vraiment supprimer l'artiste " + artiste + " ?");
    if (r === true) {
        $.ajax({
            url: 'delete_artiste.php',
            type: 'POST',
            data: {artisteTitle: artiste},
            success: function (data) {
                alert(data);
                location.assign("http://127.0.0.1:5000/accueil.php"); // Reload the page to see the changes
            },
            error: function () {
                alert('An error occurred while deleting the album.');
            }
        });

    }
}