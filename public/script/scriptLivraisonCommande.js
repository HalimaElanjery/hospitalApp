function newLivraison()
{
    let commandeList = document.getElementById('commandeList');
    let formLivraison = document.getElementById('formLivraison');
    commandeList.style.display = "none";
    formLivraison.style.display = "block";
    
}

function validated()
{
    let commandeList = document.getElementById('commandeList');
    let fomrAchat = document.getElementById('fomrAchat');
    commandeList.style.display = "none";
    fomrAchat.style.display = "block";
    
}


function addProduitLivrais() {

    let codeProduits = document.getElementById("codeProduits").value;
    let designation = document.getElementById("designation").value;
    let categorieValue = document.getElementById("categorieValue").value;
    let conditionnement = document.getElementById("conditionnement").value;
    let quantite = document.getElementById("quantite").value;
    let prix = document.getElementById('prix').value;
    console.log(codeProduits);
    let formCoalmmande = document.querySelector('.formCommande');
    let lignes = formCommande.getElementsByTagName('div');
    let div = document.createElement('div');
    // console.log(lignes.HTMLCollection)
    if(lignes.length == 0)
    {
        div.innerHTML = 
        `
            <input type="hidden" name="0[idProduits]" value="`+ codeProduits +`" class="form-control" id="`+ codeProduits +`">
            <input type="text" desabled name="0[designation]" value="`+ designation +`" class="form-control mb-2 mr-1 col-lg-3" id="`+ designation +`">
            <input type="text"  name="0[conditionnement]" value="`+ conditionnement +`" class="form-control mb-2 mr-1 col-lg-3" id="`+ conditionnement +`">
            <input type="text"  name="0[quantite]" value="`+ quantite +`" class="form-control mb-2 mr-1 col-lg-3" id="'`+ quantite +`">
            <input type="text" name="0[prix]" value="`+ prix +`" class="form-control mb-2 mr-1 col-lg-2" id="`+ prix +`">
                    
        `;
        formCommande.appendChild(div);
    }
    else if (lignes.length >= 1)
    {
        for (let i = 0; i < lignes.length; i++) 
        {
           

            div.innerHTML = 
                `
                <input type="hidden" name="`+i+`[idProduits]" value="`+ codeProduits +`" class="form-control" id="`+ codeProduits +`">
                <input type="text" desabled name="`+i+`[designation]" value="`+ designation +`" class="form-control mb-2 mr-1 col-lg-3" id="`+ designation +`">
                <input type="text"  name="`+i+`[conditionnement]" value="`+ conditionnement +`" class="form-control mb-2 mr-1 col-lg-3" id="`+ conditionnement +`">
                <input type="text"  name="`+i+`[quantite]" value="`+ quantite +`" class="form-control mb-2 mr-1 col-lg-3" id="'`+ quantite +`">
                <input type="text" name="`+i+`[etat]" value="`+ etat +`" class="form-control mb-2 mr-1 col-lg-2" id="`+ etat +`">
                
                `;
            formCommande.appendChild(div);
        }
    }
    

}


