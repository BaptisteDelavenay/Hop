<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hop - Collaborateur</title>
    <link href="../../ASSETS/dist/output.css" rel="stylesheet">

</head>
<body class="bg-hop-violet min-h-dvh">

    <?php
        include "../../connexionBDD/connexionBDD.php";

        session_start();

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

        // Récupère le lien de la photo de profil
        $pdp = $infosUser["photo_profil"];
    ?>

    <header class="w-full pt-10 p-4 mb-24 flex items-start justify-between">

        <div class="flex items-start">
            <div class="bg-black w-18 h-18 rounded-full overflow-hidden flex items-center justify-center"><img class="h-full w-full scale-110 object-cover" src="<?= $pdp ?>" alt=""></div>
            <div class="ml-4">
                <h3 class="text-white text-xl">Bonjour, Bienvenue</h3>
                <h2 class="text-white text-4xl font-bold"><?= $_SESSION['collaborateur_prenom'] ?></h2>
            </div>
        </div>

        <a href="../../compte/actions/deconnexion.php">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="size-8"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
        </a>
    </header>

    <section class="bg-[#F8F6FF] p-4 w-full rounded-t-3xl min-h-dvh absolute">

        <!-- div Streak -->
        <div class="bg-white border border-gray-300 rounded-2xl px-4 py-6 relative -top-20">
            <div class="flex items-start justify-between w-full">
                <div class="flex">
                    <p class="text-8xl -ml-8">🔥</p>
                    <div class="-ml-4 -m-2">
                        <h1 class="text-5xl font-extrabold leading-tight tracking-tight">28 jours</h1>
                        <p class="text-gray-500 text-xl">de missions réussies</p>
                    </div>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
            </div>
            
            <!-- Jours de la semaine -->
            <div class="w-full mt-4 gap-6 flex items-center">
                <div class="w-8 flex flex-col items-center">
                    <div class="flex items-center justify-center h-8 w-8 rounded-full bg-hop-vert"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="green" class="size-5"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg></div>
                    <p class="mt-2 text-sm">Lun</p>        
                </div>
                <div class="w-8 flex flex-col items-center">
                    <div class="flex items-center justify-center h-8 w-8 rounded-full bg-hop-vert"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="green" class="size-5"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg></div>
                    <p class="mt-2 text-sm">Mar</p>        
                </div>
                <div class="w-8 flex flex-col items-center">
                    <div class="flex items-center justify-center h-8 w-8 rounded-full bg-hop-vert"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="green" class="size-5"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg></div>
                    <p class="mt-2 text-sm">Mer</p>        
                </div>
                <div class="w-8 flex flex-col items-center">
                    <div class="flex items-center justify-center h-8 w-8 rounded-full bg-hop-vert opacity-30"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="green" class="size-5"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg></div>
                    <p class="mt-2 text-sm">Jeu</p>        
                </div>
                <div class="w-8 flex flex-col items-center">
                    <div class="flex items-center justify-center h-8 w-8 rounded-full bg-hop-vert opacity-30"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="green" class="size-5"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg></div>
                    <p class="mt-2 text-sm">Ven</p>        
                </div>
                
            </div>
        </div>


    </section>

    <?php include("../../composants/nav.php"); ?>

    
</body>
</html>