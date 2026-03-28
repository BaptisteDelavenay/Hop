<?php

    session_start();
    include("../../connexionBDD/connexionBDD.php");
    include("./niveau.php");
    include("./streak.php");

    // Passe la mission de "en cours" à "validée"
    $updateStatus = "UPDATE mission_assign SET statut = 'validee' WHERE id = :idMission;";
    $status = $db->prepare($updateStatus);
    $status->execute(array(
        "idMission" => $_POST["missionID"]

    ));

    // Ajoute le nombre de points gagné au total de l'utilisateur
    $updatePoints = "UPDATE user SET total_points = total_points+:points WHERE id = :idUser;";
    $points = $db->prepare($updatePoints);
    $points->execute(array(
        "points" => $_POST["missionPoints"],
        "idUser" => $_SESSION["collaborateur_id"]
    ));

    // Si les 2 requetes sont faites on envoie les données sous forme d'objet json 
    if ($status && $points) {

        $nouvelleStreak = incrementStreak($db, $_SESSION["collaborateur_id"]);

        $query = $db->prepare("SELECT total_points FROM user WHERE id = :id");
        $query->execute(["id" => $_SESSION["collaborateur_id"]]);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        $nouveauTotal = $user['total_points'];

        $infos = calculerInfosNiveau($nouveauTotal);

        echo json_encode([
            "success" => true,
            "nouveauNiveau" => $infos['niveau'],
            "nouveauxPointsRelatifs" => $infos['pointsRelatifs'],
            "nouvelObjectif" => (int)str_replace('/', '', $infos['seuilActuel']), // On enlève le "/" s'il existe
            "pointsGagnes" => (int)$_POST["missionPoints"],
            "nouvelleStreak" => $nouvelleStreak
        ]);
    }
    else{
        echo json_encode(["success"=>false]);
    }

    
?>