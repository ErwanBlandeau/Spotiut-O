document.addEventListener('DOMContentLoaded', function () {
    var inputSearch = document.querySelector('.input_search');
    var crossIcon = document.querySelector('.cross_icon');
    var navLinks = document.querySelectorAll('.navbar-item a');

    // Stocker la valeur de la barre de recherche lorsqu'un élément du nav est cliqué
    navLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            localStorage.setItem('searchValue', inputSearch.value);
        });
    });

    // Restaurer la valeur précédente du champ de recherche depuis le localStorage
    var search = localStorage.getItem('searchValue') || '';
    localStorage.removeItem('searchValue');
    inputSearch.value = search || '';
    inputSearch.focus();
    inputSearch.setSelectionRange(search.length, search.length);

    // fonction pour gérer les changements de la barre de recherche
    function handleSearchChange() {
        if (inputSearch.value.trim() !== '') {
            crossIcon.style.opacity = '1';
        } else {
            crossIcon.style.opacity = '0';
        }

        var search = inputSearch.value.toLowerCase();
        var searchResults = document.querySelectorAll('.search-result');

        searchResults.forEach(function(result) {
            var resultText = '';
            var paragraph = result.querySelector('p');
            var tableCells = result.querySelectorAll('td');

            if (paragraph) {
                resultText = paragraph.textContent.toLowerCase();
            } else {
                tableCells.forEach(function(cell) {
                    resultText += cell.textContent.toLowerCase() + ' ';
                });
            }

            if (resultText.includes(search)) {
                result.style.display = '';
            } else {
                result.style.display = 'none';
            }
        });

        var nbResultsText = document.querySelector('.nb-results');
        if (nbResultsText) {
            var nbResults = document.querySelectorAll('.search-result:not([style="display: none;"])').length;
            if (nbResults > 0) {
                if (nbResults == 1){
                    nbResultsText.textContent = nbResults + ' résultat trouvé';
                } else { nbResultsText.textContent = nbResults + ' résultats trouvés'; }
            } else {
                nbResultsText.textContent = 'Aucun résultat trouvé';
            }
        }
    }

    // érer les changements de la barre de recherche
    handleSearchChange();

    // barre de recherche
    inputSearch.addEventListener('input', handleSearchChange);
    crossIcon.addEventListener('click', function () {
        inputSearch.value = '';
        crossIcon.style.opacity = '0';
        handleSearchChange();
    });

    inputSearch.addEventListener('input', function () {
        var search = inputSearch.value;
        console.log(search.trim());
        if (search.trim() !== '' && !window.location.href.includes('explorer')) {
            localStorage.setItem('searchValue', search);
            window.location.href = 'index.php?action=explorer&search=Tout';
        }
    });
});