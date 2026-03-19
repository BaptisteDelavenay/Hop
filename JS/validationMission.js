document.querySelectorAll(".js-button-valider").forEach((btn) => {
  btn.addEventListener("click", function () {
    const id = this.getAttribute("data-id");
    console.log(id);
  });
});
