let input = document.getElementById("inpuntName");

let aucunResultat = document.getElementById("aucunResultat");
let listeUtilisateurs = document.getElementById("listeUtilisateurs");


function resultatUtilisateur(data){
    listeUtilisateurs.innerHTML="";
    aucunResultat.innerHTML="";
    data.forEach(elem=>{
        // div parent
        let container = document.createElement("div");
        container.classList.add("flex","items-center","justify-between");
        listeUtilisateurs.appendChild(container);    

        // div avatar + prenom nom
        let infosUtilisateur = document.createElement("div");
        infosUtilisateur.classList.add("flex","items-center","gap-3");
        container.appendChild(infosUtilisateur);
                
        // photo de profil
        let photoProfil = document.createElement("img");
        photoProfil.classList.add("w-12","h-12","rounded-full","flex","items-center","justify-center","scale-110","object-cover");
        photoProfil.src = `${elem.photo_profil}`;
        infosUtilisateur.appendChild(photoProfil);

        let divPrenomNom = document.createElement("div");
        // divPrenomNom.classList.add();
        infosUtilisateur.appendChild(divPrenomNom);

        // prenom nom
        let PrenomNom = document.createElement("p");
        PrenomNom.classList.add("font-semibold","items-center","justify-between");
        PrenomNom.innerHTML=`${elem.prenom} ${elem.nom}`;
        divPrenomNom.appendChild(PrenomNom);

        // prenom nom
        let points = document.createElement("p");
        points.classList.add("text-sm","text-gray-500");
        points.innerHTML=`${elem.total_points || 0}`;
        divPrenomNom.appendChild(points);    
                
        let menu = document.createElement("div");
        menu.innerHTML=`⋮`;
        container.appendChild(menu);             
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
        if(Array.isArray(data)){
            resultatUtilisateur(data)
        }
        else{
            aucunResultat.innerHTML="Aucun résultat";
        }
    })
})
