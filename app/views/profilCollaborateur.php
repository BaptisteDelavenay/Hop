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

    <section class="bg-[#F8F6FF] p-4 w-full rounded-t-3xl min-h-screen">

        <div class="flex flex-col items-center -mt-20 mb-6">
            <div class="bg-black w-32 h-32 rounded-full overflow-hidden border-4 border-[#F8F6FF] shadow-lg">
                <img class="h-full w-full object-cover" src="<?= $pdp ?>" alt="Profil">
            </div>

            <div class="text-center mt-3">
                <h2 class="text-hop-violet text-3xl font-bold"><?= $_SESSION['collaborateur_prenom'] ?></h2>
            </div>

            <div class="bg-white border border-gray-300 rounded-2xl px-4 py-6 relative">
            <div class="flex items-start justify-between w-full">
                <div class="flex">
                    <div class="-ml-4 -m-2">
                        <h1 class="text-5xl font-extrabold leading-tight tracking-tight">28 jours</h1>
                        <p class="text-gray-500 text-xl">de missions réussies</p>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <?php include("../../composants/nav.php"); ?>

</body>