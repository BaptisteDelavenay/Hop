let input = document.getElementById("inpuntName");
let aucunResultat = document.getElementById("aucunResultat");
let listeUtilisateurs = document.getElementById("listeUtilisateurs");

function resultatUtilisateur(data){
    listeUtilisateurs.innerHTML="";
    aucunResultat.innerHTML="";
    data.forEach(elem=>{
        let container = document.createElement("div");
        container.classList.add("flex","items-center","justify-between");
        listeUtilisateurs.appendChild(container);    

        let infosUtilisateur = document.createElement("div");
        infosUtilisateur.classList.add("flex","items-center","gap-3");
        container.appendChild(infosUtilisateur);
                
        let photoProfil = document.createElement("img");
        photoProfil.classList.add("w-12","h-12","rounded-full","flex","items-center","justify-center","scale-110","object-cover");
        photoProfil.src = `${elem.photo_profil}`;
        infosUtilisateur.appendChild(photoProfil);

        let divPrenomNom = document.createElement("div");
        infosUtilisateur.appendChild(divPrenomNom);

        let PrenomNom = document.createElement("p");
        PrenomNom.classList.add("font-semibold","items-center","justify-between");
        PrenomNom.innerHTML=`${elem.prenom} ${elem.nom}`;
        divPrenomNom.appendChild(PrenomNom);

        let points = document.createElement("p");
        points.classList.add("text-sm","text-gray-500");
        points.innerHTML=`${elem.total_points || 0} points`;
        divPrenomNom.appendChild(points);    
                
        let menuContainer = document.createElement("div");
        
        let btnDelete = document.createElement("button");
        btnDelete.type = "button";
        btnDelete.classList.add("btn-delete", "text-gray-400", "hover:text-red-500", "text-2xl", "font-bold", "transition-all", "active:scale-90");
        btnDelete.innerHTML = `⋮`;
        btnDelete.setAttribute("data-id", elem.id);
        btnDelete.setAttribute("data-name", `${elem.prenom} ${elem.nom}`);

        btnDelete.addEventListener('click', function() {
            const userId = this.getAttribute('data-id');
            const userName = this.getAttribute('data-name');

            Swal.fire({
                title: 'Supprimer ce collaborateur ?',
                text: `Voulez-vous vraiment supprimer ${userName} ? Cette action est définitive.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, supprimer !',
                cancelButtonText: 'Annuler',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `../actions/suppresionUtilisateur.php?id=${userId}`;
                }
            });
        });

        menuContainer.appendChild(btnDelete);
        container.appendChild(menuContainer);            
    })
}

input.addEventListener("input", function(){
    fetch("../../app/actions/rechercheDynamique.php",{
        method:"POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body:`input=${this.value}`
    }).then((response) => response.json())
    .then((data) => {
        if(Array.isArray(data) && data.length > 0){
            resultatUtilisateur(data)
        }
        else{
            listeUtilisateurs.innerHTML="";
            aucunResultat.innerHTML="Aucun résultat";
        }
    })
})