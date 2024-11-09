<footer>
    <section>
        <h2>Contact</h2>
        <hr>
        <p>Instagram | <a class="link-in-footer" href="https://www.instagram.com/mcruthenois">@mcruthenois</a></p>
        <p>Facebook | <a class="link-in-footer" href="https://www.facebook.com/MCRuthenois">Moto Club Ruthenois</a></p>
        <p>Mail | <a class="link-in-footer" href="index.php?controller=Contact">mcruthenois@outlook.fr</a></p>
    </section>
    <!--<section>
        <h2>Localisation</h2>
        <hr>
        <iframe width="350" height="150" src="https://www.openstreetmap.org/export/embed.html?bbox=2.5795125961303715%2C44.44132164661284%2C2.582747340202332%2C44.44371919135304&amp;layer=mapnik" style="border: 1px solid black"></iframe><br/><small><a href="https://www.openstreetmap.org/#map=18/44.442520/2.581130">Afficher une carte plus grande</a></small>
    </section>-->
    <section>
        <h2>Administration</h2>
        <hr>

        <?php
        if(!$isLog){
        ?>
        <p>Accéder à votre compte administrateur.</p> <a id="go-to-connexion" href="index.php?controller=Compte">Se connecter</a>
        <?php
        }else{
        ?>
        <p>Vous êtes connecté en tant que :</p>
        <p>NOM - <?php echo $_SESSION["nom"]; ?></p>
        <p>PRENOM - <?php echo $_SESSION["prenom"]; ?></p>
        <p>MAIL - <?php echo $_SESSION["mail"]; ?></p>
        <?php 
        }
        ?>
        
    </section>
</footer>