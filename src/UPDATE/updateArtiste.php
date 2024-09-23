<?php

$pdo = getPdo();

require 'src/BDD/Function/databaseGet.php';
$idArtiste = $_REQUEST['idArtiste'];
$nomArtiste = get_name_with_id($pdo, $idArtiste);

print_r($idArtiste);
print_r($nomArtiste);

if ($_REQUEST['nom'] != '' && $_REQUEST['nom'] != trim($nomArtiste)) {
    require 'src/BDD/Function/databaseUpdate.php';
    update_artiste($pdo, $_REQUEST['nom'], $idArtiste);

    require 'src/provider/renameFichier.php';
    renameFile('./images/ARTISTES', trim($nomArtiste), trim($_REQUEST['nom']));

    header('Location: index.php?action=artiste&id='. $idArtiste);
} else if ($_REQUEST['nom'] == '') {
    header('Location: index.php?action=editerArtiste&idArtiste='. $idArtiste .'&erreur=Veuillez entrer un nom');
} else if ($_REQUEST['nom'] == trim($nomArtiste)) {
    header('Location: index.php?action=editerArtiste&idArtiste='. $idArtiste .'&erreur=Veuillez entrer un nom différent');
}

