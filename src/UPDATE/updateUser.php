<?php

$pdo = getPdo();

require 'src/BDD/Function/databaseGet.php';
$idUser = get_id_with_email($pdo, $_SESSION['mail']);

echo $_POST['nom'] . '<br>';
echo $_POST['mdp'] . '<br>';
echo $_POST['mdpVerif'] . '<br>';
echo $_POST['mail'] . '<br>';

if ($_POST['mdp'] == $_POST['mdpVerif'] && ($_POST['mdp'] != $_SESSION['mdp'] || $_POST['mail']!= $_SESSION['mail'] || $_POST['nom'] != $_SESSION['nom'])) {
    require 'src/BDD/Function/databaseUpdate.php';
    update_utilisateur($pdo, $_POST['nom'], $_POST['mdp'], $_POST['mail'], $idUser);
    $_SESSION['nom'] = $_POST['nom'];
    $_SESSION['mdp'] = $_POST['mdp'];
    $_SESSION['mail'] = $_POST['mail'];
    header('Location: index.php?action=compte');
} else if ($_POST['mdp'] == $_SESSION['mdp'] && $_POST['mail'] && $_SESSION['mail'] && $_POST['nom'] == $_SESSION['nom']) {
    header('Location: index.php?action=compte&erreur=Les informations sont identiques');
} else {
    header('Location: index.php?action=compte&erreur=Les mots de passe ne correspondent pas');
}


