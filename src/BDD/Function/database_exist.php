
<?php
function note_Existe($pdo, $id_utilisateur, $id_album){
        try {
            $smtp = $pdo->prepare("SELECT * FROM Note WHERE ID_Utilisateur = :ID_Utilisateur AND ID_Album = :ID_Album");
            $smtp->bindParam(':ID_Utilisateur', $id_utilisateur);
            $smtp->bindParam(':ID_Album', $id_album);
            $smtp->execute();
            $result = $smtp->fetchAll();
            if(count($result) == 0){
                return false;
            }
            else{
                return true;
            }
        }
        catch (PDOException $e) {
            echo 'erreur note existe';
        }
    }

    function favorisAlbumExiste($pdo, $id_utilisateur, $id_album){
        try {
            $smtp=$pdo->prepare("SELECT * FROM Favoris_Album WHERE ID_Utilisateur = :ID_Utilisateur AND ID_Album = :ID_Album");
            $smtp->bindParam(':ID_Utilisateur', $id_utilisateur);
            $smtp->bindParam(':ID_Album', $id_album);
            $smtp->execute();
            $result = $smtp -> fetchAll();
            if(count($result) == 0){
                return false;
            }
            else{
                return true;
            }
        }
        catch (PDOException $e) {
            echo 'erreur favoris existe';
        } 
    }

    function favorisMusiqueExiste($pdo, $id_utilisateur, $id_Musique){
        try {
            $smtp=$pdo->prepare("SELECT * FROM Favoris_Musique WHERE ID_Utilisateur = :ID_Utilisateur AND ID_Musique = :ID_Musique");
            $smtp->bindParam(':ID_Utilisateur', $id_utilisateur);
            $smtp->bindParam(':ID_Musique', $id_Musique);
            $smtp->execute();
            $result = $smtp -> fetchAll();
            if(count($result) == 0){
                return false;
            }
            else{
                return true;
            }
        }
        catch (PDOException $e) {
            echo 'erreur favoris existe';
        } 
    }

    function favorisArtisteExiste($pdo, $id_utilisateur, $id_artiste){
        try {
            $smtp=$pdo->prepare("SELECT * FROM Favoris_Artiste WHERE ID_Utilisateur = :ID_Utilisateur AND ID_Artiste = :ID_Artiste");
            $smtp->bindParam(':ID_Utilisateur', $id_utilisateur);
            $smtp->bindParam(':ID_Artiste', $id_artiste);
            $smtp->execute();
            $result = $smtp -> fetchAll();
            if(count($result) == 0){
                return false;
            }
            else{
                return true;
            }
        }
        catch (PDOException $e) {
            echo 'erreur favoris existe';
        } 
    }

    function favorisPlaylistExiste($pdo, $id_utilisateur, $id_playlist){
        try {
            $smtp=$pdo->prepare("SELECT * FROM Favoris_Playlist WHERE ID_Utilisateur = :ID_Utilisateur AND ID_Playlist = :ID_Playlist");
            $smtp->bindParam(':ID_Utilisateur', $id_utilisateur);
            $smtp->bindParam(':ID_Playlist', $id_playlist);
            $smtp->execute();
            $result = $smtp -> fetchAll();
            if(count($result) == 0){
                return false;
            }
            else{
                return true;
            }
        }
        catch (PDOException $e) {
            echo 'erreur favoris existe';
        } 
    }

function verifMusicInPlaylist($pdo, $idMusique, $idPlaylist) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM Musique_Playlist WHERE ID_Musique = ? AND ID_Playlist = ?");
        $stmt->bindParam(1, $idMusique);
        $stmt->bindParam(2, $idPlaylist);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if(count($result) == 0){
            return false;
        }
        else{
            return true;
        }
    } catch (PDOException $e) {
        echo "Erreur lors de la vérification de la musique dans la playlist : " . $e->getMessage();
        return false;
    }
}

?>