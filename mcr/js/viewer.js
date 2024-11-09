let currentIndex = 0;
let images = [];

function loadViewer(){

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./IMGViewer/IMGViewer.xml", true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const xmlDoc = xhr.responseXML;
            const imagesXML = xmlDoc.getElementsByTagName("image");

            for (let i = 0; i < imagesXML.length; i++) {
                const src = imagesXML[i].getAttribute("src");
                const alt = imagesXML[i].getAttribute("alt");

                images.push({ src, alt });
            }

            showImg(currentIndex);
        }
    };

    xhr.send();
}

function showImg(index){
    const viewer = document.getElementById("image-viewer");
    viewer.innerHTML = ""; // Vide

    let img = document.createElement('img');
    img.src = images[index].src;
    img.alt = images[index].alt;

    viewer.appendChild(img);
}

// Fonction pour afficher l'image précédente
function showPrevImage() {
    currentIndex = (currentIndex > 0) ? currentIndex - 1 : images.length - 1;
    showImg(currentIndex);
}

// Fonction pour afficher l'image suivante
function showNextImage() {
    currentIndex = (currentIndex < images.length - 1) ? currentIndex + 1 : 0;
    showImg(currentIndex);
}

window.addEventListener('load', loadViewer());