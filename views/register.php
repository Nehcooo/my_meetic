<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte</title>
    <link rel="stylesheet" href="/assets/css/index.css">
    <link rel="stylesheet" href="/assets/css/register.css">
    <link rel="stylesheet" href="/assets/css/components/hobbies.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=add" />
</head>
<body>
    <div class="page">
        <div class="infos">
            <img src="/assets/images/logo.png" draggable="false" />
            <p><span>Bienvenue</span> sur <span style="color: var(--pink)">MyMeetic</span></p>
        </div>

        <div class="container">
            <?php
                require_once "components/hobbies.php";
            ?>
            
            <form name="register" method="POST" action="/controllers/RegisterController.php" onsubmit="validateForm(event)">
                <p class="title">Créer un compte</p>

                <p class="text_account">Vous avez déjà un compte ? <a href="/login">Connectez-vous</a></p>

                <div class="checkbox">
                    <div class="input">
                        <label for="male">Homme</label>
                        <input type="radio" name="gender" value="male" id="male" required />
                    </div>

                    <div class="input">
                        <label for="female">Femme</label>
                        <input type="radio" name="gender" value="female" id="female" required />
                    </div>

                    <div class="input">
                        <label for="other">Autre</label>
                        <input type="radio" name="gender" value="other" id="other" required />
                    </div>
                </div>

                <div class="flex-input">
                    <div class="input">
                        <label for="firstname">Nom</label>
                        <input type="text" name="firstname" id="firstname" placeholder="Entrez votre nom" required />
                    </div>

                    <div class="input margin">
                        <label for="lastname">Prénom</label>
                        <input type="text" name="lastname" id="lastname" placeholder="Entrez votre prénom" required />
                    </div>
                </div>

                <div class="input">
                    <label for="email">Adresse email</label>
                    <input type="email" name="email" id="email" placeholder="Entrez votre adresse email" required />
                </div>

                <div class="input">
                    <label for="password">Mots de passe</label>
                    <input type="password" name="password" id="password" placeholder="Entrez votre mots de passe" required />
                </div>

                <div class="input">
                    <label for="dob">Date de naissance</label>
                    <input type="date" name="dob" id="dob" required />
                </div>

                <div class="input">
                    <label for="city">Ville</label>
                    <input type="text" name="city" id="city" placeholder="Entrez votre ville" required />
                </div>
                
                <button type="submit">S'inscrire</button>
            </form>
        </div>
    </div>

    <script src="/assets/js/register.js"></script>
    <script src="/assets/js/components/hobbies.js"></script>
</body>
</html>