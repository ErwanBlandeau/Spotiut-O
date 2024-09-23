<?php

require 'src/BDD/Function/databaseDelete.php';
$pdo = getPdo();

$idArtiste = $_REQUEST['idArtiste'];

print_r($idArtiste);

if (deleteArtiste($pdo, $idArtiste) == false) {
    header('Location: index.php?action=accueil&erreur=Erreur lors de la suppression de l\'artiste');
    exit();
}

header('Location: index.php?action=accueil');