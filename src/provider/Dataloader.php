<?php

declare(strict_types=1);

class Dataloader {
    private $pdo;
    private $file;
    public function __construct(string $databaseName, string $file) {
        try {
            $this->pdo = new PDO('sqlite:' . "src/BDD/".$databaseName);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->file = $file;
            $_SESSION['pdo']["ligne1"] = "sqlite:" . "src/BDD/".$databaseName;
            $_SESSION['pdo']["ligne2"] = PDO::ATTR_ERRMODE;
            $_SESSION['pdo']["ligne3"] = PDO::ERRMODE_EXCEPTION;

        } catch (PDOException $e) {
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
        }
    }

    public function createTables(): bool {
        try {

              // Table Artiste
              $this->pdo->exec("CREATE TABLE IF NOT EXISTS Artiste (
                ID_Artiste INTEGER PRIMARY KEY AUTOINCREMENT,
                Nom TEXT UNIQUE
            )");
          

            // Table Album
            $this->pdo->exec("CREATE TABLE IF NOT EXISTS Album (
                ID_Album INTEGER PRIMARY KEY AUTOINCREMENT,
                Titre TEXT UNIQUE,
                Date_de_sortie INTEGER NOT NULL CHECK (Date_de_sortie <= 2024) ,
                Genre TEXT,
                Pochette TEXT,
                ID_Artiste_By INTEGER,
                ID_Artiste_Parent INTEGER,
                FOREIGN KEY (ID_Artiste_By) REFERENCES Artiste(ID_Artiste),
                FOREIGN KEY (ID_Artiste_Parent) REFERENCES Artiste(ID_Artiste)
            )");

            // Table typesUtilisateur
            $this->pdo->exec("CREATE TABLE IF NOT EXISTS typesUtilisateur (
                ID_typesUtilisateur INTEGER PRIMARY KEY AUTOINCREMENT,
                Nom_du_type TEXT UNIQUE
            )");


            // Table Utilisateur
            $this->pdo->exec("CREATE TABLE IF NOT EXISTS Utilisateur (
                ID_Utilisateur INTEGER PRIMARY KEY AUTOINCREMENT,
                Nom_utilisateur TEXT UNIQUE,
                Mot_de_passe TEXT,
                Email TEXT UNIQUE, 
                ID_types INTEGER,
                FOREIGN KEY (ID_types) REFERENCES typesUtilisateur(ID_typesUtilisateur)
            )");

            // Table Album_Playlist
            $this->pdo->exec("CREATE TABLE IF NOT EXISTS Album_Playlist (
                ID_Album INTEGER,
                ID_Playlist INTEGER,
                FOREIGN KEY (ID_Album) REFERENCES Album(ID_Album),
                FOREIGN KEY (ID_Playlist) REFERENCES Playlist(ID_Playlist)
            )");

            // Table Playlist
            $this->pdo->exec("CREATE TABLE IF NOT EXISTS Playlist (
                ID_Playlist INTEGER PRIMARY KEY AUTOINCREMENT,
                Nom TEXT,
                ID_Utilisateur INTEGER,
                Est_public INTEGER,
                FOREIGN KEY (ID_Utilisateur) REFERENCES Utilisateur(ID_Utilisateur)
            )");

            // Table Genre
            $this->pdo->exec("CREATE TABLE IF NOT EXISTS Genre (
                ID_Genre INTEGER PRIMARY KEY AUTOINCREMENT,
                Nom_du_genre TEXT UNIQUE
            )");

            // Table listeGenre
            $this->pdo->exec("CREATE TABLE IF NOT EXISTS listeGenre (
                ID_Genre INTEGER,
                ID_Album INTEGER,
                FOREIGN KEY (ID_Genre) REFERENCES Genre(ID_Genre),
                FOREIGN KEY (ID_Album) REFERENCES Album(ID_Album)
            )");

            // Table Note
            $this->pdo->exec("CREATE TABLE IF NOT EXISTS Note (
                ID_Note INTEGER PRIMARY KEY AUTOINCREMENT,
                Valeur INTEGER,
                ID_Utilisateur INTEGER,
                ID_Album INTEGER,
                FOREIGN KEY (ID_Utilisateur) REFERENCES Utilisateur(ID_Utilisateur),
                FOREIGN KEY (ID_Album) REFERENCES Album(ID_Album)
            )");

            // Table musique
            $this->pdo->exec("CREATE TABLE IF NOT EXISTS Musique (
                ID_Musique INTEGER PRIMARY KEY AUTOINCREMENT,
                Titre TEXT,
                Lien Text,
                ID_Album INTEGER,
                FOREIGN KEY (ID_Album) REFERENCES Album(ID_Album)
            )");

            // Table Musique_Playlist
            $this->pdo->exec("CREATE TABLE IF NOT EXISTS Musique_Playlist (
                ID_Musique INTEGER,
                ID_Playlist INTEGER,
                FOREIGN KEY (ID_Musique) REFERENCES Musique(ID_Musique),
                FOREIGN KEY (ID_Playlist) REFERENCES Playlist(ID_Playlist)
            )");

            // Table favoris Artiste 
            $this->pdo->exec("CREATE TABLE IF NOT EXISTS Favoris_Artiste (
                ID_Utilisateur INTEGER,
                ID_Artiste INTEGER,
                FOREIGN KEY (ID_Utilisateur) REFERENCES Utilisateur(ID_Utilisateur),
                FOREIGN KEY (ID_Artiste) REFERENCES Artiste(ID_Artiste)
            )");

            // Table favoris Album
            $this->pdo->exec("CREATE TABLE IF NOT EXISTS Favoris_Album (
                ID_Utilisateur INTEGER,
                ID_Album INTEGER,
                FOREIGN KEY (ID_Utilisateur) REFERENCES Utilisateur(ID_Utilisateur),
                FOREIGN KEY (ID_Album) REFERENCES Album(ID_Album)
            )");

            // Table favoris Musique
            $this->pdo->exec("CREATE TABLE IF NOT EXISTS Favoris_Musique (
                ID_Utilisateur INTEGER,
                ID_Musique INTEGER,
                FOREIGN KEY (ID_Utilisateur) REFERENCES Utilisateur(ID_Utilisateur),
                FOREIGN KEY (ID_Musique) REFERENCES Musique(ID_Musique)
            )");

            // Table Historique
            $this->pdo->exec("CREATE TABLE IF NOT EXISTS Historique (
                ID_Utilisateur INTEGER,
                recherche TEXT,
                FOREIGN KEY (ID_Utilisateur) REFERENCES Utilisateur(ID_Utilisateur)
            )");

            // Table favoris Playlist
            $this->pdo->exec("CREATE TABLE IF NOT EXISTS Favoris_Playlist (
                ID_Utilisateur INTEGER,
                ID_Playlist INTEGER,
                FOREIGN KEY (ID_Utilisateur) REFERENCES Utilisateur(ID_Utilisateur),
                FOREIGN KEY (ID_Playlist) REFERENCES Playlist(ID_Playlist)
            )");

            return true;
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }

    public function getPdo(): PDO {
        return $this->pdo;
    }
    
}
