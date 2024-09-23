<?php

require 'src\BDD\Function\databaseGet.php';
require 'src\BDD\Function\databaseUpdate.php';
$pdo = getPdo();

$mailUser = $_SESSION['mail'];
$idUser = get_id_with_email($pdo, $mailUser);
$idPlaylist = $_REQUEST['idPlaylist'];

update_favoris_playlist($pdo, $idUser, $idPlaylist);
header('Location: index.php?action=playlist&idPlaylist='.$idPlaylist);