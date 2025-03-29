<?php

$uri = $_SERVER["REQUEST_URI"];

?>

<header>
    <div class="container">
        <img src="/assets/images/logo.png" draggable="false" />
        <p><span></span><span style="color: var(--pink)">MyMeetic</span></p>

        <div class="cat">
            <a class="<?php echo $uri == '/home' ? 'active' : '' ?>" href="/home">Accueil</a>
            <a class="<?php echo $uri == '/account' ? 'active' : '' ?>" href="/account">Mon compte</a>
            <a class="<?php echo $uri == '/message' ? 'active' : '' ?>" href="/message">Messagerie</a>
        </div>
    </div>
</header>