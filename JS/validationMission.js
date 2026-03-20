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
        let MissionID = id;

        fetch("../actions/validerMission.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: `missionID=${MissionID}&missionPoints=${points}`,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.success) {
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
              btn.innerHTML =
                '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="#6030E1" class="size-8"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>';

              // Maj dynamique de l'état de la barre
              const pointsUtilisateur = document.querySelector('.js-points-utilisateur');
              const pointsPalier = document.querySelector('.js-points-palier');
              
              // Mettre a jour les data attributs
              pointsUtilisateur.setAttribute('data-progression', data.nouveauxPointsRelatifs);
              pointsPalier.setAttribute('data-palier', data.nouvelObjectif);
              
              pointsPalier.innerHTML = `<b data-progression="${data.nouveauxPointsRelatifs}" class="js-points-utilisateur text-black font-bold">${data.nouveauxPointsRelatifs} </b>/ ${data.nouvelObjectif}pts`;

              const niveauElement = document.querySelector('p.text-gray-500 b');
              if (niveauElement) {
                niveauElement.textContent = data.nouveauNiveau;
              }

              // Fonction qui actualise la barre
              majBarre(pointsUtilisateur, pointsPalier);

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
                text: "Une erreur s'est produite lors de la validation",
                icon: "error",
                confirmButtonColor: "#d33",
              });
            }
          })
          .catch((error) => {
            Swal.fire({
              title: "Erreur",
              text: "Impossible de contacter le serveur",
              icon: "error",
              confirmButtonColor: "#d33",
            });
          });
      }
    });
  });
});