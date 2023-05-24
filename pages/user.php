<?php

// require "../conf.inc.php";
// require "../core/functions.php";

?>
<div>
    <h1>Liste des utilisateurs</h1>

</div>
<?php
$connection = connectDB();
$results = $connection->query("SELECT * FROM ".DB_PREFIX."UTILISATEUR");
$results = $results -> fetchAll();
?>
<div>
    <table class = "table"></table>
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
            <th>id_Avatar</th>
            <th>Pays</th>
            <th>Adresse</th>
            <th>Code postal</th>
            <th>Ville</th>
            
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
            echo "<td>".$user["email"]."</td>";
            echo "<td>".$user["telephone"]."</td>";
            echo "<td>".$user["date_de_naissance"]."</td>";
            echo "<td>".$user["point_utilisateur"]."</td>";
            echo "<td>".$user["role_utilisateur"]."</td>"; 
            echo "<td>".$user["type_compte"]."</td>";
            echo "<td>".$user["statut"]."</td>";    
            echo  "<td>".$user["date_inserted"]."</td>";
            echo  "<td>".$user["date_updated"]."</td>";
            echo  "<td>".$user["avatar_utilisateur"]."</td>";
            echo  "<td>".$user["country"]."</td>";
            echo  "<td>".$user["adresse"]."</td>";
            echo  "<td>".$user["code_postal"]."</td>";
            echo  "<td>".$user["ville"]."</td>";
            echo "<td><a href='/ProjetAnnuel/core/userDel.php?id=".$user["id_utilisateur"]."' class='btn btn-danger'>Suppression</a></td>";
            echo "</tr>";

        }
        ?>
    </tbody>
</table>
    
</div>