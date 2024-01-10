// ! intégrer les tooltips Bootstrap :

const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));


// ? pop-up pour message de suppression : 
// const deleteBtn = document.querySelector('.fa-trash');
const deleteLinks = document.querySelectorAll('.delete__link');

console.log(deleteLinks);


deleteLinks.forEach(deleteLink => {
    deleteLink.addEventListener('click', (event) => {
        const confirm = window.confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?'); 
        // window est l'objet global du navigateur où se trouvent les méthodes globales comme confirm().
        if (confirm) {
            // let redirectionPage = event.target.dataset.delete;
            let redirectionPage = event.currentTarget.getAttribute('data-delete');
            const redirectionStandardPage = '/controllers/dashboard/categories/list-ctrl.php';
            // J'utilise le dataset que j'ai mis dans list.php pour récupérer le lien de redirection, sachant que du PHP ne peut pas être interprété dans du JS.
            // currentTarget fait référence à l'élément sur lequel l'évènement est attaché (le gestionnaire d'événements). 
            // Il aurait été possible d'utiliser event.target qui fait référence à l'élément qui a déclenché l'évènement (cela peut être différent de currentTarget si l'événement a été propagé à partir d'un élément enfant).
            console.log(redirectionPage);
            window.location.href= redirectionPage;
        } else {
            // return window.location.href= redirectionStandardPage;
        }
    })
});
