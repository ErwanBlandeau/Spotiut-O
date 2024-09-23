<div class="container-milieu-bottom">
    <div class="div-navbar">
        <nav class="navbar">
            <ul class="liste">
                <?php
                        if (!empty($titres || $artistes || $this->data || $playlists)) {
                            echo "<li class='navbar-item'><a href='index.php?action=explorer&search=Tout'>Tout</a></li>";
                        }
                        if (!empty($titres)) {
                            echo "<li class='navbar-item active'><a href='index.php?action=explorer&search=Titres'>Titres</a></li>";
                        }
                        if (!empty($artistes)) {
                            echo "<li class='navbar-item'><a href='index.php?action=explorer&search=Artistes'>Artistes</a></li>";
                        }
                        if (!empty($this->data)) {
                            echo "<li class='navbar-item'><a href='index.php?action=explorer&search=Albums'>Albums</a></li>";
                        }
                        if (!empty($playlists)) {
                            echo "<li class='navbar-item'><a href='index.php?action=explorer&search=Playlists'>Playlists</a></li>";
                        }
                ?>
            </ul>
        </nav>
    </div>
    <?php
        $nb_results = count($titres);
        if ($nb_results > 0) {
            if ($nb_results == 1){
                echo '<h2 class="nb-results">' . $nb_results . ' résultat trouvé</h2>';
            } else { echo '<h2 class="nb-results">' . $nb_results . ' résultats trouvés</h2>';}
        } else {
            echo '<h2 class="nb-results">Aucun résultat trouvé</h2>';
        }
        if (!empty($titres)) {
    ?>
                <div class="results">
                    <table>
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Artiste</th>
                                <th>Album</th>
                                <th>Année</th>
                                <th>Genre</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // Parcourir chaque entrée musicale
                                foreach ($titres as $entry) {
                                    $album = get_album_with_id(getPdo(), $entry[3]);
                                    $artiste = get_artiste_with_id(getPdo(), $album[5]);
                                    $lien_img = explode(' ', $album[3]);
                                    if (!str_starts_with($lien_img[1], 'null')){
                                        $album[3] = "images/ALBUMS/" . trim($lien_img[1]);
                                    } else {
                                        $album[3] = "images/ALBUMS/default.jpg";
                                    }
                                    echo '<tr class="search-result">';
                                    echo '<td>';
                                    echo '<a href="index.php?action=musique&id='. trim($entry[0]) .'"><img class="img-titre" src="' . htmlspecialchars($album[3]) . '" alt="Image de la pochette">' . htmlspecialchars($entry[1]) . '</a>';
                                    echo '<td>' . htmlspecialchars($artiste[0]) . '</td>';
                                    echo '<td>' . htmlspecialchars($album[0]) . '</td>';
                                    echo '<td>' . htmlspecialchars($album[1]) . '</td>';
                                    echo '<td>' . htmlspecialchars($album[2]) . '</td>';
                                    echo '</tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            <?php
            }
            ?>
</div>