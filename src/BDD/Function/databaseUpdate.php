<?php

    require_once "database_exist.php";
    
    function update_utilisateur($pdo, $nom, $mdp, $email, $id_utilisateur){
        try {
            $smtp = $pdo->prepare("UPDATE Utilisateur SET Nom_utilisateur = :Nom_utilisateur, Mot_de_passe = :Mot_de_passe, Email = :Email WHERE ID_Utilisateur = :ID_Utilisateur");
            $smtp->bindParam(':Nom_utilisateur', $nom);
            $smtp->bindParam(':Mot_de_passe', $mdp);
            $smtp->bindParam(':Email', $email);
            $smtp->bindParam(':ID_Utilisateur', $id_utilisateur);
            $smtp->execute();
            echo 'modif user';
        } catch (PDOException $e) {
            echo 'erreur update user';
        }
    }
    
    function update_artiste($pdo, $nom, $id_artiste){
        try {
            $smtp = $pdo->prepare("UPDATE Artiste SET Nom = :Nom WHERE ID_Artiste = :ID_Artiste");
            $smtp->bindParam(':Nom', $nom);
            $smtp->bindParam(':ID_Artiste', $id_artiste);
            $smtp->execute();
            echo 'modif artiste';
        } catch (PDOException $e) {
            echo 'erreur update artiste';
        }
    }

    function update_favoris_album($pdo, $id_utilisateur, $id_album){
        try {
            $verif_favoris = favorisAlbumExiste($pdo, $id_utilisateur, $id_album);
            if($verif_favoris == false){
                $smtp = $pdo->prepare("INSERT INTO Favoris_Album (ID_Utilisateur, ID_Album) VALUES (:ID_Utilisateur, :ID_Album)");
                $smtp->bindParam(':ID_Utilisateur', $id_utilisateur);
                $smtp->bindParam(':ID_Album', $id_album);
                $smtp->execute();
            }
            else{
                $smtp = $pdo->prepare("DELETE FROM Favoris_Album WHERE ID_Utilisateur = :ID_Utilisateur AND ID_Album = :ID_Album");
                $smtp->bindParam(':ID_Utilisateur', $id_utilisateur);
                $smtp->bindParam(':ID_Album', $id_album);
                $smtp->execute();
            }
        }
        catch (PDOException $e) {
            echo 'erreur update favoris album';
        }
    }

    function update_favoris_musique($pdo, $id_utilisateur, $id_musique){
        try {
            $verif_favoris = favorisMusiqueExiste($pdo, $id_utilisateur, $id_musique);
            $idPlaylist = getPlaylistTitreLikeUser($pdo, $id_utilisateur);
            if($verif_favoris == false){
                $smtp = $pdo->prepare("INSERT INTO Favoris_Musique (ID_Utilisateur, ID_Musique) VALUES (:ID_Utilisateur, :ID_Musique)");
                $smtp->bindParam(':ID_Utilisateur', $id_utilisateur);
                $smtp->bindParam(':ID_Musique', $id_musique);
                $smtp->execute();
                insertMusicPlaylistFavoris($pdo, $id_musique, $idPlaylist);
            }
            else{
                $smtp = $pdo->prepare("DELETE FROM Favoris_Musique WHERE ID_Utilisateur = :ID_Utilisateur AND ID_Musique = :ID_Musique");
                $smtp->bindParam(':ID_Utilisateur', $id_utilisateur);
                $smtp->bindParam(':ID_Musique', $id_musique);
                $smtp->execute();
                deleteMusicPlaylistFavoris($pdo, $id_musique, $idPlaylist);
            }
        }
        catch (PDOException $e) {
            echo 'erreur update favoris musique';
        }
    }

    function update_favoris_artiste($pdo, $id_utilisateur, $id_artiste){
        try {
            $verif_favoris = favorisArtisteExiste($pdo, $id_utilisateur, $id_artiste);
            if($verif_favoris == false){
                $smtp = $pdo->prepare("INSERT INTO Favoris_Artiste (ID_Utilisateur, ID_Artiste) VALUES (:ID_Utilisateur, :ID_Artiste)");
                $smtp->bindParam(':ID_Utilisateur', $id_utilisateur);
                $smtp->bindParam(':ID_Artiste', $id_artiste);
                $smtp->execute();
            }
            else{
                $smtp = $pdo->prepare("DELETE FROM Favoris_Artiste WHERE ID_Utilisateur = :ID_Utilisateur AND ID_Artiste = :ID_Artiste");
                $smtp->bindParam(':ID_Utilisateur', $id_utilisateur);
                $smtp->bindParam(':ID_Artiste', $id_artiste);
                $smtp->execute();
            }
        }
        catch (PDOException $e) {
            echo 'erreur update favoris artiste';
        }
    }

    function update_favoris_playlist($pdo, $id_utilisateur, $id_playlist){
        try {
            $verif_favoris = favorisPlaylistExiste($pdo, $id_utilisateur, $id_playlist);
            if($verif_favoris == false){
                $smtp = $pdo->prepare("INSERT INTO Favoris_Playlist (ID_Utilisateur, ID_Playlist) VALUES (:ID_Utilisateur, :ID_Playlist)");
                $smtp->bindParam(':ID_Utilisateur', $id_utilisateur);
                $smtp->bindParam(':ID_Playlist', $id_playlist);
                $smtp->execute();
            }
            else{
                $smtp = $pdo->prepare("DELETE FROM Favoris_Playlist WHERE ID_Utilisateur = :ID_Utilisateur AND ID_Playlist = :ID_Playlist");
                $smtp->bindParam(':ID_Utilisateur', $id_utilisateur);
                $smtp->bindParam(':ID_Playlist', $id_playlist);
                $smtp->execute();
            }
        }
        catch (PDOException $e) {
            echo 'erreur update favoris playlist';
        }
    }


    function update_note($pdo, $note, $id_utilisateur, $id_album){
        try {
            $verif_note = note_Existe($pdo, $id_utilisateur, $id_album);
            if($verif_note == false){
                $smtp = $pdo->prepare("INSERT INTO Note (Valeur, ID_Utilisateur, ID_Album) VALUES (:Valeur, :ID_Utilisateur, :ID_Album)");
                $smtp->bindParam(':Valeur', $note);
                $smtp->bindParam(':ID_Utilisateur', $id_utilisateur);
                $smtp->bindParam(':ID_Album', $id_album);
                $smtp->execute();
            }
            else{
                $smtp = $pdo->prepare("UPDATE Note SET Valeur = :Valeur WHERE ID_Utilisateur = :ID_Utilisateur AND ID_Album = :ID_Album");
                $smtp->bindParam(':Valeur', $note);
                $smtp->bindParam(':ID_Utilisateur', $id_utilisateur);
                $smtp->bindParam(':ID_Album', $id_album);
                $smtp->execute();
            }
        }
        catch (PDOException $e) {
            echo 'erreur update note';
        }               
    }

    function update_album(PDO $pdo, string $nom, string $date, string $genre, string $pochette, int $ID_Artiste_By, int $ID_Artiste_Parent, int $idAlbum) {
        try {
            $stmt = $pdo->prepare("UPDATE Album SET Titre = :nom, Date_de_sortie = :dates, Genre = :genre, Pochette = :pochette, ID_Artiste_By = :idBy, ID_Artiste_Parent = :idParent WHERE ID_Album = :idAlbum");
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':dates', $date);
            $stmt->bindParam(':genre', $genre);
            $stmt->bindParam(':pochette', $pochette);
            $stmt->bindParam(':idBy', $ID_Artiste_By);
            $stmt->bindParam(':idParent', $ID_Artiste_Parent);
            $stmt->bindParam(':idAlbum', $idAlbum);
            $stmt->execute();
    
            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour de l'album : " . $e->getMessage();
            return false;
        }
    }
    

    function update_musique(PDO $pdo, String $titre, String $lien, int $idAlbum, int $idMusique){
        try {
            $stmt = $pdo->prepare("UPDATE Musique SET Titre = :titre, Lien = :lien, ID_Album = :idAlbum WHERE ID_Musique = :idMusique");
            $stmt->bindParam(':titre', $titre);
            $stmt->bindParam(':lien', $lien);
            $stmt->bindParam(':idAlbum', $idAlbum);
            $stmt->bindParam(':idMusique', $idMusique);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de la modification de la musique : " . $e->getMessage();
            return false;
        }
    }

    function insertArtiste($pdo, $nom){
        try {
            $stmt = $pdo->prepare("INSERT INTO Artiste (Nom) VALUES (:nom)");
            $stmt->bindParam(':nom', $nom);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout de l'artiste : " . $e->getMessage();
            return false;
        }
    }

    function insertMusique($pdo, $titre, $lien, $idAlbum){
        try {
            $stmt = $pdo->prepare("INSERT INTO Musique (Titre, Lien, ID_Album) VALUES (:titre, :lien, :idAlbum)");
            $stmt->bindParam(':titre', $titre);
            $stmt->bindParam(':lien', $lien);
            $stmt->bindParam(':idAlbum', $idAlbum);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout de la musique : " . $e->getMessage();
            return false;
        }
    }

    function insert_album($pdo, $titre, $dateSortie, $genre, $pochette, $nomArtiste, $nomParent){
        try {
            $stmt = $pdo->prepare("INSERT INTO Album (Titre, Date_de_sortie, Genre, Pochette, ID_Artiste_By, ID_Artiste_Parent) VALUES (:titre, :dateSortie, :genre, :pochette, :nomArtiste, :nomParent)");
            $stmt->bindParam(':titre', $titre);
            $stmt->bindParam(':dateSortie', $dateSortie);
            $stmt->bindParam(':genre', $genre);
            $stmt->bindParam(':pochette', $pochette);
            $stmt->bindParam(':nomArtiste', $nomArtiste);
            $stmt->bindParam(':nomParent', $nomParent);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout de l'album : " . $e->getMessage();
            return false;
        }
    }

    function lock_unlock_playlist($pdo, $id_playlist, $estVisible){
        try { 
            $stmt = $pdo->prepare("UPDATE Playlist SET Est_public = :estVisible WHERE ID_Playlist = :idPlaylist");
            $stmt->bindParam(':estVisible', $estVisible);
            $stmt->bindParam(':idPlaylist', $id_playlist);
            $stmt->execute();
            $stmt = $pdo->prepare("Delete from Favoris_Playlist where ID_Playlist = :idPlaylist");
            $stmt->bindParam(':idPlaylist', $id_playlist);
            $stmt->execute();
            
            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de la modification de la playlist : " . $e->getMessage();
            return false;
        }
        
    }
