// import Swal from "sweetalert2";

document.querySelectorAll(".js-button-valider").forEach((btn) => {
  btn.addEventListener("click", function () {
    const id = this.getAttribute("data-id");
    const points = this.getAttribute("data-points");
    Swal.fire({
      title: "Valider la mission ?",
      text: "Soyez honnête :)",
      imageUrl: "../../IMG/mascotte.png", // Chemin vers ton SVG
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
            // 3. ICI on vérifie la réponse du PHP (data.success)
            if (data.success) {
              btn.disabled = true;
              btn.classList.remove(
                "bg-gradient-to-tr",
                "from-hop-violet",
                "to-violet-400",
              );
              btn.classList.add("border", "border-hop-violet");
              btn.disabled = true;
              btn.innerHTML =
                '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="#6030E1" class="size-8"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>';
              Swal.fire({
                title: "Hop!",
                text: "Mission validée!",
                icon: "success",
                confirmButtonColor: "#6D28D9",
                confirmButtonText: "Continuer",
              });
            } else {
              alert("Le PHP a renvoyé une erreur");
            }
          });
      }
    });
  });
});
