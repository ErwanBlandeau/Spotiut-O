<?php
require 'src/BDD/Function/databaseGet.php';

$pdo = getPdo();
$mail_username = $_POST['email_username'];
if (filter_var($mail_username, FILTER_VALIDATE_EMAIL)) {
    $mail = $mail_username;
    $username = get_nom_with_mail($pdo, $mail);
    $id = get_id_with_email($pdo, $mail);
} else {
    $username = $mail_username;
    $mail = get_mail_with_username($pdo, $username);
    $id = get_id_with_pseudo($pdo, $username);
}
$mdp = $_POST['password'];

if ($mail == null || $mdp == null) {
    header('Location: index.php?action=login&erreur=identifiants ou mot de passe incorrect');
}

$mdpVerif = get_password_with_email($pdo, $mail);
echo "test : ".$mdpVerif;


if ($mdpVerif != $mdp){
    header('Location: index.php?action=login&erreur=identifiants ou mot de passe incorrect');
} else {
    $_SESSION['idUser'] = $id;
    $_SESSION['mail'] = $mail;
    $_SESSION['mdp'] = $mdp;
    $_SESSION['nom'] = $username;
    $_SESSION['IdType'] = get_type_compte_with_id($pdo, $id);
    print_r($_SESSION);
    header('Location: index.php?action=accueil');
}

echo $_SESSION['mail'];
echo $_SESSION['mdp'];
echo $_SESSION['nom'];