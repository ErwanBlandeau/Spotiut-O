<?php

$pdo = getPdo();
require 'src/BDD/Function/databaseUpdate.php';
require 'src/BDD/Function/databaseGet.php';

$idPlaylist = $_REQUEST['idPlaylist'];

if (get_playlist_locked($pdo, $idPlaylist) == 0) {
    lock_unlock_playlist($pdo, $idPlaylist, 1);
} else {
    lock_unlock_playlist($pdo, $idPlaylist, 0);
}

header('Location: index.php?action=playlist&idPlaylist=' . $idPlaylist);


