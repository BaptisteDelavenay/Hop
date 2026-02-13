<?php
    include "../connexionBDD/connexionBDD.php";

    $prenom = $_POST["prenom"];
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $verifNewUtilisateur = "SELECT EXISTS(SELECT 1 FROM user WHERE prenom = :prenom AND nom = :nom AND email = :email);";
    $verifUtilisateur = $db->prepare($verifNewUtilisateur);
    $verifUtilisateur->execute(array(
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email
    ));

    $exists = $verifUtilisateur->fetchColumn();

    if ($exists) {
        echo "compte deja existant !";
        // header("Location: Connexion.php?CompteExistant");
    } 
    
    else {
        
        $nouvelUtilisateur = $db->prepare("INSERT INTO `user` (`id`, `nom`, `prenom`, `email`, `password`, `role`, `entrepriseID`, `totalPoints`, `missionsCompletees`, `streak`, `streakMax`, `derniereMissionDate`, `dateInscription`) VALUES (NULL, :nom, :prenom, :email, :password, 'employe', '1', '0', '0', '0', '0', NULL, current_timestamp());");
        $nouvelUtilisateur->execute(array(
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'password' => $password,
        ));

        echo "compte ajouté !";
    };
?>