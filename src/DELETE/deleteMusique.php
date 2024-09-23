<?php

require 'src/BDD/Function/databaseDelete.php';
$pdo = getPdo();

$idMusique = $_REQUEST['idMusique'];

if (deleteMusiqueInBDD($pdo, $idMusique) == false) {
    header('Location: index.php?action=accueil&erreur=Erreur lors de la suppression de la musique');
    exit();
} 

header('Location: index.php?action=accueil');

