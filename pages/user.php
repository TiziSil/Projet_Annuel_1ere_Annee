<?php
// session_start();
// require "../conf.inc.php";
// require "../core/functions.php";
redirectIfNotConnected();
redirectIfNotAdmin();
logUserActivity("../log.txt");
// ?>
<div>
<h2>Recherche d'utilisateurs</h2>
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
<h1>Liste des utilisateurs</h1>
</div>
<nav class="nav flex-column">
<a class="nav-link active" href="mon-compte">Retour à mon compte</a>
</nav>
<?php
$connection = connectDB();
$results = $connection->query("SELECT * FROM ".DB_PREFIX."UTILISATEUR");
$results = $results -> fetchAll();
// $tableHTML = '<table>
//     <thead>
//         <tr>
//             <th>Id</th>
//             <th>Nom</th>
//             <th>Prénom</th>
//             <th>Pseudo</th>
//             <th>Email</th>
//         </tr>
//     </thead>
//     <tbody>';


// foreach ($results as $user){
//     $id = $user["id_utilisateur"];
//     $nom = $user["nom_utilisateur"];
//     $prenom = $user["prenom_utilisateur"];
//     $pseudo = $user["pseudo"];
//     $email = $user["email"];

//     $tableHTML .= '
//             <tr>
//             <td>' . $id . '</td>
//             <td>' . $nom . '</td>
//             <td>' . $prenom . '</td>
//             <td>' . $pseudo . '</td>
//             <td>' . $email . '</td>
//             </tr>';
// }
// $tableHTML .= '</tbody>
// </table>';

// // Renvoyer le tableau des résultats sous forme de HTML
// echo $tableHTML;
?>

<div class = "row">
    <div class ="col-11">
        <table class = "table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Pseudo</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Date de naissance</th>
                    <th>Nombres de points</th>
                    <th>Role utilisateur</th>
                    <th>Type compte</th>
                    <th>Statut</th>
                    <th>Ajouté</th>
                    <th>Modifié</th>
                    <th>Pays</th>
                    <th>Adresse</th>
                    <th>Code postal</th>
                    <th>Ville</th>
                    <th>Actions</th>
                    <th>Banissement</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($results as $user){
                    
                    echo "<tr>";
                    echo "<td>".$user["id_utilisateur"]."</td>";
                    echo "<td>".$user["nom_utilisateur"]."</td>";
                    echo "<td>".$user["prenom_utilisateur"]."</td>";
                    echo "<td>".$user["pseudo"]."</td>"; 
                    echo "<td class = 'col-md-3'>".$user["email"]."</td>";
                    echo "<td>".$user["telephone"]."</td>";
                    echo "<td>".$user["date_de_naissance"]."</td>";
                    echo "<td>".$user["point_utilisateur"]."</td>";
                    echo "<td>".$user["role_utilisateur"]."</td>"; 
                    echo "<td>".$user["type_compte"]."</td>";
                    echo "<td>".$user["statut"]."</td>";    
                    echo  "<td>".$user["date_inserted"]."</td>";
                    echo  "<td>".$user["date_updated"]."</td>";
                    echo  "<td>".$user["country"]."</td>";
                    echo  "<td>".$user["adresse"]."</td>";
                    echo  "<td>".$user["code_postal"]."</td>";
                    echo  "<td>".$user["ville"]."</td>";
                    echo "<td>
                    <form id='deleteForm' action='core/userDel.php' method='POST'>
                    <input type='hidden' name='id' value='".$user["id_utilisateur"]."'>
                    <button type='submit' class='btn btn-danger' onclick='confirmDelete()'>Supprimer</button>
                    </form>
                    <form action='userEdit' method='POST'>
                    <input type='hidden' name='id' value='".$user["id_utilisateur"]."'>
                    <button type='submit' class='btn btn-primary'>Modifier</button>
                    </form>
                
                    </td>";
                        echo "<td>";
                        echo "<form id='banForm' action='core/banUser.php' method='POST' style='display:inline;'>";
                        echo "<input type='hidden' name='id' value='" . $user["id_utilisateur"] . "'>";
                        if ($user["statut"] == 2) {
                            echo "<button type='submit' name='unban' class='btn btn-success' onclick='confirmUnban()'>Débannir</button>";
                        } else {
                            echo "<button type='submit' name='ban' class='btn btn-danger' onclick='confirmBan()'>Bannir</button>";
                        }
                        echo "</form>";
                        echo "</td>";
                    echo "</tr>";

                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function confirmDelete() {
        if (confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?")) {
            // L'utilisateur a confirmé la suppression, soumettez le formulaire
            document.getElementById("deleteForm").submit();
        } else {
            // L'utilisateur a annulé la suppression, rien ne se passe
        }
    }
</script>
