<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hop - Collaborateur</title>
    <link href="../../ASSETS/dist/output.css" rel="stylesheet">

</head>

<body class="bg-hop-violet pt-50">

    <?php
    session_start();

    include "../../connexionBDD/connexionBDD.php";
    include "../actions/missions.php";

    if ($_SESSION['session_collaborateur'] != 'OK') {
        // header("Location: ../../compte/views/connexion.php");
        echo "erreur de session";
    }
    ;

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

    function calculerNiveau($points)
    {
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
                return $niveau;
            }
        }

        return 1;
    }

    $totalpts = $infosUser["total_points"];
    $niveauActuel = calculerNiveau($totalpts);
    ?>

    <section class="bg-[#F8F6FF] p-4 w-full rounded-t-3xl min-h-screen">

        <div class="flex flex-col items-center -mt-20 mb-6">
            <div class="bg-black w-32 h-32 rounded-full overflow-hidden border-4 border-[#F8F6FF] shadow-lg">
                <img class="h-full w-full object-cover" src="<?= $pdp ?>" alt="Profil">
            </div>

            <div class="text-center mt-3">
                <h2 class="text-black text-3xl font-bold"><?= $_SESSION['collaborateur_prenom'] ?></h2>
            </div>

            <div class="bg-white border border-gray-300 rounded-3xl w-full mt-10 shadow-sm p-6">

                <div class="flex justify-center items-center gap-2 mb-6">
                    <div class="text-center">
                        <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider mb-1">niv.</p>
                        <p class="font-bold text-3xl leading-tight text-black"><?= $niveauActuel ?></p>
                    </div>
                </div>

                <div class="flex w-full items-start">

                    <div class="flex-1 flex flex-col items-center border-r border-gray-100">
                        <span class="text-3xl">🍃</span>
                        <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider mb-1">Nombre de points
                        </p>
                        <p class="font-bold text-2xl text-black"><?= $totalpts ?></p>
                    </div>

                    <div class="flex-1 flex flex-col items-center">
                        <span class="text-3xl">🏢</span>
                        <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider mb-1">Place entreprise
                        </p>
                        <p class="font-bold text-2xl text-black">#<?= $placeEntreprise ?></p>
                    </div>

                </div>
            </div>
        </div>

    </section>

    <?php include("../../composants/nav.php"); ?>

</body>