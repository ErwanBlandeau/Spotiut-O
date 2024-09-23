<div class="container-milieu-bottom">
    <div class="div-navbar">
        <nav class="navbar">
            <ul class="liste">
                <?php
                    if (!empty($titres || $artistes || $this->data || $playlists)) {
                        echo "<li class='navbar-item active'><a href='index.php?action=explorer&search=Tout'>Tout</a></li>";
                    }
                    if (!empty($titres)) {
                        echo "<li class='navbar-item'><a href='index.php?action=explorer&search=Titres'>Titres</a></li>";
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
    <main class="container-all-search">
        <div class="container-titres">
            <?php
            if (!empty($titres)) {
            ?>
                <h2>Titres</h2>
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

        <div class="container-albums">
            <?php
            if (!empty($this->data)) {
            ?>
            <h2>Albums</h2>
            <div class="results">
                <?php
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
                echo "</div>";
            }
            ?>
        </div>
        <div class="container-playlists">
            <?php
                if (!empty($playlists)) {
                    ?>
                    <h2>Playlists</h2>
                    <div class="results">
                    <?php
                        foreach ($playlists as $entry) {
                            echo '<div class="search-result">';
                            echo '<p>Playlist : ' . htmlspecialchars($entry[2]) . '</p>';
                            echo '</div>';
                        }
                    echo "</div>";

                }
                ?>
        </div>
        <div class="container-artistes">
            <?php
                if (!empty($artistes)) {
            ?>
            <h2>Artistes</h2>
            <div class="results">
                <?php
                    
                        // Parcourir chaque entrée musicale
                        foreach ($artistes as $entry) {
                            $lien_img = explode(' ', $entry[0]);
            
                            $imgVerif = get_img_album_with_artist_name(getPdo(), $entry[0]);
            
                            $path = './images/ARTISTES/';
                            $imgArtiste = trim($entry[0]).'.jpg';
                            $imgArtisteCondition = checkFileNameExists($path, $imgArtiste);
                            echo '<div class="search-result">';
                                echo '<p>' . htmlspecialchars($entry[0]) . '</p>';
                                if ($imgArtisteCondition){
                                    echo '<a href="index.php?action=artiste&id='. trim($entry[1]) .'"><img class="img-artiste" src="./images/ARTISTES/' . trim($entry[0]) . '.jpg" alt="Image de la pochette"></a>';
                                } else if ($imgVerif != null && !$imgArtisteCondition){
                                    echo '<a href="index.php?action=artiste&id='. trim($entry[1]) .'"><img class="img-artiste" src="./images/ALBUMS/' . trim($imgVerif) . '" alt="Image de la pochette"></a>';
                                } else {
                                    echo '<a href="index.php?action=artiste&id='. trim($entry[1]) .'"><img class="img-artiste" src="./images/ALBUMS/default.jpg" alt="Image de la pochette"></a>';
                                }
                            echo '</div>';
                        }
                echo "</div>";
                }
                ?>
        </div>
    </main>
</div>