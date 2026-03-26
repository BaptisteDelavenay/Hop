let input = document.getElementById("inpuntName");

input.addEventListener("input", function(){
    fetch("../../app/actions/rechercheDynamique.php",{
        method:"POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body:`input=${this.value}`
    }).then((response) => response.json())
    .then((data) => {
        let listeUtilisateurs = document.getElementById("listeUtilisateurs");
        listeUtilisateurs.innerHTML="";
        if(Array.isArray(data)){
            data.forEach(elem=>{
                // div parent
                let container = document.createElement("div");
                container.classList.add("flex","items-center","justify-between");
                listeUtilisateurs.appendChild(container);    

                // div avatar + prenom nom
                let infosUtilisateur = document.createElement("div");
                container.appendChild(infosUtilisateur);  

                // prenom nom
                let PrenomNom = document.createElement("p");
                PrenomNom.classList.add("font-semibold","items-center","justify-between");
                PrenomNom.textContent=`${elem.prenom} ${elem.nom}`;
                infosUtilisateur.appendChild(PrenomNom);   

                // prenom nom
                let points = document.createElement("p");
                points.classList.add("text-sm","text-gray-500");
                points.textContent=`${elem.total_points || 0}`;
                infosUtilisateur.appendChild(points);            
            })
        }
        else{
            let aucunResultat = document.getElementById("aucunResultat");
            aucunResultat.innerHTML="Aucun résultat";
        }
    })
})
