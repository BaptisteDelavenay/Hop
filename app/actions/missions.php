<?php
// Fichier à include dans accueilCollaborateur.php
include("../../connexionBDD/connexionBDD.php");

$userId = $_SESSION["collaborateur_id"];

// --- 1. GESTION DES MISSIONS JOURNALIÈRES ---
// On vérifie si l'utilisateur a déjà des missions assignées aujourd'hui
$checkDaily = $db->prepare("SELECT COUNT(*) FROM `mission_assign` INNER JOIN mission ON mission_assign.mission_id = mission.id WHERE user_id = :id AND date_assignation = CURDATE() AND mission.frequence = 'journaliere'");
$checkDaily->execute(['id' => $userId]);

if ($checkDaily->fetchColumn() == 0) {
    // On pioche 3 nouvelles missions journalières
    $getDaily = $db->query("SELECT id FROM mission WHERE frequence = 'journaliere' ORDER BY RAND() LIMIT 3");
    $newMissions = $getDaily->fetchAll(PDO::FETCH_ASSOC);

    $insert = $db->prepare("INSERT INTO `mission_assign` (user_id, mission_id, date_assignation, statut, multiplicateur) VALUES (:idUser, :idMission, CURDATE(), 'en_cours', '1')");
    foreach ($newMissions as $m) {
        $insert->execute(['idUser' => $userId, 'idMission' => $m["id"]]);
    }
}

// --- 2. GESTION DES MISSIONS HEBDOMADAIRES ---
// On vérifie si l'utilisateur a des missions pour la SEMAINE ACTUELLE
// YEARWEEK(date_assignation) permet de comparer l'année et le numéro de semaine
$checkHebdo = $db->prepare("SELECT COUNT(*) FROM `mission_assign` INNER JOIN mission ON mission_assign.mission_id = mission.id WHERE user_id = :id AND YEARWEEK(date_assignation, 1) = YEARWEEK(CURDATE(), 1) AND mission.frequence = 'hebdomadaire'");
$checkHebdo->execute(['id' => $userId]);

if ($checkHebdo->fetchColumn() == 0) {
    // On pioche 3 nouvelles missions bonus hebdomadaires
    $getHebdo = $db->query("SELECT id FROM mission WHERE frequence = 'hebdomadaire' ORDER BY RAND() LIMIT 3");
    $newHebdo = $getHebdo->fetchAll(PDO::FETCH_ASSOC);

    $insertH = $db->prepare("INSERT INTO `mission_assign` (user_id, mission_id, date_assignation, statut, multiplicateur) VALUES (:idUser, :idMission, CURDATE(), 'en_cours', '1')");
    foreach ($newHebdo as $mh) {
        $insertH->execute(['idUser' => $userId, 'idMission' => $mh["id"]]);
    }
}

// --- 3. RÉCUPÉRATION POUR AFFICHAGE ---

// Missions du jour (Assignées aujourd'hui)
$sqlDaily = "SELECT ma.id, m.frequence, ma.statut, m.titre, m.description, m.points_base, m.difficulte 
             FROM `mission_assign` ma 
             INNER JOIN `mission` m ON ma.mission_id = m.id 
             WHERE ma.user_id = :id AND ma.date_assignation = CURDATE() AND m.frequence='journaliere'";
$queryDaily = $db->prepare($sqlDaily);
$queryDaily->execute(['id' => $userId]);
$missionsJournalieres = $queryDaily->fetchAll(PDO::FETCH_ASSOC);

// Missions de la semaine (Assignées n'importe quel jour de la semaine en cours)
$sqlWeekly = "SELECT ma.id, m.frequence, ma.statut, m.titre, m.description, m.points_base, m.difficulte 
              FROM `mission_assign` ma 
              INNER JOIN `mission` m ON ma.mission_id = m.id 
              WHERE ma.user_id = :id AND YEARWEEK(ma.date_assignation, 1) = YEARWEEK(CURDATE(), 1) AND m.frequence='hebdomadaire'";
$queryWeekly = $db->prepare($sqlWeekly);
$queryWeekly->execute(['id' => $userId]);
$missionsHebdo = $queryWeekly->fetchAll(PDO::FETCH_ASSOC);
?>