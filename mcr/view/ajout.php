<div class="contenu">
    <div class="titre-contenu">
        <h1>Ajouter un évènement</h1>
        <div class="line"></div>
    </div>

    <?php 
    if($isLog){
    ?>

    <?php
        if(isset($isAdd) && $isAdd){
            echo "<p class='ok'>Article ajouté avec succès!<p>";
        }else if(isset($isAdd)){
            echo "<p class='non-ok'>" . $reponse . "</p>";
        }
    ?>

    <form action="index.php" method="post" enctype="multipart/form-data">

        <input type="hidden" name="controller" value="Description">
        <input type="hidden" name="action" value="ajouter">

        <label for="titre">Titre:</label>
        <input type="text" id="titre" name="titre" required><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br>

        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required><br>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required><br>

        <label for="etat">Etat : </label>
        <select id="etat" name="etat" require>
            <?php 
            while($row = $etats->fetch()){
            ?>
            <option value="<?php echo $row["nom"];?>"><?php echo $row["nom"];?></option>
            <?php 
            }
            ?>
        </select><br>

        <label for="type">Type : </label>
        <select id="type" name="type" require>
            <?php 
            while($row = $types->fetch()){
            ?>
            <option value="<?php echo $row["nom"];?>"><?php echo $row["nom"];?></option>
            <?php 
            }
            ?>
        </select><br>

        <button type="submit">Ajouter l'article</button>
    </form>
    <?php
    }else {
        echo "Vous n'êtes pas connecté, vous ne pouvez pas acceder à cette page !";
    }
    ?>
</div>