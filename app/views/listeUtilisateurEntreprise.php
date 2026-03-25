<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hop - Liste utilisateurs</title>
    <link href="../../ASSETS/dist/output.css" rel="stylesheet">
</head>

<body class="bg-white min-h-dvh flex flex-col">

<?php
    session_start();

    include "../../connexionBDD/connexionBDD.php";

    if ($_SESSION['session_entreprise'] != 'OK') {
        echo "erreur de session";
    }

    // Récupérer les utilisateurs
    $selectUsers = "SELECT * FROM user WHERE entreprise_id = :entreprise_id";
    $req = $db->prepare($selectUsers);
    $req->execute([
        'entreprise_id' => $_SESSION['entreprise_id']
    ]);

    $users = $req->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- HEADER -->
<header class="p-4 pt-10">
    <h1 class="text-lg font-semibold mb-4">Liste des utilisateurs</h1>

    <!-- BARRE DE RECHERCHE -->
    <div class="bg-gray-100 rounded-xl flex items-center px-4 py-2">
        <input type="text" placeholder="John Doe" class="bg-transparent outline-none flex-1">
        🔍
    </div>
</header>

<!-- LISTE -->
<main class="flex-1 px-4 mt-4 space-y-4">

<?php foreach($users as $user): ?>

    <div class="flex items-center justify-between">

        <!-- Partie gauche -->
        <div class="flex items-center gap-3">

            <!-- Avatar -->
            <div class="w-12 h-12 bg-black rounded-full"></div>

            <div>
                <p class="font-semibold">
                    <?php echo $user['nom'], " ", $user['prenom'] ?? "John Doe"; ?>
                </p>
                <p class="text-sm text-gray-500">
                    <?php echo $user['total_points'] ?? "0"; ?> points
                </p>
            </div>

        </div>

        <!-- Menu -->
        <div>
            ⋮
        </div>

    </div>

<?php endforeach; ?>

</main>

<!-- NAVBAR -->
<?php include "../../composants/navEntreprise.php"; ?>

</body>
</html>
