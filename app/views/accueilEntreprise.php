<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hop - Entreprise</title>
    <link href="../../ASSETS/dist/output.css" rel="stylesheet">
</head>

<body class="bg-hop-violet min-h-dvh flex flex-col">

<?php
    session_start();

    include "../../connexionBDD/connexionBDD.php";
    include "../actions/nbMissionEntreprise.php";

    if ($_SESSION['session_entreprise'] != 'OK') {
        header("Location: ../../compte/views/connexion.php");
    }

    // Récupérer les infos de l’entreprise
    $selectEntreprise = "SELECT * FROM entreprise WHERE id = :id;";
    $req = $db->prepare($selectEntreprise);
    $req->execute([
        'id' => $_SESSION['entreprise_id']
    ]);

    $entreprise = $req->fetch(PDO::FETCH_ASSOC);

    // stats temp (à modifier et ajouter d'autres stats, nécessaire d'avoir le "missions_completees" dans la bdd qui augmente à chaque mission réalisée)
    $selectUsers = "SELECT COUNT(*) FROM user WHERE entreprise_id = :entreprise_id";
    $reqUsers = $db->prepare($selectUsers);
    $reqUsers->execute([
        'entreprise_id' => $_SESSION['entreprise_id']
    ]);
    $nbUsers = $reqUsers->fetchColumn();

?>
<!-- HEADER -->
<header class="w-full pt-10 p-4 flex items-start justify-between">

    <div class="flex items-start">
        <a href="profilCollaborateur.php" class="bg-black w-18 h-18 rounded-full overflow-hidden flex items-center justify-center active:scale-90 transition-all"><img class="h-full w-full scale-110 object-cover" src="<?= $entreprise["photo_profil"] ?>" alt=""></a>
        <div class="ml-4">
            <h3 class="text-white text-xl">Bonjour, Bienvenue</h3>
            <h2 class="text-white text-4xl font-bold"><?= $_SESSION['entreprise_nom'] ?></h2>
        </div>
    </div>

    <div class="js-btnModal cursor-pointer active:scale-95 transition-all">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="size-8"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
    </div>
</header>

<main class="flex-1 bg-white rounded-t-3xl p-6 mt-6">

    <h2 class="text-2xl font-bold mb-6">Tableau de bord</h2>

    <div class="space-y-4">

        <!-- Nombre d'utilisateurs -->
        <div class="bg-gray-100 p-4 rounded-xl flex justify-between items-center">
            <span>Nombre de Collaborateurs :</span>
            <span class="font-bold"><?php echo $nbUsers; ?></span>
        </div>

        <!-- Missions réalisées -->
        <div class="bg-gray-100 p-4 rounded-xl flex justify-between items-center">
            <span>Missions réalisées :</span>
            <span class="font-bold"><?php echo $countMission; ?></span>
        </div>

    </div>

    <!-- BOUTON ACCÈS LISTE -->
    <div class="mt-8">
        <a href="listeUtilisateurEntreprise.php" 
           class="block bg-hop-vert text-white text-center py-3 rounded-xl font-semibold">
            Voir les collaborateurs
        </a>
    </div>

        <!-- BOUTON ACCÈS RECAP -->
    <div class="mt-8">
        <a href="recapEntreprise.php" 
           class="block bg-hop-vert text-white text-center py-3 rounded-xl font-semibold">
            Voir le récapitulatif
        </a>
    </div>

</main>

    <!-- Div paramètre du compte -->
    <div class="js-CompteModal items-center justify-center top-0 left-0 h-full w-full bg-black/60 p-4 pt-60 fixed hidden z-100000">
        <div class="bg-white h-auto rounded-2xl flex flex-col p-4 gap-4">
            <div class="js-closeModal">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="size-6 float-right"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
            </div>
            <div class="h-full flex flex-col items-start justify-between gap-6 mb-4 pl-2">
                <a href="profilCollaborateur.php" class="flex items-center gap-2">
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

    <!-- NAVBAR (composant existant) -->
    <?php include "../../composants/navEntreprise.php"; ?>

    <script src="../../JS/modal.js"></script>

</body>
</html>
