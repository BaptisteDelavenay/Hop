let modalProfile = document.querySelector(".js-CompteModal");
let btnModalProfile = document.querySelector(".js-btnModal");
let btnCloseModal = document.querySelector(".js-closeModal");
let body = document.body;

btnModalProfile.addEventListener("click", function () {
  modalProfile.classList.remove("hidden");
  modalProfile.classList.add("fixed");
  body.classList.add("overflow-hidden");

  btnCloseModal.addEventListener("click", function () {
    modalProfile.classList.remove("fixed");
    modalProfile.classList.add("hidden");
    body.classList.remove("overflow-hidden");
  });
});
