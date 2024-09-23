<?php

require 'src/BDD/Function/databaseUpdate.php';
$pdo = getPdo();

$nomArtiste = $_REQUEST['nom'];

print_r($nomArtiste);


if ($nomArtiste == null) {
    header('Location: index.php?action=compte&erreur=Erreur lors de l\'ajout de l\'artiste');
} else {
    insertArtiste($pdo, $nomArtiste);
    header('Location: index.php?action=compte');
}
