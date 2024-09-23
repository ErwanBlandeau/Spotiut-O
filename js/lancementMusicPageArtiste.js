document.addEventListener('DOMContentLoaded', function () {
    const lecteur = document.querySelector('.container-lecteur');
    const containers = document.querySelectorAll('.container-album-unique-artiste');

    // Elements du lecteur
    let lienTitreMusique = document.querySelector('.lien-titre-music-lecteur');
    let lienNomArtiste = document.querySelector('.lien-nom-artiste-lecteur');
    let titreMusique = document.querySelector('.titre-musique-lecteur');
    let artisteMusique = document.querySelector('.nom-artiste-lecteur');
    let imageMusique = document.querySelector('.pochette');

    // Elements du lecteur
    let modeRandom = false;
    let modeRepeat = false;
    let btnRandomInactif = document.getElementById('btn-random-inactif');
    let btnRandomActif = document.getElementById('btn-random-actif');
    let btnRepeatInactif = document.getElementById('btn-loop-inactif');
    let btnRepeatActif = document.getElementById('btn-loop-actif');

    btnRandomInactif.addEventListener('click', function() {
        modeRandom = true;
        modeRepeat = false;
        btnRandomInactif.style.display = 'none';
        btnRandomActif.style.display = 'block';
        btnRepeatInactif.style.display = 'block';
        btnRepeatActif.style.display = 'none';
    });

    btnRandomActif.addEventListener('click', function() {
        modeRandom = false;
        btnRandomInactif.style.display = 'block';
        btnRandomActif.style.display = 'none';
    });

    btnRepeatInactif.addEventListener('click', function() {
        modeRepeat = true;
        modeRandom = false;
        btnRepeatInactif.style.display = 'none';
        btnRepeatActif.style.display = 'block';
        btnRandomInactif.style.display = 'block';
        btnRandomActif.style.display = 'none';
    });

    btnRepeatActif.addEventListener('click', function() {
        modeRepeat = false;
        btnRepeatInactif.style.display = 'block';
        btnRepeatActif.style.display = 'none';
    });

    // liste des musiques jouées
    let listeMusiqueJouer = new Array();
    let currentSongIndex = 0; 

    // liste des musiques
    let listeMusiques = [];
    let lienMusiqueActuel = '';
    let audio = new Audio();
    let currentSongTime = 0;
    let dureeMusique = "";

    // Elements du lecteur
    let tempsLecture = document.querySelector('.temps-lecture');
    let tempsTotal = document.querySelector('.temps-total');
    let interval;

    // boutons lecteur
    let btnPlay = document.getElementById('btn-play');
    let btnPause = document.getElementById('btn-pause');
    let btnPrev = document.getElementById('btn-previous');
    let btnNext = document.getElementById('btn-next');

    // boutons de la musique lancer 
    let btnPlayCourant = null;
    let btnPauseCourant = null;
    let numeroMusiqueCourant = null;

    let listeBtnPlay = [];
    let listeBtnPause = [];
    let listeNumeroMusique = [];

    let jouerPlaylist = document.querySelector('.jouer-playlist');


    // volume
    let archiveVolume = 0;
    let btnVolumeHigh = document.getElementById('btn-volume-high');
    let btnVolumeLow = document.getElementById('btn-volume-low');
    let btnVolumeMute = document.getElementById('btn-volume-mute');
    let sliderVolume = document.getElementById("slider-volume");
    sliderVolume.addEventListener('input', function() {
        var value = (this.value - this.min) / (this.max - this.min) * 100;
        this.style.background = 'linear-gradient(to right, #740c96 0%, #840c96 ' + value + '%, #d3d3d3 ' + value + '%, #d3d3d3 100%)';
        if (this.value == 0) {
            btnVolumeHigh.style.display = 'none';
            btnVolumeLow.style.display = 'none';
            btnVolumeMute.style.display = 'block';
        } else if (this.value > 0 && this.value < 50) {
            btnVolumeHigh.style.display = 'none';
            btnVolumeLow.style.display = 'block';
            btnVolumeMute.style.display = 'none';
        } else {
            btnVolumeHigh.style.display = 'block';
            btnVolumeLow.style.display = 'none';
            btnVolumeMute.style.display = 'none';
        }
    });

    btnVolumeHigh.addEventListener('click', function() {
        archiveVolume = sliderVolume.value;
        sliderVolume.value = 0;
        sliderVolume.style.background = '#d3d3d3';
        audio.volume = 0;
        btnVolumeHigh.style.display = 'none';
        btnVolumeLow.style.display = 'none';
        btnVolumeMute.style.display = 'block';
    });

    btnVolumeLow.addEventListener('click', function() {
        archiveVolume = sliderVolume.value;
        sliderVolume.value = 0;
        sliderVolume.style.background = '#d3d3d3';
        audio.volume = 0;
        btnVolumeHigh.style.display = 'none';
        btnVolumeLow.style.display = 'none';
        btnVolumeMute.style.display = 'block';
    });

    btnVolumeMute.addEventListener('click', function() {
        sliderVolume.value = archiveVolume;
        audio.volume = archiveVolume / 100;
        sliderVolume.style.background = 'linear-gradient(to right, #740c96 0%, #840c96 ' + archiveVolume + '%, #d3d3d3 ' + archiveVolume + '%, #d3d3d3 100%)';
        if (archiveVolume == 0) {
            btnVolumeHigh.style.display = 'none';
            btnVolumeLow.style.display = 'none';
            btnVolumeMute.style.display = 'block';
        } else if (archiveVolume > 0 && archiveVolume < 50) {
            btnVolumeHigh.style.display = 'none';
            btnVolumeLow.style.display = 'block';
            btnVolumeMute.style.display = 'none';
        } else {
            btnVolumeHigh.style.display = 'block';
            btnVolumeLow.style.display = 'none';
            btnVolumeMute.style.display = 'none';
        }
    });


    // Mettre à jour le volume initial
    audio.volume = sliderVolume.value / 100;

    // Fonction pour ajuster le volume
    sliderVolume.oninput = function() {
        // Obtenir la valeur du sliderVolume
        var volume = this.value;
        // Mettre à jour le volume dans votre application ou lecteur audio
        updateVolume(volume);
    }

    // Fonction pour mettre à jour le volume (à adapter selon votre application)
    function updateVolume(volume) {
        audio.volume = volume / 100;
    }

    let sliderLecture = document.getElementById("slider-lecture");
    sliderLecture.addEventListener('input', function() {
        audio.currentTime = this.value;
        // var value = (this.value - this.min) / (this.max - this.min) * 100;
        // this.style.background = 'linear-gradient(to right, #740c96 0%, #840c96 ' + value + '%, #d3d3d3 ' + value + '%, #d3d3d3 100%)';
    });

    function formatDuration(totalSeconds) {
        var minutes = Math.floor(totalSeconds / 60);
        var seconds = Math.floor(totalSeconds % 60);
    
        // Formater le temps en ajoutant un zéro devant les secondes si elles sont inférieures à 10
        var formattedSeconds = (seconds < 10) ? "0" + seconds : seconds;
    
        var formattedDuration = minutes + ':' + formattedSeconds;
    
        return formattedDuration;
    }
    

    // update time/progress bar
    function updateTime() {
        var minutes = Math.floor(audio.currentTime / 60);
        var seconds = Math.floor(audio.currentTime % 60);
        var formattedTime = minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
        tempsLecture.textContent = formattedTime;

        sliderLecture.value = audio.currentTime;
        var value = (sliderLecture.value - sliderLecture.min) / (sliderLecture.max - sliderLecture.min) * 100;
        sliderLecture.style.background = 'linear-gradient(to right, #740c96 0%, #840c96 ' + value + '%, #d3d3d3 ' + value + '%, #d3d3d3 100%)';
    }

    // permet de mettre à jour le temps de lecture maxi
    audio.addEventListener('loadedmetadata', function() {
        sliderLecture.setAttribute('max', audio.duration);
        dureeMusique = formatDuration(audio.duration);
        tempsTotal.textContent = dureeMusique;
    });

    containers.forEach(function (container) {
        const numeroMusique = container.querySelector('.numero-album');
        listeNumeroMusique.push(numeroMusique);
        const play = container.querySelector('.lancer-music');
        listeBtnPlay.push(play);
        const pause = container.querySelector('.pause-music');
        listeBtnPause.push(pause);

        const btnListeAttente = container.querySelector('.btn-liste-attente');
        
        const infoMusique =  JSON.parse(container.querySelector('.info-musique').textContent);
        const infoAlbum =  JSON.parse(container.querySelector('.info-album').textContent);
        const infoArtiste =  JSON.parse(container.querySelector('.info-artiste').textContent);


        function dejaJouer(){
            for (let i = 0; i < listeMusiqueJouer.length; i++) {
                if (listeMusiqueJouer[i][0].Lien == infoMusique.Lien) {
                    return i;
                }
            }
            return null;
        }

        // Ajout d'un écouteur d'événement pour le survol
        container.addEventListener('mouseover', function() {
            if (lienMusiqueActuel != infoMusique.Lien) {
                // Masquer l'élément lorsque survolé
                numeroMusique.style.display = 'none';
                play.style.display = 'block';
            }
        });

        // Ajout d'un écouteur d'événement pour le passage de la souris hors de l'élément survolé
        container.addEventListener('mouseout', function() {
            if (lienMusiqueActuel != infoMusique.Lien) {
                // Afficher l'élément lorsque la souris n'est plus dessus
                numeroMusique.style.display = 'block';
                play.style.display = 'none';
            }
        });

        play.addEventListener('click', function() {
            console.log(infoMusique);
            console.log(infoAlbum);
            console.log(infoArtiste);

            if (lienMusiqueActuel != infoMusique.Lien) {
                currentSongTime = 0;
                lienMusiqueActuel = infoMusique.Lien;
            }
            for (let i = 0; i < listeBtnPlay.length; i++) {
                listeBtnPlay[i].style.display = 'none';
                listeBtnPause[i].style.display = 'none';
                listeNumeroMusique[i].style.display = 'block';
            }   
            playSong();
            play.style.display = 'none';
            pause.style.display = 'block';
            numeroMusique.style.display = 'none';
            btnPlay.style.display = 'none';
            btnPause.style.display = 'block';
            btnPlayCourant = play;
            btnPauseCourant = pause;
            numeroMusiqueCourant = numeroMusique;

            titreMusique.textContent = infoMusique.Titre;
            artisteMusique.textContent = infoArtiste.Nom;
            lienNomArtiste.href = "index.php?action=artiste&id="+infoArtiste['ID_Artiste'];
            lienTitreMusique.href = "index.php?action=musique&id="+infoMusique['ID_Musique'];
            let titreAlbum = infoAlbum.Pochette.split(" ")[1];
            console.log("./images/ALBUMS/"+titreAlbum+".jpg");
            imageMusique.src = "./images/ALBUMS/"+titreAlbum;

            conditionDejaJouer = dejaJouer();
            if (conditionDejaJouer != null) {
                currentSongIndex = conditionDejaJouer;
            } else {
                if (listeMusiqueJouer.length > 0) {
                    currentSongIndex++;
                }
                listeMusiqueJouer.push([infoMusique, infoAlbum, infoArtiste, play, pause, numeroMusique, titreMusique, artisteMusique, imageMusique]);
            }
            // console.log(listeMusiqueJouer);
        });

        pause.addEventListener('click', function() {
            pauseSong();
            pause.style.display = 'none';
            play.style.display = 'block';
            btnPause.style.display = 'none';
            btnPlay.style.display = 'block';
        });

        btnListeAttente.addEventListener('click', function() {
            console.log('Ajouté à la liste d\'attente');

            conditionDejaJouer = dejaJouer();
            if (conditionDejaJouer != null) {
                currentSongIndex = conditionDejaJouer;
            } else {
                if (listeMusiqueJouer.length > 0) {
                    currentSongIndex++;
                }
                listeMusiqueJouer.push([infoMusique, infoAlbum, infoArtiste, play, pause, numeroMusique, titreMusique, artisteMusique, imageMusique]);
            }
        });

    });

    
    // Function to play the current song
    function playSong() {
        lecteur.style.display = 'flex';
        audio.src = lienMusiqueActuel;
        audio.currentTime = currentSongTime; 
        audio.play();
        interval = setInterval(updateTime, 1000);
        sliderLecture.setAttribute('max', audio.duration);
    }
    
    // Function to pause the current song
    function pauseSong() {
        currentSongTime = audio.currentTime;
        audio.pause();
        clearInterval(interval);
    }

    audio.addEventListener('ended', function() {
        if (!modeRepeat) {
            clearInterval(interval);
            tempsLecture.textContent = '0:00';
            tempsTotal.textContent = '0:00';
            sliderLecture.value = 0;
            sliderLecture.style.background = '#d3d3d3';
            playNext();
        } else {
            audio.currentTime = 0;
            audio.play();
        }
    });

    btnPause.addEventListener('click', function() {
        console.log('pause');
        pauseSong();
        btnPause.style.display = 'none';
        btnPlay.style.display = 'block';
        btnPlayCourant.style.display = 'block';
        btnPauseCourant.style.display = 'none';
        numeroMusiqueCourant.style.display = 'none';
    });

    btnPlay.addEventListener('click', function() {
        console.log('play');
        playSong();
        btnPlay.style.display = 'none';
        btnPause.style.display = 'block';
        btnPlayCourant.style.display = 'none';
        btnPauseCourant.style.display = 'block';
        numeroMusiqueCourant.style.display = 'none';
    });

    btnNext.addEventListener('click', function() {
        console.log('next');
        playNext();
    });

    btnPrev.addEventListener('click', function() {
        console.log('prev');
        playPrevious();
    });


     // Function to play the next song
     function playNext() {
        try {
            if (modeRandom) {
                btnPlayCourant.style.display = 'none';
                btnPauseCourant.style.display = 'none';
                numeroMusiqueCourant.style.display = 'block';
                let randomIndex = Math.floor(Math.random() * listeMusiqueJouer.length);
                currentSongIndex = randomIndex;
                let musique = listeMusiqueJouer[currentSongIndex];
                titreMusique.textContent = musique[0].Titre;
                artisteMusique.textContent = musique[2].Nom;
                let titreAlbum = musique[1].Pochette.split(" ")[1];
                imageMusique.src = "./images/ALBUMS/"+titreAlbum;
                lienMusiqueActuel = musique[0].Lien;
                btnPlayCourant = musique[3];
                btnPauseCourant = musique[4];
                numeroMusiqueCourant = musique[5];
                btnPlayCourant.style.display = 'none';
                btnPauseCourant.style.display = 'block';
                numeroMusiqueCourant.style.display = 'none';
                playSong();
            } else {
                if (currentSongIndex < listeMusiqueJouer.length - 1) {
                    currentSongIndex++;
                    currentSongTime = 0;
                } else {
                    // If it's the last song, loop back to the first song
                    currentSongIndex = 0;
                    currentSongTime = 0;
                }
                btnPlay.style.display = 'none';
                btnPause.style.display = 'block';
                btnPlayCourant.style.display = 'none';
                btnPauseCourant.style.display = 'none';
                numeroMusiqueCourant.style.display = 'block';
                // remettre les bonnes valeurs
                let musique = listeMusiqueJouer[currentSongIndex];
                titreMusique.textContent = musique[0].Titre;
                artisteMusique.textContent = musique[2].Nom;
                let titreAlbum = musique[1].Pochette.split(" ")[1];
                imageMusique.src = "./images/ALBUMS/"+titreAlbum;
                lienMusiqueActuel = musique[0].Lien;
                btnPlayCourant = musique[3];
                btnPauseCourant = musique[4];
                numeroMusiqueCourant = musique[5];
                btnPlayCourant.style.display = 'none';
                btnPauseCourant.style.display = 'block';
                numeroMusiqueCourant.style.display = 'none';
                playSong();
            }
        } catch (error) {
            console.log(error);
        }
    }

    // Function to play the previous song
    function playPrevious() {
        try {
            if (currentSongIndex > 0) {
                currentSongIndex--;
                currentSongTime = 0;
            } else {
                // If it's the first song, loop back to the last song
                currentSongIndex = listeMusiqueJouer.length - 1;
                currentSongTime = 0;
            }
            btnPlay.style.display = 'none';
            btnPause.style.display = 'block';
            btnPlayCourant.style.display = 'none';
            btnPauseCourant.style.display = 'none';
            numeroMusiqueCourant.style.display = 'block';
            // remettre les bonnes valeurs
            let musique = listeMusiqueJouer[currentSongIndex];
            titreMusique.textContent = musique[0].Titre;
            artisteMusique.textContent = musique[2].Nom;
            let titreAlbum = musique[1].Pochette.split(" ")[1];
            imageMusique.src = "./images/ALBUMS/"+titreAlbum;
            lienMusiqueActuel = musique[0].Lien;
            btnPlayCourant = musique[3];
            btnPauseCourant = musique[4];
            numeroMusiqueCourant = musique[5];
            btnPlayCourant.style.display = 'none';
            btnPauseCourant.style.display = 'block';
            numeroMusiqueCourant.style.display = 'none';
            playSong();
        } catch (error) {
            console.log(error);
        }
    }


    jouerPlaylist.addEventListener('click', function() {
        let ind = 0;
        containers.forEach(function (container) {
            const numeroMusique = container.querySelector('.numero-album');
            const play = container.querySelector('.lancer-music');
            const pause = container.querySelector('.pause-music');
                
            const infoMusique =  JSON.parse(container.querySelector('.info-musique').textContent);
            const infoAlbum =  JSON.parse(container.querySelector('.info-album').textContent);
            const infoArtiste =  JSON.parse(container.querySelector('.info-artiste').textContent);
    
            if (ind == 0) {
                if (lienMusiqueActuel != infoMusique.Lien) {
                    currentSongTime = 0;
                    lienMusiqueActuel = infoMusique.Lien;
                }
                play.style.display = 'none';
                pause.style.display = 'block';
                numeroMusique.style.display = 'none';
                btnPlay.style.display = 'none';
                btnPause.style.display = 'block';
                btnPlayCourant = play;
                btnPauseCourant = pause;
                numeroMusiqueCourant = numeroMusique;

                titreMusique.textContent = infoMusique.Titre;
                artisteMusique.textContent = infoArtiste.Nom;
                let titreAlbum = infoAlbum.Pochette.split(" ")[1];
                imageMusique.src = "./images/ALBUMS/"+titreAlbum;

                lienTitreMusique.href = "index.php?action=musique&id="+infoMusique['ID_Musique'];
                console.log(infoArtiste);
                lienNomArtiste.href = "index.php?action=artiste&id="+infoArtiste['ID_Artiste'];
                lienMusiqueActuel = infoMusique.Lien;

                playSong();
            }

            listeMusiqueJouer.push([infoMusique, infoAlbum, infoArtiste, play, pause, numeroMusique, titreMusique, artisteMusique, imageMusique]);
            
            ind++;
        });
    });

});