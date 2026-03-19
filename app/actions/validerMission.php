<?php

    include("../../connexionBDD/connexionBDD.php");

    $updateStatus = "UPDATE mission_assign SET statut = 'validee' WHERE id = :idMission OR 1=2;";
    $status = $db->prepare($updateStatus);
    $status->execute(array(
        "idMission" => $_POST["missionID"]
    ));

    if ($status) {
        echo json_encode(["success"=>true]);
    }
    else{
        echo json_encode(["success"=>false]);
    }

?>