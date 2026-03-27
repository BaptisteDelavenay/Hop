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

    if ($_SESSION['session_entreprise'] != 'OK') {
        echo "erreur de session";
    }

    // Récupérer les infos de l’entreprise
    $selectEntreprise = "SELECT * FROM entreprise WHERE id = :id;";
    $req = $db->prepare($selectEntreprise);
    $req->execute([
        'id' => $_SESSION['entreprise_id']
    ]);

    $entreprise = $req->fetch(PDO::FETCH_ASSOC);
?>

<!-- HEADER -->
<header class="w-full pt-10 p-4 flex justify-between items-center text-white">
    <h1 class="text-xl font-bold">
        <?php echo $entreprise['nom'] ?? "Entreprise"; ?>
    </h1>
</header>

<main class="flex-1 bg-white rounded-t-3xl p-6 mt-6">

    <div class="space-y-4">

    <!-- Section progression -->
    <section class="">
        <h2 class="mt-10 mb-4 text-4xl font-extrabold">Récapitulatif</h2>
            <div class="flex flex-col gap-4">

            <!-- RSE -->
            <div class="bg-hop-vert/30 w-full rounded-3xl p-4 flex flex-row justify-between  items-center">
                <div class="flex items-center gap-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 stroke-[#6E8F00]"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" /></svg>
                <p class="text-md text-gray-600"><b>Avancement Certification</b></p>
                </div>
                <h2 class="js-counter text-4xl font-extrabold text-[#6E8F00]" data-target="36.4"data-unit="%">36.4 %</h2>
            </div>
            <!-- CO2 quotidien -->
            <div class="bg-hop-violet/20 w-full rounded-3xl p-4 flex flex-row justify-between  items-center">
                <div class="flex items-center gap-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 stroke-hop-violet"><path stroke-linecap="round" stroke-linejoin="round" d="m20.893 13.393-1.135-1.135a2.252 2.252 0 0 1-.421-.585l-1.08-2.16a.414.414 0 0 0-.663-.107.827.827 0 0 1-.812.21l-1.273-.363a.89.89 0 0 0-.738 1.595l.587.39c.59.395.674 1.23.172 1.732l-.2.2c-.212.212-.33.498-.33.796v.41c0 .409-.11.809-.32 1.158l-1.315 2.191a2.11 2.11 0 0 1-1.81 1.025 1.055 1.055 0 0 1-1.055-1.055v-1.172c0-.92-.56-1.747-1.414-2.089l-.655-.261a2.25 2.25 0 0 1-1.383-2.46l.007-.042a2.25 2.25 0 0 1 .29-.787l.09-.15a2.25 2.25 0 0 1 2.37-1.048l1.178.236a1.125 1.125 0 0 0 1.302-.795l.208-.73a1.125 1.125 0 0 0-.578-1.315l-.665-.332-.091.091a2.25 2.25 0 0 1-1.591.659h-.18c-.249 0-.487.1-.662.274a.931.931 0 0 1-1.458-1.137l1.411-2.353a2.25 2.25 0 0 0 .286-.76m11.928 9.869A9 9 0 0 0 8.965 3.525m11.928 9.868A9 9 0 1 1 8.965 3.525" /></svg>
                <p class="text-md text-gray-600"><b>CO₂ économisés</b></p>
                </div>
                <h2 class="js-counter text-4xl font-extrabold text-hop-violet" data-target="112" data-unit="kg">112 kg</h2>
            </div>
            <!-- electricité -->
            <div class="bg-hop-vert/30 w-full rounded-3xl p-4 flex flex-row justify-between  items-center">
                <div class="flex items-center gap-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="size-8 stroke-[#6E8F00]"><path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" /></svg>
                <p class="text-md text-gray-600"><b>Électricité économisé</b></p>
                </div>
                <h2 class="js-counter text-4xl font-extrabold text-[#6E8F00]" data-target="10"data-unit="kwh">10 kWh</h2>
            </div>
            <!-- EAU -->
            <div class="bg-hop-violet/20 w-full rounded-3xl p-4 flex flex-row justify-between  items-center">
                <div class="flex items-center gap-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-8 stroke-hop-violet"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" /></svg>
                    <p class="text-md text-gray-600"><b>Eau  économisé</b></p>
                </div>
                <h2 class="js-counter text-4xl font-extrabold text-hop-violet" data-target="50" data-unit="l">50 L</h2>
            </div>
            <!-- ambiance -->
            <div class="bg-hop-vert/30 w-full rounded-3xl p-4 flex flex-row justify-between  items-center">
                <div class="flex items-center gap-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="size-8 stroke-[#6E8F00]"><path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 0 1-6.364 0M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" /></svg>
                <p class="text-md text-gray-600"><b>Une meilleure ambiance s’est installé dans l’entreprise</b></p>
                </div>
            </div>
            <!-- CO2 quotidien -->
            <div class="bg-hop-violet/20 w-full rounded-3xl p-4 flex flex-row justify-between  items-center">
                <div class="flex items-center gap-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 stroke-hop-violet"><path stroke-linecap="round" stroke-linejoin="round" d="m20.893 13.393-1.135-1.135a2.252 2.252 0 0 1-.421-.585l-1.08-2.16a.414.414 0 0 0-.663-.107.827.827 0 0 1-.812.21l-1.273-.363a.89.89 0 0 0-.738 1.595l.587.39c.59.395.674 1.23.172 1.732l-.2.2c-.212.212-.33.498-.33.796v.41c0 .409-.11.809-.32 1.158l-1.315 2.191a2.11 2.11 0 0 1-1.81 1.025 1.055 1.055 0 0 1-1.055-1.055v-1.172c0-.92-.56-1.747-1.414-2.089l-.655-.261a2.25 2.25 0 0 1-1.383-2.46l.007-.042a2.25 2.25 0 0 1 .29-.787l.09-.15a2.25 2.25 0 0 1 2.37-1.048l1.178.236a1.125 1.125 0 0 0 1.302-.795l.208-.73a1.125 1.125 0 0 0-.578-1.315l-.665-.332-.091.091a2.25 2.25 0 0 1-1.591.659h-.18c-.249 0-.487.1-.662.274a.931.931 0 0 1-1.458-1.137l1.411-2.353a2.25 2.25 0 0 0 .286-.76m11.928 9.869A9 9 0 0 0 8.965 3.525m11.928 9.868A9 9 0 1 1 8.965 3.525" /></svg>
                <p class="text-md text-gray-600"><b>CO₂ économisés aujourd’hui</b></p>
                </div>
                <h2 class="js-counter text-4xl font-extrabold text-hop-violet" data-target="63.8" data-unit="kg">9,5 kg</h2>
            </div>
        </div>
    </section>

        <!-- btn export (non fonctionnel) -->
    <div class="mt-8">
        <a href="" 
           class="block bg-hop-vert text-white text-center py-3 rounded-xl font-semibold">
            Exporter les données
        </a>
    </div>
</main>

<?php include "../../composants/navEntreprise.php"; ?>

</body>
</html>