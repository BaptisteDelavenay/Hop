<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hop - erreur 404</title>
    <link href="../ASSETS/dist/output.css" rel="stylesheet">
</head>
<?php session_start(); ?>
<body class="bg-hop-violet min-h-screen flex flex-col">
    <section class="flex flex-col items-center gap-6 mt-30 bg-[#F8F6FF] p-4 w-full rounded-t-3xl min-h-full flex-1 pt-10">
        <img class="h-50 w-50" src="../IMG/mascotte.png" alt="">
        <h2 class="text-6xl font-bold">403</h2>
        <p>Oups... Vous n'avez pas accès à ce fichier !</p>
        <a class="mt-10" href="../app/views/accueilCollaborateur.php"><button class="flex text-lg gap-2 items-center bg-gradient-to-tr from-hop-violet to-violet-400 px-7 py-4 rounded-4xl text-white font-bold active:scale-90 transition-all">Revenir en lieu sûr</button></a>
    </section>
</body>
</html>