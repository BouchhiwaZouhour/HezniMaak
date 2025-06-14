// resources/js/stepper.js

document.addEventListener('DOMContentLoaded', function () {
    // Vérifier que l'élément searchButton existe avant d'ajouter l'écouteur d'événements
    const searchButton = document.getElementById('searchButton');
    if (searchButton) {
        searchButton.addEventListener('click', function () {
            // Afficher la section des résultats de recherche et passer à l'étape 2
            document.getElementById('step1').classList.remove('active');
            document.getElementById('step1').classList.add('disabled');

            document.getElementById('step2').classList.add('show', 'active');
            document.getElementById('step2-tab').classList.remove('disabled');
            document.getElementById('step2-tab').classList.add('active');
            
            document.getElementById('result_rech').style.display = 'block'; // Afficher les résultats de recherche
        });
    } else {
        console.warn('Element with ID "searchButton" not found');
    }

    // Vérifier que l'élément reserver existe avant d'ajouter l'écouteur d'événements
    const reserverButton = document.getElementById('reserver');
    if (reserverButton) {
        reserverButton.addEventListener('click', function () {
            document.getElementById('step2').classList.remove('active');
            document.getElementById('step2').classList.add('disabled');

            document.getElementById('step3').classList.add('show', 'active');
            document.getElementById('step3-tab').classList.remove('disabled');
            document.getElementById('step3-tab').classList.add('active');
        });
    } else {
        console.warn('Element with ID "reserver" not found');
    }
});
