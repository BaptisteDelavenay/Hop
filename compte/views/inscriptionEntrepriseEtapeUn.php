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
    <header class="flex flex-col items-center justify-center py-8">
        <p class="text-white text-4xl font-bold leading-tight tracking-tight">Inscription</p>
        <p class="text-white font-medium">entreprise</p>
    </header>

    <section class="flex-1 bg-white rounded-t-4xl p-6">

        <p class="text-center mb-2 text-2xl font-bold mt-8">Inscrivez votre entreprise !</p>
        <p class="text-center text-gray-500 font-medium mt-4 mb-6">Étape 1 / 2</p>

        
        <!-- Formulaire de connexion -->
        <form class="flex flex-col justify-center items-center" action="inscriptionEntrepriseEtapeDeux.php" method="POST">


            <!-- input Nom de l'entreprise -->
            <div class="w-full flex flex-col mb-6">
                <label for="email" class="text-xs font-bold uppercase text-gray-600 mb-1.5 ml-1 tracking-widest-1">Nom de l'entreprise</label>
                <div class="flex items-center bg-gray-100 h-14 rounded-2xl px-4 focus-within:ring-2 focus-within:ring-hop-violet/20 border border-transparent focus-within:border-hop-violet/10 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="size-5 text-gray-400 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" /></svg>
                    <input class="flex-1 bg-transparent outline-none text-hop-noir placeholder:text-gray-400 text-md" type="text" id="prenom" name="prenom" placeholder="Google" required>
                </div>
            </div>

            <!-- input Secteur d'activité -->
            <div class="w-full flex flex-col mb-6">
                <label for="email" class="text-xs font-bold uppercase text-gray-600 mb-1.5 ml-1 tracking-widest">Secteur d'activité</label>
                <div class="flex items-center bg-gray-100 h-14 rounded-2xl px-4 focus-within:ring-2 focus-within:ring-hop-violet/20 border border-transparent focus-within:border-hop-violet/10 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="size-5 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M14.25 6.087c0-.355.186-.676.401-.959.221-.29.349-.634.349-1.003 0-1.036-1.007-1.875-2.25-1.875s-2.25.84-2.25 1.875c0 .369.128.713.349 1.003.215.283.401.604.401.959v0a.64.64 0 0 1-.657.643 48.39 48.39 0 0 1-4.163-.3c.186 1.613.293 3.25.315 4.907a.656.656 0 0 1-.658.663v0c-.355 0-.676-.186-.959-.401a1.647 1.647 0 0 0-1.003-.349c-1.036 0-1.875 1.007-1.875 2.25s.84 2.25 1.875 2.25c.369 0 .713-.128 1.003-.349.283-.215.604-.401.959-.401v0c.31 0 .555.26.532.57a48.039 48.039 0 0 1-.642 5.056c1.518.19 3.058.309 4.616.354a.64.64 0 0 0 .657-.643v0c0-.355-.186-.676-.401-.959a1.647 1.647 0 0 1-.349-1.003c0-1.035 1.008-1.875 2.25-1.875 1.243 0 2.25.84 2.25 1.875 0 .369-.128.713-.349 1.003-.215.283-.4.604-.4.959v0c0 .333.277.599.61.58a48.1 48.1 0 0 0 5.427-.63 48.05 48.05 0 0 0 .582-4.717.532.532 0 0 0-.533-.57v0c-.355 0-.676.186-.959.401-.29.221-.634.349-1.003.349-1.035 0-1.875-1.007-1.875-2.25s.84-2.25 1.875-2.25c.37 0 .713.128 1.003.349.283.215.604.401.96.401v0a.656.656 0 0 0 .658-.663 48.422 48.422 0 0 0-.37-5.36c-1.886.342-3.81.574-5.766.689a.578.578 0 0 1-.61-.58v0Z" /></svg>
                    <input class="flex-1 bg-transparent outline-none text-hop-noir placeholder:text-gray-400 text-md" type="text" id="nom" name="nom" placeholder="Informatique" required>
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
            <div class="w-full flex flex-col mb-10">
                <label for="password" class="text-xs font-bold uppercase text-gray-600 mb-1.5 ml-1 tracking-widest">Mot de passe</label>
                <div class="flex items-center bg-gray-100 h-14 rounded-2xl px-4 focus-within:ring-2 focus-within:ring-hop-violet/20 border border-transparent focus-within:border-hop-violet/10 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="size-5 text-gray-400 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" /></svg>
                    <input class="flex-1 bg-transparent outline-none text-hop-noir placeholder:text-gray-400 text-md" type="password" id="password" name="password" placeholder="••••••••••••••••" required>
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