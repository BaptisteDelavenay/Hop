<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hop</title>
    <link href="../ASSETS/dist/output.css" rel="stylesheet">
</head>
<body class="bg-hop-violet min-h-screen antialiased p-4">

    <!-- Titre de la page -->
    <header class="flex flex-col items-center justify-center py-6 mb-6 gap-6 shrink-0">
        <h2 class="text-white text-4xl font-bold antialiased leading-tight tracking-tight">Inscription</h2>
        <p class="text-white text-xl font-medium">Qui êtes vous ?</p>
    </header>

    <section class="flex flex-col flex-1 gap-6">    
        
        <!-- Carte création de compte collaborateur -->
        <a href="inscriptionCollaborateur.php" class="flex flex-col bg-white h-70 w-11/12 mx-auto p-4 rounded-xl active:scale-[0.97] transition-all">
            <div class="flex items-center justify-between">
                <div class="bg-hop-violet p-2 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                </div>
            </div>
            <div class="mt-4">
                <p class="text-3xl mb-4 font-bold antialiased leading-tight tracking-tight">Collaborateur</p>
                <p class="mb-4">Rejoignez votre entreprise !</p>
            </div>

            <div class="flex items-center justify-center w-full h-30 rounded-lg mt-auto overflow-hidden">
                <img src="../IMG/collaborateur.png" alt="">
            </div>
        </a>

        <!-- Carte création de compte entreprise -->
        <a href="inscriptionEntrepriseEtapeUn.php" class="flex flex-col bg-white h-70 w-11/12 mx-auto p-4 rounded-xl active:scale-[0.97] transition-all">
            <div class="flex items-center justify-between">
                <div class="bg-hop-violet p-2 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" /></svg>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="black" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                </div>
            </div>

            <div class="mt-4">
                <p class="text-3xl mb-4 font-bold antialiased leading-tight tracking-tight">Entreprise</p>
                <p class="mb-4">Inscrivez votre entreprise !</p>
            </div>

            <div class="flex items-center justify-center w-full h-30 rounded-lg mt-auto overflow-hidden">
                <img src="../IMG/entreprise.png" alt="">
            </div>
        </a>

    </section>


    <!-- Déjà inscrit ? -->
    <div class="mt-auto pt-10 mb-auto pb-6">
        <p class="text-center text-white">Déjà inscrit ? <a class="font-bold" href="connexion.php">Connectez-vous !</a></p>
    </div>

</body>
</html>