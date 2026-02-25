<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hop - Collaborateur</title>
    <link href="../../ASSETS/dist/output.css" rel="stylesheet">

</head>
<body>

    <?php
        session_start();
            if ($_SESSION['session_collaborateur']!='OK') {
                // header("Location: ../../compte/views/connexion.php");
                echo "erreur de session";
            };
    ?>


    
</body>
</html>