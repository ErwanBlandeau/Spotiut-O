<?php

echo '<link rel="stylesheet" href="./css/popup.css">';

echo '<aside class="container-left">';
echo '<div class="container-left-top">';

echo '<h2 class="titre-menu">Menu rapide</h2>';

echo '<ul class="menu">';
    if ($_REQUEST['action'] == 'accueil'){
        echo '<li><img class="img-active" id="img-accueil-plein" src="./images/maisonPlein.png" alt=""><a id="btn-accueil" class="btn-accueil" href="#">Accueil</a></li>';
        echo '<li><img class="img-active" id="img-explorer-vide" src="./images/explorerVide.png" alt=""><a id="btn-explorer" class="btn-explorer" href="index.php?action=explorer&search=Tout">Explorer</a></li>';
        echo '<li><img class="img-active" id="img-coeur-vide" src="./images/coeurVide.png" alt=""><a id="btn-favoris" class="btn-favoris" href="index.php?action=favoris&search=Tout">Favoris</a></li>';
    } else if ($_REQUEST['action'] == 'explorer'){
        echo '<li><img class="img-active" id="img-accueil-vide" src="./images/maisonVide.png" alt=""><a id="btn-accueil" class="btn-accueil" href="index.php?action=accueil">Accueil</a></li>';
        echo '<li><img class="img-active" id="img-explorer-plein" src="./images/explorerPlein.png" alt=""><a id="btn-explorer" class="btn-explorer" href="#">Explorer</a></li>';
        echo '<li><img class="img-active" id="img-coeur-vide" src="./images/coeurVide.png" alt=""><a id="btn-favoris" class="btn-favoris" href="index.php?action=favoris&search=Tout">Favoris</a></li>';
    }  else if ($_REQUEST['action'] == 'favoris') {
        echo '<li><img class="img-active" id="img-accueil-vide" src="./images/maisonVide.png" alt=""><a id="btn-accueil" class="btn-accueil" href="index.php?action=accueil">Accueil</a></li>';
        echo '<li><img class="img-active" id="img-explorer-vide" src="./images/explorerVide.png" alt=""><a id="btn-explorer" class="btn-explorer" href="index.php?action=explorer&search=Tout">Explorer</a></li>';
        echo '<li><img class="img-active" id="img-coeur-plein" src="./images/coeurPlein.png" alt=""><a id="btn-favoris" class="btn-favoris" href="index.php?action=favoris&search=Tout">Favoris</a></li>';
    } else {
        echo '<li><img class="img-active" id="img-accueil-vide" src="./images/maisonVide.png" alt=""><a id="btn-accueil" class="btn-accueil" href="index.php?action=accueil">Accueil</a></li>';
        echo '<li><img class="img-active" id="img-explorer-vide" src="./images/explorerVide.png" alt=""><a id="btn-explorer" class="btn-explorer" href="index.php?action=explorer&search=Tout">Explorer</a></li>';
        echo '<li><img class="img-active" id="img-coeur-vide" src="./images/coeurVide.png" alt=""><a id="btn-favoris" class="btn-favoris" href="index.php?action=favoris&search=Tout">Favoris</a></li>';
    }
    
echo '</ul>';


echo '<div class="container-playlist">';

    
        $playlists = $_SESSION['playlistUser'];
        $playlistsLiked = get_playlist_liked_with_id(getPdo(), get_id_with_email(getPdo(), $_SESSION['mail']));

        if ($playlistsLiked != null && !empty($playlistsLiked)){
            $playlists = array_merge($playlists, $playlistsLiked);
        }

        echo '<div class="container-playlist-top">';
            echo '<h2 class="titre-playlist">Playlists</h2>';
            echo '<button id="btnAddPlaylist" class="btn-creer-playlist">+</button>';
        echo '</div>';

        echo '<div id="playlistPopup" style="display: none;">';

            echo '<button id="btnClosePopup"><img src="./images/croix.png" alt=""></button>';
            echo '<form id="playlist-form" action="index.php?action=ajouterPlaylist" method="POST" class="form">';
                echo '<div class="form-group">';
                    echo '<label for="name">Nom de la playlist</label>';
                    echo '<input name="nomPlaylist" type="text" id="playlistName" placeholder="Nom de la playlist">';
                echo '</div>';
                echo '<button type="submit" id="btnSavePlaylist">Valider</button>';
            echo '</form>';

        echo '</div>';

        // erreur ajout playlist
        echo '<p class="erreur-ajout-playlist">'. $_REQUEST['erreurAjoutPlaylist'] .'</p>';

        if ($playlists == null || empty($playlists)){
            echo '<p class="aucune-playlist">Aucune playlist</p>';
        } else {
            for ($i = 0; $i < count($playlists); $i++) {
                if ($_REQUEST['idPlaylist'] == $playlists[$i]['ID_Playlist']){
                    echo '<a class="playlist playlist-actif" href="#">';
                } else {
                    echo '<a class="playlist" href="index.php?action=playlist&idPlaylist='. $playlists[$i]['ID_Playlist'] .'">';
                }
                    // print_r("tets: ".yaDesMusiqueDansPlaylist(getPdo(), $playlists[$i]['ID_Playlist']));
                    if (trim($playlists[$i]['Nom']) == 'Titres Likés'){
                        echo '<img src="./images/PLAYLIST/coup-coeur.jpg" alt="">';
                    } else if (yaDesMusiqueDansPlaylist(getPdo(), $playlists[$i]['ID_Playlist'])){
                        // print_r("eh ".getMusiqueDansPlaylist(getPdo(), $playlists[$i]['ID_Playlist'])[0]['ID_Album']);
                        $albums = getMusiqueDansPlaylist(getPdo(), $playlists[$i]['ID_Playlist']);
                        if (count($albums) > 3){
                            echo '<img id="mergedImage" src="./images/ALBUMS/default.jpg" alt="">';
                            $imagePlaylist1 = trim('./images/ALBUMS/').trim(get_album_with_id(getPdo(), $albums[0]['ID_Album'])['Pochette']);
                            $imagePlaylist2 = trim('./images/ALBUMS/').trim(get_album_with_id(getPdo(), $albums[1]['ID_Album'])['Pochette']);
                            $imagePlaylist3 = trim('./images/ALBUMS/').trim(get_album_with_id(getPdo(), $albums[2]['ID_Album'])['Pochette']);
                            $imagePlaylist4 = trim('./images/ALBUMS/').trim(get_album_with_id(getPdo(), $albums[3]['ID_Album'])['Pochette']);
                            ?>
                            <script>
                            // Charger les quatre images
                            var images = [];
                            var loadedImages = 0;

                            function loadImage(src, index) {
                                var img = new Image();
                                img.onload = function() {
                                    loadedImages++;
                                    if (loadedImages === 4) {
                                        mergeImages();
                                    }
                                };
                                img.src = src;
                                images[index] = img;
                            }

                            // Charger les images
                            loadImage('<?php echo $imagePlaylist1; ?>', 0);
                            loadImage('<?php echo $imagePlaylist2; ?>', 1);
                            loadImage('<?php echo $imagePlaylist3; ?>', 2);
                            loadImage('<?php echo $imagePlaylist4; ?>', 3);

                            console.log(images);

                            function mergeImages() {
                                // Créer un canvas temporaire pour fusionner les images
                                var canvas = document.createElement('canvas');
                                var ctx = canvas.getContext('2d');

                                // Taille des images individuelles
                                var imageWidth = images[0].width;
                                var imageHeight = images[0].height;

                                // Taille de l'image de sortie
                                var outputWidth = imageWidth * 2;
                                var outputHeight = imageHeight * 2;

                                // Définir la taille du canvas
                                canvas.width = outputWidth;
                                canvas.height = outputHeight;

                                // Fusionner les images sur le canvas
                                for (var i = 0; i < 2; i++) {
                                    for (var j = 0; j < 2; j++) {
                                        ctx.drawImage(images[i * 2 + j], j * imageWidth, i * imageHeight, imageWidth, imageHeight);
                                    }
                                }

                                // Convertir le canvas en URL de données (data URL)
                                var mergedImageUrl = canvas.toDataURL();

                                // Afficher l'image fusionnée dans la balise <img>
                                var mergedImageElement = document.getElementById('mergedImage');
                                mergedImageElement.src = mergedImageUrl;
                            }
                            </script>
                            <?php
                        } else {
                            $idAlbum = getMusiqueDansPlaylist(getPdo(), $playlists[$i]['ID_Playlist'])[0]['ID_Album'];
                            echo '<img src="'. trim('./images/ALBUMS/').trim(get_album_with_id(getPdo(), $idAlbum)['Pochette']) .'" alt="image de la playlist">';
                        }
                    } 
                    else {
                        echo '<img src="./images/ALBUMS/default.jpg" alt="">';
                    }
                    echo '<div class="container-playlist-bottom-text">';
                        echo '<p>'. $playlists[$i]['Nom'] .'</p>';
                        if (trim($playlists[$i]['Nom']) == 'Titres Likés'){
                            echo '<p>par Spotiut\'O</p>';
                        } else {
                            $idUser = get_playlist_with_id(getPdo(), $playlists[$i]['ID_Playlist'])['ID_Utilisateur'];
                            echo '<p>par '. trim(get_pseudo_with_id(getPdo(), $idUser)) .'</p>';
                        }
                    echo '</div>';
                echo '</a>';
            }
        }

        echo '<script src="./js/AjouterPlaylist.js"></script>';
   
echo '</div>';


echo '</div>';

echo '</aside>';



