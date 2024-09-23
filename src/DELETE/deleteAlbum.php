<?php

require 'src/BDD/Function/databaseDelete.php';
$pdo = getPdo();

$idAlbum = $_REQUEST['idAlbum'];

print_r($idAlbum);

if (deleteAlbum($pdo, $idAlbum) == false) {
    header('Location: index.php?action=accueil&erreur=Erreur lors de la suppression de l\'album');
    exit();
} 

header('Location: index.php?action=accueil');


