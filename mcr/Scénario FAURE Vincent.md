# FAURE Vincent

## Acte métier

L'utilisateur souhaite savoir si le terrain de motocross sera ouvert ce samedi. De plus, il veut obtenir plus d'informations sur les tarifs et les options disponibles.

## Solution

Consultation du site : https://motoclub-ruthenois.codelib.re/

## Scénario

**Ouvrir le plugin, taper about:blank dans la barre d'adresse, vider le cache, activer les bonnes pratiques**

### Première page : Accueil

1. Arrivée sur la page d'accueil du Moto Club Ruthénois.

**Mesure 1**

### Deuxième page : Description

1. Arrivée sur la page de description, l'utilisateur a accès à tous les types d'événements créés.

**Mesure 2**

2. L'utilisateur filtre les événements. Il veut voir si le terrain est ouvert ce week-end. Il remplit le filtre "Type" avec "Ouverture", le filtre "date" avec la "date de samedi" et le filtre "état" avec l'état "Créé".
3. Il appuie sur "Appliquer" les filtres.

**Mesure 3**

4. Il a maintenant accès à l'ouverture de samedi. Il clique dessus pour avoir plus d'informations.


**FIN**

## Mesures

## Premier run ecoindex
| Mesure | Requêtes | Taille | DOM | Ecoindex | Eau | CO2 | BP Rouges | BP Jaunes | BP Vertes |
|--------|----------|--------|-----|----------|-----|-----|-----------|-----------|-----------|
|       1|        14|    6261|   55|     78.31| 2,15| 1,43|          6|          1|         14|
|       2|        16|    2130|  196|     76,95| 2,19| 1,46|          6|          1|         14|
|       3|        16|    2130|   79|     80.59| 2,08| 1,39|          6|          1|         14|

## 2e run ecoindex
| Mesure | Requêtes | Taille | DOM | Ecoindex | Eau | CO2 | BP Rouges | BP Jaunes | BP Vertes |
|--------|----------|--------|-----|----------|-----|-----|-----------|-----------|-----------|
|       1|        13|    1041|   50|     87,79| 1,87| 1,24|          2|          1|         18|
|       2|        16|    2129|  197|     76,92| 2,19| 1,46|          3|          1|         17|
|       3|        16|    2129|   80|     80,56| 2,08| 1,39|          3|          1|         17|

## 3e run ecoindex
| Mesure | Requêtes | Taille | DOM | Ecoindex | Eau | CO2 | BP Rouges | BP Jaunes | BP Vertes |
|--------|----------|--------|-----|----------|-----|-----|-----------|-----------|-----------|
|       1|         9|     297|   43|     93,14| 1,71| 1,14|          1|          1|         19|
|       2|         9|     358|  190|     86,19| 1,91| 1,28|          2|          1|         18|
|       3|         6|     358|   73|     89,92| 1,80| 1,14|          2|          1|         18|
