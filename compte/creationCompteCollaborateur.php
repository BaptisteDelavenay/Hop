<?php
    include "../connexionBDD/connexionBDD.php";

    $prenom = $_POST["prenom"];
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $entreprise = $_POST["entreprise"];

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
        
        $nouvelUtilisateur = $db->prepare("INSERT INTO `user` (`id`, `nom`, `prenom`, `email`, `password`, `role`, `entreprise_id`, `total_points`, `missions_completees`, `streak`, `streak_max`, `derniere_mission_date`, `date_inscription`) VALUES (NULL, :nom, :prenom, :email, :password, 'employe', :entreprise, '0', '0', '0', '0', NULL, current_timestamp());");
        $nouvelUtilisateur->execute(array(
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'password' => $password,
            'entreprise' => $entreprise
        ));

        // echo "<br>";
        // echo $prenom;
        // echo "<br>";
        // echo $nom;
        // echo "<br>";
        // echo $email;
        // echo "<br>";
        // echo $password;
        // echo "<br>";
        // echo $entreprise;

        echo "compte ajouté !";
    };
?>