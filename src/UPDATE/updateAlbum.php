<?php

require 'src/BDD/Function/databaseGet.php';

$pdo = getPdo();
require 'src/BDD/Function/databaseUpdate.php';

$idAlbum = $_REQUEST['idAlbum'];
$titre = $_REQUEST['titre'];
$dateSortie = $_REQUEST['dateSortie'];
$genre = $_REQUEST['genre'];
$pochette = $_REQUEST['pochette'];
$nomArtiste = $_REQUEST['nomArtiste'];
$nomParent = $_REQUEST['nomParent'];

// print_r($idAlbum);
// print_r($titre);
// print_r($dateSortie);
// print_r($genre);
// print_r($pochette);
// print_r($nomArtiste);
// print_r($nomParent);

if (empty($titre) || empty($dateSortie) || empty($genre) || empty($pochette) || empty($nomArtiste) || empty($nomParent)) {
    header('Location: index.php?action=editerAlbum&idAlbum='.$idAlbum.'&erreur=Veuillez remplir tous les champs');
    exit();
}

$idArtiste = get_id_with_artist_name($pdo, $nomArtiste);
$idParent = get_id_with_artist_name($pdo, $nomParent);

if (trim($titre) == trim($album['Titre']) && trim($dateSortie) == trim($album['Date_de_sortie']) && trim($genre) == trim($album['Genre']) && trim($pochette) == trim($album['Pochette']) && trim($idArtiste) == trim($album['ID_Artiste_By']) && trim($idParent) == trim($album['ID_Artiste_Parent'])) {
    header('Location: index.php?action=editerAlbum&idAlbum='.$idAlbum.'&erreur=Veuillez modifier au moins un champ');
    exit();
}

update_album($pdo, $titre, $dateSortie, $genre, $pochette, intval($idArtiste), intval($idParent), intval($idAlbum));
header('Location: index.php?action=editerAlbum&idAlbum='.$idAlbum);



