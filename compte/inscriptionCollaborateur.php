<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hop</title>
    <link href="../ASSETS/dist/output.css" rel="stylesheet">
</head>

<?php
    require("../connexionBDD/connexionBDD.php");
    $queryEntreprise = $db->prepare("SELECT DISTINCT nom FROM `entreprise`;");
    $queryEntreprise->execute();
    $entreprises = $queryEntreprise->fetchAll(PDO::FETCH_ASSOC);
?>

<body>

    <!-- texte de bienvenue et logo -->
    <p class="text-center text-lg font-extrabold mt-10 mb-6">Inscription</p>
    <p class="text-center text-md mb-2">Rejoingnez votre équipe !</p>
    <p class="text-center text-sm mb-6">Créez votre compte pour aider votre entreprise dans ses démarches RSE</p>
    <!-- Formulaire de connexion -->
    <form class="flex flex-col justify-center items-center" action="creationCompteCollaborateur.php" method="POST">


        <!-- input Prénom -->
        <div class="w-11/12 flex flex-col mb-5">
            <label for="email" class="mb-1">Prénom</label>
            <input class="bg-gray-200 h-12 rounded-lg p-4" type="text" id="prenom" name="prenom" placeholder="John" required>
        </div>

        <!-- input Nom -->
        <div class="w-11/12 flex flex-col mb-5">
            <label for="email" class="mb-1">Nom</label>
            <input class="bg-gray-200 h-12 rounded-lg p-4" type="text" id="nom" name="nom" placeholder="Doe" required>
        </div>

        <!-- input Email -->
        <div class="w-11/12 flex flex-col mb-5">
            <label for="email" class="mb-1">Email professionel</label>
            <input class="bg-gray-200 h-12 rounded-lg p-4" type="email" id="email" name="email" placeholder="nom@entreprise.com" required>
        </div>

        <!-- input Mot de passe -->
        <div class="w-11/12 flex flex-col mb-4">
            <label for="password" class="mb-1">Mot de passe</label>
            <input class="bg-gray-200 h-12 rounded-lg p-4" type="password" id="password" name="password" placeholder="••••••••••••••••" required>
        </div>

        <!-- Nom de l'entreprise -->
        <div class="w-11/12 flex flex-col mb-4">
            <label for="password" class="mb-1">Nom de l'entreprise</label>
            <select class="bg-gray-200 h-12 rounded-lg pl-4" id="entreprise" name="entreprise">
                <?php foreach($entreprises as $entreprise):?>
                    <option value="<?= $entreprise["nom"] ?>"><?= $entreprise["nom"] ?></option>
                <?php endforeach;?>
            </select>
        </div>



        <!-- Submit -->
        <input type="submit" value="Se connecter" class="w-11/12 bg-gray-400 h-10 rounded-lg mt-14">

        <!-- Lien vers la création de compte -->
        <p class="text-center mt-14 mb-10">Vous n'avez pas de compte ? <a href="inscriptionChoix.php">Créez-en un !</a></p>
    </form>
</body>
</html>