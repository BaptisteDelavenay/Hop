<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hop</title>
    <link href="../ASSETS/dist/output.css" rel="stylesheet">
</head>

<!-- Requete SQL pour récupérer l'ensemble des entreprises pour le formulaire de création de compte -->
<?php
    require("../connexionBDD/connexionBDD.php");
    $queryEntreprise = $db->prepare("SELECT DISTINCT nom, id FROM `entreprise`;");
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
            <div class="flex items-center bg-gray-100 h-14 rounded-2xl px-4 focus-within:ring-2 focus-within:ring-hop-violet/20 border border-transparent focus-within:border-hop-violet/10 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="size-5 text-gray-400 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>    
                <input class="flex-1 bg-transparent outline-none text-hop-noir placeholder:text-gray-400 text-md" type="text" id="prenom" name="prenom" placeholder="John" required>
            </div>
        </div>

        <!-- input Nom -->
        <div class="w-11/12 flex flex-col mb-5">
            <label for="email" class="mb-1">Nom</label>
            <div class="flex items-center bg-gray-100 h-14 rounded-2xl px-4 focus-within:ring-2 focus-within:ring-hop-violet/20 border border-transparent focus-within:border-hop-violet/10 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="size-5 text-gray-400 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" /></svg>                
                <input class="flex-1 bg-transparent outline-none text-hop-noir placeholder:text-gray-400 text-md" type="text" id="nom" name="nom" placeholder="Doe" required>
            </div>
        </div>

        <!-- input Email -->
        <div class="w-11/12 flex flex-col mb-5">
            <label for="email" class="mb-1">Email professionel</label>
            <div class="flex items-center bg-gray-100 h-14 rounded-2xl px-4 focus-within:ring-2 focus-within:ring-hop-violet/20 border border-transparent focus-within:border-hop-violet/10 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="size-5 text-gray-400 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg>
                <input class="flex-1 bg-transparent outline-none text-hop-noir placeholder:text-gray-400 text-md" type="email" id="email" name="email" placeholder="nom@entreprise.com" required>
            </div>
        </div>

        <!-- input Mot de passe -->
        <div class="w-11/12 flex flex-col mb-4">
            <label for="password" class="mb-1">Mot de passe</label>
            <div class="flex items-center bg-gray-100 h-14 rounded-2xl px-4 focus-within:ring-2 focus-within:ring-hop-violet/20 border border-transparent focus-within:border-hop-violet/10 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="size-5 text-gray-400 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" /></svg>
                <input class="flex-1 bg-transparent outline-none text-hop-noir placeholder:text-gray-400 text-md" type="password" id="password" name="password" placeholder="••••••••••••••••" required>
            </div>
        </div>

        <!-- Nom de l'entreprise -->
        <div class="w-11/12 flex flex-col mb-4">
            <label for="password" class="mb-1">Nom de l'entreprise</label>
            <select class="bg-gray-200 h-12 rounded-lg pl-4" id="entreprise" name="entreprise">
                <?php foreach($entreprises as $entreprise):?>
                    <option value="<?= $entreprise["id"] ?>"><?= $entreprise["nom"] ?></option>
                <?php endforeach;?>
            </select>
        </div>

        <!-- Submit -->
        <input type="submit" value="Se connecter" class="w-11/12 bg-gray-400 h-10 rounded-lg mt-14">

        <!-- Lien vers la création de compte -->
        <p class="text-center mt-14 mb-10">Vous avez déjà un compte ? <a href="inscriptionChoix.php">Connectez-vous !</a></p>
    </form>
</body>
</html>