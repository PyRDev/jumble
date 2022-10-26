/* Faire apparaître un formulaire sur la page panier */

document.addEventListener('DOMContentLoaded', function () {
    let buttons = document.querySelectorAll('.modif-qte a');
    let forms = document.querySelectorAll('.form-modif-qte');

    for (let form of forms) {
        form.classList.add('hidden');
    }

    for (let button of buttons) {

        button.addEventListener('click', function(e) {

            for (let form of forms) {
                form.classList.add('hidden');
            }

            let cible = document.querySelector(e.target.hash);
            cible.classList.remove('hidden');
        })
    }
})
