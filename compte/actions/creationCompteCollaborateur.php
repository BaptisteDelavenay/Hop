<?php
    include "../../connexionBDD/connexionBDD.php";

    session_start();

    // Récupère les données du premier formulaire
    $prenom = $_SESSION["tempo"]["prenom"];
    $nom = $_SESSION["tempo"]["nom"];
    $email = $_SESSION["tempo"]["email"];
    $password = $_SESSION["tempo"]["password"];
    $entreprise = $_SESSION["tempo"]["entreprise"];

    $photo = $_FILES["photoDeProfil"];

    $fileName = $_FILES["photoDeProfil"]["name"];
    $fileSize = $_FILES["photoDeProfil"]["size"];
    $FileExt = pathinfo($fileName, PATHINFO_EXTENSION);

    // Vérifier si le compte existe déjà dans la bdd
    $verifNewUtilisateur = "SELECT EXISTS(SELECT 1 FROM user WHERE email = :email);";
    $verifUtilisateur = $db->prepare($verifNewUtilisateur);
    $verifUtilisateur->execute(array(
        'email' => $email
    ));

    $exists = $verifUtilisateur->fetchColumn();

    if ($exists) {
        echo "compte deja existant !";
        // header("Location: Connexion.php?CompteExistant");
    } 

    // Si il n'existe pas, on le créé
    else {

        // Si l'image est supérieure à 3MO on ne l'accpete pas
        if ($fileSize > 3 * 1024 * 1024) {
            die("Erreur : fichier trop lourd");
        }

        // Génère un nom unique
        $nouveauNom = md5(uniqid()).".".$FileExt;

        // Destination du fichier (dossier upload)
        $destination = "../../uploads/".$nouveauNom;

        if(move_uploaded_file($_FILES['photoDeProfil']['tmp_name'], $destination)){
            echo "fichier ajouté !";
        }
        else{
            die("Erreur : Problème lors de l'importation du fichier");
        }
        
        $nouvelUtilisateur = $db->prepare("INSERT INTO `user` (`id`, `nom`, `prenom`, `email`, `password`, `role`, `entreprise_id`, `photo_profil`, `total_points`, `missions_completees`, `streak`, `streak_max`, `derniere_mission_date`, `date_inscription`) VALUES (NULL, :nom, :prenom, :email, :password, 'collaborateur', :entreprise, :photo, '0', '0', '0', '0', NULL, current_timestamp());");
        $nouvelUtilisateur->execute(array(
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'password' => $password,
            'entreprise' => $entreprise,
            'photo' => $destination
        ));

        // Une fois le compte crée, on le connecte automatiquement
        $idUser = $db->lastInsertId(); // Récupère l'id de l'utilisateur qu'on vient d'insérer
        $_SESSION['session_collaborateur']='OK';
        $_SESSION['user_id'] = $idUser;
        $_SESSION["collaborateur_prenom"] = $prenom;
        header("Location: ../../app/views/accueilCollaborateur.php");
        exit();
    };
?>