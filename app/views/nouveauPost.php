<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hop - Nouveau post</title>
    <link href="../../ASSETS/dist/output.css" rel="stylesheet">
</head>

<body class="bg-hop-violet flex flex-col min-h-dvh">

    <!-- texte de bienvenue et logo -->
    <header class="relative flex items-center justify-center py-8 px-6">
        <a href="EntrepriseCollaborateur.php" class="absolute left-6 p-2 rounded-full bg-white/10 active:scale-95 transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="white" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>
        
        <h1 class="text-white text-4xl font-bold leading-tight tracking-tight">Nouveau post</h1>
    </header>

    <section class="flex flex-col flex-1 bg-white rounded-t-4xl p-6">

        <p class="text-center mb-2 text-2xl font-bold mt-8">Quoi de neuf ?</p>
        <p class="text-center text-gray-500 font-medium mt-4 mb-6">Postez une information utile pour gagner des points
            bonus !</p>

        <form action="../actions/post.php" enctype="multipart/form-data" method="POST"
            class="mt-4 flex flex-col space-y-1 w-full ">

            <p for="email" class="text-xs font-bold uppercase text-gray-600 mb-1.5 ml-1 tracking-widest-1">Choisissez
                votre image</p>
            <label for="image" class="cursor-pointer mb-6 w-full">
                <div id="imgContainer"
                    class="bg-gray-100 h-60 w-full flex items-center justify-center rounded-4xl border border-dashed border-gray-400 hover:bg-gray-200 overflow-hidden transition-colors relative">
                    <svg id="uploadIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" class="size-20 stroke-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>

                    <img id="img" class="h-full w-full object-cover hidden absolute inset-0" src="" alt="Aperçu">
                </div>
                <input type="file" id="image" name="image" class="hidden">
            </label>

            <div class="w-full flex flex-col mb-6">
                <label for="description"
                    class="text-xs font-bold uppercase text-gray-600 mb-1.5 ml-1 tracking-widest-1">Description</label>

                <div
                    class="flex items-start bg-gray-100 min-h-[3.5rem] rounded-2xl px-4 py-3 focus-within:ring-2 focus-within:ring-hop-violet/20 border border-transparent focus-within:border-hop-violet/10 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5 text-gray-400 mr-3 mt-0.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>
                    <textarea
                        class="flex-1 bg-transparent outline-none text-hop-noir placeholder:text-gray-400 text-md resize-none"
                        id="description" name="description" placeholder="Écrivez une courte description ici..." rows="3"
                        required></textarea>
                </div>
            </div>

            <button type="submit"
                class="bg-hop-vert text-hop-noir text-base font-extrabold w-full h-14 rounded-2xl shadow-xl active:scale-[0.98] transition-all">
                Publier
            </button>

        </form>

    </section>
    <script src="../../JS/imgPreview.js"></script>
</body>

</html>