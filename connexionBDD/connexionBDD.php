<?php

// try {
//     $db = new PDO('mysql:host=localhost;dbname=db-delavbap', 'usr-delavbap', 'e(qR/BU)pYPu', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
// } catch (Exception $e) {
//     die('Erreur : ' . $e->getMessage());
// }
try {
    $db = new PDO('mysql:host=localhost;dbname=hop', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

?>