<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hop - Entreprise</title>
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
        <h2 class="text-white text-4xl font-bold leading-tight tracking-tight">Entreprise</h2>
    </header>

    <!-- Section fil d'actualité -->
    <section class="bg-[#F8F6FF] p-4 w-full rounded-t-3xl pb-40 mt-10 flex flex-col flex-1">
    <h2 class="mt-10 text-3xl font-extrabold text-center">Fil d'actualité</h2>


    <!-- POST -->
    <div>
        <!-- Photo de profil et nom -->
        <div class="flex items-center gap-2">
            <!-- photo de profil -->
            <img class="h-12 w-12 rounded-full object-cover" src="../../uploads/01a31144f1fc880f5ff32c4985b0209e.jpg" alt="">
            <!-- Nom prenom -->
             <p class="font-bold">John Doe</p>
             <p class="text-gray-600"> - </p>
             <p class="text-gray-600">2 heures</p>
        </div>
        <img class="rounded-2xl" src="../../IMG/exempleFeed.png" alt="">
        <!-- Interactions -->
        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" /></svg>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8"><path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" /></svg>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" /></svg>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15m0-3-3-3m0 0-3 3m3-3V15" /></svg>
        </div>
        <!-- description -->
        <div class="flex items-center gap-2">
            <!-- Nom prenom -->
            <p>John Doe</p>
            <p> - </p>
            <!-- description du post -->
            <p>Lorem ipsum dolor sit amet.</p>
        </div>
    </div>
       
    </section>


    <div class="h-20 w-20 rounded-full bg-hop-vert fixed right-10 bottom-30 flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12 stroke-green-900"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
    </div>

  

    <?php include("../../composants/nav.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    <script src="../../JS/validationMission.js"></script>

    </body>

</html>