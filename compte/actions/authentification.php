<?php

    session_start();

    include "../../connexionBDD/connexionBDD.php";

    $email = htmlentities($_POST["email"]);
    $password = $_POST["password"];
    $userType = $_POST["user_type"];

    // Si le type de l'utilisateur est entreprise, alors table = 'entreprise', sinon table = 'user'
    $table = ($userType === "entreprise") ? "entreprise" : "user";

    // Requete sql pour aller chercher tous les utilisateur pour vérifier plus tard si ils existent
    $selectAccount = $db->prepare("SELECT * FROM $table WHERE Email = :email");
    $selectAccount->execute(array(
        "email"=>$email
    ));
    $account = $selectAccount->fetch(PDO::FETCH_ASSOC);

    // Si le compte existe et que le mdp est correct
    if($account && password_verify($password, $account["password"])){
        // Si le role de la bdd correspond avec le role du formulaire
        if($account['role'] === $userType){
            $_SESSION['session_'.$userType]='OK';
            $_SESSION['user_id'] = $account['id'];
            // Choisi le fichier vers lequel l'utilisateur sera renvoyé en fonction de son rôle
            $redirection = ($userType === "entreprise") ? "accueilEntreprise.php" : "accueilCollaborateur.php";
            header("Location: ../../app/views/".$redirection);
            exit();
        }
    }
    else{
        echo "identifiant ou mot de passe incorrect";
    }

?>