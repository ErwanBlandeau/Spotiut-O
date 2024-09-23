<?php

function checkFileNameExists($directory, $fileNameToCheck) {
    // Vérifie si le dossier existe
    if (!is_dir($directory)) {
        die("Le dossier spécifié n'existe pas.");
    }

    // Ouvre le dossier
    $dir = opendir($directory);

    // Parcourt tous les fichiers du dossier
    while (($file = readdir($dir)) !== false) {
        // Ignore les fichiers spéciaux
        if ($file == '.' || $file == '..') {
            continue;
        }

        // Vérifie si le nom de fichier existe déjà
        if ($file == $fileNameToCheck) {
            closedir($dir);
            return true;
        }
    }

    // Ferme le dossier
    closedir($dir);

    // Si le nom de fichier n'est pas trouvé
    return false;
}

// Exemple d'utilisation :
// $directory = "chemin/vers/le/dossier"; // Spécifiez le chemin vers votre dossier
// $fileNameToCheck = "nom_du_fichier.txt"; // Spécifiez le nom du fichier à vérifier

// if (checkFileNameExists($directory, $fileNameToCheck)) {
//     echo "Le nom de fichier existe déjà dans le dossier.";
// } else {
//     echo "Le nom de fichier n'existe pas dans le dossier.";
// }

?>
