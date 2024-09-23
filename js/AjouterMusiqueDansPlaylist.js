document.addEventListener("DOMContentLoaded", function() {
    let containers = document.querySelectorAll(".container-album-unique-artiste");

    containers.forEach(function(container) {
        let btnAddMusic = container.querySelector(".btn-ajouter-a-playlist");
        let playlistPopup = container.querySelector(".container-ajouter");
        let btnClosePopup = container.querySelector(".btn-close");

        btnAddMusic.addEventListener("click", function() {
            console.log("click");
            playlistPopup.style.display = "flex";
        });

        btnClosePopup.addEventListener("click", function() {
            playlistPopup.style.display = "none";
        });
    });
});
