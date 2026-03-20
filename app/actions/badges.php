<?php

    include("../../connexionBDD/connexionBDD.php");
    // Récupérer les missions du jour pour les afficher dans notre application
    $selectBadges = "SELECT mission_assign.id, mission_assign.statut, mission.titre, mission.description, mission.points_base, mission.difficulte FROM `mission_assign` INNER JOIN `mission` ON mission_assign.mission_id = mission.id WHERE mission_assign.user_id = :id AND mission_assign.date_assignation = CURDATE();";
    $badges = $db->prepare($selectBadges);
    $badges->execute(array(
        'id'=>$_SESSION["collaborateur_id"]
        ));
    $badges = $badges->fetchAll(PDO::FETCH_ASSOC);

    print_r($badges)

?>