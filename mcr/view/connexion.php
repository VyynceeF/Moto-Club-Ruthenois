<script src="../js/connexion.js"></script>

<div class="body-view">
    <div class="connexion-container">
        <div class="logo-container"><img class="logo" src="" /></div>     
        <div class="connexion">

            <form action="index.php" method="POST">
                <input type="hidden" name="controller" value="Compte">
                <input type="hidden" name="action" value="login">

                <section>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </section>
                <section>
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" required>
                </section>
                <section class="submit-container">
                    <label>Se connecter</label>
                    <button type="submit">
                        <div class="line-arrow high"></div>
                        <div class="line-arrow body"></div>
                        <div class="line-arrow low"></div>
                    </button>
                </section>  
            </form>
        </div>
    </div>
</div>