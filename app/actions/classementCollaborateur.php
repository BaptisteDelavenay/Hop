<?php

    // /!\ PAS DE SESSIONS START NI DE INCLUDE A LA CONNEXION DE LA BDD CAR IL EST PRESENT DANS LE FICHIER PRINCIPAL

    if(isset($_SESSION["session_collaborateur"])=="OK"){

        // Récupère la liste de tous les collaborateurs de l'entreprise
        $getUserList = $db->prepare("SELECT * FROM `user` WHERE entreprise_id = :entrepriseID ORDER BY total_points DESC;");
        $getUserList->execute(['entrepriseID' => $_SESSION["collaborateur_entreprise_id"]]);
        $userList = $getUserList->fetchAll(PDO::FETCH_ASSOC);
    }
    elseif(isset($_SESSION["session_entreprise"])=="OK"){

        // Récupère la liste de tous les collaborateurs de l'entreprise
        $getUserListEntreprise = $db->prepare("SELECT * FROM `user` WHERE entreprise_id = :entrepriseID ORDER BY total_points DESC;");
        $getUserListEntreprise->execute(['entrepriseID' => $_SESSION["entreprise_id"]]);
        $userListEntreprise = $getUserListEntreprise->fetchAll(PDO::FETCH_ASSOC);
    }

?>