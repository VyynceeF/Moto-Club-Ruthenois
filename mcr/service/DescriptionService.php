<?php

class DescriptionService {

    # Ajout d'un artcile en table
    public function addArticle($pdo, $titre, $description, $imagePath, $date, $etat, $type){
        try{
            // Récupérer la date et l'heure courantes
            $currentDateTime = date('Y-m-d H:i:s');

            $pdo->beginTransaction();

            $sql = "INSERT INTO infos_article VALUES (:dateCreation, :dateMaj, :userCreation, :userMaj)";
            $searchStmt = $pdo->prepare($sql);
            $searchStmt->bindParam('dateCreation', $currentDateTime);
            $searchStmt->bindParam('dateMaj', $currentDateTime);
            $searchStmt->bindParam('userCreation', $_SESSION["mail"]);
            $searchStmt->bindParam('userMaj', $_SESSION["mail"]);
            $searchStmt->execute();

            $sql = "INSERT INTO articles (titre, description, image, date, etat, type, date_creation, user_creation) 
            VALUES (:titre, :description, :image, :date, :etat, :type, :date_creation, :user_creation)";
    
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':titre' => $titre,
                ':description' => $description,
                ':image' => $imagePath,
                ':date' => $date,
                ':etat' => $etat,
                ':type' => $type,
                ':date_creation' => $currentDateTime,
                ':user_creation' => $_SESSION["mail"]
            ]);

            $pdo->commit();

            if ($stmt->rowCount() > 0) {
                return true;
            }
            return false;
        }catch(PDOException $e){
            $pdo->rollBack();
            return false;
        }
    }

    public function getTypes($pdo){
        $sql = "SELECT nom, couleur FROM type";
        $searchStmt = $pdo->prepare($sql);
        $searchStmt->execute();
        return $searchStmt; 
    }

    public function getEtats($pdo){
        $sql = "SELECT nom FROM etats";
        $searchStmt = $pdo->prepare($sql);
        $searchStmt->execute();
        return $searchStmt;
    }

    /**
     * Recuperer tous les articles
     */
    public function getArticles($pdo){
        $sql = "SELECT articles.id, articles.date, articles.titre, articles.description, articles.image, articles.etat, articles.type, type.couleur AS couleur FROM articles JOIN type ON articles.type = type.nom";
        $searchStmt = $pdo->query($sql);
        $articles = $searchStmt->fetchAll(PDO::FETCH_ASSOC);
        return $articles;
    }

    /**
     * Supprimer un article par son identifiant unique
     */
    public function supprimerParId($pdo, $id){

        $query = "DELETE FROM articles WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}