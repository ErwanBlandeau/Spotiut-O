<?php
class Accueil 
{
    private $data = [];

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data=$data;
    }

    public function afficher()
    {
        require 'src/provider/checkFichierDansDossier.php';
        $pdo = getPdo();

        echo '<div class="container-milieu-bottom">';

            // carousel pour les artistes
            echo '<div class="carousel-container">';
                echo '<h2 class="titre-carousel">Artistes que vous pourriez aimez</h2>';
                echo '<button class="carousel-btn left-btn"><img src="./images/fleche-gauche.png" alt="fleche gauche"></button>';
                echo '<div class="carousel-wrapper">';


                $artistes = get_all_artiste($pdo);
                // Vérifier si des données existent
                if (!empty($artistes)) {
                    // Parcourir chaque entrée musicale
                    foreach ($artistes as $entry) {
                        echo '<div class="carousel-slide">';
                        $lien_img = explode(' ', $entry[0]);

                        $imgVerif = get_img_album_with_artist_name(getPdo(), $entry[0]);

                        $path = './images/ARTISTES/';
                        $imgArtiste = trim($entry[0]).'.jpg';
                        $imgArtisteCondition = checkFileNameExists($path, $imgArtiste);

                        if ($imgArtisteCondition){
                            echo '<a href="index.php?action=artiste&id='. trim($entry[1]) .'"><img class="img-artiste" src="./images/ARTISTES/' . trim($entry[0]) . '.jpg" alt="Image de la pochette"></a>';
                        } else if ($imgVerif != null && !$imgArtisteCondition){
                            echo '<a href="index.php?action=artiste&id='. trim($entry[1]) .'"><img class="img-artiste" src="./images/ALBUMS/' . trim($imgVerif) . '" alt="Image de la pochette"></a>';
                        } else {
                            echo '<a href="index.php?action=artiste&id='. trim($entry[1]) .'"><img class="img-artiste" src="./images/ALBUMS/default.jpg" alt="Image de la pochette"></a>';
                        }
                        echo '<p>' . htmlspecialchars($entry[0]) . '</p>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>Aucune donnée trouvée.</p>';
                }

                echo '</div>';
                echo '<button class="carousel-btn right-btn"><img src="./images/fleche-droite.png" alt="fleche droite"></button>';
            echo '</div>';
        

            // carousel pour les contenus 'concu pour toi'
            echo '<div class="carousel-container">';
                echo '<h2 class="titre-carousel">Conçu pour toi</h2>';
                echo '<button class="carousel-btn left-btn"><img src="./images/fleche-gauche.png" alt="fleche gauche"></button>';
                echo '<div class="carousel-wrapper">';

                $albums = get_all_album($pdo);
                // Vérifier si des données existent
                if (!empty($albums)) {
                    // Parcourir chaque entrée musicale
                    foreach ($albums as $entry) {
                        $lien_img = $entry[3];
                        if (!str_starts_with(trim($lien_img), 'null')){
                            $entry[3] = "images/ALBUMS/".trim($lien_img);
                        } else {
                            $entry[3] = "images/ALBUMS/default.jpg";
                        }
                        echo '<div class="carousel-slide">';
                        // echo '<p><strong>Artiste:</strong> ' . htmlspecialchars($entry[0]) . '</p>';
                        // echo '<p><strong>Genre:</strong> ' . htmlspecialchars($entry[2]) . '</p>';
                        // echo '<p><strong>Année de sortie:</strong> ' . htmlspecialchars($entry[5]) . '</p>';
                        echo '<p>' . htmlspecialchars($entry[0]) . '</p>';
                        // echo '<a class="img-fav" href="#"><img src="images/coeurVide.png" alt="Image favoris"></a>';
                        echo '<a href="index.php?action=album&id='. trim($entry[6]) .'"><img class="img-album" src="' . htmlspecialchars($entry[3]) . '" alt="Image de la pochette"></a>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>Aucune donnée trouvée.</p>';
                }

                echo '</div>';
                echo '<button class="carousel-btn right-btn"><img src="./images/fleche-droite.png" alt="fleche droite"></button>';
            echo '</div>';


            
            $genres = get_all_genre($pdo);
            foreach ($genres as $genre){
                $albums = get_albums_with_genre($pdo, $genre[0]);

                // Vérifier si des données existent
                if (!empty($albums)) {
                echo '<div class="carousel-container">';
                    echo '<h2 class="titre-carousel">Du genre '. trim($genre[0]) .'</h2>';
                    echo '<button class="carousel-btn left-btn"><img src="./images/fleche-gauche.png" alt="fleche gauche"></button>';
                    echo '<div class="carousel-wrapper">';

                        // Parcourir chaque entrée musicale
                        foreach ($albums as $entry) {
                            $lien_img = $entry[3];
                            if (!str_starts_with(trim($lien_img), 'null')){
                                $entry[3] = "images/ALBUMS/".trim($lien_img);
                            } else {
                                $entry[3] = "images/ALBUMS/default.jpg";
                            }
                            echo '<div class="carousel-slide">';
                            // echo '<p><strong>Artiste:</strong> ' . htmlspecialchars($entry[0]) . '</p>';
                            // echo '<p><strong>Genre:</strong> ' . htmlspecialchars($entry[2]) . '</p>';
                            // echo '<p><strong>Année de sortie:</strong> ' . htmlspecialchars($entry[5]) . '</p>';
                            echo '<p>' . htmlspecialchars($entry[0]) . '</p>';
                            // echo '<a class="img-fav" href="#"><img src="images/coeurVide.png" alt="Image favoris"></a>';
                            echo '<a href="index.php?action=album&id='. trim($entry[6]) .'"><img class="img-album" src="' . htmlspecialchars($entry[3]) . '" alt="Image de la pochette"></a>';
                            echo '</div>';
                        }
            
                    echo '</div>';
                    echo '<button class="carousel-btn right-btn"><img src="./images/fleche-droite.png" alt="fleche droite"></button>';
                echo '</div>';
                
                }
            }
            
    }
}
