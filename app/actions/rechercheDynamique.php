<?php

    include("../../connexionBDD/connexionBDD.php");

    $input = $_POST["input"]."%";

    $selectResult = "SELECT * FROM user WHERE prenom LIKE :search OR nom LIKE :search LIMIT 10";
    $result = $db->prepare($selectResult);
    $result->execute([
        'search' => $input
    ]);

    $res = $result->fetchAll(PDO::FETCH_ASSOC);

    if($res){
        echo json_encode($res);
    }
    else{
        echo json_encode("Aucun résultat");
    }
?>