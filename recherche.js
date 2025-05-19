// Ajouter un gestionnaire d'événement pour la soumission de formulaire
document .getElementById('formulairerechercheJS').addEventListener('submit', function(event) {
    event.preventDefault();//Empêcher le comportement par défaut du formulaire
    const mot_recherche = document.getElementById('recherche mot').value.toLowerCase();
    //Obtenir le mot-clé en minuscule(recherche insensible à la casse)
    const résultats = document.getElementById('resultas');// Div où les résultats seront affichés
    résultats.innerHTML = '';//Réinitialiser le contenu des résultats

    //Listes des pages à rechercher
    const pages = ['TP1.html', 'Média.html','Cérémonie.html']
    //Parcourir chaque page pour effectuer la recherche
    
    pages.forEach(page => {
        fetch(page) //fetch: obtenir le contenu de la page
            .then(response => response.text())//Convertir la réponse en texte
            .then(data => {//Vérifie si le mot est présent dans le contenu de la page(convertir en minuscule)
        // Vérifier si le mot clé est présent dans le contenu de la page
    if (data.toLowerCase().includes(mot_recherche))
    {
        // si trouvé, ajouter un lien vers al page dans les résultats
        résultats.innerHTML += `<div><a href="${page}">${page}: Mot-clé trouvé</a></div>`;
    }else 
    {
        // Si non trouvé, indiquer que le mot-clé n'est pas présent
        résultats.innerHTML += `<div> ${page}: Mot-clé non trouvé</div>`;
    }
                    })
.catch(() => {
    // En cas d'erreur de la récupération de la page, afficher un message d'erreur
    résultats.innerHTML +=`<div>${page}: Erreur lors de la récupération de la page</div>`;
}); 
})
})