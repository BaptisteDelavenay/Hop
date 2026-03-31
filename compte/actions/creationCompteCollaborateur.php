<?php
    include "../../connexionBDD/connexionBDD.php";

    session_start();

    // Récupérer les informations stockées dans la SESSION 
    $prenom = $_SESSION["tempo"]["prenom"];
    $nom = $_SESSION["tempo"]["nom"];
    $email = $_SESSION["tempo"]["email"];
    $password = $_SESSION["tempo"]["password"];
    $code = $_SESSION["tempo"]["code"];

    // Information sur l'image de la photo de profil
    $fileName = $_FILES["photoDeProfil"]["name"];
    $fileSize = $_FILES["photoDeProfil"]["size"];
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Vérifier si l'utilisateur existe déjà
    $verifUtilisateur = $db->prepare("SELECT 1 FROM user WHERE email = :email");
    $verifUtilisateur->execute(['email' => $email]);

    if ($verifUtilisateur->fetchColumn()) {
        $_SESSION["erreur"] = "Compte déjà existant. Veuillez vous connecter !";
        header("Location: ../views/connexion.php");
        exit();
    }

    // Récupérer les infos de l'entreprise via le code unique
    $infoEntreprise = $db->prepare("SELECT id, code_unique FROM `entreprise` WHERE code_unique = :code");
    $infoEntreprise->execute(['code' => $code]);
    $donneesEntreprise = $infoEntreprise->fetch(PDO::FETCH_ASSOC);

    // Si le code n'est pas dans la bdd alors c'est un faux code, on ne poursuit pas la création de compte
    if (!$donneesEntreprise) {
        $_SESSION["erreur"] = "Code entreprise invalide.";
        header("Location: ../views/inscriptionCollaborateurEtapeUn.php");
        exit();
    }

    // Vérification du fichier
    $extensionsAutorisees = ['jpg', 'jpeg', 'png', 'webp',];
    if (!in_array($fileExt, $extensionsAutorisees)) {
        $_SESSION["erreur"] = "Format d'image non valide (JPG, PNG, WEBP).";
        header("Location: ../views/inscriptionCollaborateurEtapeUn.php");
        exit();
    }

    // Si la taille est au dessus de 3mo
    if ($fileSize > 3 * 1024 * 1024) {
        $_SESSION["erreur"] = "Fichier trop lourd (3Mo max) !";
        header("Location: ../views/inscriptionCollaborateurEtapeUn.php");
        exit();
    }

    // Créer un nouveau nom pour l'image
    $nouveauNom = md5(uniqid()) . "." . $fileExt;
    $destination = "../../uploads/" . $nouveauNom;

    // Si tout c'est bien passé alors on insert le nouvel utilisateur dans la bdd
    if (move_uploaded_file($_FILES['photoDeProfil']['tmp_name'], $destination)) {

        $sql = "INSERT INTO `user` (`nom`, `prenom`, `email`, `password`, `role`, `entreprise_id`, `photo_profil`, `total_points`, `missions_completees`, `streak`, `streak_max`, `derniere_mission_date`, `date_inscription`) VALUES (:nom, :prenom, :email, :password, 'collaborateur', :entreprise, :photo, 0, 0, 0, 0, NULL, CURRENT_TIMESTAMP())";
        $nouvelUtilisateur = $db->prepare($sql);
        $nouvelUtilisateur->execute(array(
            'nom'        => $nom,
            'prenom'     => $prenom,
            'email'      => $email,
            'password'   => $password,
            'entreprise' => $donneesEntreprise["id"], 
            'photo'      => $destination
        ));

        // Connexion automatique après inscription
        $_SESSION['session_collaborateur'] = 'OK';
        $_SESSION['collaborateur_id'] = $db->lastInsertId();
        $_SESSION['entreprise_collaborateur_id'] = $account['entreprise_collaborateur_id'];
        $_SESSION["collaborateur_prenom"] = $prenom;

        header("Location: ../../app/views/accueilCollaborateur.php");
        exit();

    } 
    else {
        // Gestion des erreurs
        $_SESSION["erreur"] = "Problème lors de l'importation de l'image.";
        header("Location: ../views/inscriptionCollaborateurEtapeUn.php");
        exit();
    }
?>