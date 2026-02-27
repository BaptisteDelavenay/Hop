let img = document.getElementById("img");
let imgContainer = document.getElementById("imgContainer");
let inputFile = document.getElementById("photoDeProfil");

inputFile.addEventListener("change", function () {
  const file = this.files[0]; // On récupère le fichier

  if (file) {
    const reader = new FileReader();

    reader.onload = function (e) {
      // 1. On met la source de l'image avec les données du fichier
      img.src = e.target.result;
      // 2. On affiche l'image et on cache l'icône
      img.classList.remove("hidden");
      inputFile.classList.add("hidden");
    };

    reader.readAsDataURL(file);
  }
});
