<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="/assets/css/index.css">
    <link rel="stylesheet" href="/assets/css/login.css">
</head>
<body>
    <div class="page">
        <div class="infos">
            <img src="/assets/images/logo.png" draggable="false" />
            <p><span>Bienvenue</span> sur <span style="color: var(--pink)">MyMeetic</span></p>
        </div>

        <form method="POST" action="/controllers/LoginController.php">
            <p class="title">Connexion</p>

            <p class="text_account">Vous n'avez pas de compte ? <a href="/register">Créer un compte</a></p>

            <?php
                if (isset($_SESSION["login_error"])) {
                    echo "<div class='error'>
                            <p>Adresse email ou mots de passe invalide !</p>
                        </div>";

                    unset($_SESSION["login_error"]);
                }
            ?>

            <div class="input">
                <label for="email">Adresse email</label>
                <input type="email" name="email" id="email" placeholder="Entrez votre adresse email" required />
            </div>

            <div class="input">
                <label for="password">Mots de passe</label>
                <input type="password" name="password" id="password" placeholder="Entrez votre mots de passe" required />
            </div>

            <div class="input check">
                <label class="check" for="remember_me">Se souvenir de moi</label>
                <input class="check" type="checkbox" name="remember_me" id="remember_me" />
            </div>

            <button type="submit">Se connecter</button>
        </form>
    </div>    
</body>
</html>