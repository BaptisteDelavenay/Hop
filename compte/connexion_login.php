<?php
session_start();

error_reporting(E_ALL);
ini_set("display_errors", 1);

//Connexion a la base de données
include("../connexion_bdd.php");

if (isset($_POST["email"]) && isset($_POST["password"])) { // On regarde si les cases mail et mdp sont remplies
    $Mail = $_POST["email"];
    $Mdp = $_POST["password"];

    $verifUtilisateur = $db->prepare("SELECT * FROM user WHERE Email = :Email"); // on prends l'utilisateur qui correspond avec l'adresse mail dans la BDD
    $verifUtilisateur->execute(array(
        'Email' => $Mail
    ));
    $verif = $verifUtilisateur->fetch(PDO::FETCH_ASSOC);

    if ($verif) {

        if (password_verify($Mdp, $verif["Mdp"])) { // On vérifie que le mot de passe correspond à celle de la BDD
            session_start();
            $_SESSION['session_valide'] = 'OK';
            $_SESSION['ID'] = $verif["ID"];
            $_SESSION['Role'] = $verif["Role"];
            $_SESSION['Mail'] = htmlspecialchars($Mail);
            $_SESSION['Nom'] = htmlspecialchars($verif["Nom"]);
            $_SESSION['Prenom'] = htmlspecialchars($verif["Prenom"]);
            // header("Location: ../index_2.php");
            print("ougabouga");
            exit;
        } else {
            $_SESSION['flash_error'] = "Mot de passe incorrect.";
            // header("Location: login.php");
            print("ougaPASbouga");
            exit;
        }

    } else {
        $_SESSION['flash_error'] = "Adresse e-mail inconnue veuillez créer votre compte.";
        // header("Location: login.php");
        print("ougaPASbouga");
        exit;
    }
} else {
    $_SESSION['flash_error'] = "Veuillez remplir tous les champs.";
    // header("Location: login.php");
    print("ougaPASbouga");
    exit;
}
?>