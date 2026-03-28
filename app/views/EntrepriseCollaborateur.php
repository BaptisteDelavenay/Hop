<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hop - Entreprise</title>
    <link href="../../ASSETS/dist/output.css" rel="stylesheet">
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.4.0/model-viewer.min.js"></script>
</head>

<?php
session_start();
include "../../connexionBDD/connexionBDD.php";
include "../actions/missions.php";
include "../actions/EntrepriseProgression.php";

if ($_SESSION['session_collaborateur'] != 'OK') {
    echo "erreur de session";
};

$selectUser = "SELECT * FROM `user` WHERE id = :id;";
$User = $db->prepare($selectUser);
$User->execute(array('id' => $_SESSION["collaborateur_id"]));
$infosUser = $User->fetch(PDO::FETCH_ASSOC);
?>

<body class="bg-hop-violet min-h-dvh flex flex-col">

    <header class="flex justify-center items-center pt-10 pb-10">
        <h2 class="text-white text-4xl font-bold leading-tight tracking-tight">Entreprise</h2>
    </header>

    <div class="px-8 mt-6 flex flex-col items-center">
        <div class="flex justify-between w-full max-w-md mb-2">
            <span class="text-white font-bold text-sm uppercase tracking-wider">Niveau Entreprise</span>
            <span class="text-white font-bold text-sm"><?= $niveauEntreprise ?> / 10</span>
        </div>
        
        <div class="w-full max-w-md h-4 bg-white/20 rounded-full overflow-hidden border border-white/10 shadow-inner">
            <div class="h-full bg-gradient-to-r from-hop-vert to-green-400 rounded-full transition-all duration-1000 shadow-[0_0_15px_rgba(163,230,53,0.5)]" 
                 style="width: <?= $pourcentage ?>%">
            </div>
        </div>
        
        <p class="text-white/60 text-[10px] mt-2 uppercase font-bold tracking-widest italic">
            <?= number_format($pointsCollectifs, 0, '.', ' ') ?> points collectifs
        </p>
    </div>

    <div class="w-full h-[350px] shrink-0 flex justify-center items-center overflow-hidden z-0 relative">
        <model-viewer 
            src="../../uploads/office-10.glb" 
            alt="Modèle 3D entreprise"
            auto-rotate 
            camera-controls 
            disable-zoom
            interaction-prompt="none"
            /* On bloque l'angle vertical à 75deg pour interdire le haut/bas */
            /* On règle la distance à 5m pour l'effet "Gros plan" */
            camera-orbit="0deg 75deg 20m" 
            min-camera-orbit="auto 75deg 20m"
            max-camera-orbit="auto 75deg 20m"
            class="relative -top-15 w-full h-[450px] outline-none"
            style="--poster-color: transparent;"
            loading="eager">
        </model-viewer>
    </div>

    <section class="bg-[#F8F6FF] p-4 w-full rounded-t-3xl pb-40 flex flex-col flex-1 z-10">
        <h2 class="mt-10 text-3xl font-extrabold text-center">Fil d'actualité</h2>

        <div class="mt-6">
            <div class="flex items-center gap-2">
                <img class="h-12 w-12 rounded-full object-cover" src="../../uploads/01a31144f1fc880f5ff32c4985b0209e.jpg" alt="">
                <p class="font-bold">John Doe</p>
                <p class="text-gray-600"> - </p>
                <p class="text-gray-600">2 heures</p>
            </div>
            <img class="rounded-2xl mt-2" src="../../IMG/exempleFeed.png" alt="">
            
            <div class="flex items-center gap-2 mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                </svg>
                </div>
        </div>
    </section>

    <div class="h-20 w-20 rounded-full bg-hop-vert fixed right-10 bottom-30 flex items-center justify-center z-30">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12 stroke-green-900">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
    </div>

    <?php include("../../composants/nav.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../JS/validationMission.js"></script>
</body>
</html>