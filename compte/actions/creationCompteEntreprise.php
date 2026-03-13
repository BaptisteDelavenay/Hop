<?php

    include "../../connexionBDD/connexionBDD.php";

    session_start();

    // Récupérer toutes les infos saisies dans les 2 formulaires
    $nomEntreprise = $_SESSION["tempo"]["nomEntreprise"];
    $activite = $_SESSION["tempo"]["activite"];
    $email = $_SESSION["tempo"]["email"];
    $password = $_SESSION["tempo"]["password"];
    $photo = $_FILES["photoDeProfil"];

    // Variables concernant les infos de l'image qui seront utiles dans le code pour l'import de l'image
    $fileName = $_FILES["photoDeProfil"]["name"];
    $fileSize = $_FILES["photoDeProfil"]["size"];
    $FileExt = pathinfo($fileName, PATHINFO_EXTENSION);

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
        $_SESSION["erreur"] = "Compte déjà existant. Veuillez vous connectez !";
        header("Location: ../views/connexion.php");
        exit();
    } 

    // Si il n'existe pas, on le créé
    else {

        // Si l'image est supérieure à 3MO on ne l'accpete pas
        if ($fileSize > 3 * 1024 * 1024) {
            $_SESSION["erreur"] = "Fichier trop lourd !";
            header("Location: ../views/inscriptionEntrepriseEtapeUn.php");
            exit();
        }

        // Génère un nom unique
        $nouveauNom = md5(uniqid()).".".$FileExt;

        // Destination du fichier (dossier upload)
        $destination = "../../uploads/".$nouveauNom;
 
        function randomCode(){
            $randomCode = "";
            $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            for ($i=0; $i < 4; $i++) { 
                $randomNumber = rand(0, strlen($caracteres)-1);
                $randomCode .= $caracteres[$randomNumber];
            }
            return $randomCode;
        }

        if(move_uploaded_file($_FILES['photoDeProfil']['tmp_name'], $destination)){
            $nouvelleEntreprise = $db->prepare("INSERT INTO entreprise (nom, secteur_activite, email, password, code_unique, photo_profil, total_points, niveau_arene) VALUES (:nom, :activite, :email, :password, :codeUnique, :photo, 0, 1)");
            $nouvelleEntreprise->execute(array(
                'nom'     => $nomEntreprise,
                'activite' => $activite,
                'email'   => $email,
                'password' => $password,
                'codeUnique' => randomCode(),
                'photo'   => $destination
            ));

            // Une fois le compte crée, on le connecte automatiquement
            $idEntreprise = $db->lastInsertId(); // Récupère l'id de l'entreprise qu'on vient d'insérer
            $_SESSION['session_entreprise']='OK';
            $_SESSION['entreprise_id'] = $idEntreprise;
           
            header("Location: ../../app/views/accueilEntreprise.php");
            exit();        
        }
        
        else{
            $_SESSION["erreur"] = "Problème lors de l'importation de l'image. Veuillez Réessayer !";
            header("Location: ../views/inscriptionEntrepriseEtapeUn.php");
            exit();
        }

    };

?>