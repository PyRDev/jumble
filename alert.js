/* Alerte "validé" pour la page articles */

document.addEventListener('DOMContentLoaded', function () {

const forms = document.querySelectorAll('form.addtocart');

for ( let form of forms ) {

    form.addEventListener('submit', function (ev) {
        ev.preventDefault();
        Swal.fire('Article ajouté au panier')
            .then((result) => {
                if (result.isConfirmed) {
                   form.submit();
                }
            });

    })
}


});