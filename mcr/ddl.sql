-- CREATION DE LA BD --
-- CREATE DATABASE mcruthenois;

-- CREATION DES TABLES --
CREATE TABLE club(
    nom varchar(50) PRIMARY KEY,
    mail varchar(320) NOT NULL,
    insta varchar(100),
    facebook varchar(100),
    description TEXT
);

INSERT INTO club VALUES ("Moto Club Ruthénois", "mcruthenois@outlook.fr", "https://www.instagram.com/mcruthenois", "https://www.facebook.com/MCRuthenois", "Le Moto Club Ruthénois est un club dédié au motocross et à l'enduro, situé près de Rodez. Il offre un cadre idéal pour les passionnés de sports motorisés, avec des pistes adaptées aux débutants comme aux pilotes expérimentés. Le club met en avant des valeurs de camaraderie et de respect, créant un environnement accueillant pour ses membres. Accessible à tous, il permet de partager l’amour du deux-roues et de progresser dans une ambiance conviviale et dynamique.");

CREATE TABLE users(
    mail varchar(320) PRIMARY KEY,
    mdp varchar(20) NOT NULL,
    nom varchar(50) NOT NULL,
    prenom varchar(50) NOT NULL
);

INSERT INTO users VALUES ("vincent.faure12@gmail.com", "root", "FAURE", "Vincent");

CREATE TABLE etats(
    nom varchar(20) PRIMARY KEY
);

INSERT INTO etats VALUES ("En cours");
INSERT INTO etats VALUES ("Terminé");
INSERT INTO etats VALUES ("Créé");

CREATE TABLE infos_article(
    date_creation DATETIME NOT NULL,
    date_maj DATETIME NOT NULL,
    user_creation varchar(320) NOT NULL,
    user_maj varchar(320) NOT NULL,
    CONSTRAINT usercreation_fk FOREIGN KEY (user_creation) REFERENCES users(mail),
    CONSTRAINT usermaj_fk FOREIGN KEY (user_maj) REFERENCES users(mail),
    PRIMARY KEY (date_creation, user_creation)
);

CREATE TABLE type(
    nom varchar(25) PRIMARY KEY,
    couleur varchar(7) NOT NULL
);

INSERT INTO type VALUES ('Ouverture', '#00FF00');
INSERT INTO type VALUES ('Évènement', '#0000FF');
INSERT INTO type VALUES ('Information', '#FFFF00');

CREATE TABLE articles(
    id int AUTO_INCREMENT PRIMARY KEY,
    titre varchar(250) NOT NULL,
    description TEXT NOT NULL,
    image varchar(50) NOT NULL,
    date DATE NOT NULL,
    etat varchar(20) NOT NULL,
    type varchar(25) NOT NULL,
    date_creation DATETIME NOT NULL,
    user_creation varchar(320) NOT NULL, 
    CONSTRAINT type_fk FOREIGN KEY (type) REFERENCES type(nom),
    CONSTRAINT etat_fk FOREIGN KEY (etat) REFERENCES etats(nom),
    CONSTRAINT infos_fk FOREIGN KEY (date_creation, user_creation) REFERENCES infos_article(date_creation, user_creation)
);