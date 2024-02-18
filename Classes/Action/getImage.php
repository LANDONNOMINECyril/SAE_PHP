<?php
use Classes\models\Album;
use Classes\models\Artiste;

function extracted(Album|Artiste $nalbum): void
{
    $tmp_name = $_FILES['image']['tmp_name'];
    // basename() may prevent filesystem traversal attacks;
    // further validation/sanitation of the filename may be appropriate
    $name = basename($_FILES['image']['name']);
    $target_dir = "fixtures/images/";
    $target_file = $target_dir . $name;

    // Move the uploaded file to the target directory
    if (move_uploaded_file($tmp_name, $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
        $nalbum->setUrlImage($name);
    } else {
        echo "Failed to upload image.";
    }
}
?>
