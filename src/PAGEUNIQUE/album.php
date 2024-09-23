<?php
class Album
{
    private $id;
    private $title;
    private $artiste;
    private $year;
    private $genre;
    private $cover;
    private $parent;

    public function __construct($id, $title, $artiste, $year, $genre, $cover, $parent)
    {
        $this->id = $id;
        $this->title = $title;
        $this->artiste = $artiste;
        $this->year = $year;
        $this->genre = $genre;
        $this->cover = $cover;
        $this->parent = $parent;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title; 
    }

    public function getArtiste()
    {
        return $this->artiste;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function getGenre()
    {
        return $this->genre;
    }

    public function getCover()
    {
        return $this->cover;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function afficher(){
        require 'src/BDD/Function/databaseUpdate.php';
        require 'src/provider/checkFichierDansDossier.php';

        echo '<link rel="stylesheet" href="./css/album.css">';

        echo '<div class="container-btn-album">';
            echo '<a class="btn-retour" href="javascript:history.back()"><img src="./images/fleche-gauche.png" alt="fleche gauche"></a>';
            echo '<p>' . trim($this->title) . ', de '. trim($this->artiste) . ', '. $this->year .' <span>'. $this->genre .'</span></p>';
            echo '<div class="container-btn-playlist-right">';
                echo '<button class="jouer-playlist"><img src="./images/LECTEUR/playLecteur.png" alt="jouer la playlist"></button>';
                if ($_SESSION['IdType'] == 1){
                    echo '<a class="btn-editer" href="index.php?action=editerAlbum&idAlbum='. trim($this->id) .'"><img src="./images/editer.png" alt="Editer album"></a>';
                    echo '<a class="btn-supprimer" href="index.php?action=deleteAlbum&idAlbum='. trim($this->id) .'"><img src="./images/croix.png" alt="supprimer album"></a>';
                }
                if (favorisAlbumExiste(getPdo(), get_id_with_email(getPdo(), $_SESSION['mail']), $this->id)) {
                    echo '<a class="btn-editer" href="index.php?action=favorisAlbum&idAlbum='. trim($this->id) .'"><img src="./images/coeurPlein.png" alt="Liker un album"></a>';
                } else {
                    echo '<a class="btn-editer" href="index.php?action=favorisAlbum&idAlbum='. trim($this->id) .'"><img src="./images/coeurVide.png" alt="Liker un album"></a>';
                }
            echo '</div>';
        echo '</div>';

        echo '<div class="container-milieu-album">';
            echo '<div class="container-milieu-bottom-left">';  
                echo '<div class="container-rating">';
                $idUser = get_id_with_email(getPdo(), $_SESSION['mail']);
                    $note = getNote(getPdo(), $idUser, $this->id);
                    //print_r($note);
                    ?>
                    <script>
                        var note = <?php echo $note; ?>;
                    </script>
                    <?php
                    
                    if ($note == 0){
                        echo '<a class="etoile1" id="etoile1" href="index.php?action=noterAlbum&idAlbum='. trim($this->id) .'&note=1"><img class="etoile-actif" id="imgVideEtoile1" src="./images/starVide.png" alt="etoile"><img class="etoile-hidden" id="imgPleineEtoile1" src="./images/starPlein.png" alt="etoile"></a>';      
                        echo '<a class="etoile2" id="etoile2" href="index.php?action=noterAlbum&idAlbum='. trim($this->id) .'&note=2"><img class="etoile-actif" id="imgVideEtoile2" src="./images/starVide.png" alt="etoile"><img class="etoile-hidden" id="imgPleineEtoile2" src="./images/starPlein.png" alt="etoile"></a>';
                        echo '<a class="etoile3" id="etoile3" href="index.php?action=noterAlbum&idAlbum='. trim($this->id) .'&note=3"><img class="etoile-actif" id="imgVideEtoile3" src="./images/starVide.png" alt="etoile"><img class="etoile-hidden" id="imgPleineEtoile3" src="./images/starPlein.png" alt="etoile"></a>';
                        echo '<a class="etoile4" id="etoile4" href="index.php?action=noterAlbum&idAlbum='. trim($this->id) .'&note=4"><img class="etoile-actif" id="imgVideEtoile4" src="./images/starVide.png" alt="etoile"><img class="etoile-hidden" id="imgPleineEtoile4" src="./images/starPlein.png" alt="etoile"></a>';
                        echo '<a class="etoile5" id="etoile5" href="index.php?action=noterAlbum&idAlbum='. trim($this->id) .'&note=5"><img class="etoile-actif" id="imgVideEtoile5" src="./images/starVide.png" alt="etoile"><img class="etoile-hidden" id="imgPleineEtoile5" src="./images/starPlein.png" alt="etoile"></a>';
                    } elseif ($note == 1) {
                        echo '<a class="etoile1" id="etoile1" href="index.php?action=noterAlbum&idAlbum='. trim($this->id) .'&note=1"><img class="etoile-hidden" id="imgVideEtoile1" src="./images/starVide.png" alt="etoile"><img class="etoile-actif" id="imgPleineEtoile1" src="./images/starPlein.png" alt="etoile"></a>';      
                        echo '<a class="etoile2" id="etoile2" href="index.php?action=noterAlbum&idAlbum='. trim($this->id) .'&note=2"><img class="etoile-actif" id="imgVideEtoile2" src="./images/starVide.png" alt="etoile"><img class="etoile-hidden" id="imgPleineEtoile2" src="./images/starPlein.png" alt="etoile"></a>';
                        echo '<a class="etoile3" id="etoile3" href="index.php?action=noterAlbum&idAlbum='. trim($this->id) .'&note=3"><img class="etoile-actif" id="imgVideEtoile3" src="./images/starVide.png" alt="etoile"><img class="etoile-hidden" id="imgPleineEtoile3" src="./images/starPlein.png" alt="etoile"></a>';
                        echo '<a class="etoile4" id="etoile4" href="index.php?action=noterAlbum&idAlbum='. trim($this->id) .'&note=4"><img class="etoile-actif" id="imgVideEtoile4" src="./images/starVide.png" alt="etoile"><img class="etoile-hidden" id="imgPleineEtoile4" src="./images/starPlein.png" alt="etoile"></a>';
                        echo '<a class="etoile5" id="etoile5" href="index.php?action=noterAlbum&idAlbum='. trim($this->id) .'&note=5"><img class="etoile-actif" id="imgVideEtoile5" src="./images/starVide.png" alt="etoile"><img class="etoile-hidden" id="imgPleineEtoile5" src="./images/starPlein.png" alt="etoile"></a>';
                    } elseif ($note == 2) {
                        echo '<a class="etoile1" id="etoile1" href="index.php?action=noterAlbum&idAlbum='. trim($this->id) .'&note=1"><img class="etoile-hidden" id="imgVideEtoile1" src="./images/starVide.png" alt="etoile"><img class="etoile-actif" id="imgPleineEtoile1" src="./images/starPlein.png" alt="etoile"></a>';      
                        echo '<a class="etoile2" id="etoile2" href="index.php?action=noterAlbum&idAlbum='. trim($this->id) .'&note=2"><img class="etoile-hidden" id="imgVideEtoile2" src="./images/starVide.png" alt="etoile"><img class="etoile-actif" id="imgPleineEtoile2" src="./images/starPlein.png" alt="etoile"></a>';
                        echo '<a class="etoile3" id="etoile3" href="index.php?action=noterAlbum&idAlbum='. trim($this->id) .'&note=3"><img class="etoile-actif" id="imgVideEtoile3" src="./images/starVide.png" alt="etoile"><img class="etoile-hidden" id="imgPleineEtoile3" src="./images/starPlein.png" alt="etoile"></a>';
                        echo '<a class="etoile4" id="etoile4" href="index.php?action=noterAlbum&idAlbum='. trim($this->id) .'&note=4"><img class="etoile-actif" id="imgVideEtoile4" src="./images/starVide.png" alt="etoile"><img class="etoile-hidden" id="imgPleineEtoile4" src="./images/starPlein.png" alt="etoile"></a>';
                        echo '<a class="etoile5" id="etoile5" href="index.php?action=noterAlbum&idAlbum='. trim($this->id) .'&note=5"><img class="etoile-actif" id="imgVideEtoile5" src="./images/starVide.png" alt="etoile"><img class="etoile-hidden" id="imgPleineEtoile5" src="./images/starPlein.png" alt="etoile"></a>';
                    } elseif ($note == 3) {
                        echo '<a class="etoile1" id="etoile1" href="index.php?action=noterAlbum&idAlbum='. trim($this->id) .'&note=1"><img class="etoile-hidden" id="imgVideEtoile1" src="./images/starVide.png" alt="etoile"><img class="etoile-actif" id="imgPleineEtoile1" src="./images/starPlein.png" alt="etoile"></a>';      
                        echo '<a class="etoile2" id="etoile2" href="index.php?action=noterAlbum&idAlbum='. trim($this->id) .'&note=2"><img class="etoile-hidden" id="imgVideEtoile2" src="./images/starVide.png" alt="etoile"><img class="etoile-actif" id="imgPleineEtoile2" src="./images/starPlein.png" alt="etoile"></a>';
                        echo '<a class="etoile3" id="etoile3" href="index.php?action=noterAlbum&idAlbum='. trim($this->id) .'&note=3"><img class="etoile-hidden" id="imgVideEtoile3" src="./images/starVide.png" alt="etoile"><img class="etoile-actif" id="imgPleineEtoile3" src="./images/starPlein.png" alt="etoile"></a>';
                        echo '<a class="etoile4" id="etoile4" href="index.php?action=noterAlbum&idAlbum='. trim($this->id) .'&note=4"><img class="etoile-actif" id="imgVideEtoile4" src="./images/starVide.png" alt="etoile"><img class="etoile-hidden" id="imgPleineEtoile4" src="./images/starPlein.png" alt="etoile"></a>';
                        echo '<a class="etoile5" id="etoile5" href="index.php?action=noterAlbum&idAlbum='. trim($this->id) .'&note=5"><img class="etoile-actif" id="imgVideEtoile5" src="./images/starVide.png" alt="etoile"><img class="etoile-hidden" id="imgPleineEtoile5" src="./images/starPlein.png" alt="etoile"></a>';
                    } elseif ($note == 4) {
                        echo '<a class="etoile1" id="etoile1" href="index.php?action=noterAlbum&idAlbum='. trim($this->id) .'&note=1"><img class="etoile-hidden" id="imgVideEtoile1" src="./images/starVide.png" alt="etoile"><img class="etoile-actif" id="imgPleineEtoile1" src="./images/starPlein.png" alt="etoile"></a>';      
                        echo '<a class="etoile2" id="etoile2" href="index.php?action=noterAlbum&idAlbum='. trim($this->id) .'&note=2"><img class="etoile-hidden" id="imgVideEtoile2" src="./images/starVide.png" alt="etoile"><img class="etoile-actif" id="imgPleineEtoile2" src="./images/starPlein.png" alt="etoile"></a>';
                        echo '<a class="etoile3" id="etoile3" href="index.php?action=noterAlbum&idAlbum='. trim($this->id) .'&note=3"><img class="etoile-hidden" id="imgVideEtoile3" src="./images/starVide.png" alt="etoile"><img class="etoile-actif" id="imgPleineEtoile3" src="./images/starPlein.png" alt="etoile"></a>';
                        echo '<a class="etoile4" id="etoile4" href="index.php?action=noterAlbum&idAlbum='. trim($this->id) .'&note=4"><img class="etoile-hidden" id="imgVideEtoile4" src="./images/starVide.png" alt="etoile"><img class="etoile-actif" id="imgPleineEtoile4" src="./images/starPlein.png" alt="etoile"></a>';
                        echo '<a class="etoile5" id="etoile5" href="index.php?action=noterAlbum&idAlbum='. trim($this->id) .'&note=5"><img class="etoile-actif" id="imgVideEtoile5" src="./images/starVide.png" alt="etoile"><img class="etoile-hidden" id="imgPleineEtoile5" src="./images/starPlein.png" alt="etoile"></a>';
                    } else {
                        echo '<a class="etoile1" id="etoile1" href="index.php?action=noterAlbum&idAlbum='. trim($this->id) .'&note=1"><img class="etoile-hidden" id="imgVideEtoile1" src="./images/starVide.png" alt="etoile"><img class="etoile-actif" id="imgPleineEtoile1" src="./images/starPlein.png" alt="etoile"></a>';      
                        echo '<a class="etoile2" id="etoile2" href="index.php?action=noterAlbum&idAlbum='. trim($this->id) .'&note=2"><img class="etoile-hidden" id="imgVideEtoile2" src="./images/starVide.png" alt="etoile"><img class="etoile-actif" id="imgPleineEtoile2" src="./images/starPlein.png" alt="etoile"></a>';
                        echo '<a class="etoile3" id="etoile3" href="index.php?action=noterAlbum&idAlbum='. trim($this->id) .'&note=3"><img class="etoile-hidden" id="imgVideEtoile3" src="./images/starVide.png" alt="etoile"><img class="etoile-actif" id="imgPleineEtoile3" src="./images/starPlein.png" alt="etoile"></a>';
                        echo '<a class="etoile4" id="etoile4" href="index.php?action=noterAlbum&idAlbum='. trim($this->id) .'&note=4"><img class="etoile-hidden" id="imgVideEtoile4" src="./images/starVide.png" alt="etoile"><img class="etoile-actif" id="imgPleineEtoile4" src="./images/starPlein.png" alt="etoile"></a>';
                        echo '<a class="etoile5" id="etoile5" href="index.php?action=noterAlbum&idAlbum='. trim($this->id) .'&note=5"><img class="etoile-hidden" id="imgVideEtoile5" src="./images/starVide.png" alt="etoile"><img class="etoile-actif" id="imgPleineEtoile5" src="./images/starPlein.png" alt="etoile"></a>';
                    }
                echo '</div>';

                $path = './images/ALBUMS/';
                $imgAlbumCondition = checkFileNameExists($path, trim($this->cover));
                
                if ($imgAlbumCondition == true){
                    echo '<img src="./images/ALBUMS/'. trim($this->cover) . '" alt="'. trim($this->title) . '">';
                } else {
                    echo '<img src="./images/ALBUMS/default.jpg" alt="'. trim($this->title) . '">';
                }
            echo '</div>';
            echo '<div class="container-milieu-bottom-right">';
                echo '<p class="titre-right">Les musiques de cet album</p>';
                echo '<div class="container-album-artiste">';
                $musiques = get_musique_in_album(getPdo(), $this->id);
                if (count($musiques) == 0){
                    echo '<p class="aucun-album">Aucune musique</p>';
                } else {
                    for ($i=0; $i < count($musiques); $i++) { 
                        $musique = $musiques[$i]; // ID_Album
                        $album = get_album_with_id(getPdo(), $musique['ID_Album']);
                        $artiste = get_artiste(getPdo(), intval($album['ID_Artiste_By']));

                        $pathAlbum = './images/musiques/';
                        $imgAlbum = $musique['Pochette'];
    
                        echo '<div class="container-album-unique-artiste">';
                            ?>
                            <script>
                                var musique = <?php echo json_encode($musique); ?>;
                                var artiste = <?php echo json_encode($artiste);?>;
                                var album = <?php echo json_encode($album); ?>;
                            </script>
                            <?php

                            echo '<p class="info-musique" style="display:none">'. trim(json_encode($musique)) .'</p>';
                            echo '<p class="info-artiste" style="display:none">'. trim(json_encode($artiste)) .'</p>';
                            echo '<p class="info-album" style="display:none">'. trim(json_encode($album)) .'</p>';

                            $numero = $i+1;
                            echo '<p class="numero-album">'.$numero .'</p>';
                            echo '<button class="lancer-music"><img src="./images/bouton-play.png" alt="logo play music"></button>';
                            echo '<button class="pause-music"><img src="./images/pause.png" alt="logo pause music"></button>';
                            if ($imgAlbumCondition == true){
                                echo '<img src="./images/ALBUMS/'. trim($this->cover) . '" alt="'. trim($this->title) . '">';
                            } else {
                                echo '<img src="./images/ALBUMS/default.jpg" alt="'. trim($this->title) . '">';
                            }
                            echo '<div class="contenu-album">';
                                echo '<a href="index.php?action=musique&id='. trim($musique['ID_Musique']) .'"><p class="titre-album">'.$musique['Titre'].'</p></a>';
                            echo '</div>';
                            echo '<button class="btn-liste-attente"><img src="./images/ajoutFileAttente.png" alt="ajouter à la liste d\'attente"></button>';
                            if (favorisMusiqueExiste(getPdo(), get_id_with_email(getPdo(), $_SESSION['mail']), $musique['ID_Musique'])) {
                                echo '<a class="btn-like" href="index.php?action=favorisMusique&idMusique='. trim($musique['ID_Musique']) .'&idAlbum='. trim($this->id) .'"><img src="images/coeurPlein.png" alt="liker une musique"></a>';
                            } else {
                                echo '<a class="btn-like" href="index.php?action=favorisMusique&idMusique='. trim($musique['ID_Musique']) .'&idAlbum='. trim($this->id) .'"><img src="images/coeurVide.png" alt="liker une musique"></a>';
                            }
                            echo '<button id="btn-ajouter-a-playlist" class="btn-ajouter-a-playlist"><img class="ajouter-music" src="./images/ajouter.png" alt="ajouter"></button>';
                            echo '<div class="container-ajouter">';
                                echo '<button class="btn-close"><img src="./images/croix.png" alt="close"></button>';
                                echo '<div class="container-ajouter-playlist">';
                                echo '<p>Ajouter à une playlist</p>';
                                    $playlists = get_playlist_with_id_utilisateur(getPdo(), get_id_with_email(getPdo(), $_SESSION['mail']));
                                    for ($j=0; $j < count($playlists); $j++) { 
                                        $playlist = $playlists[$j];
                                        if ($playlist['Nom'] != "Titres Likés") {
                                            echo '<a class="lien-playlist" href="index.php?action=ajouterMusicPlaylist&idMusique='. trim($musique['ID_Musique']) .'&idPlaylist='. trim($playlist['ID_Playlist']) .'&idAlbum='. trim($this->id) .'">'. $playlist['Nom'] .'</a>';
                                        }
                                    }
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    }   
                }
                echo '</div>';
            echo '</div>';
        echo '</div>';
        echo '<script src="js/AjouterMusiqueDansPlaylist.js"></script>';
        echo '<script src="js/ratingAlbum.js"></script>';
    }
}
?>