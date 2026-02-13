<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hop</title>
    <link href="../ASSETS/dist/output.css" rel="stylesheet">
</head>
<body>

    <!-- texte de bienvenue et logo -->
    <p class="text-center text-lg font-extrabold mt-10">Connexion</p>
    <img src="../IMG/Logo_png.png" class="w-6/12 m-auto" alt="">

    <!-- Formulaire de connexion -->
    <form class="flex flex-col justify-center items-center" action="authentification.php" method="POST">

        <!-- Choix collaborateur ou entreprise -->
        <div class="flex w-11/12 p-1 bg-gray-200 rounded-xl mb-8">
    
            <label class="flex-1 cursor-pointer">
                <input type="radio" name="user_type" value="collaborateur" class="sr-only peer" checked>
                <div class="flex items-center justify-center py-2 text-sm font-semibold text-gray-600 transition-all rounded-lg peer-checked:bg-white peer-checked:text-gray-900 peer-checked:shadow-sm">
                    Collaborateur
                </div>
            </label>

            <label class="flex-1 cursor-pointer">
                <input type="radio" name="user_type" value="entreprise" class="sr-only peer">
                <div class="flex items-center justify-center py-2 text-sm font-semibold text-gray-600 transition-all rounded-lg peer-checked:bg-white peer-checked:text-gray-900 peer-checked:shadow-sm">
                    Entreprise
                </div>
            </label>
        
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

        <!-- Mot de passe oublié ? -->
        <div class="w-11/12">
            <a href="" class="float-right">Mot de passe oublié ?</a>
        </div>

        <!-- Submit -->
        <input type="submit" value="Se connecter" class="w-11/12 bg-gray-400 h-10 rounded-lg mt-14">

        <!-- Lien vers la création de compte -->
        <p class="text-center mt-14">Vous n'avez pas de compte ? <a href="inscriptionChoix.php">Créez-en un !</a></p>
    </form>
</body>
</html>