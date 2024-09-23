<?php

echo '<link rel="stylesheet" href="./css/compte.css">';

echo '<div class="container-compte">';

    echo '<form id="formUser" action="index.php?action=modifierUser" method="POST" class="container-info">';
        echo '<h2>Informations personnelles</h2>';
        echo '<input type="text" placeholder="Nom" name="nom" value="'. $_SESSION['nom'] .'">';
        echo '<input type="mail" placeholder="Mail" name="mail" value="'. $_SESSION['mail'] .'">';
        echo '<input type="password" name="mdp" placeholder="Mot de passe" value="'. $_SESSION['mdp'] .'">';
        echo '<input type="password" name="mdpVerif" placeholder="Confirmer mot de passe" value="'. $_SESSION['mdp'] .'">';

        if (isset($_REQUEST['erreur'])) {
            echo '<p class="erreur">'. $_REQUEST['erreur'] .'</p>';
            unset($_REQUEST['erreur']);
        }  

        echo '<input type="submit" value="Modifier">';
    echo '</form>';

    if ($_SESSION['IdType'] == 1){
        echo '<div class="container-btn-ajout">';
            echo '<button id="retour-form" style="display:none">Retour</button>';

            echo '<button id="btnAjoutAlbum">Ajouter un Album</button>';
            echo '<button id="btnAjoutArtiste">Ajouter un Artiste</button>';
            echo '<button id="btnAjoutMusique">Ajouter une Musique</button>';
        echo '</div>';

        ?>
        <form id="popupAjoutAlbum" action="index.php?action=insertAlbum" method="POST" class="container-info" style="display:none">

            <label class="label" for="titre">Titre de l'album</label>
            <input type="text" placeholder="Titre de l'album" name="titre">

            <label class="label" for="dateSortie">Date de sortie</label>
            <input type="text" placeholder="Ex : 2016" name="dateSortie">

            <label class="label" for="genre">Genres de l'album</label>
            <input type="text" placeholder="Genre" name="genre">

            <label class="label" for="image">Pochette de l'album</label>
            <input type="text" placeholder="Pochette" name="pochette">

            <label class="label" for="artiste">Artiste de l'album</label>
            <!-- <input type="text" placeholder="Nom de l'artiste" name="nomArtiste"> -->
            <select name="nomArtiste">
                <?php
                $Artistes = get_all_artiste($pdo);
                foreach ($Artistes as $Artiste) {
                    echo '<option value="'. $Artiste['Nom'] .'">'. $Artiste['Nom'] .'</option>';
                }
                ?>
            </select>

            <label class="label" for="parentAlbum">Parent de l'album</label>
            <!-- <input type="text" placeholder="Nom de l'artiste parent" name="nomParent"> -->
            <select name="nomParent">
                <?php
                $Artistes = get_all_artiste($pdo);
                foreach ($Artistes as $Artiste) {
                    echo '<option value="'. $Artiste['Nom'] .'">'. $Artiste['Nom'] .'</option>';
                }
                ?>
            </select>

            <input type="submit" value="Ajouter">
        </form>


        <form id="popupAjoutArtiste" action="index.php?action=insertArtiste" method="POST" class="container-info" style="display:none">
            <input type="text" placeholder="Nom de l'artiste" name="nom">
            <input type="submit" value="Ajouter">
        </form>

        <form id="popupAjoutMusique" action="index.php?action=insertMusique" method="POST" class="container-info" style="display:none" enctype="multipart/form-data">

            <label class="label" for="nom">Nom de la musique</label>
            <input type="text" placeholder="Nom de la musique" name="nom">

            <label class="label" for="musique">Lien de la musique</label>
            <input type="file" placeholder="sélectionner un fichier" name="fileMusique" accept="audio/mp3">

            <label class="label" for="nomAlbum">Album choisit</label>
            <?php
            $Albums = get_all_album($pdo);
            echo '<select name="nomAlbum">';
                foreach ($Albums as $Album) {
                    echo '<option value="'. $Album['Titre'] .'">'. $Album['Titre'] .'</option>';
                }
                echo '</select>';

            ?>
            <input type="submit" value="Ajouter">
        </form>

        <?php if (isset($_REQUEST['erreur'])): ?>
            <p class="erreur"><?= $_REQUEST['erreur'] ?></p>
            <?php unset($_REQUEST['erreur']); ?>
        <?php endif; ?>

        <script src="./js/popupAjout.js"></script>
        <?php
    }

    echo '<a href="index.php?action=deconnexion">Déconnexion</a>';

echo '</div>';
?>