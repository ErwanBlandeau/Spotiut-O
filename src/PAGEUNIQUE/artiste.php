<?php

class Artiste {
    private $id;
    private $nom;

    public function __construct($id, $nom) {
        $this->id = $id;
        $this->nom = $nom;
    }

    public function afficher(){
        require 'src/provider/checkFichierDansDossier.php';
        require 'src/BDD/Function/databaseUpdate.php';

        echo '<link rel="stylesheet" href="./css/artiste.css">';

        echo '<div class="container-btn-album">';
            echo '<a class="btn-retour" href="javascript:history.back()"><img src="./images/fleche-gauche.png" alt="fleche gauche"></a>';
            // echo '<a class="btn-editer" href="index.php?action=editerArtiste&idArtiste='. trim($this->id) .'"><img src="./images/editer.png" alt="Editer album"></a>';
            echo '<p class="titre-artiste">'.$this->nom.'</p>';
            if ($_SESSION['IdType'] == 1){
                echo '<div class="editer-artiste-container">';
                echo '<a class="btn-editer" href="index.php?action=editerArtiste&idArtiste='. trim($this->id) .'"><img src="./images/editer.png" alt="Editer album"></a>';
                echo '<a class="btn-supprimer" href="index.php?action=deleteArtiste&idArtiste='. trim($this->id) .'"><img src="./images/croix.png" alt="supprimer album"></a>';
            }
            if (favorisArtisteExiste(getPdo(), get_id_with_email(getPdo(), $_SESSION['mail']), $this->id))
                echo '<a class="btn-editer" href="index.php?action=favorisArtiste&idArtiste='. trim($this->id) .'"><img src="./images/coeurPlein.png" alt="liker l\'artiste"></a>';
            else
                echo '<a class="btn-editer" href="index.php?action=favorisArtiste&idArtiste='. trim($this->id) .'"><img src="./images/coeurVide.png" alt="liker l\'artiste"></a>';
            if ($_SESSION['IdType'] == 1){
                echo '</div>';
            }
        echo '</div>';

        echo '<div class="container-milieu-album">';
            echo '<div class="container-milieu-bottom-left">';
                $imgVerif = get_img_album_with_artist_name(getPdo(), $this->nom);

                $path = './images/ARTISTES/';
                $imgArtiste = trim($this->nom).'.jpg';
                $imgArtisteCondition = checkFileNameExists($path, $imgArtiste);
            
        
                // si l'image existe dans le dossier ARTISTES
                if ($imgArtisteCondition){
                    echo '<img src="./images/ARTISTES/'. trim($this->nom).'.jpg" alt="">';
                }
                // si l'image existe dans le dossier ALBUMS et existe dans le dossier ARTISTES
                else if ($imgVerif != null && !$imgArtisteCondition){
                    echo '<img src="./images/ALBUMS/'. trim($imgVerif).'" alt="">';
                }
                // si l'image n'existe pas dans le dossier ALBUMS et n'existe pas dans le dossier ARTISTES
                else if (!$imgArtisteCondition && $imgVerif == null) {
                    echo '<img src="./images/ALBUMS/default.jpg" alt="">';
                } 
                else {
                    echo '<img src="./images/ARTISTES/'. trim($this->nom).'.jpg" alt="">';
                }
            echo '</div>';
            echo '<div class="container-milieu-bottom-right">';
                echo '<p class="titre-container-album">Les albums de cet artiste</p>';
                echo '<div class="container-album-artiste">';
                $albums = get_albums_artiste(getPdo(), $this->id);
                if (count($albums) == 0){
                    echo '<p class="aucun-album">Aucun album</p>';
                } else {
                    for ($i=0; $i < count($albums); $i++) { 
                        $album = $albums[$i];
    
                        $pathAlbum = './images/ALBUMS/';
                        $imgAlbum = $album['Pochette'];
                        $imgAlbumCondition = checkFileNameExists($pathAlbum, trim($imgAlbum));
                        echo '<a class="container-album-unique-artiste" href="index.php?action=album&id='. trim($album['ID_Album']) .'">';
                            if ($imgAlbumCondition){
                                echo '<img src="./images/ALBUMS/'. trim($imgAlbum).'" alt="">';
                            }
                            else {
                                echo '<img src="./images/ALBUMS/default.jpg" alt="">';
                            }
                            echo '<div class="contenu-album">';
                                echo '<p class="titre-album">'.$album['Titre'].'</p>';
                                echo '<div class="container-contenu-album-bottom">';  
                                    echo '<span class="genre-album">'.$album['Genre'].'</span>';
                                    if ($album['Date_de_sortie'] != null && $album['Date_de_sortie'] != 0){
                                        echo '<span class="date-album">'.$album['Date_de_sortie'].'</span>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        echo '</a>';
                    }   
                }
                echo '</div>';
            echo '</div>';
        echo '</div>';
    }
}