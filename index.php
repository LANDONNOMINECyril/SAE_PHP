<?php 
    require_once 'Classes/Autoloader.php';
    Autoloader::register();

    require_once 'Classes/data/bd.php';
    createBD();
    header('Location: login.php?res=debut');
?>