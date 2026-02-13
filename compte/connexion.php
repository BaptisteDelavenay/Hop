<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../ASSETS/dist/output.css" rel="stylesheet">
</head>
<body>
    <p>Connexion</p>
    <img src="../IMG/Logo_png.png" alt="">
    <form action="verifConnexion.php" method="POST">
        <label for="email">Email professionel</label>
        <input type="email" id="email" name="email">

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password">

        <a href="">Mot de passe oublié ?</a>

        <input type="submit" value="Se connecter">

        <p>Vous n'avez pas de compte ? <a href="">Créez-en un !</a></p>
    </form>
</body>
</html>