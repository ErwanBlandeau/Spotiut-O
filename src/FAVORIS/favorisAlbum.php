<?php

require 'src\BDD\Function\databaseGet.php';
require 'src\BDD\Function\databaseUpdate.php';
$pdo = getPdo();

$mailUser = $_SESSION['mail'];
$idUser = get_id_with_email($pdo, $mailUser);
$idAlbum = $_REQUEST['idAlbum'];

update_favoris_album($pdo, $idUser, $idAlbum);
header('Location: index.php?action=album&id='.$idAlbum);