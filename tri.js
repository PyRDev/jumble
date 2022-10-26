/* Tri pour page articles et articles-admin*/

document.addEventListener( 'DOMContentLoaded', function() {

    // Tri
    const buttonsTri = document.querySelectorAll('.nav-tri button');

    // Pour chaque bouton de tri
    for (let buttonTri of buttonsTri) {

        // Ajouyte gestionnaire d'évènement
        buttonTri.addEventListener('click', function (ev) {

            // Récupère le critère de tri
            let critere = ev.target.dataset.sort;

            // Gestion classe active
            let activeBtn = document.querySelector('.nav-tri .active')
            activeBtn.classList.remove('active');
            ev.target.classList.add('active');

            console.log(critere)
            tinysort('.grid-item', { selector: critere });
        });
    }



})