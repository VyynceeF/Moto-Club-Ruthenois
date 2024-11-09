<div class="contenu">
    <div class="titre-contenu">
        <h1>Contactez-nous</h1>
        <div class="line"></div>
    </div>

    <?php
        if(isset($isSend) && $isSend){
            echo "<p class='ok'>Votre message a été envoyé avec succès !<p>";
        }else if(isset($isSend)){
            echo "<p class='non-ok'>Une erreur s'est produite. Veuillez réessayer.<p>";
        }
    ?>

    <form action="index.php" method="post">

        <input type="hidden" name="controller" value="Contact">
        <input type="hidden" name="action" value="send">

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required><br><br>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required><br><br>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="message">Message :</label>
        <textarea id="message" name="message" rows="5" required></textarea><br><br>

        <button type="submit">Envoyer</button>
    </form>
</div>