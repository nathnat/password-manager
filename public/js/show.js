// Suprimage
function setupDeleteEvent() {
    const buttons = document.querySelectorAll('.table .row button.delete');
    const popup = document.querySelector('.delete-champ .overlay');

    buttons.forEach((button) => {
        button.addEventListener('click', () => {

            document.querySelector('.delete-champ .overlay').style.display = 'block';

            document.querySelector('.delete-champ .supprimer').addEventListener('click', () => {

                request('POST', './delete', {
                    id: button.parentElement.id
                }).then(() => {

                    // On enlève le champ
                    button.parentElement.remove();

                    // On ferme la popup
                    popup.style.display = 'none';
                });
            }, { once: true });

            document.querySelector('.delete-champ .annuler').addEventListener('click', () => {
                popup.style.display = 'none';
            }, { once: true });

            document.querySelector('.delete-champ .close-popup > span').addEventListener('click', () => {
                popup.style.display = 'none';
            });
        });
    });
}

function setupEvents() {
    setupDeleteEvent();
}

function handleSiteLink() {

    const cases = document.querySelectorAll('.site');

    cases.forEach(element => {
        const champ = {
            id: element.parentElement.id,
            site: element.dataset.site
        };

        if (window.innerWidth <= 1050) {
            element.innerHTML = `<a href="modify?id=${champ.id}">${champ.site}</a>`;
        } else {
            
            element.innerHTML = champ.site;
        }
    });

}

handleSiteLink();

setupEvents();

// Recherche
(() => {
    const input = document.querySelector('input.search');
    const table = document.querySelector('.table .tbody');
    const initialTable = table.innerHTML;

    table.setContents = (content) => {
        table.innerHTML = content;
        handleSiteLink();
        setupEvents();
    };

    input.addEventListener('input', (e) => {
        if (input.value) {

            // On envoie une requête
            request('POST', 'search', {
                searchWord: input.value
            }).then((response) => {

                // On vérifie aussi si il y a une valeur dans l'input car des fois la réponse vient aprés que l'utilisateur est fini de taper
                if (response && input.value) {
                    table.setContents(response);
                } else {
                    table.setContents(initialTable);
                }
            });
        } else {
            table.setContents(initialTable);
        }
    });
})();



window.addEventListener('resize', handleSiteLink);
