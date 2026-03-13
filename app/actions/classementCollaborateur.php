<?php

    // /!\ PAS DE SESSIONS START NI DE INCLUDE A LA CONNEXION DE LA BDD CAR IL EST PRESENT DANS LE FICHIER PRINCIPAL

    // Récupère l'id de l'entreprise
    $getEntrepriseID = $db->prepare("SELECT entreprise_id FROM `user` WHERE prenom = :prenom");
    $getEntrepriseID->execute(['prenom' => $_SESSION["collaborateur_prenom"]]);
    $entrepriseID = $getEntrepriseID->fetch(PDO::FETCH_ASSOC);

    // Récupère la liste de tous les collaborateurs de l'entreprise
    $getUserList = $db->prepare("SELECT * FROM `user` WHERE entreprise_id = :entrepriseID ORDER BY total_points DESC;");
    $getUserList->execute(['entrepriseID' => $entrepriseID["entreprise_id"]]);
    $userList = $getUserList->fetchAll(PDO::FETCH_ASSOC);

?>