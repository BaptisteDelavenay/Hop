<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hop - Classement</title>
    <link href="../../ASSETS/dist/output.css" rel="stylesheet">

</head>

<?php
    session_start();
    include("../../connexionBDD/connexionBDD.php");
    // fichier qui gère le classement des collaborateurs
    include("../actions/classementCollaborateur.php");
?>

<body class="bg-hop-violet flex flex-col min-h-dvh">
    <header class="px-4">
        <h2 class="text-white text-center text-4xl font-bold leading-tight tracking-tight my-6">Classement</h2>
        <div class="flex w-full p-1 bg-gray-100 rounded-2xl">
            <label class="flex-1 cursor-pointer">
                <input type="radio" name="user_type" value="collaborateur" class="sr-only peer" checked>
                <div class="flex items-center justify-center py-3 text-sm font-bold text-gray-400 transition-all rounded-xl peer-checked:bg-hop-violet peer-checked:text-white peer-checked:shadow-md">
                    Mois
                </div>
            </label>
            <label class="flex-1 cursor-pointer">
                <input type="radio" name="user_type" value="entreprise" class="sr-only peer">
                <div class="flex items-center justify-center py-3 text-sm font-bold text-gray-400 transition-all rounded-xl peer-checked:bg-hop-violet peer-checked:text-white peer-checked:shadow-md">
                    Global
                </div>
            </label>
        </div>
    </header>
    <section class="flex justify-evenly pt-10">
        <div class="flex flex-col justify-end items-center gap-2">
            <div class="overflow-hidden flex items-center justify-center rounded-full h-25 w-25"><img class="h-full w-full scale-110 object-cover" src="<?= isset($userList[1]["photo_profil"]) ? $userList[1]["photo_profil"] : "../../IMG/default.png" ?>" alt="photo de profil"></div>
            <p class="text-white font-bold"><?= isset($userList[1]["prenom"]) ? $userList[1]["prenom"] : "" ?> <?= isset($userList[1]["nom"]) ? $userList[1]["nom"] : "" ?></p>
            <div class="w-25 h-50 bg-gradient-to-t from-hop-violet from-5% via-hop-violet/40 via-5% to-white to-50% text-gray-600 font-bold text-4xl flex justify-center pt-10">
                2
            </div>
        </div>
        <div class="flex flex-col justify-end items-center gap-2">
            <div class="overflow-hidden flex items-center justify-center rounded-full h-25 w-25"><img class="h-full w-full scale-110 object-cover" src="<?= isset($userList[0]["photo_profil"]) ? $userList[0]["photo_profil"] : "../../IMG/default.png" ?>" alt="photo de profil"></div>
            <p class="text-white font-bold"><?= isset($userList[0]["prenom"]) ? $userList[0]["prenom"] : "" ?> <?= isset($userList[0]["nom"]) ? $userList[0]["nom"] : "" ?></p>
            <div class="w-25 h-60 bg-gradient-to-t from-hop-violet from-5% via-hop-violet/40 via-5% to-white to-50% text-amber-400 font-bold text-4xl flex justify-center pt-10">
                1
            </div>
        </div>
        <div class="flex flex-col justify-end items-center gap-2">
            <div class="overflow-hidden flex items-center justify-center rounded-full h-25 w-25"><img class="h-full w-full scale-110 object-cover" src="<?= isset($userList[2]["photo_profil"]) ? $userList[2]["photo_profil"] : "../../IMG/default.png" ?>" alt="photo de profil"></div>
            <p class="text-white font-bold"><?= isset($userList[2]["prenom"]) ? $userList[2]["prenom"] : "" ?> <?= isset($userList[2]["nom"]) ? $userList[2]["nom"] : "" ?></p>
            <div class="w-25 h-40 bg-gradient-to-t from-hop-violet from-5% via-hop-violet/40 via-5% to-white to-50% text-amber-700 font-bold text-4xl flex justify-center pt-10">
                3
            </div>
        </div>

    </section >

    <section class="bg-white rounded-t-4xl px-6 pt-8 flex flex-col gap-6 flex-1 pb-50">

        <!-- Boucle pour afficher tous les utilisateurs d'une entreprise dans la page de classement -->
        <?php $i=1; foreach($userList as $user): ?>
            <?php  
                $couleur = match($i) {
                    1 => 'text-yellow-400',
                    2 => 'text-slate-300',  
                    3 => 'text-amber-600',
                    default => 'Noir'
                };
            ?>
            <div class="flex items-center gap-2 ">
                <p class="<?= $couleur ?> text-2xl mr-2"><?= $i ?>.</p>
                <div class="flex items-center justify-center overflow-hidden h-15 w-15 rounded-full"><img class="h-full w-full scale-110 object-cover" src="<?= $user["photo_profil"] ?>" alt="photo de profil"></div>
                <div>
                    <p class="text-xl font-bold"><?= $user["prenom"] ?> <?= $user["nom"] ?></p>
                    <p class="text-hop-vert text-sm"><?= $user["total_points"] ?> points</p>
                </div>
            </div>
        <?php $i+=1; endforeach; ?>

        <p class="text-center text-gray-600 text-sm">Vous avez atteint la fin</p>

    </section>


    <?php include("../../composants/nav.php");?>
</body>
</html>