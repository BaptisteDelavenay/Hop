const PointsUtilisateur = document.querySelector(".js-points-utilisateur");
const PointsPalier = document.querySelector(".js-points-palier");
const BarreProgression = document.querySelector(".js-barre-progression");

function majBarre(utilisateur, prochainPalier) {

    // Nettoie la valeur récupérée pour garger que le chiffre
    let palierValue = prochainPalier.dataset.palier.toString().replaceAll("/", "");
    prochainPalier.dataset.palier = palierValue;
    
    let progression = parseFloat(utilisateur.dataset.progression);
    let palier = parseFloat(palierValue);
    
    let pourcentage = (progression * 100) / palier;
    BarreProgression.style.width = Math.floor(pourcentage) + "%";
}

majBarre(PointsUtilisateur, PointsPalier);