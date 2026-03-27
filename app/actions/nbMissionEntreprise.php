<?php
    // On compte le nombre de mission validées par les collaborateurs d'une entreprise  
    $QuerycountMission = "SELECT COUNT(mission_assign.id) FROM mission_assign INNER JOIN user ON user.id = mission_assign.user_id WHERE user.entreprise_id = :entrepriseID AND mission_assign.statut='validee';";
    $countMission = $db->prepare($QuerycountMission);
    $countMission->execute(array(
        'entrepriseID'=>$_SESSION["entreprise_id"]
        ));
    $countMission = $countMission->fetchColumn();
?>