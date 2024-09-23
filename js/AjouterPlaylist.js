document.addEventListener("DOMContentLoaded", function() {
    var btnAddPlaylist = document.getElementById("btnAddPlaylist");
    var playlistPopup = document.getElementById("playlistPopup");
    var btnSavePlaylist = document.getElementById("btnSavePlaylist");
    let btnClosePopup = document.getElementById("btnClosePopup");

    btnAddPlaylist.addEventListener("click", function() {
        playlistPopup.style.display = "flex";
    });

    btnClosePopup.addEventListener("click", function() {
        playlistPopup.style.display = "none";
    });

    btnSavePlaylist.addEventListener("click", function() {
        var playlistName = document.getElementById("playlistName").value;
        playlistPopup.style.display = "none";
        // header.location.href = "index.php?action=ajouterPlaylist";
    });
});
