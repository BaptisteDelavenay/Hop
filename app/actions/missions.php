<?php

    // Fichier à include dans accueilCollaborateur.php

    include("../../connexionBDD/connexionBDD.php");

    // PAS DE SESSION_START() CAR IL Y EN A DEJA UN DANS LE FICHIER PRINCIPAL !!!!! 

    // On regarde si l'utilisateur a deja des missions aujourd'hui
    $checkDailyMission = "SELECT COUNT(*) FROM `mission_assign` WHERE user_id = :id AND date_assignation = CURDATE();";
    $check = $db->prepare($checkDailyMission);
    $check->execute(array(
        'id'=>$_SESSION["collaborateur_id"]
        ));
    $check = $check->fetchColumn();

    // Si le résultat de la requête est 0, alors il n'a pas encore de missions pour aujourd'hui
    if ($check==0) {

        // On prend 3 missions au hasard dans la bdd
        $getDailyMission = "SELECT id FROM mission WHERE frequence = 'journaliere' ORDER BY RAND() LIMIT 3;";
        $DailyMission = $db->prepare($getDailyMission);
        $DailyMission->execute();
        $newDailyMission = $DailyMission->fetchAll(PDO::FETCH_ASSOC);

        // Puis on les insèrt dans la table mission_assign
        $insertDailyMission = "INSERT INTO `mission_assign` (`id`, `user_id`, `mission_id`, `date_assignation`, `date_validation`, `statut`, `preuve_url`, `preuve_texte`, `points_gagnes`, `multiplicateur`) VALUES (NULL, :idUser, :idMission, CURDATE(), NULL, 'en_cours', NULL, NULL, NULL, '1')";
        $insertMission = $db->prepare($insertDailyMission);
        foreach ($newDailyMission as $mission) {
            $insertMission->execute(array(
                'idUser'    => $_SESSION["collaborateur_id"],
                'idMission' => $mission["id"]
        ));
        }

        // On prend 3 missions au hasard dans la bdd (missions hebdomadaires)
        $getHebdoMission = "SELECT id FROM mission WHERE frequence = 'hebdomadaire' ORDER BY RAND() LIMIT 3;";
        $HebdoMission = $db->prepare($getHebdoMission);
        $HebdoMission->execute();
        $newHebdoMission = $HebdoMission->fetchAll(PDO::FETCH_ASSOC);

        // Puis on les insèrt dans la table mission_assign
        $insertNewHebdoMission = "INSERT INTO `mission_assign` (`id`, `user_id`, `mission_id`, `date_assignation`, `date_validation`, `statut`, `preuve_url`, `preuve_texte`, `points_gagnes`, `multiplicateur`) VALUES (NULL, :idUser, :idMission, CURDATE(), NULL, 'en_cours', NULL, NULL, NULL, '1')";
        $insertHebdoMission = $db->prepare($insertNewHebdoMission);
        foreach ($newHebdoMission as $HebdoMission) {
            $insertHebdoMission->execute(array(
                'idUser'    => $_SESSION["collaborateur_id"],
                'idMission' => $HebdoMission["id"]
        ));
        }
    }

    // Récupérer les missions du jour pour les afficher dans notre application
    $afficherMissionJournalieres = "SELECT mission_assign.id, mission.frequence,mission_assign.statut, mission.titre, mission.description, mission.points_base, mission.difficulte FROM `mission_assign` INNER JOIN `mission` ON mission_assign.mission_id = mission.id WHERE mission_assign.user_id = :id AND mission_assign.date_assignation = CURDATE() AND mission.frequence='journaliere'; ";
    $missionsJournalieres = $db->prepare($afficherMissionJournalieres);
    $missionsJournalieres->execute(array(
        'id'=>$_SESSION["collaborateur_id"]
        ));
    $missionsJournalieres = $missionsJournalieres->fetchAll(PDO::FETCH_ASSOC);

    // echo "<pre>";
    // print_r($missionsJournalieres);
    // echo "</pre>";

    // Récupérer les missions de la semaine pour les afficher dans notre application
    $afficherMissionHebdo = "SELECT mission_assign.id, mission.frequence,mission_assign.statut, mission.titre, mission.description, mission.points_base, mission.difficulte FROM `mission_assign` INNER JOIN `mission` ON mission_assign.mission_id = mission.id WHERE mission_assign.user_id = :id AND mission_assign.date_assignation = CURDATE() AND mission.frequence='hebdomadaire'; ";
    $missionsHebdo = $db->prepare($afficherMissionHebdo);
    $missionsHebdo->execute(array(
        'id'=>$_SESSION["collaborateur_id"]
        ));
    $missionsHebdo = $missionsHebdo->fetchAll(PDO::FETCH_ASSOC);

    // echo "<pre>";
    // print_r($missionsHebdo);
    // echo "</pre>";
?>