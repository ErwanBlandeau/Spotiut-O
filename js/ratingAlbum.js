document.addEventListener("DOMContentLoaded", function() {
    let etoile1 = document.getElementById("etoile1");
    let etoile2 = document.getElementById("etoile2");
    let etoile3 = document.getElementById("etoile3");
    let etoile4 = document.getElementById("etoile4");
    let etoile5 = document.getElementById("etoile5");

    let imgVideEtoile1 = document.getElementById("imgVideEtoile1");
    let imgVideEtoile2 = document.getElementById("imgVideEtoile2");
    let imgVideEtoile3 = document.getElementById("imgVideEtoile3");
    let imgVideEtoile4 = document.getElementById("imgVideEtoile4");
    let imgVideEtoile5 = document.getElementById("imgVideEtoile5");

    let imgPleineEtoile1 = document.getElementById("imgPleineEtoile1");
    let imgPleineEtoile2 = document.getElementById("imgPleineEtoile2");
    let imgPleineEtoile3 = document.getElementById("imgPleineEtoile3");
    let imgPleineEtoile4 = document.getElementById("imgPleineEtoile4");
    let imgPleineEtoile5 = document.getElementById("imgPleineEtoile5");

    console.log(note);

    etoile1.addEventListener("mouseover", function() {
        imgVideEtoile1.style.display = "none";
        imgVideEtoile2.style.display = "block";
        imgVideEtoile3.style.display = "block";
        imgVideEtoile4.style.display = "block";
        imgVideEtoile5.style.display = "block";

        imgPleineEtoile1.style.display = "block";
        imgPleineEtoile2.style.display = "none";
        imgPleineEtoile3.style.display = "none";
        imgPleineEtoile4.style.display = "none";
        imgPleineEtoile5.style.display = "none";
    });

    etoile1.addEventListener("mouseout", function() {
        defaultRating();
    });

    etoile2.addEventListener("mouseover", function() {
        imgVideEtoile1.style.display = "none";
        imgVideEtoile2.style.display = "none";
        imgVideEtoile3.style.display = "block";
        imgVideEtoile4.style.display = "block";
        imgVideEtoile5.style.display = "block";

        imgPleineEtoile1.style.display = "block";
        imgPleineEtoile2.style.display = "block";
        imgPleineEtoile3.style.display = "none";
        imgPleineEtoile4.style.display = "none";
        imgPleineEtoile5.style.display = "none";
    });

    etoile2.addEventListener("mouseout", function() {
        defaultRating();
    });

    etoile3.addEventListener("mouseover", function() {
        imgVideEtoile1.style.display = "none";
        imgVideEtoile2.style.display = "none";
        imgVideEtoile3.style.display = "none";
        imgVideEtoile4.style.display = "block";
        imgVideEtoile5.style.display = "block";

        imgPleineEtoile1.style.display = "block";
        imgPleineEtoile2.style.display = "block";
        imgPleineEtoile3.style.display = "block";
        imgPleineEtoile4.style.display = "none";
        imgPleineEtoile5.style.display = "none";
    });

    etoile3.addEventListener("mouseout", function() {
        defaultRating();
    });

    etoile4.addEventListener("mouseover", function() {
        imgVideEtoile1.style.display = "none";
        imgVideEtoile2.style.display = "none";
        imgVideEtoile3.style.display = "none";
        imgVideEtoile4.style.display = "none";
        imgVideEtoile5.style.display = "block";

        imgPleineEtoile1.style.display = "block";
        imgPleineEtoile2.style.display = "block";
        imgPleineEtoile3.style.display = "block";
        imgPleineEtoile4.style.display = "block";
        imgPleineEtoile5.style.display = "none";
    });

    etoile4.addEventListener("mouseout", function() {
       defaultRating();
    });

    etoile5.addEventListener("mouseover", function() {
        imgVideEtoile1.style.display = "none";
        imgVideEtoile2.style.display = "none";
        imgVideEtoile3.style.display = "none";
        imgVideEtoile4.style.display = "none";
        imgVideEtoile5.style.display = "none";

        imgPleineEtoile1.style.display = "block";
        imgPleineEtoile2.style.display = "block";
        imgPleineEtoile3.style.display = "block";
        imgPleineEtoile4.style.display = "block";
        imgPleineEtoile5.style.display = "block";
    });

    etoile5.addEventListener("mouseout", function() {
        defaultRating();
    });
 
    function defaultRating() {
        if (note == 1) {
            imgVideEtoile1.style.display = "none";
            imgVideEtoile2.style.display = "block";
            imgVideEtoile3.style.display = "block";
            imgVideEtoile4.style.display = "block";
            imgVideEtoile5.style.display = "block";

            imgPleineEtoile1.style.display = "block";
            imgPleineEtoile2.style.display = "none";
            imgPleineEtoile3.style.display = "none";
            imgPleineEtoile4.style.display = "none";
            imgPleineEtoile5.style.display = "none";
        } else if (note == 2) {
            imgVideEtoile1.style.display = "none";
            imgVideEtoile2.style.display = "none";
            imgVideEtoile3.style.display = "block";
            imgVideEtoile4.style.display = "block";
            imgVideEtoile5.style.display = "block";

            imgPleineEtoile1.style.display = "block";
            imgPleineEtoile2.style.display = "block";
            imgPleineEtoile3.style.display = "none";
            imgPleineEtoile4.style.display = "none";
            imgPleineEtoile5.style.display = "none";
        } else if (note == 3) {
            imgVideEtoile1.style.display = "none";
            imgVideEtoile2.style.display = "none";
            imgVideEtoile3.style.display = "none";
            imgVideEtoile4.style.display = "block";
            imgVideEtoile5.style.display = "block";

            imgPleineEtoile1.style.display = "block";
            imgPleineEtoile2.style.display = "block";
            imgPleineEtoile3.style.display = "block";
            imgPleineEtoile4.style.display = "none";
            imgPleineEtoile5.style.display = "none";
        } else if (note == 4) {
            imgVideEtoile1.style.display = "none";
            imgVideEtoile2.style.display = "none";
            imgVideEtoile3.style.display = "none";
            imgVideEtoile4.style.display = "none";
            imgVideEtoile5.style.display = "block";

            imgPleineEtoile1.style.display = "block";
            imgPleineEtoile2.style.display = "block";
            imgPleineEtoile3.style.display = "block";
            imgPleineEtoile4.style.display = "block";
            imgPleineEtoile5.style.display = "none";
        } else if (note == 5) {
            imgVideEtoile1.style.display = "none";
            imgVideEtoile2.style.display = "none";
            imgVideEtoile3.style.display = "none";
            imgVideEtoile4.style.display = "none";
            imgVideEtoile5.style.display = "none";

            imgPleineEtoile1.style.display = "block";
            imgPleineEtoile2.style.display = "block";
            imgPleineEtoile3.style.display = "block";
            imgPleineEtoile4.style.display = "block";
            imgPleineEtoile5.style.display = "block";
        } else {
            imgVideEtoile1.style.display = "block";
            imgVideEtoile2.style.display = "block";
            imgVideEtoile3.style.display = "block";
            imgVideEtoile4.style.display = "block";
            imgVideEtoile5.style.display = "block";

            imgPleineEtoile1.style.display = "none";
            imgPleineEtoile2.style.display = "none";
            imgPleineEtoile3.style.display = "none";
            imgPleineEtoile4.style.display = "none";
            imgPleineEtoile5.style.display = "none";
        }
    }

});