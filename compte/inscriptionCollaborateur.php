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

<body class="bg-hop-violet">

    <!-- texte de bienvenue et logo -->
    <header class="flex items-center justify-center py-8">
        <p class="text-white text-4xl font-bold leading-tight tracking-tight">Inscription</p>
    </header>

    <section class="flex-1 bg-white rounded-t-4xl p-6">

        <p class="text-center mb-2 text-2xl font-bold mt-8">Rejoingnez votre équipe !</p>
        <p class="text-center text-gray-500 font-medium mt-4 mb-6">Créez votre compte pour aider votre entreprise dans ses démarches RSE</p>

        
        <!-- Formulaire de connexion -->
        <form class="flex flex-col justify-center items-center" action="creationCompteCollaborateur.php" method="POST">


            <!-- input Prénom -->
            <div class="w-full flex flex-col mb-6">
                <label for="email" class="text-xs font-bold uppercase text-gray-600 mb-1.5 ml-1 tracking-widest-1">Prénom</label>
                <div class="flex items-center bg-gray-100 h-14 rounded-2xl px-4 focus-within:ring-2 focus-within:ring-hop-violet/20 border border-transparent focus-within:border-hop-violet/10 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="size-5 text-gray-400 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>    
                    <input class="flex-1 bg-transparent outline-none text-hop-noir placeholder:text-gray-400 text-md" type="text" id="prenom" name="prenom" placeholder="John" required>
                </div>
            </div>

            <!-- input Nom -->
            <div class="w-full flex flex-col mb-6">
                <label for="email" class="text-xs font-bold uppercase text-gray-600 mb-1.5 ml-1 tracking-widest">Nom</label>
                <div class="flex items-center bg-gray-100 h-14 rounded-2xl px-4 focus-within:ring-2 focus-within:ring-hop-violet/20 border border-transparent focus-within:border-hop-violet/10 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="size-5 text-gray-400 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" /></svg>                
                    <input class="flex-1 bg-transparent outline-none text-hop-noir placeholder:text-gray-400 text-md" type="text" id="nom" name="nom" placeholder="Doe" required>
                </div>
            </div>

            <!-- input Email -->
            <div class="w-full flex flex-col mb-6">
                <label for="email" class="text-xs font-bold uppercase text-gray-600 mb-1.5 ml-1 tracking-widest">Email professionel</label>
                <div class="flex items-center bg-gray-100 h-14 rounded-2xl px-4 focus-within:ring-2 focus-within:ring-hop-violet/20 border border-transparent focus-within:border-hop-violet/10 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="size-5 text-gray-400 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg>
                    <input class="flex-1 bg-transparent outline-none text-hop-noir placeholder:text-gray-400 text-md" type="email" id="email" name="email" placeholder="nom@entreprise.com" required>
                </div>
            </div>

            <!-- input Mot de passe -->
            <div class="w-full flex flex-col mb-6">
                <label for="password" class="text-xs font-bold uppercase text-gray-600 mb-1.5 ml-1 tracking-widest">Mot de passe</label>
                <div class="flex items-center bg-gray-100 h-14 rounded-2xl px-4 focus-within:ring-2 focus-within:ring-hop-violet/20 border border-transparent focus-within:border-hop-violet/10 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="size-5 text-gray-400 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" /></svg>
                    <input class="flex-1 bg-transparent outline-none text-hop-noir placeholder:text-gray-400 text-md" type="password" id="password" name="password" placeholder="••••••••••••••••" required>
                </div>
            </div>


            <div class="flex flex-col w-full mb-10">
                <label class="text-xs font-bold uppercase text-gray-600 mb-1.5 ml-1 tracking-widest">Entreprise</label>
                
                <div class="relative flex items-center h-14 w-full">
                    
                    <div class="absolute left-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="size-5 text-gray-400"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" /></svg>
                    </div>

                    <select required class="appearance-none w-full h-full bg-gray-100 rounded-2xl pl-12 pr-10 text-md text-gray-400 outline-none valid:text-hop-noir">
                        <option disabled selected hidden value="" disabled selected>Choisir une entreprise</option>
                        <?php foreach($entreprises as $entreprise):?>
                            <option value="<?= $entreprise["id"] ?>"><?= $entreprise["nom"] ?></option>
                        <?php endforeach;?>
                    </select>

                    <div class="absolute right-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="size-4 text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                    
                    </div>
            </div>

            <!-- Submit -->
            <button type="submit" class="bg-hop-vert text-hop-noir text-base font-extrabold w-full h-14 rounded-2xl shadow-xl active:scale-[0.98] transition-all">
                Se connecter
            </button>
            

            <!-- Lien vers la création de compte -->
            <div class="flex items-center justify-center my-auto pt-12 pb-10">
                <p class="text-sm text-gray-500">Vous avez déjà un compte ? <a class="font-bold text-hop-violet" href="connexion.php">Connectez-vous !</a></p>
            </div>
        </form>
    </section>
</body>
</html>