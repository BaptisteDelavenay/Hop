const PointsUtilisateur = document.querySelector(".js-points-utilisateur");
const PointsPalier = document.querySelector(".js-points-palier");
const BarreProgression = document.querySelector(".js-barre-progression ");

PointsPalier.dataset.palier = PointsPalier.dataset.palier.replaceAll("/", "");

let progression = PointsUtilisateur.dataset.progression;
let palier = PointsPalier.dataset.palier;

console.log(progression);
console.log(palier);

pourcentage = (progression * 100) / palier;

console.log(Math.floor(pourcentage), "%");

// Au lieu de classList.add, on modifie directement le style CSS
BarreProgression.style.width = Math.floor(pourcentage) + "%";
