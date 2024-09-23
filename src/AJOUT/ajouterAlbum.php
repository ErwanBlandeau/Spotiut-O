<?php

$pdo = getPdo();
require 'src/BDD/Function/databaseGet.php';
require 'src/BDD/Function/databaseUpdate.php';

$titre = $_POST['titre'];
$dateSortie = $_POST['dateSortie'];
$genre = $_POST['genre'];
$pochette = $_POST['pochette'];
$nomArtiste = $_POST['nomArtiste'];
$nomParent = $_POST['nomParent'];

print_r($titre);
print_r($dateSortie);
print_r($genre);
print_r($pochette);
print_r($nomArtiste);
print_r($nomParent);


$idArtiste = get_id_with_artist_name($pdo, $nomArtiste);
$idParent = get_id_with_artist_name($pdo, $nomParent);

insert_album($pdo, $titre, $dateSortie, $genre, $pochette, intval($idArtiste), intval($idParent));
header('Location: index.php?action=compte');