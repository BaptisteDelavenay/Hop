document.querySelectorAll(".js-button-valider").forEach((btn) => {
  btn.addEventListener("click", function () {
    const id = this.getAttribute("data-id");
    const points = this.getAttribute("data-points");

    Swal.fire({
      title: "Valider la mission ?",
      text: "Soyez honnête :)",
      imageUrl: "../../IMG/mascotte.png",
      imageWidth: 100,
      imageHeight: 100,
      showCancelButton: true,
      reverseButtons: true,
      confirmButtonColor: "#6030E1",
      cancelButtonColor: "#d33",
      confirmButtonText: "Valider",
    }).then((result) => {
      if (result.isConfirmed) {
        
        fetch("../actions/validerMission.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: `missionID=${id}&missionPoints=${points}`,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.success) {
              
              let missionDiv = btn.closest('.w-full.bg-white') || btn.closest('.w-full.bg-hop-violet\\/10');
              
              if (missionDiv) {
                missionDiv.classList.remove("bg-white");
                missionDiv.classList.add("bg-hop-violet/10");
              }

              // Mise à jour du bouton
              btn.disabled = true;
              btn.classList.remove(
                "bg-gradient-to-tr",
                "from-hop-violet",
                "to-violet-400",
                "shadow-lg",
                "active:scale-90",
                "transition-all"
              );
              btn.classList.add("border", "border-hop-violet");
              btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="#6030E1" class="size-8"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>';

              const pointsUtilisateur = document.querySelector('.js-points-utilisateur');
              const pointsPalier = document.querySelector('.js-points-palier');
              const niveauElement = document.querySelector('p.text-gray-500 b');

              // On ne met à jour la barre et les points que s'ils existent sur la page actuelle
              if (pointsUtilisateur && pointsPalier) {
                pointsUtilisateur.setAttribute('data-progression', data.nouveauxPointsRelatifs);
                pointsPalier.setAttribute('data-palier', data.nouvelObjectif);
                
                pointsPalier.innerHTML = `<b data-progression="${data.nouveauxPointsRelatifs}" class="js-points-utilisateur text-black font-bold">${data.nouveauxPointsRelatifs} </b>/ ${data.nouvelObjectif}pts`;

                // On n'appelle la fonction de la barre que si elle est chargée en mémoire
                if (typeof majBarre === "function") {
                  majBarre(pointsUtilisateur, pointsPalier);
                }
              }

              // Mise à jour du niveau (si l'élément est présent)
              if (niveauElement) {
                niveauElement.textContent = data.nouveauNiveau;
              }

              // Message de succès
              Swal.fire({
                title: "Hop!",
                text: `Mission validée! +${data.pointsGagnes}pts`,
                icon: "success",
                confirmButtonColor: "#6D28D9",
                confirmButtonText: "Continuer",
              });
              
            } else {
              Swal.fire({
                title: "Erreur",
                text: data.message || "Une erreur s'est produite lors de la validation",
                icon: "error",
                confirmButtonColor: "#d33",
              });
            }
          })
          .catch((error) => {
            console.error("Erreur de retour :", error);
            Swal.fire({
              title: "Erreur",
              text: "Impossible de contacter le serveur ou erreur de lecture des données",
              icon: "error",
              confirmButtonColor: "#d33",
            });
          });
      }
    });
  });
});