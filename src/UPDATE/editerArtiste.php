<?php

class editerArtiste {
    private $id;
    private $nom;

    public function __construct($id, $nom) {
        $this->id = $id;
        $this->nom = $nom;
    }

    public function afficher() {
        echo '<link rel="stylesheet" href="./css/editerArtiste.css">';

        echo '<div class="container-artiste">';

            echo '<form action="index.php?action=modifierArtiste&idArtiste='. trim($this->id) .'" method="POST" class="container-info">';
                echo '<div class="container-top-edit">';
                    echo '<a class="btn-retour" href="index.php?action=artiste&id='. trim($this->id) .'"><img src="./images/fleche-gauche.png" alt="fleche gauche"></a>';
                    echo '<h2>Éditer l\'artiste</h2>';
                echo '</div>';

                echo '<input type="text" placeholder="Nom de l\'artiste" name="nom" value="'. trim($this->nom) .'">';

                if (isset($_REQUEST['erreur'])) {
                    echo '<p class="erreur">'. $_REQUEST['erreur'] .'</p>';
                    unset($_REQUEST['erreur']);
                }  

                echo '<input type="submit" value="Modifier">';
            echo '</form>';

        echo '</div>';
    }
}

