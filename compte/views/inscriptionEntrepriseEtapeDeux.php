<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hop</title>
    <link href="../../ASSETS/dist/output.css" rel="stylesheet">
</head>

<?php

    // Récupère les infos du premier formulaire pour les mettre dans $_SESSION pour la deuxième étape

    $nomEntreprise = htmlentities($_POST["nomEntreprise"]);
    $activite = htmlentities($_POST["activite"]);
    $email = htmlentities($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    session_start();

    $_SESSION["tempo"]['nomEntreprise'] = $nomEntreprise;
    $_SESSION["tempo"]['activite'] = $activite;
    $_SESSION["tempo"]['email'] = $email;
    $_SESSION["tempo"]['password'] = $password;

?>


<body class="bg-hop-violet min-h-dvh flex flex-col">

    <!-- texte de bienvenue et logo -->
    <header class="flex flex-col items-center justify-center py-8">
        <p class="text-white text-4xl font-bold leading-tight tracking-tight">Inscription</p>
        <p class="text-white font-medium">entreprise</p>
    </header>

    <section class="flex-1 flex flex-col items-center bg-white rounded-t-4xl p-6">

        <p class="text-center mb-2 text-2xl font-bold mt-6">Inscrivez votre entreprise !</p>
        <p class="text-center text-gray-500 font-medium mt-2 mb-4">Étape 2 / 2</p>

        <!-- Input pour la photo de profil de l'entreprise -->

        <form action="../actions/creationCompteEntreprise.php" enctype="multipart/form-data" method="POST" class="flex items-center justify-center flex-col space-y-1 w-full">

            <label for="photoDeProfil" class="cursor-pointer mb-6">
                <div id="imgContainer" class="bg-gray-100 h-60 w-60 flex items-center justify-center rounded-full border border-1 border-gray-400 hover:bg-gray-200 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="size-30 stroke-gray-400"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                    <img id="img" class="h-full w-ful object-cover hidden" src="" alt="">
                </div>
                <input type="file" id="photoDeProfil" name="photoDeProfil" class="hidden">
            </label>

            <p class="text-lg font-bold">Ajoutez votre logo</p>
            <p>fichiers autorisés : .jpg, .avif, .webp</p>

            <div class="mt-auto pt-20 flex items-center flex-col gap-6 w-full">
                <button class="bg-gray-300 text-gray-600 text-base font-extrabold w-full h-14 rounded-2xl active:scale-[0.98] transition-all">Passer cette étape</button>
                <button type="submit" class="bg-hop-vert text-hop-noir text-base font-extrabold w-full h-14 rounded-2xl shadow-xl active:scale-[0.98] transition-all">S'inscrire</button>
            </div>

        </form>

    </section>

    <script src="../../JS/pdpPreview.js"></script>

</body>
</html>