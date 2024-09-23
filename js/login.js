document.addEventListener('DOMContentLoaded', function () {

const btnInscription = document.getElementById('btn-inscription');
const btnConnexion = document.getElementById('btn-connexion');
const inscriptionForm = document.getElementById('inscription-form');
const connexionForm = document.getElementById('connexion-form');
const subtitleConnexion = document.getElementById('subtitle-connexion');
const subtitleInscription = document.getElementById('subtitle-inscription');

function affichageInscription() {
    inscriptionForm.style.display = 'flex';
    connexionForm.style.display = 'none';
    subtitleConnexion.style.display = 'none';
    subtitleInscription.style.display = 'flex';
}

function affichageConnexion() {
    inscriptionForm.style.display = 'none';
    connexionForm.style.display = 'flex';
    subtitleConnexion.style.display = 'flex';
    subtitleInscription.style.display = 'none';
}

btnInscription.addEventListener('click', affichageInscription);
btnConnexion.addEventListener('click', affichageConnexion);

let passwordInput = document.getElementById('password-connexion');
let toggleIcon = document.getElementById('toggle-password-connexion');


function togglePasswordVisibilityConnexion() {
    if (passwordInput.type === 'password') {
        console.log('togglePasswordVisibilityConnexion: password');
        passwordInput.type = 'text';
        toggleIcon.textContent = '🙈'; // Change icon or text accordingly
    } else {
        console.log('togglePasswordVisibilityConnexion: text');
        passwordInput.type = 'password';
        toggleIcon.textContent = '👁️'; // Change icon or text accordingly
    }
}

toggleIcon.addEventListener('click', togglePasswordVisibilityConnexion);

let passwordInput2 = document.getElementById('password-inscription');
let toggleIcon2 = document.getElementById('toggle-password-inscription');

function togglePasswordVisibilityInscription() {
    if (passwordInput2.type === 'password') {
        console.log('togglePasswordVisibilityInscription: password');
        passwordInput2.type = 'text';
        toggleIcon2.textContent = '🙈'; // Change icon or text accordingly
    } else {
        console.log('togglePasswordVisibilityInscription: text');
        passwordInput2.type = 'password';
        toggleIcon2.textContent = '👁️'; // Change icon or text accordingly
    }
}

toggleIcon2.addEventListener('click', togglePasswordVisibilityInscription);

});