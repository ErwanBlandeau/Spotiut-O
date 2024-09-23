<?php

class editerMusique {
    private $id;
    private $nom;
    private $nomAlbum;

    public function __construct($id, $nom, $nomAlbum) {
        $this->id = $id;
        $this->nom = $nom;
        $this->nomAlbum = $nomAlbum;
    }

    public function afficher() {
        $pdo = getPdo();
        echo '<link rel="stylesheet" href="./css/editerArtiste.css">';

        echo '<div class="container-artiste">';

            echo '<form action="index.php?action=modifierMusique&idMusique='.trim($this->id).'" method="POST" class="container-info">';
                echo '<div class="container-top-edit">';
                    echo '<a class="btn-retour" href="index.php?action=musique&id='. trim($this->id) .'"><img src="./images/fleche-gauche.png" alt="fleche gauche"></a>';
                    echo '<h2>Éditer la musique "'. $this->nom .'"</h2>';
                echo '</div>';

                echo '<label for="nom">Nom de la musique</label>';
                echo '<input type="text" placeholder="Nom de la musique" name="nom" value="'. $this->nom .'">';

                echo '<label for="nomAlbum">Nom de l\'album</label>';
                $Albums = get_all_album($pdo);
                // echo '<input type="text" placeholder="Nom de l\'album" name="nomAlbum" value="'. $this->nomAlbum .'">';
                echo '<select name="nomAlbum">';
                foreach ($Albums as $Album) {
                    if ($Album['Titre'] == $this->nomAlbum) {
                        echo '<option value="'. $Album['Titre'] .'" selected>'. $Album['Titre'] .'</option>';
                    } else {
                        echo '<option value="'. $Album['Titre'] .'">'. $Album['Titre'] .'</option>';
                    }
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

