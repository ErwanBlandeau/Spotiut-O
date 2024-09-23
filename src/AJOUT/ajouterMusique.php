<?php

require 'src/BDD/Function/databaseUpdate.php';
require 'src/BDD/Function/databaseGet.php';
$pdo = getPdo();

$nomMusique = $_REQUEST['nom'];
$nomAlbum = $_REQUEST['nomAlbum'];
$fileMusique = $_REQUEST['fileMusique'];
$idAlbum = get_idAlbum_with_name($pdo, $nomAlbum);

$lienMusique = 'MUSIQUE/'.trim($nomAlbum).'/'.trim($nomMusique).'.mp3';

print_r($nomMusique);
print_r($nomAlbum);
print_r($fileMusique);
print_r($lienMusique);

insertMusique($pdo, $nomMusique, $lienMusique, intval($idAlbum));
header('Location: index.php?action=compte');





// Chemin où vous souhaitez stocker les fichiers sur votre serveur
//$dossierDestination = $lienMusique;

// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["fileMusique"])) {
//     $fichierTemporaire = $_FILES["fileMusique"]["tmp_name"];
//     $nomFichier = $_FILES["fileMusique"]["name"];
//     $cheminFichierDestination = $cheminDestination . $nomFichier;

//     // Vérifier si le fichier a été correctement téléchargé
//     if (move_uploaded_file($fichierTemporaire, $cheminFichierDestination)) {
//         echo "Le fichier $nomFichier a été téléchargé avec succès.";
//     } else {
//         echo "Une erreur s'est produite lors du téléchargement du fichier.";
//     }
// } else {
//     echo "Erreur : Aucun fichier n'a été sélectionné ou la méthode de soumission du formulaire n'est pas POST.";
// }
