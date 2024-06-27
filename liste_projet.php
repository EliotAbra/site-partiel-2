<?php
session_start();

// Vérifier si l'utilisateur est authentifié
if (!isset($_SESSION['loggedin2']) || $_SESSION['loggedin2'] !== true) {
    header('Location: login2.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Projets</title>
    <link rel="stylesheet" href="liste_projet.css">
</head>
<body>
    <div class="container">
        <h1>Liste des Projets - Administrateur</h1>
        <?php
        // Connexion à la base de données
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "portfolio";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Vérifier la connexion
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Récupérer tous les projets ordonnés par titre
        $sql = "SELECT id, titre FROM projets ORDER BY titre";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Afficher chaque projet avec des liens de suppression et de modification
            while($row = $result->fetch_assoc()) {
                echo "<div>";
                echo "<h3>{$row['titre']}</h3>";
                echo "<a href='supprimer_projet.php?id={$row['id']}' class='btn-supprimer'>Supprimer</a>";
                echo " <a href='modifier_projet.php?id={$row['id']}' class='btn-modifier'>Modifier</a>";
                echo "</div>";
            }
        } else {
            echo "Aucun projet trouvé.";
        }

        $conn->close();
        ?>
        <a href="logout2.php" class="deconect">Se déconnecter</a>
    </div>
</body>
</html>
