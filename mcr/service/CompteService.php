<?php

class CompteService{

    # Connexion au compte admin
    public function login($pdo, $password, $mail){
        
        $sql = "SELECT mail, nom, prenom FROM users WHERE mdp=:mdp AND mail=:mail";
        $searchStmt = $pdo->prepare($sql);
        $searchStmt->bindParam('mdp', $password);
        $searchStmt->bindParam('mail', $mail);
        $searchStmt->execute();

        $infos = [];

        while($row = $searchStmt->fetch()){
            $infos = [
                "nom" => $row['nom'],
                "prenom" => $row['prenom'],
                "mail" => $row['mail']
            ];
        }

        //Renvoie un tableau avec les infos de l'utilisateur si le id et mdp sont corrects, si connexion echouer le tab est vide
        return $infos;
    }
}