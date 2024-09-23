<?php
class Favoris 
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
        $this->data = $data;
    }

    public function afficher()
    {
        require 'src/provider/checkFichierDansDossier.php';
        $pdo = getPdo();
        // $playlists = get_playlist_favoris($pdo, $_SESSION['idUser']);
        $playlists = [];
        $artistes = get_artistes_favoris($pdo, $_SESSION['idUser']);
        $this->$data = $data;
        $titres = get_musiques_favoris($pdo, $_SESSION['idUser']);
        
?>
        <link rel="stylesheet" href="./css/search.css">

        <div class="container-milieu-bottom">
            <div class="div-navbar">
                <nav class="navbar">
                    <ul class="liste">
                        <?php
                        if ($_REQUEST['search'] == 'Tout') {
                            require 'src/search_filters/tout.php';    
                        } else if ($_REQUEST['search'] == 'Titres') {
                            require 'src/search_filters/titres.php'; 
                        } else if ($_REQUEST['search'] == 'Artistes') {
                            require 'src/search_filters/artistes.php'; 
                        } else if ($_REQUEST['search'] == 'Albums') {
                            require 'src/search_filters/albums.php'; 
                        } else if ($_REQUEST['search'] == 'Playlists') {
                            require 'src/search_filters/playlists.php'; 
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>

<?php
    }
}
?>