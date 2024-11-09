<?php

include("service/DescriptionService.php");

# Gestion de la page description et ajout, tout ce qui est relatif aux articles
class DescriptionController{

    private $descriptionService;

    public function __construct(){
        $this->descriptionService = new DescriptionService();
    }

    /**
     * To add a event
     */
    public function ajouter($pdo){

        $titre = htmlspecialchars($_POST["titre"]);
        $description = htmlspecialchars($_POST["description"]);
        $date = htmlspecialchars($_POST["date"]);
        $etat = htmlspecialchars($_POST["etat"]);
        $type = htmlspecialchars($_POST["type"]);
        $imagePath = $this->imageTraitment();

        $view = $this->addView($pdo);

        if(!$imagePath['isUpload']){
            $view->addValue("isAdd", false);
            $view->addValue("reponse", $imagePath['reponse']);
            return $view;
        }

        $isAdd = $this->descriptionService->addArticle($pdo, $titre, $description, $imagePath["reponse"], $date, $etat, $type);

        if($isAdd){
            $view->addValue("isAdd", true);
            return $view;
        }

        $view->addValue("isAdd", false);
        $view->addValue("reponse", "Une erreur s'est produite. Veuillez réessayer)");
        return $view;
    }

    # Traitement de l'image à télécharger
    private function imageTraitment(){
        if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
            $target_dir = "img/uploads/";
            $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
            $target_file = $target_dir . uniqid() . '.' . $imageFileType;
    
            // Vérification de la taille et type de l'image
            if (in_array($imageFileType, ["jpg", "jpeg", "png"]) && $_FILES["image"]["size"] <= 5000000) { 
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    // Compression et redimensionnement de l'image
                    $source_image = imagecreatefromstring(file_get_contents($target_file));
                    $original_width = imagesx($source_image);
                    $original_height = imagesy($source_image);

                    $new_height = 300;
                    $new_width = $new_width = round(($original_width / $original_height) * $new_height);

                    $resized_image = imagescale($source_image, $new_width, $new_height);
                    imagejpeg($resized_image, $target_file, 100); // Compression

                    return [
                        "isUpload" => true, 
                        "reponse" => $target_file
                    ];
                }
                return [
                    "isUpload" => false, 
                    "reponse" => "L'image est trop grande. La taille maximale autorisée est 5MB."
                ];

            }
            return [
                "isUpload" => false, 
                "reponse" => "Le format de l'image n'est pas autorisé. Seules les images JPG, JPEG et PNG sont acceptées."
            ];

        }
        return [
            "isUpload" => false, 
            "reponse" => "Veuillez sélectionner une image."
        ];
    }

    public function supprimer($pdo){
        $id = htmlspecialchars($_POST["id"]);
        $isRm = $this->descriptionService->supprimerParId($pdo, $id);

        $view = $this->index($pdo);
        $view->addValue("isRm", $isRm);
        return $view;
    }

    public function addView($pdo){
        $view= new View("ajout");

        $types = $this->descriptionService->getTypes($pdo);
        $etats = $this->descriptionService->getEtats($pdo);

        $view->addValue("types", $types);
        $view->addValue("etats", $etats);

        return $view;
    }

    public function index($pdo) {

        $types = $this->descriptionService->getTypes($pdo);
        $etats = $this->descriptionService->getEtats($pdo);

        $view = new View("description");
        $view->addValue("types", $types);
        $view->addValue("etats", $etats);

        return $view;
    }
}