<?php

class View{

    /**
     * Chemin d'acces à la vue
     */
    private $path;

    /**
     * Dictionnaire de valeurs à faire passer dans la page (Key -> nom de la variable, Value -> valeur que contien la variable)
     */
    private $values;

    /**
     * Construction d'une View, init du tableau de valeur et init du chemin d'acces à la vue
     */
    public function __construct($path){
        $this->path = $path;
        $this->values = array();
    }

    /**
     * Ajoute un couple (clé, valeur) au dico
     */
    public function addValue($key, $value){
        $this->values[$key] = $value;
        return $this;
    }

    /**
     * Construit le rendu de la page php
     */
    public function render(){
        /* Transform le dico en plusieurs variables (clé = nom de la var et valeur = valeur de la variable) */
        extract($this->values);

        if($this->path != "connexion"){
            include("view/header.php");
        }

        require("view/" . $this->path . ".php");

        if($this->path != "connexion"){
            include("view/footer.php");
        }
    }
}