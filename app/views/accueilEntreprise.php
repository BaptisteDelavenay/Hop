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

    // stats temp (à modifier et ajouter d'autres stats, nécessaire d'avoir le "missions_completees" dans la bdd qui augmente à chaque mission réalisée)
    $selectUsers = "SELECT COUNT(*) FROM user WHERE entreprise_id = :entreprise_id";
    $reqUsers = $db->prepare($selectUsers);
    $reqUsers->execute([
        'entreprise_id' => $_SESSION['entreprise_id']
    ]);
    $nbUsers = $reqUsers->fetchColumn();

    $selectMissions = "SELECT SUM(missions_completees) FROM user WHERE entreprise_id = :entreprise_id";
    $reqMissions = $db->prepare($selectMissions);
    $reqMissions->execute([
        'entreprise_id' => $_SESSION['entreprise_id']
    ]);

    $nbMissions = $reqMissions->fetchColumn();


?>
<!-- HEADER -->
<header class="w-full pt-10 p-4 flex justify-between items-center text-white">
    <h1 class="text-xl font-bold">
        <?php echo $entreprise['nom'] ?? "Entreprise"; ?>
    </h1>
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
            <span class="font-bold"><?php echo $nbMissions; ?></span>
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

<!-- NAVBAR (composant existant) -->
<?php include "../../composants/navEntreprise.php"; ?>

</body>
</html>
