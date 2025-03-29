<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="/assets/css/index.css">
    <link rel="stylesheet" href="/assets/css/account.css">
    <link rel="stylesheet" href="/assets/css/components/header.css">
    <link rel="stylesheet" href="/assets/css/components/hobbies.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap" />
</head>
<body>
    <?php
        require_once "components/header.php";
        require_once "components/hobbies.php";
    ?>

    <div class="page">
        <div class="profile">
            <div class="img">
                <span class="material-symbols-outlined">person</span>
                <img id="profile_pic" src="" style="display: none" />
            </div>

            <form name="profile" method="POST" action="/controllers/UpdateUserProfileImageController.php" enctype="multipart/form-data" onsubmit="selectImage(event)">
                <button type="submit" class="edit-image">Modifier la photo de profile</button>
            </form>

            <form method="POST" action="/controllers/DisconnectController.php">
                <button type="submit" class="disconnect">Se déconnecter</button>
            </form>

            <form method="POST" action="/controllers/DeleteUserController.php">
                <button class="delete">Supprimer mon compte</button>
            </form>
        </div>

        <form id="accountForm" class="user" name="account" method="POST" action="/controllers/UpdateUserController.php" onsubmit="validateForm(event)">
            <p class="title">Vos informations</p>

            <div class="input disable" id="gender">
                <div class="container">
                    <p class="name">Genre</p>

                    <div class="right">
                        <p class="value"></p>
                    </div>
                </div>
            </div>

            <div class="input" id="lastname">
                <div class="container">
                    <p class="name">Nom</p>

                    <div class="right">
                        <p class="value"></p>
                        <span class="material-symbols-outlined">arrow_forward_ios</span>
                    </div>

                    <input type="text" name="lastname" placeholder="Entrez votre nom" />
                </div>
            </div>

            <div class="input" id="firstname">
                <div class="container">
                    <p class="name">Prénom</p>

                    <div class="right">
                        <p class="value"></p>
                        <span class="material-symbols-outlined">arrow_forward_ios</span>
                    </div>

                    <input type="text" name="firstname" placeholder="Entrez votre prénom" />
                </div>
            </div>

            <div class="input" id="email">
                <div class="container">
                    <p class="name">Adresse email</p>

                    <div class="right">
                        <p class="value"></p>
                        <span class="material-symbols-outlined">arrow_forward_ios</span>
                    </div>

                    <input type="email" name="email" placeholder="Entrez votre adresse email" />
                </div>
            </div>

            <div class="input" id="password">
                <div class="container">
                    <p class="name">Nouveau mots de passe</p>

                    <div class="right">
                        <p class="value top">******</p>
                        <span class="material-symbols-outlined">arrow_forward_ios</span>
                    </div>

                    <input type="password" name="password" placeholder="Entrez votre mots de passe" />
                </div>
            </div>

            <div class="input" id="dob">
                <div class="container">
                    <p class="name">Date de naissance</p>

                    <div class="right">
                        <p class="value"></p>
                        <span class="material-symbols-outlined">arrow_forward_ios</span>
                    </div>

                    <input type="date" name="dob" />
                </div>
            </div>

            <div class="input" id="city">
                <div class="container">
                    <p class="name">Ville</p>

                    <div class="right">
                        <p class="value"></p>
                        <span class="material-symbols-outlined">arrow_forward_ios</span>
                    </div>

                    <input type="text" name="city" placeholder="Entrez votre ville" />
                </div>
            </div>

            <div class="input" id="hobbies">
                <div class="container">
                    <p class="name">Loisirs</p>

                    <div class="right">
                        <p class="value"></p>
                        <span class="material-symbols-outlined">arrow_forward_ios</span>
                    </div>
                </div>
            </div>
            
            <button class="submit" type="submit">Sauvegarder les modifications</button>
        </form>
    </div>
    
    <script src="/assets/js/account.js"></script>
    <script src="/assets/js/components/hobbies.js"></script>
</body>
</html>