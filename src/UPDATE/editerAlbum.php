<?php

class editerAlbum {
    private $id;
    private $titre;
    private $dateSortie;
    private $genre;
    private $pochette;
    private $idArtiste;
    private $idParent;

    public function __construct($id, $titre, $dateSortie, $genre, $pochette, $idArtiste, $idParent) {
        $this->id = $id;
        $this->titre = $titre;
        $this->dateSortie = $dateSortie;
        $this->genre = $genre;
        $this->pochette = $pochette;
        $this->idArtiste = $idArtiste;
        $this->idParent = $idParent;
    }

    public function afficher() {
        echo '<link rel="stylesheet" href="./css/editerArtiste.css">';

        echo '<div class="container-artiste">';

            echo '<form action="index.php?action=modifierAlbum&idAlbum='. trim($this->id) .'" method="POST" class="container-info">';
                echo '<div class="container-top-edit">';
                    echo '<a class="btn-retour" href="index.php?action=album&id='. trim($this->id) .'"><img src="./images/fleche-gauche.png" alt="fleche gauche"></a>';
                    echo '<h2>Éditer l\'album</h2>';
                echo '</div>';

                echo '<label for="titre">Titre de l\'album</label>';
                echo '<input type="text" placeholder="titre de l\'album" name="titre" value="'. trim($this->titre) .'">';

                echo '<label for="dateSortie">Date de sortie</label>';
                echo '<input type="text" name="dateSortie" value="'. trim($this->dateSortie) .'">';

                echo '<label for="genre">Genres de l\'album</label>';
                echo '<input type="text" placeholder="genre" name="genre" value="'. trim($this->genre) .'">';

                echo '<label for="image">Pochette de l\'album</label>';
                echo '<input type="text" placeholder="pochette" name="pochette" value="'. trim($this->pochette) .'">';

                echo '<label for="Artiste de l\'album">Artiste de l\'album</label>';
                $nomArtiste = getNomArtiste(getPdo(), $this->idArtiste);
                echo '<select name="nomArtiste">';
                    echo '<option value="'. trim($nomArtiste) .'">'. trim($nomArtiste) .'</option>';
                    $listeArtiste = get_all_artiste(getPdo());
                    foreach ($listeArtiste as $artiste) {
                        echo '<option value="'. trim($artiste['Nom']) .'">'. trim($artiste['Nom']) .'</option>';
                    }
                echo '</select>';

                echo '<label for="Parent de l\'ablum">Parent de l\'album</label>';
                $nomParent = getNomArtiste(getPdo(), $this->idParent);
                echo '<select name="nomParent">';
                    echo '<option value="'. trim($nomParent) .'">'. trim($nomParent) .'</option>';
                    $listeArtiste = get_all_artiste(getPdo());
                    foreach ($listeArtiste as $artiste) {
                        echo '<option value="'. trim($artiste['Nom']) .'">'. trim($artiste['Nom']) .'</option>';
                    }
                echo '</select>';

                if (isset($_REQUEST['erreur'])) {
                    echo '<p class="erreur">'. $_REQUEST['erreur'] .'</p>';
                    unset($_REQUEST['erreur']);
                }  

                echo '<input type="submit" value="Modifier">';
            echo '</form>';

        echo '</div>';
    }
}

