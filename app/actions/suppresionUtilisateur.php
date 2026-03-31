<?php

    session_start();

    include "../../connexionBDD/connexionBDD.php";

    $idUtilisateur = $_GET["id"];
    echo $idUtilisateur;

    $SupprimerUtilisateur = $db->prepare("DELETE FROM user WHERE id=:idUtilisateur");
    $SupprimerUtilisateur->execute(['idUtilisateur' => $idUtilisateur]);

    if($SupprimerUtilisateur){
        header("Location: ../views/listeUtilisateurEntreprise.php");
        exit;
    }

?>