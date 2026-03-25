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

    <h2 class="text-2xl font-bold mb-6">Récapitulatif</h2>

    <div class="space-y-4">

    <!-- Section progression -->
    <section class="">
        <h2 class="mt-10 mb-4 text-4xl font-extrabold">Progression</h2>
            <div class="flex items-center justify-between gap-4">
            <!-- CO2 -->
            <div class="bg-hop-violet/20 w-full rounded-3xl p-5 flex flex-col gap-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-8 stroke-hop-violet"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" /></svg>
                <p class="text-md text-gray-600"><b>CO2 économisé</b> (collaborateur)</p>
                <h2 class="js-counter text-4xl font-extrabold text-hop-violet" data-target="24.4" data-unit="kg">24.4</h2>
            </div>
            <!-- RSE -->
            <div class="bg-hop-vert/30 w-full rounded-3xl p-4 flex flex-col gap-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 stroke-[#6E8F00]"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" /></svg>
                <p class="text-md text-gray-600"><b>Certification RSE</b> (entreprise)</p>
                <h2 class="js-counter text-4xl font-extrabold text-[#6E8F00]" data-target="79.4"data-unit="%">79.4%</h2>
            </div>
        </div>
    </section>


</main>

<!-- NAVBAR (composant existant) -->
<?php include "../../composants/navEntreprise.php"; ?>

</body>
</html>
