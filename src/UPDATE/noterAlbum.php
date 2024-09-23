<?php

require 'src/BDD/Function/databaseGet.php';
require 'src/BDD/Function/databaseUpdate.php';
$pdo = getPdo();

$idAlbum = $_REQUEST['idAlbum'];
$mailUser = $_SESSION['mail'];
$idUser = get_id_with_email($pdo, $mailUser);
$note = $_REQUEST['note'];


update_note($pdo, $note, $idUser, $idAlbum);
header('Location: index.php?action=album&id='. $idAlbum .'');