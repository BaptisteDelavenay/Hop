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
include "../actions/getFeed.php";

if ($_SESSION['session_collaborateur'] != 'OK') {
    echo "erreur de session";
}
;

$selectUser = "SELECT * FROM `user` WHERE id = :id;";
$User = $db->prepare($selectUser);
$User->execute(array('id' => $_SESSION["collaborateur_id"]));
$infosUser = $User->fetch(PDO::FETCH_ASSOC);
?>

<body class="bg-hop-violet min-h-dvh flex flex-col">

    <header class="flex justify-center items-center pt-10 pb-10">
        <h2 class="text-white text-4xl font-bold leading-tight tracking-tight">Entreprise</h2>
    </header>

    <div class="px-8 mt-6 w-full max-w-md mx-auto">
        <div class="flex items-end justify-between mb-2">
            <p class="text-white/70 text-xl font-medium">niv.
                <b class="text-white text-5xl font-bold italic tracking-tighter"><?= $niveauEntreprise ?></b>
            </p>

            <p class="text-white/70 text-lg">
                <b class="text-white font-bold italic"><?= number_format($pointsDansCeNiveau, 0, '.', ' ') ?></b>
                / <?= number_format($distanceEntrePaliers, 0, '.', ' ') ?> pts
            </p>
        </div>

        <div class="w-full h-4 rounded-lg border border-white/20 overflow-hidden bg-white/10 shadow-lg">
            <div class="h-full bg-hop-vert transition-all duration-1000 shadow-[0_0_15px_rgba(163,230,53,0.4)]"
                style="width: <?= $pourcentageBarre ?>%">
            </div>
        </div>

        <div class="flex justify-between items-center mt-2">
            <p class="text-white/40 text-[10px] uppercase font-bold tracking-widest">
                Objectif niv. <?= $niveauEntreprise + 1 ?>
            </p>
            <p class="text-white/40 text-[10px] uppercase font-bold tracking-widest italic">
                Total : <?= number_format($pointsCollectifs, 0, '.', ' ') ?> pts
            </p>
        </div>
    </div>

    <div class="w-full h-[350px] shrink-0 flex justify-center items-center overflow-hidden z-0 relative">
        <model-viewer src="../../uploads/cartoon_office.glb" alt="Modèle 3D entreprise" auto-rotate camera-controls
            disable-zoom interaction-prompt="none" camera-orbit="0deg 75deg 50m" min-camera-orbit="auto 75deg 50m"
            max-camera-orbit="auto 75deg 50m" class="relative -top-5 w-full h-[450px] outline-none"
            style="--poster-color: transparent;" loading="eager">
        </model-viewer>
    </div>

    <!-- Section fil d'actualité -->
    <section class="bg-[#F8F6FF] p-4 w-full rounded-t-3xl pb-40 mt-10 flex flex-col flex-1 gap-10">
        <h2 class="mt-10 text-3xl font-extrabold text-center">Fil d'actualité</h2>


        <?php foreach ($feed as $post): ?>
            <!-- POST -->
            <div class="flex flex-col gap-2">
                <!-- Photo de profil et nom -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <!-- photo de profil -->
                        <img class="h-12 w-12 rounded-full object-cover" src="<?= $post["photo_profil"] ?>" alt="">
                        <!-- Nom prenom -->
                        <p class="font-bold"><?= $post["prenom"] ?>     <?= $post["nom"] ?></p>
                        <p class="text-gray-600 text-sm"><?= tempsEcoule($post["date"]) ?></p>
                    </div>
                    <p class="font-bold">⋮</p>
                </div>
                <img class="rounded-2xl" src="<?= $post["image"] ?>" alt="">
                <!-- Interactions -->
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                    </svg>
                    <span><?= $post["nb_likes"] ?></span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15m0-3-3-3m0 0-3 3m3-3V15" />
                    </svg>
                </div>
                <!-- description -->
                <div class="flex items-center gap-2">
                    <!-- Nom prenom -->
                    <p class="font-bold"><?= $post["prenom"] ?> <?= $post["nom"] ?></p>
                    <p> - </p>
                    <!-- description du post -->
                    <p><?= $post["description"] ?></p>
                </div>
            </div>


        <?php endforeach; ?>

    </section>

    <a href="nouveauPost.php"
        class="h-20 w-20 rounded-full bg-hop-vert fixed right-10 bottom-30 flex items-center justify-center shadow-lg active:scale-90 transition-all duration-75">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-12 stroke-green-900">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
    </a>

    <?php include("../../composants/nav.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../JS/validationMission.js"></script>
</body>

</html>