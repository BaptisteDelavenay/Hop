<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hop - Collaborateur</title>
    <link href="../../ASSETS/dist/output.css" rel="stylesheet">

</head>
<body class="bg-hop-violet">

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

        // Récupère le lien de la photo de profil
        $pdp = $infosUser["photo_profil"];
    ?>

    <header class="w-full pt-10 p-4 mb-24 flex items-start justify-between">

        <div class="flex items-start">
            <a href="profilCollaborateur.php" class="bg-black w-18 h-18 rounded-full overflow-hidden flex items-center justify-center active:scale-90 transition-all"><img class="h-full w-full scale-110 object-cover" src="<?= $pdp ?>" alt=""></a>
            <div class="ml-4">
                <h3 class="text-white text-xl">Bonjour, Bienvenue</h3>
                <h2 class="text-white text-4xl font-bold"><?= $_SESSION['collaborateur_prenom'] ?></h2>
            </div>
        </div>

        <div class="js-btnModal cursor-pointer active:scale-95 transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="size-8"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
        </div>
    </header>

    <section class="bg-[#F8F6FF] p-4 w-full rounded-t-3xl absolute h-250">

        <!-- div Streak -->
        <div class="bg-white border border-gray-300 rounded-2xl px-4 py-6 relative -mt-20">
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

        <h2 class="mt-10 text-4xl font-extrabold">Missions du jour</h2>

        <!-- Missions du jour -->
        
        <section class="flex gap-4 flex-col mt-4">
        <?php foreach ($missions as $mission): 
           
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
            } else {
                $classesBouton = "js-button-valider bg-gradient-to-tr from-hop-violet to-violet-400 p-4 rounded-full shadow-lg active:scale-90 transition-all";
                $disabled = "";
                $icone = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="white" class="size-8"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>';
            }
        ?>
        
        <div id="<?= $mission['id'] ?>" class="w-full h-auto bg-white border border-gray-300 flex items-center justify-between py-4 px-6 rounded-3xl">
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

        <section>

            <h2 class="mt-10 text-4xl font-extrabold">L'objectif de Hop</h2>

            <p>L'objectif de Hop est de vous accompagner dans votre démarche RSE. Hop ne décerne pas cette certification mais vous permez d'obtenir les informations nécessaires pour obtenir cette Certifcation RSE tout en étant ludique.</p>

        </section>

    </section>

    </section>

    <?php include("../../composants/nav.php"); ?>

    <div class="js-CompteModal items-center justify-center top-0 left-0 h-full w-full bg-black/60 p-4 pt-60 fixed hidden">
        <div class="bg-white h-auto rounded-2xl flex flex-col p-4 gap-4">
            <div class="js-closeModal">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="size-6 float-right"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
            </div>
            <div class="h-full flex flex-col items-start justify-between gap-6 mb-4 pl-2">
                <a href="" class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
                    <p class="text-2xl font-regular font-bold">Profil utilisateur</p>
                </a>
                <a href="../../compte/actions/deconnexion.php" class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-8"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" /></svg>
                    <p class="text-2xl font-regular font-bold">Se déconnecter</p>
                </a>
            </div>
        </div>
    </div>

    <script src="../../JS/modal.js"></script>   
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    <script src="../../JS/validationMission.js"></script>
</body>
</html>