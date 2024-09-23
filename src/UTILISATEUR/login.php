<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | Connecte toi sur Spotiut'o</title>
    <link rel="stylesheet" href="./css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@300;400;700&family=Hind+Siliguri:wght@300;400;500;600&family=Lexend:wght@200;300;400;500;600;700;800;900&family=M+PLUS+Rounded+1c:wght@100;300;400;500;700&family=Montserrat:wght@400;700&family=Noto+Sans:ital,wght@0,100;0,300;0,400;0,600;1,500&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="topbar">
        <a href="" class="logo-container">
            <img src="./images/logo.png" alt="logo" class="logo">
            <strong class="title">SPOTIUT'O</strong>
        </a>
    </nav>
    <main class="main-container">
        <h1 class="text-center">Connecte-toi</h1>
        <p id="subtitle-connexion" class="subtitle">Tu n'as pas encore de compte sur Spotiut'o ?<a id="btn-inscription">Inscription</a></p>
        <p id="subtitle-inscription" class="subtitle">Tu as déjà un compte sur Spotiut'o ?<a id="btn-connexion">Connexion</a></p>
        <form id="connexion-form" action="index.php?action=login" method="POST" class="form">
            <div class="form-group">
                <label for="email_username">Adresse e-mail ou Username</label>
                <input type="text" name="email_username" id="email_username" placeholder="Entrez votre adresse e-mail ou username">
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <div class="password-container">
                    <input type="password" name="password" id="password-connexion" placeholder="Entrez votre mot de passe">
                    <span id="toggle-password-connexion" onclick="">
                        👁️
                    </span>
                </div>
                <div class="password-hint">8 caractères min.</div>
            </div>    
            <button type="submit">Se connecter</button>
        </form>
        <form id="inscription-form" action="index.php?action=inscription" method="POST" class="form">
            <div class="form-group">
                <label for="email">Adresse e-mail</label>
                <input type="email" name="email" id="email" placeholder="Entrez votre adresse e-mail">
            </div>
            <div class="form-group">
                <label for="name">Pseudo</label>
                <input type="name" name="name" id="name" placeholder="Entrez votre pseudo">
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <div class="password-container">
                    <input type="password" name="password" id="password-inscription" placeholder="Entrez votre mot de passe">
                    <span id="toggle-password-inscription" onclick="">
                        👁️
                    </span>
                </div>
                <div class="password-hint">8 caractères min.</div>
            </div>    
            <button type="submit">S'inscrire</button>
        </form>
        <?php
        if ($_REQUEST != null){
            echo '<p class="erreur">'. $_REQUEST['erreur'] .'</p>';
        }
        ?>
    </main>
    <script src="./js/login.js"></script>
</body>