<?php

function insertUser(PDO $pdo,String $userName, String $usePassword, String $userEmail, int $idType) {
        try {
            $stmt = $pdo->prepare("INSERT INTO Utilisateur (Nom_utilisateur, Mot_de_passe, Email, ID_Types) VALUES (?, ?, ?, ?)");
            $stmt->bindParam(1, $userName);
            $stmt->bindParam(2, $usePassword);
            $stmt->bindParam(3, $userEmail);
            $stmt->bindParam(4, $idType);
            $stmt->execute();

            $idUt = get_id_utlisateur($pdo, $userEmail);
            insertPlaylist($pdo,"Titres Likés", $idUt);

            return $idUt;
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout de l'utilisateur : " . $e->getMessage();
    }
}  

function insertPlaylistCoupCoeur(PDO $pdo, int $idUt) {
    try {
        $titre = "Titres Likés";
        $stmt = $pdo->prepare("INSERT INTO Playlist (Nom, ID_Utilisateur) VALUES (?, ?)");
        $stmt->bindParam(1, $titre);
        $stmt->bindParam(2, $idUt);
        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout de la playlist : " . $e->getMessage();
        return false;
    }
}



function insertAlbumIntoFavori(PDO $pdo, int $idAlbum, int $idUt) {
    try {

        $stmt = $pdo->prepare("SELECT * FROM Playlist WHERE ID_Utilisateur = ?");
        $stmt->bindParam(1, $idUt);
        $stmt->execute();
        $playlist = $stmt->fetch();
        $idPlaylist = $playlist['ID_Playlist'];

        $stmt = $pdo->prepare("INSERT INTO Album_Playlist (ID_Album, ID_Playlist) VALUES (?, ?)");
        $stmt->bindParam(1, $idAlbum);
        $stmt->bindParam(2, $idPlaylist);
        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout de l'album dans les favoris : " . $e->getMessage();
        return false;
    }
}

function insertNote(PDO $pdo, int $valeur, int $idUt, int $idAlbum) {
    try {
        $stmt = $pdo->prepare("INSERT INTO Note (Valeur, ID_Utilisateur, ID_Album) VALUES (?, ?, ?)");
        $stmt->bindParam(1, $valeur);
        $stmt->bindParam(2, $idUt);
        $stmt->bindParam(3, $idAlbum);
        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout de la note : " . $e->getMessage();
        return false;
    }
}

function insertPlaylist(PDO $pdo, String $nom, int $idUt) {
    try {
        $estPublic = 0;
        $stmt = $pdo->prepare("INSERT INTO Playlist (Nom, ID_Utilisateur, Est_public) VALUES (?, ?, ?)");
        $stmt->bindParam(1, $nom);
        $stmt->bindParam(2, $idUt);
        $stmt->bindParam(3, $estPublic);
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout de la playlist : " . $e->getMessage();
        return false;
    }
}

function insertArtiste(PDO $pdo, String $nom, String $description, String $image) {
    try {
        $stmt = $pdo->prepare("INSERT INTO Artiste (Nom, Description, Image) VALUES (?, ?, ?)");
        $stmt->bindParam(1, $nom);
        $stmt->bindParam(2, $description);
        $stmt->bindParam(3, $image);
        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout de l'artiste : " . $e->getMessage();
        return false;
    }
}

function insertAlbum(PDO $pdo, String $nom, String $date, String $genre, String $pochette , int $ID_Artiste_By, int $ID_Artiste_Parent){

    try {
        $stmt = $pdo->prepare("INSERT INTO Album (Nom, Date_sortie, Genre, Pochette, ID_Artiste_By, ID_Artiste_Parent) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $nom);
        $stmt->bindParam(2, $date); 
        $stmt->bindParam(3, $genre);
        $stmt->bindParam(4, $pochette);
        $stmt->bindParam(5, $ID_Artiste_By);
        $stmt->bindParam(6, $ID_Artiste_Parent);
        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout de l'album : " . $e->getMessage();
        return false;
    }
}

function insertGenre(PDO $pdo, String $nom) {
    try {
        $stmt = $pdo->prepare("INSERT INTO Genre (Nom_du_genre) VALUES (?)");
        $stmt->bindParam(1, $nom);
        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout du genre : " . $e->getMessage();
        return false;
    }
}

function insertArtisteAlbum(PDO $pdo, int $idArtiste, int $idAlbum) {
    try {
        $stmt = $pdo->prepare("INSERT INTO Artiste_Album (ID_Artiste, ID_Album) VALUES (?, ?)");
        $stmt->bindParam(1, $idArtiste);
        $stmt->bindParam(2, $idAlbum);
        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout de l'artiste dans l'album : " . $e->getMessage();
        return false;
    }
}


function insertFavorisMusique(PDO $pdo, int $idMusique, int $idUt) {
    try {
        $stmt = $pdo->prepare("INSERT INTO  Favoris_Musique (ID_Musique, ID_Utilisateur) VALUES (?,?)");
        $stmt->bindParam(1, $idMusique);
        $stmt->bindParam(2, $idUt);
        $stmt->execute();
        $stmt-> $pdo->prepare("INSERT INTO Musique_Playlist (ID_Musique, ID_Playlist) VALUES (?, ?)");
        $stmt->bindParam(1, $idMusique);
        
        return true;
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout de la musique dans les favoris : ". $e->getMessage();
        return false;
    }
}

function insertFavorisArtiste(PDO $pdo, int $idArtiste, int $idUt) {
    try {
        $stmt = $pdo->prepare("INSERT INTO Favoris_Artiste (ID_Artiste, ID_Utilisateur) VALUES (?,?)");
        $stmt->bindParam(1, $idUt);
        $stmt->bindParam(2, $idArtiste);
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout de l'artiste dans les favoris : ". $e->getMessage();
        return false;
    }
}

function insertFavorisAlbum(PDO $pdo, int $idAlbum, int $idUt) {
    try {
        $stmt = $pdo->prepare("INSERT INTO Favoris_Album (ID_Album, ID_Utilisateur) VALUES (?,?)");
        $stmt->bindParam(1, $idUt);
        $stmt->bindParam(2, $idAlbum);
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout de l'album dans les favoris : ". $e->getMessage();
        return false;
    }
}

function insertMusicPlaylistFavoris(PDO $pdo, int $idMusique, int $idPlaylist) {
    try {
        $verifMusicInPlaylist = verifMusicInPlaylist($pdo, $idMusique, $idPlaylist);
        if($verifMusicInPlaylist == false){
            $stmt = $pdo->prepare("INSERT INTO Musique_Playlist (ID_Musique, ID_Playlist) VALUES (?, ?)");
            $stmt->bindParam(1, $idMusique);
            $stmt->bindParam(2, $idPlaylist);
            $stmt->execute();
        }
        else{
            $stmt = $pdo->prepare("DELETE FROM Musique_Playlist WHERE ID_Musique = ? AND ID_Playlist = ?");
            $stmt->bindParam(1, $idMusique);
            $stmt->bindParam(2, $idPlaylist);
            $stmt->execute();
        }
        return true;
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout de la musique dans la playlist : " . $e->getMessage();
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

function insertPlaylistFavoris(PDO $pdo, int $idPlaylist, int $idUt) {
    try {
        $stmt = $pdo->prepare("INSERT INTO Favoris_Playlist (ID_Utilisateur, ID_Playlist) VALUES (?, ?)");
        $stmt->bindParam(1, $idUt);
        $stmt->bindParam(2, $idPlaylist);
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout de la playlist dans les favoris : " . $e->getMessage();
        return false;
    }
}
