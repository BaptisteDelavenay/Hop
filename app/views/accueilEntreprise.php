<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hop - Entreprise</title>
</head>
<body>

    <?php
        include "../../connexionBDD/connexionBDD.php";

        session_start();

        if ($_SESSION['session_entreprise']!='OK') {
            // header("Location: ../../compte/views/connexion.php");
            echo "erreur de session";
        };

        // print_r($_SESSION);
    ?>

    <h1>Bienvenue sur l'accueil du compte entreprise !</h1>
    <a href="../../compte/actions/deconnexion.php">Deconnexion</a>

    <?php
    
        $selectUserEntreprise = "SELECT user.id, user.prenom, user.nom FROM `user` INNER JOIN `entreprise` ON user.entreprise_id = entreprise.id WHERE entreprise.id = :id;";
        $userEntreprise = $db->prepare($selectUserEntreprise);
        $userEntreprise->execute(array(
            'id'=>$_SESSION["entreprise_id"]
        ));

        $users = $userEntreprise->fetchAll(PDO::FETCH_ASSOC);
    
        echo "<pre>";
        print_r($users);
        echo "</pre>";

    ?>
    
</body>
</html>