<?php
    session_start();
    include("../../connexionBDD/connexionBDD.php");

    // description récupérée dans le $_POST
    $description = $_POST["description"];

    // Information sur l'image de la photo de profil
    $fileName = $_FILES["image"]["name"];
    $fileSize = $_FILES["image"]["size"];
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    $extensionsAutorisees = ['jpg', 'jpeg', 'png', 'webp',];
    if (!in_array($fileExt, $extensionsAutorisees)) {
        $_SESSION["erreur"] = "Format d'image non valide (JPG, PNG, WEBP).";
        header("Location: ../views/nouveauPost.php.php");
        exit();
    }

    // Si la taille est au dessus de 5mo
    if ($fileSize > 5 * 1024 * 1024) {
        $_SESSION["erreur"] = "Fichier trop lourd (3Mo max) !";
        header("Location: ../views/inscriptionCollaborateurEtapeUn.php");
        exit();
    }

    // Créer un nouveau nom pour l'image
    $nouveauNom = md5(uniqid()) . "." . $fileExt;
    $destination = "../../uploads/feed/" . $nouveauNom;

    // Si tout c'est bien passé alors on insert le nouveau post dans la bdd
    if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)){

        $sql = "INSERT INTO `feed` (`id_utilisateur`, `description`, `image`, `nb_likes`) VALUES (:idUtilisateur, :description, :image,:nbLikes)";
        $nouveauPost = $db->prepare($sql);
        $nouveauPost->execute(array(
            'idUtilisateur'        => $_SESSION["collaborateur_id"],
            'description'     => $description,
            'image'      => $destination,
            'nbLikes' => 0
        ));

        // On redirige vers le feed
        header("Location: ../../app/views/EntrepriseCollaborateur.php");
        exit();
    }
    else{
        // Gestion des erreurs
        $_SESSION["erreur"] = "Problème lors de la publication";
        header("Location: ../views/nouveauPost.php");
        exit();
    }

?>