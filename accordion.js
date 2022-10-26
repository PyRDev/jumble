/* Mettre tous les boutons modifier sur la page articles-admin de type "accordéon" */

document.addEventListener( 'DOMContentLoaded', function() {

    let accordions = document.querySelectorAll('.accordion-container');

    for ( var i = 0; i < accordions.length; i++ ) {
        new Accordion(accordions[i]);
    }

});