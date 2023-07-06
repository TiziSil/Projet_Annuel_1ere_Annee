<!DOCTYPE html>
<html>
<head>
    <title>Recherche d'utilisateurs</title>
</head>
<body>
    <h1>Recherche d'utilisateurs</h1>
    <input type="text" id="searchInput" placeholder="Entrez un nom d'utilisateur">
    <button id="searchButton">Rechercher</button>
    <div id="searchResults"></div>

    <script>
        var searchButton = document.getElementById('searchButton');
        var searchInput = document.getElementById('searchInput');
        var searchResults = document.getElementById('searchResults');

        searchButton.addEventListener('click', function() {
            var searchTerm = searchInput.value.trim();

            if (searchTerm !== '') {
                searchUsers(searchTerm);
            }
        });

        function searchUsers(searchTerm) {
            //requête ajax
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'search.php?query=' + encodeURIComponent(searchTerm), true);

            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 400) {
                    var response = xhr.responseText;
                    searchResults.innerHTML = response;
                } else {
                    console.error('Erreur lors de la requête AJAX');
                }
            };

            xhr.onerror = function() {
                console.error('Erreur lors de la requête AJAX');
            };

            xhr.send();
        }
    </script>
</body>
</html>
