<?php

$pdo = getPdo();
require 'src/BDD/Function/databaseGet.php';

$mailUser = $_SESSION['mail'];
$nomPlaylist = $_POST['nomPlaylist'];

$idUser = get_id_with_email($pdo, $mailUser);


echo $nomPlaylist;
echo $mailUser;
echo $idUser;

if (trim($nomPlaylist) != "Titres Likés"){
    insertPlaylist($pdo, $nomPlaylist, $idUser);
    header('Location: index.php?action=accueil');
} else {
    header('Location: index.php?action=accueil&erreurAjoutPlaylist=Erreur lors de l\'ajout de la playlist');
}
