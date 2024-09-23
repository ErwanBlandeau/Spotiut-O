<?php
$pdo = getPdo();
require 'src/BDD/Function/databaseGet.php';

$idMusique = $_REQUEST['idMusique'];
$idPlaylist = $_REQUEST['idPlaylist'];
$idAlbum = $_REQUEST['idAlbum'];

echo $idMusique;
echo '<br>';
echo $idPlaylist;
echo '<br>';
echo $idAlbum;

insertMusicPlaylist($pdo, $idMusique, $idPlaylist);
header('Location: index.php?action=album&id='. trim($idAlbum));

