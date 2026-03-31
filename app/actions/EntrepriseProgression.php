<?php
$entrepriseID = $_SESSION["collaborateur_entreprise_id"];

// Requête SQL
$sqlEntreprise = "SELECT COUNT(id) as nb_employes, SUM(total_points) as points_collectifs FROM `user` WHERE entreprise_id = :id";
$queryEntreprise = $db->prepare($sqlEntreprise);
$queryEntreprise->execute(["id" => $entrepriseID ]);
$dataEntreprise = $queryEntreprise->fetch(PDO::FETCH_ASSOC);

// Sécurisation des données
$pointsCollectifs = $dataEntreprise['points_collectifs'] ?? 0;
// Sécurité anti-division par zéro
$nbEmployes = (isset($dataEntreprise['nb_employes']) && $dataEntreprise['nb_employes'] > 0) ? $dataEntreprise['nb_employes'] : 1;

// Logique de progression
$objectifAnnuelTotal = $nbEmployes * 11000;
$pourcentage = ($pointsCollectifs / $objectifAnnuelTotal) * 100;
if ($pourcentage > 100) $pourcentage = 100;

// Calcul du niveau (1 à 10)
$paliers = [
    10 => 100, // Niveau 10 à 100%
    9  => 80,
    8  => 60,
    7  => 45,
    6  => 30,
    5  => 20,
    4  => 12,
    3  => 6,  // Niveau 3 à 6%
    2  => 2,  // Niveau 2 à seulement 2% (très motivant au début !)
    1  => 0   // Niveau 1 par défaut
];

$niveauEntreprise = 1;
foreach ($paliers as $niv => $seuil) {
    if ($pourcentage >= $seuil) {
        $niveauEntreprise = $niv;
        break; // On s'arrête dès qu'on trouve le palier atteint le plus haut
    }
}
?>