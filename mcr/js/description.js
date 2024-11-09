let allArticles = []

function supprimer(event, id){
    event.stopPropagation()

    const formData = new URLSearchParams();  // Simule les données comme un formulaire
    formData.append('controller', 'Description');
    formData.append('action', 'supprimer');
    formData.append('id_unique', id);

     fetch('index.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: formData.toString()  // Convertit les données en chaîne comme un vrai formulaire
    });
}

function getArticles(){
    allArticles = []
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "https://vins.alwaysdata.net/mcr/api/ArticleApi.php/article", true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var articles = JSON.parse(xhr.responseText);
            allArticles = articles;
            displayArticles(articles);
        }
    };

    xhr.send();
}

function previsualiser(texte) {
    // Divise le texte en mots
    const mots = texte.split(/\s+/);

    if (mots.length > 8) {
      // Reconstitue la phrase
      phrase = mots.slice(0, 8).join(' ');
      return phrase + " ...";
    } else {
      return texte;
    }
  }

function displayArticles(articles) {
    var container = document.getElementsByClassName('event-boxes')[0];
    container.innerHTML = "";

    articles.forEach(function(article) {
        var section = document.createElement('section');
        section.className = 'box';
        section.addEventListener('click', function() {
            expandBox(this);
        });

        head = '';

        if(isLoged){
            head = `
            <div class="head-box">
                <p>${article.date}</p>

                <form method='POST' action='index.php' class='form-suppression'>
                    <input type='hidden' name='controller' value='Description'>
                    <input type='hidden' name='action' value='supprimer'>
                    <input type='hidden' name='id' value='${article.id}'>
                    <button type='submit'>-</button>
                </form>
            </div>
            `
        }else {
            head = `<p>${article.date}</p>`
        }

        section.innerHTML = head + `
            <div class="box-picture"><img class="img-article" src="${article.image}" /></div>
            <div class="title-container">
                <h4>${article.titre}</h4>
                <div>
                    <div class="stick ${article.etat}"></div>
                    <p>${article.etat}</p>
                </div>
            </div>
            <p class="id" style="display:none">${article.id}<p>
        `;
        var textType = document.createElement('p');
        textType.innerText = article.type;
        textType.className = 'label-type';
        textType.style.borderColor = article.couleur;
        section.appendChild(textType);

        var description = document.createElement('p');
        description.innerHTML = previsualiser(article.description);
        description.className = 'description';
        section.appendChild(description);

        container.appendChild(section);
    });
}

function filter(){
    const type = document.getElementById("type").value;
    const state = document.getElementById("etat").value;
    const date = document.getElementById("date").value;

    toDisplay = [];
    allArticles.forEach(function(article) {
        if((type == "Tout" || article.type == type) 
            && (state == "Tout" || article.etat == state) 
                && (date == "" || article.date == date)){
            toDisplay.push(article);
        }
    });

    displayArticles(toDisplay);
}

window.addEventListener('load', getArticles());

function findArticleById(id){
    let articleToFind;
    allArticles.forEach(function(article) {
        if(article.id == id){
            articleToFind = article;
            return;
        }
    });
    return articleToFind;
}

function expandBox(element) {
    const isExpanded = element.classList.contains("expanded");

    const id = element.querySelector(".id");
    const desc = element.querySelector(".description");
    const article = findArticleById(id.textContent);

    if (!isExpanded) {
        element.classList.add("expanded");
        desc.innerText = article.description;
    } else {
        element.classList.remove("expanded");
        desc.innerText = previsualiser(article.description);
    }
}