<?php
$pdo = getPdo();
require 'src/BDD/Function/databaseDelete.php';

$idMusique = $_REQUEST['idMusique'];
$idPlaylist = $_REQUEST['idPlaylist'];

echo $idMusique;
echo '<br>';
echo $idPlaylist;


deleteMusicPlaylist($pdo, $idMusique, $idPlaylist);
header('Location: index.php?action=playlist&idPlaylist='. trim($idPlaylist));

