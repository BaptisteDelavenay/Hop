<?php
    // Récupérer l'entreprise de l'utilisateur
    $getInfoUtilisateur = "SELECT entreprise_id FROM user WHERE id=:idCollaborateur";
    $infoUtilisateur = $db->prepare($getInfoUtilisateur);
    $infoUtilisateur->execute(array(
        'idCollaborateur'=>$_SESSION["collaborateur_id"]
        ));
    $infoUtilisateur = $infoUtilisateur->fetch(PDO::FETCH_ASSOC);

    $idEntreprise = $infoUtilisateur["entreprise_id"];

    
    function tempsEcoule($date_creation) {
        $timestamp = strtotime($date_creation);
        $diff = time() - $timestamp;

        if ($diff < 60) {
            return "À l'instant";
        } elseif ($diff < 3600) {
            $mins = floor($diff / 60);
            return "Il y a " . $mins . " min";
        } elseif ($diff < 86400) {
            $heures = floor($diff / 3600);
            return "Il y a " . $heures . " h";
        } elseif ($diff < 604800) {
            $jours = floor($diff / 86400);
            return "Il y a " . $jours . " j";
        } else {
            // Au-delà d'une semaine, on affiche la date réelle
            return "Le " . date('d/m/Y', $timestamp);
        }
    }


    // Récupérer toutes les infos de posts pour les afficher dans le feed
    $getFeed = "SELECT user.prenom, user.nom, user.photo_profil, feed.id_utilisateur, feed.image, feed.description, feed.nb_likes, feed.date FROM feed INNER JOIN user ON user.id = feed.id_utilisateur INNER JOIN entreprise ON user.entreprise_id = entreprise.id WHERE entreprise.id = :idEntreprise ORDER BY feed.date DESC";
    $feed = $db->prepare($getFeed);
    $feed->execute(array(
        'idEntreprise'=>$idEntreprise        
    ));
    $feed = $feed->fetchAll(PDO::FETCH_ASSOC);
?>