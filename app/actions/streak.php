<?php
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function checkAndGetStreak($db, $userId) {
    // 1. On récupère les infos de l'utilisateur
    $query = $db->prepare("SELECT streak, derniere_mission_date FROM user WHERE id = :id");
    $query->execute(['id' => $userId]);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    $streak = $user['streak'] ?? 0;
    $lastDate = $user['derniere_mission_date'];
    $today = date('Y-m-d');

    // S'il n'a jamais rien validé, la streak est de 0
    if (!$lastDate) {
        return 0;
    }

    // Si la dernière validation est aujourd'hui, la streak est valide, on ne fait rien
    if ($lastDate === $today) {
        return $streak;
    }

    // 2. Vérification des jours manqués (On ignore les week-ends)
    $currentDate = new DateTime($lastDate);
    $currentDate->modify('+1 day'); // On commence à vérifier le lendemain de la dernière validation
    $endDate = new DateTime($today);
    $missedWeekday = false;

    // On boucle sur tous les jours entre la dernière validation et aujourd'hui
    while ($currentDate < $endDate) {
        // 'N' retourne 1 pour Lundi, jusqu'à 7 pour Dimanche
        $dayOfWeek = $currentDate->format('N');
        
        // Si le jour manqué est entre Lundi (1) et Vendredi (5), la streak est brisée
        if ($dayOfWeek <= 5) {
            $missedWeekday = true;
            break;
        }
        $currentDate->modify('+1 day');
    }

    // 3. Si un jour de semaine a été manqué, on réinitialise à 0 en BDD
    if ($missedWeekday) {
        $streak = 0;
        $update = $db->prepare("UPDATE user SET streak = 0 WHERE id = :id");
        $update->execute(['id' => $userId]);
    }

    return $streak;
}

/**
 * À appeler quand l'utilisateur valide une mission.
 */
function incrementStreak($db, $userId) {
    error_log("Lancement de incrementStreak pour l'utilisateur : " . $userId);
    // On s'assure d'abord que la streak est à jour (pas brisée)
    $currentStreak = checkAndGetStreak($db, $userId);
    $today = date('Y-m-d');
    
    // On revérifie la date en BDD au cas où la fonction précédente l'a modifiée
    $query = $db->prepare("SELECT derniere_mission_date FROM user WHERE id = :id");
    $query->execute(['id' => $userId]);
    $lastDate = $query->fetchColumn();

    // Si on n'a pas encore validé de mission aujourd'hui, on incrémente !
    if ($lastDate !== $today) {
        $newStreak = $currentStreak + 1;
        $update = $db->prepare("UPDATE user SET streak = :streak, derniere_mission_date = :today WHERE id = :id");
        $update->execute([
            'streak' => $newStreak,
            'today' => $today,
            'id' => $userId
        ]);
        return $newStreak;
    }

    // S'il avait déjà validé une mission aujourd'hui, la streak ne bouge pas
    return $currentStreak;
}
?>