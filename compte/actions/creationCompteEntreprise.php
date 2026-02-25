<?php

    include "../../connexionBDD/connexionBDD.php";

    session_start();

    // Récupérer toutes les infos saisies dans les 2 formulaires
    $nomEntreprise = $_SESSION["tempo"]["nomEntreprise"];
    $activite = $_SESSION["tempo"]["activite"];
    $email = $_SESSION["tempo"]["email"];
    $password = $_SESSION["tempo"]["password"];
    $logo = $_POST["photoDeProfil"];




?>