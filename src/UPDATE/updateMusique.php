<?php

require 'src/BDD/Function/databaseGet.php';
require 'src/BDD/Function/databaseUpdate.php';
$pdo = getPdo();


$idMusique = $_REQUEST['idMusique'];
$nomMusique = $_POST['nom'];
$nomAlbum = $_POST['nomAlbum'];

print_r($nomMusique);
print_r($nomAlbum);

if (empty($nomMusique) || empty($nomAlbum)) {
    header('Location: index.php?action=editerMusique&idMusique='.trim($idMusique).'&erreur=Veuillez remplir tous les champs');
    exit();
}

$musique = get_music_with_id($pdo, $idMusique);
$album = get_album_with_id($pdo, $musique['ID_Album']);


if (trim($musique['Titre']) == trim($nomMusique) && trim($album['Titre']) == trim($nomAlbum)) {
    header('Location: index.php?action=editerMusique&idMusique='.trim($idMusique).'&erreur=Vous n\'avez rien modifié');
    exit();
}

$newIdAlbum = get_id_album_with_name($pdo, $nomAlbum);

if ($newIdAlbum == null) {
    header('Location: index.php?action=editerMusique&idMusique='.trim($idMusique).'&erreur=Album inexistant');
    exit();
}

print_r($newIdAlbum);
print_r($musique['Lien']);
 
if (update_musique($pdo, $nomMusique, $musique['Lien'], intval($newIdAlbum), $idMusique) == true) {
    header('Location: index.php?action=editerMusique&idMusique='.trim($idMusique));
    exit();
} else {
    header('Location: index.php?action=editerMusique&idMusique='.trim($idMusique).'&erreur=Erreur lors de la modification');
    exit();
}
