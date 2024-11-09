<?php

class AccueilService {

    /**
     * Recuperer tous les infos club
     */
    public function getInfosClub($pdo){
        $sql = "SELECT mail, facebook, insta, description, nom FROM club";
        $searchStmt = $pdo->query($sql);
        $articles = $searchStmt->fetchAll(PDO::FETCH_ASSOC);
        return $articles;
    }
}