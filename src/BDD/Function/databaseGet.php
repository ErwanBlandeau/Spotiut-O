<?php

    function get_password_with_email(PDO $pdo, String $mail){
        try{
            $stmt = $pdo->prepare("SELECT Mot_de_passe FROM Utilisateur WHERE Email = :Email");
            $stmt->bindParam(':Email', $mail);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result['Mot_de_passe'];
        } catch (PDOException $e){
            echo $e->getMessage();
            return null;
        }
    }

    function get_password_with_pseudo(PDO $pdo, String $pseudo){
        $stmt = $pdo->prepare("SELECT Mot_de_passe FROM Utilisateur WHERE Nom_utilisateur = :Nom_utilisateur");
        $stmt->bindParam(':Nom_utilisateur', $pseudo);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['Mot_de_passe'];
    }

    function get_id_with_email(PDO $pdo, String $mail){
        $stmt = $pdo->prepare("SELECT ID_Utilisateur FROM Utilisateur WHERE Email = :Email");
        $stmt->bindParam(':Email', $mail);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['ID_Utilisateur'];
    }

    function get_mail_with_id(PDO $pdo, int $id){
        $stmt = $pdo->prepare("SELECT Email FROM Utilisateur WHERE ID_Utilisateur = :ID_Utilisateur");
        $stmt->bindParam(':ID_Utilisateur', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['Email'];
    }

    function get_mail_with_username(PDO $pdo, String $username){
        $stmt = $pdo->prepare("SELECT Email FROM Utilisateur WHERE Nom_utilisateur = :Nom_utilisateur");
        $stmt->bindParam(':Nom_utilisateur', $username);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['Email'];
    }

    function get_pseudo_with_id(PDO $pdo, int $id){
        $stmt = $pdo->prepare("SELECT Nom_utilisateur FROM Utilisateur WHERE ID_Utilisateur = :ID_Utilisateur");
        $stmt->bindParam(':ID_Utilisateur', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['Nom_utilisateur'];
    }

    function get_pseudo_with_mail(PDO $pdo, String $mail){
        $stmt = $pdo->prepare("SELECT Nom_utilisateur FROM Utilisateur WHERE Email = :Email");
        $stmt->bindParam(':Email', $mail);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['Nom_utilisateur'];
    }

    function get_id_with_pseudo(PDO $pdo, String $pseudo){
        $stmt = $pdo->prepare("SELECT ID_Utilisateur FROM Utilisateur WHERE Nom_utilisateur = :Nom_utilisateur");
        $stmt->bindParam(':Nom_utilisateur', $pseudo);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['ID_Utilisateur'];
    }

    function get_type_compte_with_id(PDO $pdo, int $id){
        $stmt = $pdo->prepare("SELECT ID_types FROM Utilisateur WHERE ID_Utilisateur = :ID_Utilisateur");
        $stmt->bindParam(':ID_Utilisateur', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['ID_types'];
    }

    function get_all_album(PDO $pdo){
        $stmt = $pdo->prepare("SELECT Titre,Date_de_sortie,Genre,Pochette,ID_Artiste_By,ID_Artiste_Parent, ID_Album FROM Album");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    function get_albums_artiste(PDO $pdo, int $id){
        $stmt = $pdo->prepare("SELECT Titre,Date_de_sortie,Genre,Pochette,ID_Artiste_By,ID_Artiste_Parent, ID_Album FROM Album WHERE ID_Artiste_By = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    function get_id_album_with_name(PDO $pdo, String $name){
        $stmt = $pdo->prepare("SELECT ID_Album FROM Album WHERE Titre = :name");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['ID_Album'];
    }

    function get_artiste(PDO $pdo, int $id){
        $stmt = $pdo->prepare("SELECT ID_Artiste, Nom FROM Artiste WHERE ID_Artiste = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    function get_artiste_with_id(PDO $pdo, int $id){
        $stmt = $pdo->prepare("SELECT Nom FROM Artiste WHERE ID_Artiste = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    function get_all_artiste(PDO $pdo){
        $stmt = $pdo->prepare("SELECT Nom,ID_Artiste FROM Artiste");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    function get_all_genre(PDO $pdo){
        $stmt = $pdo->prepare("SELECT Nom_du_genre, ID_Genre FROM Genre NATURAL JOIN listeGenre GROUP BY ID_Genre ORDER BY COUNT(ID_Genre) DESC");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    function get_genre_with_id(PDO $pdo, int $id){
        $stmt = $pdo->prepare("SELECT Nom_du_genre FROM Genre WHERE ID_Genre = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['Nom_du_genre'];
    }

    function get_albums_with_genre(PDO $pdo, String $nom){
        $result = array();
        $albums = get_all_album($pdo);

        for ($i = 0; $i < count($albums); $i++){
            $genres = explode(',', $albums[$i]['Genre']);
            for ($j = 0; $j < count($genres); $j++){
                if (trim($genres[$j]) == $nom){
                    array_push($result, $albums[$i]);
                }
            }
        }
        return $result;
    }

    function get_album_with_id(PDO $pdo, int $id){
        $stmt = $pdo->prepare("SELECT Titre,Date_de_sortie,Genre,Pochette,ID_Artiste_By,ID_Artiste_Parent, ID_Album FROM Album WHERE ID_Album = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    function get_idAlbum_with_name($pdo, $titre){
        $stmt = $pdo->prepare("SELECT ID_Album FROM Album WHERE Titre = ?");
        $stmt->bindParam(1, $titre);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['ID_Album'];
    }

    function get_img_album_with_artist_name(PDO $pdo, String $name){
        $stmt = $pdo->prepare("SELECT Pochette FROM Album WHERE ID_Artiste_By = (SELECT ID_Artiste FROM Artiste WHERE Nom = :name)");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['Pochette'];
    }

    function get_nom_with_mail(PDO $pdo, String $mail){
        $stmt = $pdo->prepare("SELECT Nom_utilisateur FROM Utilisateur WHERE Email = :Email");
        $stmt->bindParam(':Email', $mail);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['Nom_utilisateur'];
    }

    function get_id_with_artist_name(PDO $pdo, String $name){
        $name = ' '.$name;
        // echo 'console.log('.$name.')';
        $stmt = $pdo->prepare("SELECT ID_Artiste FROM Artiste WHERE Nom like '".$name."%'");
        // $stmt = $pdo->prepare("SELECT ID_Artiste FROM Artiste WHERE Nom = '".$name."\r\n'");
        $stmt->execute();
        $result = $stmt->fetch();
        // echo 'console.log('.$result['ID_Artiste'].')';   
        return $result['ID_Artiste'];
    }

    function get_name_with_id(PDO $pdo, int $id){
        $stmt = $pdo->prepare("SELECT Nom FROM Artiste WHERE ID_Artiste = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['Nom'];
    }

    function get_nom_artiste_with_id(PDO $pdo, int $id){
        $stmt = $pdo->prepare("SELECT Nom FROM Artiste WHERE ID_Artiste = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['Nom'];
    }

    // playlist

    function get_playlist_utilisateur(PDO $pdo, int $id){
        $stmt = $pdo->prepare("SELECT ID_Playlist, Nom FROM Playlist WHERE ID_Utilisateur = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    function get_playlist_with_id(PDO $pdo, int $id){
        $stmt = $pdo->prepare("SELECT ID_Playlist, ID_Utilisateur, Nom FROM Playlist WHERE ID_Playlist = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    function get_musique_with_idPlaylist(PDO $pdo, int $id){
        $stmt = $pdo->prepare("SELECT ID_Musique, ID_Playlist, Titre, Lien, ID_Album FROM Musique_Playlist NATURAL JOIN Musique WHERE ID_Playlist = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    function get_musique_in_album(PDO $pdo, int $id){
        $stmt = $pdo->prepare("SELECT ID_Musique, Titre, Lien, ID_Album FROM Musique WHERE ID_Album = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    function get_all_musiques(PDO $pdo){
        $stmt = $pdo->prepare("SELECT ID_Musique, Titre, Lien, ID_Album FROM Musique");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    function get_musique_by_name(PDO $pdo, String $name){
        $stmt = $pdo->prepare("SELECT ID_Musique, Titre, Lien, ID_Album FROM Musique WHERE Titre = :name");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    function get_playlist(PDO $pdo){
        $stmt = $pdo->prepare("SELECT ID_Playlist, ID_Utilisateur, Nom FROM Playlist");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    function get_playlist_visible(PDO $pdo, int $id){
        $stmt = $pdo->prepare("SELECT ID_Playlist, ID_Utilisateur, Nom FROM Playlist WHERE ID_Utilisateur != :id AND Nom != 'Titres Likés' AND Est_public = 1");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    function get_playlist_with_id_utilisateur(PDO $pdo, int $id){
        $stmt = $pdo->prepare("SELECT ID_Playlist, ID_Utilisateur, Nom FROM Playlist WHERE ID_Utilisateur = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    function getNote(PDO $pdo, int $idUt, int $idAlbum) {
        try {
            $stmt = $pdo->prepare(" SELECT Valeur, ID_Note FROM Note WHERE ID_Utilisateur = :idUt AND ID_Album = :idAlbum");
            $stmt->bindParam(':idUt', $idUt);
            $stmt->bindParam(':idAlbum', $idAlbum);
            $stmt->execute();
            $result = $stmt->fetch();
            if ($result == null) {
                return 0;
            }

        } catch (PDOException $e) {
            echo "Erreur lors de la récupération de la note : " . $e->getMessage();
        }
        return $result['Valeur'];
    }

    function getPlaylistTitreLikeUser($pdo, $id_utilisateur) {
        try {
            $NomPlaylist = "Titres Likés";
            $stmt = $pdo->prepare("SELECT ID_Playlist FROM Playlist WHERE ID_Utilisateur = ? AND Nom = ?");
            $stmt->bindParam(1, $id_utilisateur);
            $stmt->bindParam(2, $NomPlaylist);
            $stmt->execute();
            $result = $stmt->fetchAll();

            return $result[0]['ID_Playlist'];
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération de la playlist Titres Likés : " . $e->getMessage();
            return false;
        }
    }

function getMusiqueWithIdArtiste(PDO $pdo, $nomArtiste){
    try{
        $stmt = $pdo->prepare("SELECT ID_Musique, Titre, Lien, ID_Album FROM Musique NATURAL JOIN Album WHERE ID_Artiste_By = (SELECT ID_Artiste FROM Artiste WHERE Nom = :nom ) OR ID_Artiste_Parent = (SELECT ID_Artiste FROM Artiste WHERE Nom = :nom )");
        $stmt->bindParam(':nom', $nomArtiste);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    catch(PDOException $e){
        echo "Erreur lors de la récupération des musiques de l'artiste : ". $e->getMessage();
        return false;
    }
}

function getMusiqueDansPlaylist(PDO $pdo, $idPlaylist){
    try{
        $stmt = $pdo->prepare("SELECT ID_Musique, Titre, Lien, ID_Album FROM Musique_Playlist NATURAL JOIN Musique WHERE ID_Playlist = :idPlaylist");
        $stmt->bindParam(':idPlaylist', $idPlaylist);
        $stmt->execute();   
        $result = $stmt->fetchAll();
        if ($result == null) {
            return null;
        }
        return $result;
    }
    catch(PDOException $e){
        echo "Erreur lors de la récupération des musiques de la playlist : ". $e->getMessage();
        return false;
    }
}

function yaDesMusiqueDansPlaylist(PDO $pdo, $idPlaylist){
    try{
        $stmt = $pdo->prepare("SELECT ID_Musique FROM Musique_Playlist WHERE ID_Playlist = :idPlaylist");
        $stmt->bindParam(':idPlaylist', $idPlaylist);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if ($result == null){
            return false;
        }
        return true;
    }
    catch(PDOException $e){
        echo "Erreur lors de la récupération des musiques de la playlist : ". $e->getMessage();
        return false;
    }
}

function getArtisteBywhithIdMusique (PDO $pdo, $idMusique){
    try{
        $stmt = $pdo->prepare("SELECT Nom FROM Artiste WHERE ID_Artiste = (SELECT ID_Artiste_By FROM Album WHERE ID_Album = (SELECT ID_Album FROM Musique WHERE ID_Musique = :idMusique))");
        $stmt->bindParam(':idMusique', $idMusique);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['Nom'];
    }
    catch(PDOException $e){
        echo "Erreur lors de la récupération de l'artiste de la musique : ". $e->getMessage();
        return false;
    }
}

function getArtisteParentwhithIdMusique(PDO $pdo, $idMusique){
    try{
        // SELECT Nom FROM Artiste WHERE ID_Artiste = (
        $stmt = $pdo->prepare("SELECT ID_Artiste_Parent FROM Album WHERE ID_Album = (SELECT ID_Album FROM Musique WHERE ID_Musique = :idMusique)");
        $stmt->bindParam(':idMusique', $idMusique);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }
    catch(PDOException $e){
        echo "Erreur lors de la récupération de l'artiste de la musique : ". $e->getMessage();
        return false;
    }
}

function get_music_with_id(PDO $pdo, int $id){
    $stmt = $pdo->prepare("SELECT ID_Musique, Titre ,Lien, ID_Album  FROM Musique WHERE ID_Musique = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result;
}


function getNomArtiste(PDO $pdo, $idArtiste){
    try{
        $stmt = $pdo->prepare("SELECT Nom FROM Artiste WHERE ID_Artiste = :idArtiste");
        $stmt->bindParam(':idArtiste', $idArtiste);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['Nom'];
    }
    catch(PDOException $e){
        echo "Erreur lors de la récupération du nom de l'artiste : ". $e->getMessage();
        return false;
    }
}

function get_artistes_favoris(PDO $pdo, $id){
    try{
        $stmt = $pdo->prepare("SELECT ID_Artiste FROM Favoris_Artiste WHERE ID_Utilisateur = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    catch(PDOException $e){
        echo "Erreur lors de la récupération des artistes favoris : ". $e->getMessage();
        return false;
    }
}


function insertMusicPlaylist(PDO $pdo, int $idMusique, int $idPlaylist) {
    try {
        $stmt = $pdo->prepare("INSERT INTO Musique_Playlist (ID_Musique, ID_Playlist) VALUES (?, ?)");
        $stmt->bindParam(1, $idMusique);
        $stmt->bindParam(2, $idPlaylist);
        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout de la musique dans la playlist : " . $e->getMessage();
        return false;
    }
}

function get_albums_favoris(PDO $pdo, $id){
    try{
        $stmt = $pdo->prepare("SELECT ID_Album FROM Favoris_Album WHERE ID_Utilisateur = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    catch(PDOException $e){
        echo "Erreur lors de la récupération des albums favoris : ". $e->getMessage();
        return false;
    }
}

function get_playlist_locked(PDO $pdo, int $id){
    $stmt = $pdo->prepare("SELECT Est_public FROM Playlist WHERE ID_Playlist = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result[0]['Est_public'];
}

function get_playlist_liked_with_id(PDO $pdo, int $id){
    $liste = array();
    $stmt = $pdo->prepare("SELECT ID_Playlist FROM Favoris_Playlist WHERE ID_Utilisateur = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetchall();
    for ($i = 0; $i < count($result); $i++){
        $playlist = get_playlist_with_id($pdo, $result[$i]['ID_Playlist']);
        array_push($liste, $playlist);
    }
    return $liste;
}

function get_musiques_favoris(PDO $pdo, $id){
    try{
        $stmt = $pdo->prepare("SELECT ID_Musique FROM Favoris_Musique WHERE ID_Utilisateur = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    catch(PDOException $e){
        echo "Erreur lors de la récupération des musiques favoris : ". $e->getMessage();
        return false;
    }
}

function get_playlist_favoris(PDO $pdo, $id){
    try{
        $stmt = $pdo->prepare("SELECT ID_Playlist FROM Favoris_Playlist WHERE ID_Utilisateur = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    catch(PDOException $e){
        echo "Erreur lors de la récupération des playlists favoris : ". $e->getMessage();
        return false;
    }
}

