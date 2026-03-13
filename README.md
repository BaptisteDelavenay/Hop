/!\ INSTALLER LE PROJET /!\

Pour que tailwind s'applique correctement, il faut saisir les 2 commandes suivantes dans la console de l'IDE :

npm install

npx tailwindcss -i ./ASSETS/src/input.css -o ./ASSETS/dist/output.css --watch

La deuxième commande doit être re-éxecutée à chaque fois pour que tailwind fonctionne correctement

Architecture :

    - Compte et App contienne 2 sous dossiers :

        - "Views" pour tous les fichiers php qui affichent de l'html dans le navigateur

        - "Action" pour tous les fichiers qui s'occupent du back (interaction avec la bdd etc...)

    - Le dossier compte contient tous les éléments relatif à la connexion et création de compte des utilisateurs

    - Le dossier app contient le reste de l'application

    - Le dossier composant contient tous les composants qu'on a besoin d'utiliser sur    plusieurs pages sans les modifier (ex : barre de navigation). Au lieu de l'écrire plusieurs fois dans le code on l'écrit une fois dans un fichier à part et on l'include où on en a besoin.
