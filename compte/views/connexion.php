<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Hop - Connexion</title>
    <link href="../ASSETS/dist/output.css" rel="stylesheet">
</head>

<body class="bg-hop-violet h-dvh flex flex-col overflow-hidden font-sans antialiased">

    <!-- Logo et titre de la page -->
    <header class="flex flex-col items-center justify-center py-6 shrink-0">
        <img src="../IMG/hop-clair.svg" class="w-4/12 mb-2" alt="Logo Hop">
        <h2 class="text-white text-4xl font-bold leading-tight tracking-tight">Connexion</h2>
    </header>

    <section class="bg-white flex-1 rounded-t-4xl p-6 shadow-2xl">
        
        <!-- Formulaire de connexion -->
        <form class="flex flex-col items-center justify-center min-h-full w-full" action="authentification.php" method="POST">
            
            <div class="w-full space-y-8">

                <!-- Choix collaborateur ou entreprise -->
                <div class="flex w-full p-1 bg-gray-100 rounded-2xl">
                    <label class="flex-1 cursor-pointer">
                        <input type="radio" name="user_type" value="collaborateur" class="sr-only peer" checked>
                        <div class="flex items-center justify-center py-3 text-sm font-bold text-gray-400 transition-all rounded-xl peer-checked:bg-hop-violet peer-checked:text-white peer-checked:shadow-md">
                            Collaborateur
                        </div>
                    </label>
                    <label class="flex-1 cursor-pointer">
                        <input type="radio" name="user_type" value="entreprise" class="sr-only peer">
                        <div class="flex items-center justify-center py-3 text-sm font-bold text-gray-400 transition-all rounded-xl peer-checked:bg-hop-violet peer-checked:text-white peer-checked:shadow-md">
                            Entreprise
                        </div>
                    </label>
                </div>

                <div class="space-y-6">
                    
                    <!-- Input Email -->
                    <div class="flex flex-col">
                        <label class="text-xs font-bold uppercase text-gray-600 mb-1.5 ml-1 tracking-widest">Email pro</label>
                        
                        <div class="flex items-center bg-gray-100 h-14 rounded-2xl px-4 focus-within:ring-2 focus-within:ring-hop-violet/20 border border-transparent focus-within:border-hop-violet/10 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="size-5 text-gray-400 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg>
                            <input class="flex-1 bg-transparent outline-none text-hop-noir placeholder:text-gray-400 text-md" type="email" placeholder="nom@entreprise.com" required>
                        </div>
                    </div>

                    <!-- Input Mot de passe -->
                    <div class="flex flex-col">
                        <label class="text-xs font-bold uppercase text-gray-600 mb-1.5 ml-1 tracking-widest">Mot de passe</label>
                        <div class="flex items-center bg-gray-100 h-14 rounded-2xl px-4 focus-within:ring-2 focus-within:ring-hop-violet/20 border border-transparent focus-within:border-hop-violet/10 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="size-5 text-gray-400 mr-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>
                            <input class="flex-1 bg-transparent outline-none text-hop-noir placeholder:text-gray-400 text-md" type="password" placeholder="••••••••••••" required>
                            <span class="text-gray-400 focus:text-hop-violet outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" /></svg>
                            </span>
                        </div>

                        <!-- Mot de passe oublié -->
                        <div class="mt-2 text-right">
                            <a href="#" class="text-xs font-bold text-hop-violet/80">Mot de passe oublié ?</a>
                        </div>
                    </div>
                </div>

                <div class="pt-2">
                    
                    <!-- Bouton se connecter -->
                    <button type="submit" class="bg-hop-vert text-hop-noir text-base font-extrabold w-full h-14 rounded-2xl shadow-xl active:scale-[0.98] transition-all">
                        Se connecter
                    </button>
                    
                    <!-- Pas de compte -->
                    <p class="text-center mt-12 text-sm text-gray-500">
                        Nouveau ici ? <a href="inscriptionChoix.php" class="font-bold text-hop-violet">Créez un compte</a>
                    </p>
                </div>
                
            </div>
        </form>
    </section>

</body>
</html>