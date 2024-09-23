<?php
$pdo = getPdo();

$nom = $_POST['name'];
$mdp = $_POST['password'];
$email = $_POST['email'];

echo $nom;
echo '<br>';
echo $mdp;
echo '<br>';
echo $email;

if ($nom == null || $mdp == null || $email == null) {
    header('Location: index.php?action=login&erreur=un ou plusieurs champs sont vides');
    exit();
}

// if (strlen($mdp) < 8) {
//     header('Location: index.php?action=login&erreur=le mot de passe doit contenir au moins 8 caractères');
//     exit();
// }

insertUser($pdo, $nom, $mdp, $email, 2);

$_SESSION['nom'] = $nom;
$_SESSION['mail'] = $email;
$_SESSION['mdp'] = $mdp;

header('Location: index.php?action=VerifInscription');

