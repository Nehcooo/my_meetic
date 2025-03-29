<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="/assets/css/index.css">
    <link rel="stylesheet" href="/assets/css/home.css">
    <link rel="stylesheet" href="/assets/css/components/header.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap" />
</head>
<body>
    <?php
        require_once "components/header.php";
    ?>

    <div class="options">
        <p class="title">Recherche</p>

        <div class="menu" id="gender">
            <button><p>Genre</p><span></span></button>

            <div class="list">
                <div class="option">
                    <input type="checkbox" name="male" id="male" checked="true" />
                    <label for="male">Homme</label>
                </div>

                <div class="option">
                    <input type="checkbox" name="female" id="female" checked="true"  />
                    <label for="female">Femme</label>
                </div>

                <div class="option">
                    <input type="checkbox" name="other" id="other" checked="true" />
                    <label for="other">Autre</label>
                </div>
            </div>
        </div>

        <div class="menu" id="hobbies">
            <button><p>Loisirs</p><span></span></button>

            <div class="list">
                <div class="option">
                    <input type="checkbox" name="dance" id="dance" checked="true" />
                    <label for="dance">Dance</label>
                </div>

                <div class="option">
                    <input type="checkbox" name="skateboard" id="skateboard" checked="true"  />
                    <label for="skateboard">Skateboard</label>
                </div>

                <div class="option">
                    <input type="checkbox" name="manga" id="manga" checked="true" />
                    <label for="manga">Manga</label>
                </div>

                <div class="option">
                    <input type="checkbox" name="licorne" id="licorne" checked="true" />
                    <label for="licorne">Licorne</label>
                </div>

                <div class="option">
                    <input type="checkbox" name="cuisiner" id="cuisiner" checked="true" />
                    <label for="cuisiner">Cuisiner</label>
                </div>

                <div class="option">
                    <input type="checkbox" name="football" id="football" checked="true" />
                    <label for="football">Football</label>
                </div>

                <div class="option">
                    <input type="checkbox" name="sport" id="sport" checked="true" />
                    <label for="sport">Sport</label>
                </div>
            </div>
        </div>

        <div class="menu" id="city">
            <button><p>Ville</p><span></span></button>

            <div class="list">
                <div class="option">
                    <input type="checkbox" name="lyon" id="lyon" checked="true" />
                    <label for="lyon">Lyon</label>
                </div>

                <div class="option">
                    <input type="checkbox" name="paris" id="paris" checked="true"  />
                    <label for="paris">Paris</label>
                </div>

                <div class="option">
                    <input type="checkbox" name="marseille" id="marseille" checked="true" />
                    <label for="marseille">Marseille</label>
                </div>
            </div>
        </div>

        <div class="menu" id="age">
            <button><p>Âge</p><span></span></button>

            <div class="list">
                <div class="option">
                    <input type="checkbox" name="age1" id="age1" checked="true" />
                    <label for="age1">18/25</label>
                </div>

                <div class="option">
                    <input type="checkbox" name="age2" id="age2" checked="true" />
                    <label for="age2">25/35</label>
                </div>

                <div class="option">
                    <input type="checkbox" name="age3" id="age3" checked="true" />
                    <label for="age3">35/45</label>
                </div>

                <div class="option">
                    <input type="checkbox" name="age4" id="age4" checked="true" />
                    <label for="age4">45+</label>
                </div>
            </div>
        </div>

        <div class="search" onclick="setUsers()">
            <span class="material-symbols-outlined">search</span>
        </div>
    </div>

    <div class="page">
        <div class="arrow_left">
            <span class="material-symbols-outlined">chevron_left</span>
        </div>

        <div class="users">
        </div>

        <div class="arrow_right">
            <span class="material-symbols-outlined">chevron_right</span>
        </div>
    </div>
    
    <script src="/assets/js/home.js"></script>
</body>
</html>