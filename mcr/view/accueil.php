<script type="application/javascript" src="./js/viewer.js"></script>

<div class="contenu">
    <div class="titre-contenu">
        <h1>À propos de nous</h1>
        <div class="line"></div>
    </div>
    <section>
        <section id="desc-club">
            <h2><?php echo $nom; ?></h2>
            <p><?php echo $description; ?></p>
        </section>

        <div id="carrousel">
            <button id="prevButton" class="carousel-button" onclick="showPrevImage()"><</button>
            <section id="image-viewer">

            </section>
            <button id="prevButton" class="carousel-button" onclick="showNextImage()">></button>
        </div>
    </section>
</div>