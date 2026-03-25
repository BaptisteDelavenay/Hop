<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hop - Collaborateur</title>
    <link href="../../ASSETS/dist/output.css" rel="stylesheet">

</head>
    <?php
        session_start();
        include "../../connexionBDD/connexionBDD.php";
        include "../actions/missions.php";
        if ($_SESSION['session_collaborateur']!='OK') {
            // header("Location: ../../compte/views/connexion.php");
            echo "erreur de session";
        };
        // Récupère toutes les infos concernant le compte connecté
        $selectUser = "SELECT * FROM `user` WHERE id = :id;";
        $User = $db->prepare($selectUser);
        $User->execute(array(
            'id'=>$_SESSION["collaborateur_id"]
        ));
        $infosUser = $User->fetch(PDO::FETCH_ASSOC);
    ?>

    <body class="bg-hop-violet min-h-dvh flex flex-col">

    <!-- header -->
    <header class="flex justify-center items-center pt-10">
        <h2 class="text-white text-4xl font-bold leading-tight tracking-tight">Mes missions</h2>
    </header>

    <section class="bg-[#F8F6FF] p-4 w-full rounded-t-3xl pb-40 mt-10">

        <!-- Section missions journalières -->
        <h2 class="mt-10 text-4xl font-extrabold">Missions du jour</h2>
        <section class="flex gap-4 flex-col mt-4">
            <?php foreach ($missionsJournalieres as $mission): 

                // Changer la couleur en fonction de la difficulté    
                $diff = strtolower($mission["difficulte"]); 

                switch ($diff) {
                    case 'difficile':
                        $bgBadge = "bg-red-100";
                        $textBadge = "text-red-600";
                        break;
                    case 'moyenne':
                        $bgBadge = "bg-orange-100";
                        $textBadge = "text-orange-600";
                        break;
                    default: 
                        $bgBadge = "bg-[#A3D400]/14";
                        $textBadge = "text-hop-vert";
                        break;
                }

                $estValidee = ($mission['statut'] == 'validee'); 
                    
                // Prépare les classes css du boutton en fonction du status de la mission
                if ($estValidee) {
                    $classesBouton = "js-button-valider border border-hop-violet p-4 rounded-full";
                    $disabled = "disabled";
                    $icone = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="#6030E1" class="size-8"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>';
                    $divMission = "w-full h-auto bg-hop-violet/10 border border-gray-300 flex items-center justify-between py-4 px-6 rounded-3xl";
                } else {
                    $classesBouton = "js-button-valider bg-gradient-to-tr from-hop-violet to-violet-400 p-4 rounded-full shadow-lg active:scale-90 transition-all";
                    $disabled = "";
                    $icone = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="white" class="size-8"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>';
                    $divMission = "w-full h-auto bg-white border border-gray-300 flex items-center justify-between py-4 px-6 rounded-3xl";
                }
            ?>

            <div id="<?= $mission['id'] ?>" class="<?= $divMission ?>">
                <div>
                    <div>
                        <p class="text-2xl font-bold"><?= $mission["titre"] ?></p>
                        <p class="text-md"><?= $mission["description"] ?></p>
                    </div>
                    <div class="mt-4 flex gap-2">
                        <span class="<?= $bgBadge ?> <?= $textBadge ?> font-bold px-4 py-1 rounded-lg text-sm">
                            <?= ucfirst($mission["difficulte"]) ?>
                        </span>

                        <span class="js-nombre-points bg-hop-vert font-bold text-white px-4 py-1 rounded-lg text-sm">
                            <?= "+".$mission["points_base"]."pts" ?>
                        </span>
                    </div>
                </div>
                <div>
                    <button <?= $disabled; ?> data-id="<?= $mission['id'] ?>" data-points="<?= $mission['points_base'] ?>" class="<?= $classesBouton ?>">
                        <?= $icone; ?>
                    </button>
                </div>
            </div>
            <?php endforeach; ?>

            

    </section>

    <!-- Section missions hebdomadaires -->
    <h2 class="mt-10 text-4xl font-extrabold">Missions bonus</h2>
    <section class="flex gap-4 flex-col mt-4">
            <?php foreach ($missionsHebdo as $mission): 

                // Changer la couleur en fonction de la difficulté    
                $diff = strtolower($mission["difficulte"]); 

                switch ($diff) {
                    case 'difficile':
                        $bgBadge = "bg-red-100";
                        $textBadge = "text-red-600";
                        break;
                    case 'moyenne':
                        $bgBadge = "bg-orange-100";
                        $textBadge = "text-orange-600";
                        break;
                    default: 
                        $bgBadge = "bg-[#A3D400]/14";
                        $textBadge = "text-hop-vert";
                        break;
                }

                $estValidee = ($mission['statut'] == 'validee'); 
                    
                // Prépare les classes css du boutton en fonction du status de la mission
                if ($estValidee) {
                    $classesBouton = "js-button-valider border border-hop-violet p-4 rounded-full";
                    $disabled = "disabled";
                    $icone = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="#6030E1" class="size-8"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>';
                    $divMission = "w-full h-auto bg-hop-violet/10 border border-gray-300 flex items-center justify-between py-4 px-6 rounded-3xl";
                } else {
                    $classesBouton = "js-button-valider bg-gradient-to-tr from-hop-violet to-violet-400 p-4 rounded-full shadow-lg active:scale-90 transition-all";
                    $disabled = "";
                    $icone = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="white" class="size-8"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>';
                    $divMission = "w-full h-auto bg-white border border-gray-300 flex items-center justify-between py-4 px-6 rounded-3xl";
                }
            ?>

            <div id="<?= $mission['id'] ?>" class="<?= $divMission ?>">
                <div>
                    <div>
                        <p class="text-2xl font-bold"><?= $mission["titre"] ?></p>
                        <p class="text-md"><?= $mission["description"] ?></p>
                    </div>
                    <div class="mt-4 flex gap-2">
                        <span class="<?= $bgBadge ?> <?= $textBadge ?> font-bold px-4 py-1 rounded-lg text-sm">
                            <?= ucfirst($mission["difficulte"]) ?>
                        </span>

                        <span class="js-nombre-points bg-hop-vert font-bold text-white px-4 py-1 rounded-lg text-sm">
                            <?= "+".$mission["points_base"]."pts" ?>
                        </span>
                    </div>
                </div>
                <div>
                    <button <?= $disabled; ?> data-id="<?= $mission['id'] ?>" data-points="<?= $mission['points_base'] ?>" class="<?= $classesBouton ?>">
                        <?= $icone; ?>
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        </section>
    </section>

    <?php include("../../composants/nav.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    <script src="../../JS/validationMission.js"></script>

    </body>

</html>