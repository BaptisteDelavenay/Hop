<?php

    include("../../connexionBDD/connexionBDD.php");

    // Récupère toutes les infos concernant le compte connecté
    $selectUser = "SELECT * FROM `user` WHERE id = :id;";
    $User = $db->prepare($selectUser);
    $User->execute(array(
        'id' => $_SESSION["collaborateur_id"]
    ));

    $infosUser = $User->fetch(PDO::FETCH_ASSOC);

    // Récupère le rang de l'utilisateur
    $sqlRank = "SELECT COUNT(*) + 1 AS rang FROM `user` WHERE total_points > :points";
    $queryRank = $db->prepare($sqlRank);
    $queryRank->execute(['points' => $infosUser["total_points"]]);


    $resultRank = $queryRank->fetch(PDO::FETCH_ASSOC);
    $placeEntreprise = $resultRank['rang'];

    $pdp = $infosUser["photo_profil"];

    function calculerInfosNiveau($points){
        $paliers = [
            10 => 10200,
            9 => 8200,
            8 => 6400,
            7 => 4800,
            6 => 3500,
            5 => 2400,
            4 => 1500,
            3 => 800,
            2 => 300,
            1 => 0
        ];

        foreach ($paliers as $niveau => $seuil) {
            if ($points >= $seuil) {
                // Points gagnés DANS ce niveau = Total - Seuil du niveau
                $pointsDansNiveau = $points - $seuil;
                
                return [
                    'niveau' => $niveau,
                    'pointsRelatifs' => $pointsDansNiveau,
                    'seuilActuel' => ($niveau < 10) ? ("/".$paliers[$niveau + 1] - $seuil) : ""
                ];
            }
        }
    }

    $totalpts = $infosUser["total_points"];
    $infosNiveau = calculerInfosNiveau($totalpts);

    $niveauActuel = $infosNiveau['niveau'];          
    $ptsProgression = $infosNiveau['pointsRelatifs']; 
    $seuil = $infosNiveau['seuilActuel']

    // echo "Niveau : " . $niveauActuel;
    // echo "<br>";
    // echo "Points dans ce niveau : " . $ptsProgression;

?>