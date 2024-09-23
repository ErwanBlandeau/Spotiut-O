<div class="container-milieu-bottom">
    <div class="div-navbar">
        <nav class="navbar">
            <ul class="liste">
                <?php
                    if (!empty($titres || $artistes || $this->data || $playlists)) {
                        echo "<li class='navbar-item'><a href='index.php?action=explorer&search=Tout'>Tout</a></li>";
                    }
                    if (!empty($titres)) {
                        echo "<li class='navbar-item'><a href='index.php?action=explorer&search=Titres'>Titres</a></li>";
                    }
                    if (!empty($artistes)) {
                        echo "<li class='navbar-item'><a href='index.php?action=explorer&search=Artistes'>Artistes</a></li>";
                    }
                    if (!empty($this->data)) {
                        echo "<li class='navbar-item active'><a href='index.php?action=explorer&search=Albums'>Albums</a></li>";
                    }
                    if (!empty($playlists)) {
                        echo "<li class='navbar-item'><a href='index.php?action=explorer&search=Playlists'>Playlists</a></li>";
                    }
                ?>
            </ul>
        </nav>
    </div>
    
    <?php
    $nb_results = count($this->data);
    if ($nb_results > 0) {
        if ($nb_results == 1){
            echo '<h2 class="nb-results">' . $nb_results . ' résultat trouvé</h2>';
        } else { echo '<h2 class="nb-results">' . $nb_results . ' résultats trouvés</h2>';}
    } else {
        echo '<h2 class="nb-results">Aucun résultat trouvé</h2>';
    }
    // Vérifier si des données existent
        if (!empty($this->data)) {
            // Parcourir chaque entrée musicale
            foreach ($this->data as $entry) {
                $lien_img = explode(' ', $entry[3]);
                if (!str_starts_with($lien_img[1], 'null')){
                    $entry[3] = "images/ALBUMS/" . trim($lien_img[1]);
                } else {
                    $entry[3] = "images/ALBUMS/default.jpg";
                }
                
                echo '<div class="search-result">';
                echo '<p>' . htmlspecialchars($entry[6]) . '</p>';
                echo '<a href="index.php?action=album&id='. trim($entry[1]) .'"><img src="' . htmlspecialchars($entry[3]) . '" alt="Image de la pochette"></a>';
                echo '</div>';
            }
        } else {
            echo '<p>Aucun résultat trouvé.</p>';
        }
    ?>
</div>