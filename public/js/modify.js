const button = document.querySelector('.suppression .btn');
const popup = document.querySelector('.delete-champ .overlay');

button.addEventListener('click', () => {
    popup.style.display = 'block';
});

popup.querySelector('.supprimer').addEventListener('click', () => {

    // On fait la requête
    request('POST', './delete', {
        id: champ.id
    }).then(() => {
        // On redirige
        location.href = '.';
    });
});

document.querySelector('.delete-champ .annuler').addEventListener('click', () => {
    popup.style.display = 'none';
});

document.querySelector('.delete-champ .close-popup').addEventListener('click', () => {
    popup.style.display = 'none';
});
