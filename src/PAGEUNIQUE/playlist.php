<?php

class Playlist {
    private $nom;
    private $id;
    private $idUtilisateur;
    private $listeMusique;

    public function __construct($id, $idUtilisateur, $nom, $listeMusique)
    {
        $this->nom = $nom;
        $this->id = $id;
        $this->idUtilisateur = $idUtilisateur;
        $this->listeMusique = $listeMusique;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    public function getListeMusique()
    {
        return $this->listeMusique;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setIdUtilisateur($idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;
    }

    public function setListeMusique($listeMusique)
    {
        $this->listeMusique = $listeMusique;
    }

    public function afficher(){
        require 'src/provider/checkFichierDansDossier.php';
        require 'src/BDD/Function/databaseUpdate.php';
        $pdo = getPdo();

        // lock_unlock_playlist($pdo, $this->id, 0);

        // print_r(get_playlist_locked($pdo, $this->id));
        ?>
        <link rel="stylesheet" href="./css/playlist.css">
       
        <?php
            $nomUser = get_pseudo_with_id($pdo, $this->idUtilisateur);
            if (trim($this->nom) == "Titres Likés") {
                echo '<div class="container-btn-playlist">';
                    echo '<a class="btn-retour" href="javascript:history.back()"><img src="./images/fleche-gauche.png" alt="fleche gauche"></a>';
                    echo '<p class="titre-playlist">'. trim($this->nom) .'<span class="nom-user">Par Spotiut\'O</span></p>';
                    echo '<button class="jouer-playlist"><img src="./images/LECTEUR/playLecteur.png" alt="jouer la playlist"></button>';
                echo '</div>';
            } else {
                echo '<div class="container-btn-playlist">';
                    echo '<a class="btn-retour" href="javascript:history.back()"><img src="./images/fleche-gauche.png" alt="fleche gauche"></a>';
                    echo '<p class="titre-playlist">'. trim($this->nom) .'<span class="nom-user">Par '. trim($nomUser) .'</span></p>';
                    echo '<div class="container-btn-playlist-right">';
                        echo '<button class="jouer-playlist"><img src="./images/LECTEUR/playLecteur.png" alt="jouer la playlist"></button>';
                        if (get_playlist_with_id($pdo, $this->id)['ID_Utilisateur'] == get_id_with_email($pdo, $_SESSION['mail'])) {
                            echo '<a class="btn-supprimer-top" href="index.php?action=deletePlaylist&idPlaylist='. trim($this->id) .'"><img src="./images/croix.png" alt="supprimer une playlist"></a>';
                            if (get_playlist_locked($pdo, $this->id) == 0) {
                                echo '<a class="btn-lock" href="index.php?action=visibilitePlaylist&idPlaylist='. trim($this->id) .'"><img src="./images/lock.png" alt="dévérouiller la playlist"></a>';
                            } else {
                                echo '<a class="btn-lock" href="index.php?action=visibilitePlaylist&idPlaylist='. trim($this->id) .'"><img src="./images/unlock.png" alt="vérouiller la playlist"></a>';
                            }
                        } else {
                            if (favorisPlaylistExiste(getPdo(), get_id_with_email(getPdo(), $_SESSION['mail']), $this->id))
                                echo '<a class="btn-editer" href="index.php?action=favorisPlaylist&idPlaylist='. trim($this->id) .'"><img src="./images/coeurPlein.png" alt="liker l\'artiste"></a>';
                            else {
                                echo '<a class="btn-editer" href="index.php?action=favorisPlaylist&idPlaylist='. trim($this->id) .'"><img src="./images/coeurVide.png" alt="liker l\'artiste"></a>';
                            }
                        }
                    echo '</div>';
                echo '</div>';
            }
        ?>

        <div class="container-musique">
            <?php
            if (count($this->listeMusique) == 0) {
                echo '<p class="aucune-musique">Aucune musique dans cette playlist</p>';
            } {
                $numero = 1;
                foreach ($this->listeMusique as $musique) {
                    $nomMusique = $musique['Titre'];
                    $nomArtiste = $musique['Nom'];
                    $nomArtiste = "Nom de l'artiste";

                    $idMusique = $musique['ID_Musique'];
                    $chemin = "./MUSIQUES/" .  trim($nomMusique) . ".mp3";
                    $cheminImage = "./images/MUSIQUES" .  trim($nomMusique) . ".jpg";
                    $cheminParDefaut = "./images/ALBUMS/default.jpg";
                    echo '<div class="container-album-unique-artiste">';
                            echo '<p class="numero-album">'. $numero .'</p>';
                            echo '<button class="lancer-music"><img src="./images/bouton-play.png" alt="logo play music"></button>';
                            echo '<button class="pause-music"><img src="./images/pause.png" alt="logo pause music"></button>';

                            $path = './images/ALBUMS/';
                            $pochette = trim(get_album_with_id(getPdo(), $musique['ID_Album'])['Pochette']);
                            $imgAlbumCondition = checkFileNameExists($path, $pochette);

                            $album = get_album_with_id(getPdo(), $musique['ID_Album']);
                            $artiste = get_artiste(getPdo(), intval($album['ID_Artiste_By']));

                            $nomArtiste = $artiste['Nom'];

                            echo '<p class="info-musique" style="display:none">'. trim(json_encode($musique)) .'</p>';
                            echo '<p class="info-artiste" style="display:none">'. trim(json_encode($artiste)) .'</p>';
                            echo '<p class="info-album" style="display:none">'. trim(json_encode($album)) .'</p>';
                            
                            if ($imgAlbumCondition == true){
                                echo '<img src="./images/ALBUMS/'. trim($pochette) . '" alt="'. trim($pochette) . '">';
                            } else {
                                echo '<img src="./images/ALBUMS/default.jpg" alt="'. trim($pochette) . '">';
                            }
                            // echo '<img src="./images/ALBUMS/default.jpg" alt="">';
    
                            echo '<a href="index.php?action=musique&id='. trim($musique['ID_Musique']) .'">';
                                echo '<div class="contenu-album">';
                                    echo '<p class="titre-album">'. $nomMusique .'</p>';
                                    echo '<div class="container-contenu-album-bottom">';  
                                        echo '<span class="genre-album">'. $nomArtiste .'</span>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</a>';
                            echo '<div class="container-supprimer-musique">';
                                echo '<button class="btn-liste-attente"><img src="./images/ajoutFileAttente.png" alt="ajouter à la liste d\'attente"></button>';
                                if (trim($this->nom) == "Titres Likés") {
                                    echo '<a class="btn-like" href="index.php?action=favorisMusique&idMusique='. trim($musique['ID_Musique']) .'&idPlaylist='. trim($this->id) .'"><img src="./images/coeurPlein.png" alt="supprimer une musique de la playlist"></a>';
                                } else {
                                    if (favorisMusiqueExiste(getPdo(), get_id_with_email(getPdo(), $_SESSION['mail']), $idMusique)) {
                                        echo '<a class="btn-like" href="index.php?action=favorisMusique&idMusique='. trim($idMusique) .'&idPlaylist='. trim($this->id) .'"><img src="images/coeurPlein.png" alt="liker une musique"></a>';
                                    } else {
                                        echo '<a class="btn-like" href="index.php?action=favorisMusique&idMusique='. trim($idMusique) .'&idPlaylist='. trim($this->id) .'"><img src="images/coeurVide.png" alt="liker une musique"></a>';
                                    }                                   
                                    echo '<a class="btn-supprimer" href="index.php?action=deleteMusiquePlaylist&idMusique='. trim($idMusique) .'&idPlaylist='. trim($this->id) .'"><img src="./images/croix.png" alt="supprimer une musique de la playlist"></a>';
                                }
                            echo '</div>';
                    echo '</div>';
                    $numero++;
                }
            }
            ?>
        </div>
        <?php
        // echo '<script src="js/lancementMusicPageArtiste.js"></script>';
    }
}
?>