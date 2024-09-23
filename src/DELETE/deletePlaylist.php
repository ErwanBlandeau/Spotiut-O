<?php
$pdo = getPdo();
require 'src/BDD/Function/databaseDelete.php';

$idPlaylist = $_REQUEST['idPlaylist'];

echo $idPlaylist;

deletePlaylist($pdo, $idPlaylist);
header('Location: index.php?action=accueil');

