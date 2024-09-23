<link rel="stylesheet" href="./css/accueil.css">
<link rel="stylesheet" href="./css/lancerMusique.css">
<script src="./js/search.js"></script>

<div class="container-milieu">
<div class="container-milieu-top">

<div class="container-milieu-top-left">
    <img class="logo" src="images/logo.png" alt="logo">
    <h1>Spotiut'O</h1>
    <div class="rechercher">
        <img class="search_icon" src="./images/search.svg" alt="">
        <input class="input_search" type="text" placeholder="Artistes, titres...">
        <img class="cross_icon" src="./images/cross.svg" alt="">
    </div>
</div>

<div class="container-milieu-top-right">
    <a href="#"><img class="img-active" src="./images/notificationVide.png" alt=""><img class="img-hidden" src="./images/notificationPlein.png" alt=""></a>
    <?php
    if ($_REQUEST['action'] == 'compte'){
        echo '<a class="btn-compte" href="#"><img src="./images/userPlein.png" alt=""></a>';
    } else {
        echo '<a class="btn-compte" href="index.php?action=compte"><img src="./images/userVide.png" alt=""></a>';
    }
    ?>
</div>

</div>

<?php

if ($_REQUEST['action'] == 'accueil') {    
    require 'src/MENURAPIDE/accueil.php';
    $acceuil = new Accueil($data);
    $acceuil->afficher();
} else if ($_REQUEST['action'] == 'compte') {
    require 'src/MENURAPIDE/compte.php';
} else if ($_REQUEST['action'] == 'bibliotheque') {
    require 'src/bibliotheque.php';
} else if ($_REQUEST['action'] == 'explorer') {
    require 'src/MENURAPIDE/search.php';
    $search = new Recherche($data);
    $search->afficher();
} else if ($_REQUEST['action'] == 'favoris') {
    require 'src/MENURAPIDE/favoris.php';
    $albums_favoris = get_albums_favoris($pdo, $_SESSION['idUser']);
    $favoris = new Favoris($albums_favoris);
    $favoris->afficher();
} else if ($_REQUEST['action'] == 'album') {
    $pdo = getPdo();
    
    $idAlbum = $_REQUEST['id'];
    $preAlbum = get_album_with_id($pdo, $idAlbum);
    $nomArtiste = get_nom_artiste_with_id($pdo, $preAlbum['ID_Artiste_By']);
    require 'src/PAGEUNIQUE/album.php';
    $album = new Album($idAlbum, $preAlbum['Titre'], $nomArtiste, $preAlbum['Date_de_sortie'], $preAlbum['Genre'], $preAlbum['Pochette'], $preAlbum['ID_Artiste_Parent']);
    $album->afficher();
} else if ($_REQUEST['action'] == 'artiste') {
    $pdo = getPdo();

    $idArtiste = $_REQUEST['id'];
    $nomArtiste = get_artiste_with_id($pdo, $idArtiste);
    require 'src/PAGEUNIQUE/artiste.php';
    $artiste = new Artiste($idArtiste, $nomArtiste[0]);
    $artiste->afficher();
} else if ($_REQUEST['action'] == 'editerArtiste') {
    $pdo = getPdo();

    $idArtiste = $_REQUEST['idArtiste'];
    $nomArtiste = get_artiste_with_id($pdo, $idArtiste);
    require 'src/UPDATE/editerArtiste.php';
    $editerArtiste = new editerArtiste($idArtiste, $nomArtiste[0]);
    $editerArtiste->afficher();
} else if ($_REQUEST['action'] == 'editerAlbum'){
    $pdo = getPdo();
    $idAlbum = $_REQUEST['idAlbum'];
    $album = get_album_with_id($pdo, $idAlbum);
    require 'src/UPDATE/editerAlbum.php';
    $editerAlbum = new editerAlbum($album['ID_Album'], $album['Titre'], $album['Date_de_sortie'], $album['Genre'], $album['Pochette'], $album['ID_Artiste_By'], $album['ID_Artiste_Parent']);
    $editerAlbum->afficher();
} else if ($_REQUEST['action'] == 'editerMusique'){
    $pdo = getPdo();
    $idMusique = $_REQUEST['idMusique'];
    $musique = get_music_with_id($pdo, $idMusique);
    require 'src/UPDATE/editerMusique.php';
    $Album = get_album_with_id($pdo, $musique['ID_Album']);
    $editerMusique = new editerMusique($idMusique, $musique['Titre'], $Album['Titre']);
    $editerMusique->afficher();
} else if ($_REQUEST['action'] == 'playlist') {
    $pdo = getPdo();

    $idPlaylist = $_REQUEST['idPlaylist'];
    $playlist = get_playlist_with_id($pdo, $idPlaylist);
    $listeMusique = get_musique_with_idPlaylist($pdo, $idPlaylist);
    require 'src/PAGEUNIQUE/playlist.php';
    $playlist = new Playlist($idPlaylist, $playlist['ID_Utilisateur'], $playlist['Nom'], $listeMusique);
    $playlist->afficher();
} else if ($_REQUEST['action'] == 'musique') {
    $pdo = getPdo();

    $idMusique = $_REQUEST['id'];
    $musique = get_music_with_id($pdo, $idMusique);
    $album = get_album_with_id($pdo, $musique['ID_Album']);
    $artiste = get_artiste_with_id($pdo, $album['ID_Artiste_By']);
    require 'src/PAGEUNIQUE/Music.php';
    $music = new Music($musique['Titre'], $artiste, $album['Genre'], $album['Date_de_sortie'], $album['Pochette'], $idMusique, $musique['Lien']);
    $music->afficher();
} else {
    require 'src/PAGEUNIQUE/404.php';
}


echo '<script src="js/lancementMusicPageArtiste.js"></script>';
?>

</div>

