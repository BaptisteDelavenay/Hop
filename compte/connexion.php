<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../ASSETS/dist/output.css" rel="stylesheet">
</head>
<body>
    <p class="text-center">Connexion</p>
    <img src="../IMG/Logo_png.png" alt="">
    <form class="flex flex-col justify-center items-center" action="verifConnexion.php" method="POST">

        <div class="flex w-11/12 p-1 bg-gray-200 rounded-xl">
    
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


        <div class="w-11/12 flex flex-col">
            <label for="email">Email professionel</label>
            <input class="bg-gray-200 h-10 rounded-lg" type="email" id="email" name="email">
        </div>

        <div class="w-11/12 flex flex-col">
            <label for="password">Mot de passe</label>
            <input class="bg-gray-200 h-10 rounded-lg" type="password" id="password" name="password">
        </div>
        <a href="" class="">Mot de passe oublié ?</a>

        <input type="submit" value="Se connecter" class="w-11/12 bg-gray-400 h-10 rounded-lg">

        <p class="text-center">Vous n'avez pas de compte ? <a href="">Créez-en un !</a></p>
    </form>
</body>
</html>