<?php

    include "../../connexionBDD/connexionBDD.php";

    session_start();

    // Récupérer toutes les infos saisies dans les 2 formulaires
    $nomEntreprise = $_SESSION["tempo"]["nomEntreprise"];
    $activite = $_SESSION["tempo"]["activite"];
    $email = $_SESSION["tempo"]["email"];
    $password = $_SESSION["tempo"]["password"];
    // $photo = $_POST["photoDeProfil"];
    $photo = "defaut.png";

    // Vérifier si le compte existe déjà dans la bdd
    $verifNewEntreprise = "SELECT EXISTS(SELECT 1 FROM entreprise WHERE nom = :nom AND secteur_activite = :activite AND email = :email);";
    $verifEntreprise = $db->prepare($verifNewEntreprise);
    $verifEntreprise->execute(array(
        'nom' => $nomEntreprise,
        'activite' => $activite,
        'email' => $email
    ));

    $exists = $verifEntreprise->fetchColumn();

    // Vérifie si le compte existe déjà
    if ($exists) {
        echo "compte deja existant !";
        // header("Location: Connexion.php?CompteExistant");
    } 

    // Si il n'existe pas, on le créé
    else {
        
        $nouvelleEntreprise = $db->prepare("INSERT INTO entreprise (nom, secteur_activite, email, password, photo_profil, total_points, niveau_arene) VALUES (:nom, :activite, :email, :password, :photo, 0, 1)");
        $nouvelleEntreprise->execute(array(
            'nom'     => $nomEntreprise,
            'activite' => $activite,
            'email'   => $email,
            'password' => $password,
            'photo'   => $photo
        ));
        echo "compte ajouté !";
    };

?>