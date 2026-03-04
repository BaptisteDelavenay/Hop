<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hop - Classement</title>
    <link href="../../ASSETS/dist/output.css" rel="stylesheet">

</head>
<body class="bg-hop-violet">
    <header class="px-4">
        <h2 class="text-white text-center text-4xl font-bold leading-tight tracking-tight my-6">Classement</h2>
        <div class="flex w-full p-1 bg-gray-100 rounded-2xl">
            <label class="flex-1 cursor-pointer">
                <input type="radio" name="user_type" value="collaborateur" class="sr-only peer" checked>
                <div class="flex items-center justify-center py-3 text-sm font-bold text-gray-400 transition-all rounded-xl peer-checked:bg-hop-violet peer-checked:text-white peer-checked:shadow-md">
                    Mois
                </div>
            </label>
            <label class="flex-1 cursor-pointer">
                <input type="radio" name="user_type" value="entreprise" class="sr-only peer">
                <div class="flex items-center justify-center py-3 text-sm font-bold text-gray-400 transition-all rounded-xl peer-checked:bg-hop-violet peer-checked:text-white peer-checked:shadow-md">
                    Global
                </div>
            </label>
        </div>
    </header>
    <section class="flex justify-evenly pt-10">
        <div class="flex flex-col justify-end items-center gap-2">
            <div class="bg-black rounded-full h-25 w-25"></div>
            <p class="text-white font-bold">John Doe</p>
            <div class="w-25 h-50 bg-gradient-to-t from-hop-violet from-5% via-hop-violet/40 via-5% to-white to-50% text-gray-600 font-bold text-4xl flex justify-center pt-10">
                2
            </div>
        </div>
        <div class="flex flex-col justify-end items-center gap-2">
            <div class="bg-black rounded-full h-25 w-25"></div>
            <p class="text-white font-bold">John Doe</p>
            <div class="w-25 h-60 bg-gradient-to-t from-hop-violet from-5% via-hop-violet/40 via-5% to-white to-50% text-amber-400 font-bold text-4xl flex justify-center pt-10">
                1
            </div>
        </div>
        <div class="flex flex-col justify-end items-center gap-2">
            <div class="bg-black rounded-full h-25 w-25"></div>
            <p class="text-white font-bold">John Doe</p>
            <div class="w-25 h-40 bg-gradient-to-t from-hop-violet from-5% via-hop-violet/40 via-5% to-white to-50% text-amber-700 font-bold text-4xl flex justify-center pt-10">
                3
            </div>
        </div>

    </section>
    <section class="bg-white rounded-t-4xl h-100 w-full"></section>
    <?php include("../../composants/nav.php");?>
</body>
</html>