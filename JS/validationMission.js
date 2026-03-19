// import Swal from "sweetalert2";

document.querySelectorAll(".js-button-valider").forEach((btn) => {
  btn.addEventListener("click", function () {
    const id = this.getAttribute("data-id");
    console.log(id);

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
          body: "missionID=" + MissionID,
        })
          .then((response) => response.json())
          .then((data) => {
            // 3. ICI on vérifie la réponse du PHP (data.success)
            if (data.success) {
              console.log("Update effectué pour l'ID : " + id);

              Swal.fire({
                title: "Hop!",
                text: "Mission validée!",
                icon: "success",
                confirmButtonColor: "#6D28D9",
                confirmButtonText: "Continuer",
              });
            } else {
              console.log("Le PHP a renvoyé une erreur");
            }
          });
      }
    });
  });
});
