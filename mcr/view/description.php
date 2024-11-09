<script>
    const isLoged = "<?php echo $isLog; ?>";
</script>

<script type="application/javascript" src="./js/description.js"></script>

<div class="contenu">
    <div class="titre-contenu">
        <h1>Évènements</h1>
        <div class="line"></div>
    </div>
    <div class="filter-container">
        <div>
            <section>
                <label for="type">Type : </label>
                <select id="type" name="type">
                    <option value="Tout" selected>Tout</option>
                    <?php 
                    while($row = $types->fetch()){
                    ?>
                    <option value="<?php echo $row["nom"];?>"><?php echo $row["nom"];?></option>
                    <?php 
                    }
                    ?>
                </select>
            </section>
            <section>
                <label for="etat">Etat : </label>
                <select id="etat" name="etat">
                    <option value="Tout" selected>Tout</option>
                    <?php 
                    while($row = $etats->fetch()){
                    ?>
                    <option value="<?php echo $row["nom"];?>"><?php echo $row["nom"];?></option>
                    <?php 
                    }
                    ?>
                </select>
            </section>
            <section>
                <label for="date">Date : </label>
                <input type="date" id="date" name="date">
            </section>
            <button onclick="filter()">Appliquer</button>
        </div>
        <?php
        if($isLog){
        ?>
        <a id="add-article" href="index.php?controller=Description&action=addView">+</a>
        <?php
        }
        ?>
    </div>
    <?php 
    if($isLog){
        if(isset($isRm) && $isRm){
            echo "<p class='ok'>L'enregistrement a été supprimé avec succès.</p>";
        }else if(isset($isRm)){
            echo "<p class='non-ok'>Erreur lors de la suppression de l'article.</p>";
        }
    }
    ?>
    <div class="event-boxes">
    </div>
</div>