<?php

function renameFile($directory, $oldFilename, $newFilename) {
    // Vérifie si le répertoire existe
    if (!is_dir($directory)) {
        return "Le répertoire spécifié n'existe pas.";
    }

    // Chemin complet de l'ancien fichier
    $oldFilePath = $directory . '/' . $oldFilename;

    // Chemin complet du nouveau fichier
    $newFilePath = $directory . '/' . $newFilename;

    // Vérifie si le fichier source existe
    if (!file_exists($oldFilePath)) {
        return "Le fichier source spécifié n'existe pas.";
    }

    // Vérifie si le nouveau nom de fichier est déjà pris
    if (file_exists($newFilePath)) {
        return "Le nouveau nom de fichier est déjà utilisé.";
    }

    // Tente de renommer le fichier
    if (rename($oldFilePath, $newFilePath)) {
        return "Le fichier a été renommé avec succès.";
    } else {
        return "Une erreur s'est produite lors du renommage du fichier.";
    }
}

// Exemple d'utilisation :
// $directory = "./chemin/vers/le/dossier"; // Spécifiez le chemin vers le répertoire
// $oldFilename = "ancien_nom.txt"; // Spécifiez l'ancien nom de fichier
// $newFilename = "nouveau_nom.txt"; // Spécifiez le nouveau nom de fichier

// echo renameFile($directory, $oldFilename, $newFilename);

?>
