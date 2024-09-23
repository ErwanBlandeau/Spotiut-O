// Récupérer le bouton pour afficher le popup
const btnAjoutAlbum = document.getElementById('btnAjoutAlbum');
const btnAjoutArtiste = document.getElementById('btnAjoutArtiste');
const btnAjoutMusique = document.getElementById('btnAjoutMusique');

// Récupérer le bouton pour masquer le popup
const btnRetour = document.getElementById('retour-form');

// Récupérer le popup et l'overlay
const popupAlbum = document.getElementById('popupAjoutAlbum');
const popupArtiste = document.getElementById('popupAjoutArtiste');
const popupAjoutMusique = document.getElementById('popupAjoutMusique');
const formUser = document.getElementById('formUser');

// Fonction pour afficher le popup
function afficherPopupAlbum() {
    popupAlbum.style.display = 'flex';
    popupArtiste.style.display = 'none';
    popupAjoutMusique.style.display = 'none';
    formUser.style.display = 'none';
    btnRetour.style.display = 'block';
    btnAjoutArtiste.style.display = 'none';
    btnAjoutAlbum.style.display = 'none';
    btnAjoutMusique.style.display = 'none';
}

function afficherPopupArtiste() {
    popupArtiste.style.display = 'flex';
    popupAlbum.style.display = 'none';
    popupAjoutMusique.style.display = 'none';
    formUser.style.display = 'none';
    btnRetour.style.display = 'block';
    btnAjoutArtiste.style.display = 'none';
    btnAjoutAlbum.style.display = 'none';
    btnAjoutMusique.style.display = 'none';
}

function afficherPopupMusique() {
    popupAjoutMusique.style.display = 'flex';
    popupAlbum.style.display = 'none';
    popupArtiste.style.display = 'none';
    formUser.style.display = 'none';
    btnRetour.style.display = 'block';
    btnAjoutArtiste.style.display = 'none';
    btnAjoutAlbum.style.display = 'none';
    btnAjoutMusique.style.display = 'none';
}

// Fonction pour masquer le popup
function masquerPopup() {
    popupAlbum.style.display = 'none';
    popupArtiste.style.display = 'none';
    popupAjoutMusique.style.display = 'none';
    formUser.style.display = 'block';
    btnRetour.style.display = 'none';
    btnAjoutArtiste.style.display = 'block';
    btnAjoutAlbum.style.display = 'block';
    btnAjoutMusique.style.display = 'block';
}

// Associer la fonction afficherPopup à l'événement clic du bouton
btnAjoutAlbum.addEventListener('click', afficherPopupAlbum);
btnAjoutArtiste.addEventListener('click', afficherPopupArtiste);
btnAjoutMusique.addEventListener('click', afficherPopupMusique);

// Associer la fonction masquerPopup à l'événement clic du bouton
btnRetour.addEventListener('click', masquerPopup);


