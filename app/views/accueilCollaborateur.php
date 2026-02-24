<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php
        session_start();
            if ($_SESSION['session_valide']!='OK') {
                header("Location: ../../compte/views/connexion.php");
            };
    ?>

    <h1>Bienvenue sur l'accueil du compte collaborateur !</h1>
    <a href="../../compte/actions/deconnexion.php">Deconnexion</a>
    
</body>
</html>