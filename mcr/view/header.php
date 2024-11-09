<?php 
$isLog = isset($_SESSION["mail"]) && isset($_SESSION["id"]) && $_SESSION["id"] == session_id();
?>
<?php
if($isLog){
?>
<div id="connecter">
    <p>Connecter : <?php echo $_SESSION["prenom"]; ?></p>
</div>
<?php
}
?>
<header>
    <div id="logo-container"><img id="logo" src="img/logo-100.png" /></div>
    <div class="container-menu">
        <input type="checkbox" id="show-menu">
        <label for="show-menu" class="burger-menu">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </label>
        <nav class="menu">
            <a href="index.php">ACCUEIL</a>
            <a href="index.php?controller=Description">DESCRIPTION</a>
            <a href="index.php?controller=Contact">CONTACT</a>
            <?php
            if($isLog){
            ?>
            <a id="deconnexion" href="index.php?controller=Compte&action=exit">DECONNEXION</a>
            <?php
            }
            ?>
        </nav>
    </div>
</header>