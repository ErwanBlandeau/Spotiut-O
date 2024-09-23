<?php

require 'src\BDD\Function\databaseGet.php';
require 'src\BDD\Function\databaseUpdate.php';
$pdo = getPdo();

$mailUser = $_SESSION['mail'];
$idUser = get_id_with_email($pdo, $mailUser);
$idArtiste = $_REQUEST['idArtiste'];

update_favoris_artiste($pdo, $idUser, $idArtiste);
header('Location: index.php?action=artiste&id='.$idArtiste);