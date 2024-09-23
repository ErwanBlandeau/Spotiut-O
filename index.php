<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotiut'O</title>
    <link rel="shortcut icon" href="images/logo.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@300;400;700&family=Hind+Siliguri:wght@300;400;500;600&family=Lexend:wght@200;300;400;500;600;700;800;900&family=M+PLUS+Rounded+1c:wght@100;300;400;500;700&family=Montserrat:wght@400;700&family=Noto+Sans:ital,wght@0,100;0,300;0,400;0,600;1,500&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

<?php

error_reporting(E_ERROR | E_PARSE);

require 'vendor/autoload.php';
require 'src/autoloader.php';
require 'src/provider/Dataloader.php';
require 'src/provider/Dataloader_function.php';
  
// Utiliser l'autoloader pour charger automatiquement les classes
Autoloader::register();

session_start();
$dataloader = new Dataloader('database.sqlite3', 'extrait.yml');

// $dataloader->createTables();
//returnToBaseBDD($dataloader->getPdo());

$pdo = $dataloader->getPdo();
$data = getdata();

// print_r($data);

echo '<div class="container-all">';
require 'src/provider/pdo.php';

if ($_REQUEST == null || ($_REQUEST['action'] != 'login' && $_SESSION['mail'] == null)) {
    require 'src/UTILISATEUR/login.php';  
} else if ($_REQUEST['erreur'] != null && $_REQUEST['action'] == 'login') {
    require 'src/UTILISATEUR/login.php';
} else if ($_REQUEST['action'] == 'login') {
    require 'src/UTILISATEUR/verifConnexion.php';
} else if ($_REQUEST['action'] == 'inscription') {
    require 'src/UTILISATEUR/inscription.php';
} else if ($_REQUEST['action'] == 'VerifInscription'){
    require 'src/BDD/Function/databaseGet.php';
    $idUser = get_id_with_email($pdo, $_SESSION['mail']);
    $_SESSION['playlistUser'] = get_playlist_utilisateur($pdo, $idUser);
    $_SESSION['IdType'] = get_type_compte_with_id($pdo, $idUser);
    header('Location: index.php?action=accueil');
} else if ($_REQUEST['action'] == 'deconnexion') {
    require 'src/provider/deconnexion.php';
} else if ($_REQUEST['action'] == 'modifierUser') {
    require 'src/UPDATE/updateUser.php'; 
} else if ($_REQUEST['action'] == 'modifierArtiste') {
    require 'src/UPDATE/updateArtiste.php';
} else if ($_REQUEST['action'] == 'modifierAlbum'){
    require 'src/UPDATE/updateAlbum.php';
} else if ($_REQUEST['action'] == 'modifierMusique'){
    require 'src/UPDATE/updateMusique.php';
} else if ($_REQUEST['action'] == 'ajouterPlaylist'){
    require 'src/AJOUT/ajouterPlaylist.php';
} else if ($_REQUEST['action'] == 'ajouterMusicPlaylist') {
    require 'src/AJOUT/insertMusiquePlaylist.php';
} else if ($_REQUEST['action'] == 'deleteMusiquePlaylist') {
    require 'src/DELETE/deleteMusiquePlaylist.php';
} else if ($_REQUEST['action'] == 'deletePlaylist') {
    require 'src/DELETE/deletePlaylist.php';
} else if ($_REQUEST['action'] == 'deleteMusique'){
    require 'src/DELETE/deleteMusique.php';
} else if ($_REQUEST['action'] == 'deleteAlbum'){
    require 'src/DELETE/deleteAlbum.php';
} else if ($_REQUEST['action'] == 'deleteArtiste'){
    require 'src/DELETE/deleteArtiste.php';
} else if ($_REQUEST['action'] == 'noterAlbum'){
    require 'src/UPDATE/noterAlbum.php';
} else if ($_REQUEST['action'] == 'favorisAlbum'){
    require 'src/FAVORIS/favorisAlbum.php';
} else if ($_REQUEST['action'] == 'favorisArtiste'){
    require 'src/FAVORIS/favorisArtiste.php';
} else if ($_REQUEST['action'] == 'favorisMusique'){
    require 'src/FAVORIS/favorisMusique.php';
} else if ($_REQUEST['action'] == 'favorisPlaylist'){
    require 'src/FAVORIS/favorisPlaylist.php';
} else if ($_REQUEST['action'] == 'insertArtiste'){
    require 'src/AJOUT/ajouterArtiste.php';
} else if ($_REQUEST['action'] == 'insertMusique'){
    require 'src/AJOUT/ajouterMusique.php';
} else if ($_REQUEST['action'] == 'insertAlbum'){
    require 'src/AJOUT/ajouterAlbum.php';
} else if ($_REQUEST['action'] == 'visibilitePlaylist'){
    require 'src/UPDATE/visibilitePlaylist.php';
}
else {
    require 'src/BDD/Function/databaseGet.php';
    $idUser = get_id_with_email($pdo, $_SESSION['mail']);
    $_SESSION['playlistUser'] = get_playlist_utilisateur($pdo, $idUser);
    require 'src/PAGEUNIQUE/lecteurMusique.php';
    require 'src/MENURAPIDE/aside.php';
    require 'src/MENURAPIDE/base.php';
} 

echo '</div>';
?>
<script src="./js/Carousel.js"></script>
<script src="./js/Ajax.js" defer></script>
</body>
</html>
