<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>Hop</title>
<link href="../ASSETS/dist/output.css" rel="stylesheet">
</head>
<body class="bg-hop-violet min-h-screen flex flex-col overflow-hidden font-sans">

    <header class="flex flex-col items-center justify-center py-6 shrink-0">
        <img src="../IMG/hop-clair.svg" class="w-4/12 mb-2" alt="Logo Hop">
        <h2 class="text-white  text-4xl font-bold antialiased leading-tight tracking-tight">Connexion</h>
    </header>

    <section class="bg-white flex-1 rounded-t-4xl p-6 shadow-2xl">
        
        <form class="flex flex-col items-center justify-center min-h-full w-full" action="authentification.php" method="POST">
            
            <div class="w-full space-y-8">

                <div class="flex w-full p-1 bg-gray-100 rounded-2xl">
                    <label class="flex-1 cursor-pointer">
                        <input type="radio" name="user_type" value="collaborateur" class="sr-only peer" checked>
                        <div class="flex items-center justify-center py-3 text-sm font-bold text-gray-500 transition-all rounded-xl peer-checked:bg-hop-violet peer-checked:text-white">
                            Collaborateur
                        </div>
                    </label>
                    <label class="flex-1 cursor-pointer">
                        <input type="radio" name="user_type" value="entreprise" class="sr-only peer">
                        <div class="flex items-center justify-center py-3 text-sm font-bold text-gray-500 transition-all rounded-xl peer-checked:bg-hop-violet peer-checked:text-white">
                            Entreprise
                        </div>
                    </label>
                </div>

                <div class="space-y-8">
                    <div class="flex flex-col">
                        <label class="text-xs font-bold uppercase text-gray-400 mb-1 ml-1 tracking-widest">Email pro</label>
                        <input class="bg-gray-100 border border-gray-200 h-14 rounded-2xl p-4 focus:border-hop-violet outline-none" type="email" placeholder="nom@entreprise.com" required>
                    </div>

                    <div class="flex flex-col">
                        <label class="text-xs font-bold uppercase text-gray-400 mb-1 ml-1 tracking-widest">Mot de passe</label>
                        <input class="bg-gray-100 border border-gray-200 h-14 rounded-2xl p-4 focus:border-hop-violet outline-none" type="password" placeholder="••••••••••••" required>
                        <div class="mt-2 text-right">
                            <a href="#" class="text-xs font-bold text-hop-violet/70">Mot de passe oublié ?</a>
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="bg-hop-vert text-hop-noir font-extrabold w-full h-14 rounded-2xl shadow-xl active:scale-[0.97] transition-all">
                        Se connecter
                    </button>
                    <p class="text-center mt-20 text-sm text-gray-600">
                        Nouveau ici ? <a href="inscriptionChoix.php" class="font-bold text-hop-violet">Créez un compte</a>
                    </p>
                </div>

            </div>

        </form>
    </section>

</body>
</html>