<?php
$entrepriseID = $_SESSION["collaborateur_entreprise_id"];

// 1. Récupération des données brutes
$sqlEntreprise = "SELECT COUNT(id) as nb_employes, SUM(total_points) as points_collectifs FROM `user` WHERE entreprise_id = :id";
$queryEntreprise = $db->prepare($sqlEntreprise);
$queryEntreprise->execute(["id" => $entrepriseID]);
$dataEntreprise = $queryEntreprise->fetch(PDO::FETCH_ASSOC);

$pointsCollectifs = $dataEntreprise['points_collectifs'] ?? 0;
$nbEmployes = (isset($dataEntreprise['nb_employes']) && $dataEntreprise['nb_employes'] > 0) ? $dataEntreprise['nb_employes'] : 1;

// --- CONFIGURATION DU SYSTÈME D'XP ---
$ptsParEmployeNiv1 = 2000; // Points nécessaires pour passer au niv 2 (par employé)
$multiplicateurDifficulte = 1.4; // Chaque niveau est 40% plus dur que le précédent
$effortBase = $nbEmployes * $ptsParEmployeNiv1;

// 2. Génération des seuils de points (Paliers cumulés)
$paliersPoints = [1 => 0]; // Niveau 1 commence à 0 point
$cumul = 0;

for ($i = 1; $i <= 10; $i++) {
    // Calcul de l'XP requise pour franchir CE niveau précis
    $besoinPourCeNiveau = $effortBase * pow($multiplicateurDifficulte, $i - 1);
    $cumul += $besoinPourCeNiveau;
    $paliersPoints[$i + 1] = round($cumul); 
}

// 3. Déterminer le niveau actuel
$niveauEntreprise = 1;
$seuilActuel = 0;
$seuilSuivant = $paliersPoints[2];

foreach ($paliersPoints as $niv => $pointsRequis) {
    if ($pointsCollectifs >= $pointsRequis) {
        $niveauEntreprise = $niv;
        $seuilActuel = $pointsRequis;
        $seuilSuivant = $paliersPoints[$niv + 1] ?? $pointsRequis;
    } else {
        break; // On a trouvé le niveau max atteint
    }
}

// 4. Calcul de la progression INTERNE (pour la barre qui se vide/remplit)
$pointsDansCeNiveau = $pointsCollectifs - $seuilActuel;
$distanceEntrePaliers = $seuilSuivant - $seuilActuel;

// Calcul du pourcentage de la barre (0 à 100%)
if ($distanceEntrePaliers > 0) {
    $pourcentageBarre = ($pointsDansCeNiveau / $distanceEntrePaliers) * 100;
} else {
    $pourcentageBarre = 100; // Cas du niveau max
}

// Sécurités
if ($pourcentageBarre > 100) $pourcentageBarre = 100;
if ($pourcentageBarre < 0) $pourcentageBarre = 0;

// On garde cette variable pour ton affichage de "points collectifs" totaux en bas si besoin
$objectifFinalAnnuel = $paliersPoints[11] ?? $cumul; 
?>