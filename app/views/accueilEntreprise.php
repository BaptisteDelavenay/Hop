<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hop - Entreprise</title>
    <link href="../../ASSETS/dist/output.css" rel="stylesheet">

</head>
<body>

    <?php
        include "../../connexionBDD/connexionBDD.php";

        session_start();

        if ($_SESSION['session_entreprise']!='OK') {
            // header("Location: ../../compte/views/connexion.php");
            echo "erreur de session";
        };

        // Récupère toutes les infos concernant le compte connecté
        $selectEntreprise = "SELECT * FROM `entreprise` WHERE entreprise.id = :id;";
        $Entreprise = $db->prepare($selectEntreprise);
        $Entreprise->execute(array(
            'id'=>$_SESSION["entreprise_id"]
        ));

        $infosEntreprise = $Entreprise->fetch(PDO::FETCH_ASSOC);

        // Récupère le lien de la photo de profil
        $pdp = $infosEntreprise["photo_profil"];
    ?>

    <h1>Bienvenue sur l'accueil du compte entreprise !</h1>
    <img class="w-20" src="<?= $pdp ?>" alt="">
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