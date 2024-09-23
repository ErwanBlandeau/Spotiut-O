<?php

require 'src\BDD\Function\databaseGet.php';
require 'src\BDD\Function\databaseUpdate.php';
$pdo = getPdo();

$mailUser = $_SESSION['mail'];
$idUser = get_id_with_email($pdo, $mailUser);
$idMusique = $_REQUEST['idMusique'];
$idAlbum = $_REQUEST['idAlbum'];

update_favoris_musique($pdo, $idUser, $idMusique);

if ($idAlbum == null) {
    $idPlaylist = $_REQUEST['idPlaylist'];
    header('Location: index.php?action=playlist&idPlaylist='.$idPlaylist);
} else {
    header('Location: index.php?action=album&id='.$idAlbum);
}
