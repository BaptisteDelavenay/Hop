<?php
    include "../../connexionBDD/connexionBDD.php";

    session_start();

    $prenom = $_POST["prenom"];
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $entreprise = $_POST["entreprise"];

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
        
        $nouvelUtilisateur = $db->prepare("INSERT INTO `user` (`id`, `nom`, `prenom`, `email`, `password`, `role`, `entreprise_id`, `total_points`, `missions_completees`, `streak`, `streak_max`, `derniere_mission_date`, `date_inscription`) VALUES (NULL, :nom, :prenom, :email, :password, 'collaborateur', :entreprise, '0', '0', '0', '0', NULL, current_timestamp());");
        $nouvelUtilisateur->execute(array(
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'password' => $password,
            'entreprise' => $entreprise
        ));

        // Une fois le compte crée, on le connecte automatiquement
        $idUser = $db->lastInsertId(); // Récupère l'id de l'utilisateur qu'on vient d'insérer
        $_SESSION['session_collaborateur']='OK';
        $_SESSION['user_id'] = $idUser;
        header("Location: ../../app/views/accueilCollaborateur.php");
        exit();
    };
?>