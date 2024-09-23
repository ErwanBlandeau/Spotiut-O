    // Fonction pour charger une nouvelle page via AJAX
    function loadPage(page) {
        $.ajax({
            url: page,
            success: function(response) {
                $('#content').html(response);
            }
        });
    }

    // Gestion des liens pour charger différentes pages sans rechargement
    $(document).on('click', 'a[data-page]', function(e) {
        e.preventDefault();
        var page = $(this).attr('data-page');
        loadPage(page);
    });
    
    // la meme chose avec les flèche de retour 
    $(document).on('click', 'a[data-back]', function(e) {
        e.preventDefault();
        var page = $(this).attr('data-back');
        loadPage(page);
    });
