<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hop - Collaborateur</title>
    <link href="../../ASSETS/dist/output.css" rel="stylesheet">
    <style>
        @keyframes pulse-fire {

            0%,
            100% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.1);
                opacity: 0.8;
            }
        }

        .animate-fire {
            animation: pulse-fire 2s ease-in-out infinite;
        }
    </style>
</head>

<body class="bg-hop-violet pt-50">

    <?php
    session_start();

    include "../../connexionBDD/connexionBDD.php";
    include "../actions/missions.php";
    include "../actions/streak.php";

    if ($_SESSION['session_collaborateur'] != 'OK') {
        echo "erreur de session";
    }
    ;

    $selectUser = "SELECT * FROM `user` WHERE id = :id;";
    $User = $db->prepare($selectUser);
    $User->execute(array('id' => $_SESSION["collaborateur_id"]));
    $infosUser = $User->fetch(PDO::FETCH_ASSOC);

    $sqlRank = "SELECT COUNT(*) + 1 AS rang FROM `user` WHERE total_points > :points";
    $queryRank = $db->prepare($sqlRank);
    $queryRank->execute(['points' => $infosUser["total_points"]]);
    $resultRank = $queryRank->fetch(PDO::FETCH_ASSOC);
    $placeEntreprise = $resultRank['rang'];

    $pdp = $infosUser["photo_profil"];

    function calculerNiveau($points)
    {
        $paliers = [10 => 10200, 9 => 8200, 8 => 6400, 7 => 4800, 6 => 3500, 5 => 2400, 4 => 1500, 3 => 800, 2 => 300, 1 => 0];
        foreach ($paliers as $niveau => $seuil) {
            if ($points >= $seuil)
                return $niveau;
        }
        return 1;
    }

    $totalpts = $infosUser["total_points"];
    $niveauActuel = calculerNiveau($totalpts);

    $collaborateurId = $_SESSION["collaborateur_id"];
    // Appel de la fonction de streak.php
    $streakActuelle = checkAndGetStreak($db, $collaborateurId);

    // Conditions pour les badges de série
    $showStreak7 = ($infosUser['badge_7_atteint'] == 1);
    $showStreak14 = ($infosUser['badge_14_atteint'] == 1);
    ?>

    <section class="bg-[#F8F6FF] p-4 w-full rounded-t-3xl min-h-screen">

        <div class="flex flex-col items-center -mt-20 mb-6">
            <div class="relative">
                <div
                    class="bg-black w-32 h-32 rounded-full overflow-hidden border-4 border-[#F8F6FF] shadow-lg text-center">
                    <img class="h-full w-full object-cover" src="<?= $pdp ?>" alt="Profil">
                </div>

                <div
                    class="absolute bottom-0 right-0 bg-white border-4 border-[#F8F6FF] rounded-full px-3 py-1 flex items-center justify-center shadow-md z-10 gap-1 <?= ($streakActuelle > 0) ? 'animate-fire' : '' ?>">
                    <span class="text-lg leading-none">🔥</span>
                    <span class="text-base font-bold text-orange-500 leading-none"><?= $streakActuelle ?></span>
                </div>
            </div>

            <div class="text-center mt-4">
                <h2 class="text-black text-3xl font-bold"><?= $_SESSION['collaborateur_prenom'] ?></h2>
            </div>

            <div class="bg-white border border-gray-300 rounded-3xl w-full mt-10 shadow-sm p-6 text-center">
                <div class="flex justify-center items-center gap-2 mb-6">
                    <div class="text-center">
                        <p class="text-gray-400 text-[15px] uppercase font-bold tracking-wider mb-1">niv.</p>
                        <p class="font-bold text-3xl leading-tight text-black"><?= $niveauActuel ?></p>
                    </div>
                </div>

                <div class="flex w-full items-start">
                    <div class="flex-1 flex flex-col items-center border-r border-gray-100 text-center">
                        <span class="text-3xl">🍃</span>
                        <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider mb-1">Nombre de points
                        </p>
                        <p class="font-bold text-2xl text-black"><?= $totalpts ?></p>
                    </div>

                    <div class="flex-1 flex flex-col items-center text-center">
                        <span class="text-3xl">🏢</span>
                        <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider mb-1">Place entreprise
                        </p>
                        <p class="font-bold text-2xl text-black">#<?= $placeEntreprise ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full mt-10 pb-20">
            <h3 class="text-black text-2xl font-bold mb-6 text-center">Mes Badges</h3>

            <div class="grid grid-cols-3 gap-y-8 gap-x-4">

                <div class="flex flex-col items-center">
                    <?php if ($showStreak7): ?>
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-orange-400 to-red-500 rounded-2xl flex items-center justify-center shadow-lg border-2 border-orange-200">
                            <span class="text-3xl">🔥</span>
                        </div>
                        <p class="mt-2 text-orange-600 font-bold text-[10px] uppercase text-center">Série 7j</p>
                    <?php else: ?>
                        <div
                            class="w-16 h-16 bg-gray-200 rounded-2xl flex items-center justify-center opacity-40 text-center">
                            <span class="text-gray-400 text-xl">🔒</span>
                        </div>
                        <p class="mt-2 text-gray-400 font-medium text-[10px] uppercase text-center">Série 7j</p>
                    <?php endif; ?>
                </div>

                <div class="flex flex-col items-center">
                    <?php if ($showStreak14): ?>
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-purple-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg border-2 border-purple-200">
                            <span class="text-3xl">⚡</span>
                        </div>
                        <p class="mt-2 text-purple-600 font-bold text-[10px] uppercase text-center">Série 14j</p>
                    <?php else: ?>
                        <div
                            class="w-16 h-16 bg-gray-200 rounded-2xl flex items-center justify-center opacity-40 text-center">
                            <span class="text-gray-400 text-xl">🔒</span>
                        </div>
                        <p class="mt-2 text-gray-400 font-medium text-[10px] uppercase text-center">Série 14j</p>
                    <?php endif; ?>
                </div>

                <?php
                for ($i = 1; $i <= 10; $i++):
                    $estDebloque = ($niveauActuel >= $i);
                    ?>
                    <div class="flex flex-col items-center">
                        <?php if ($estDebloque): ?>
                            <div class="w-16 h-16 flex items-center justify-center">
                                <img src="../../IMG/badges/badge<?= $i ?>.svg" class="w-full h-full object-contain">
                            </div>
                            <p class="mt-2 text-black font-bold text-[10px] uppercase text-center">Niveau <?= $i ?></p>
                        <?php else: ?>
                            <div
                                class="w-16 h-16 bg-gray-200 rounded-2xl flex items-center justify-center opacity-40 text-center">
                                <span class="text-gray-400 text-xl">🔒</span>
                            </div>
                            <p class="mt-2 text-gray-400 font-medium text-[10px] uppercase text-center">Niveau <?= $i ?></p>
                        <?php endif; ?>
                    </div>
                <?php endfor; ?>

            </div>
        </div>
    </section>

    <?php include("../../composants/nav.php"); ?>

</body>

</html>