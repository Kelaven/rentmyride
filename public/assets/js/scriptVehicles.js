// ! intégrer les tooltips Bootstrap :

const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));


// ! pop-up pour message de suppression : 

// * variable
const deleteLinks = document.querySelectorAll('.delete__link');
console.log(deleteLinks);

// * fonction
function openPopup(event) {

    const confirmDelete = window.confirm(`Êtes-vous sûr de vouloir supprimer ce véhicule ?\nCela va le supprimer de la base de donnée et il ne sera plus jamais accessible !`); // window est l'objet global du navigateur où se trouvent les méthodes globales comme confirm().

    if (confirmDelete) {
        let vehicleId = event.currentTarget.getAttribute('data-delete'); // J'utilise le dataset que j'ai mis dans list.php pour récupérer le lien de redirection, sachant que du PHP ne peut pas être interprété dans du JS. currentTarget fait référence à l'élément sur lequel l'évènement est attaché (le gestionnaire d'événements). Il aurait été possible d'utiliser event.target qui fait référence à l'élément qui a déclenché l'évènement (cela peut être différent de currentTarget si l'événement a été propagé à partir d'un élément enfant).

        let redirectionPage = `/controllers/dashboard/vehicles/deleteVehicles-ctrl.php?id_vehicle=${vehicleId}`; // car j'ai supprimé le href="" qui était initialement dans list.php dans la balise <a>

        window.location.replace(redirectionPage); // window.location représente l'URL de la page actuelle dans le navigateur. replace() est une méthode de l'objet window.location qui remplace l'URL actuelle par une nouvelle. Ca aurait foncionné avec href
    };

};

// * évènement
deleteLinks.forEach(deleteLink => {
    deleteLink.addEventListener('click', openPopup);
});

