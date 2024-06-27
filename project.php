<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails du Projet</title>
    <link rel="stylesheet" href="projects.css">
    <link rel="icon" href="logo-blanc-a.png" type="image/x-icon" />
</head>
<body>
    <div class="container">
        <h1 class="entete">Détails du Projet</h1>
        <?php
        // Vérifier si l'id du projet est passé en paramètre GET
        if(isset($_GET['id'])) {
            $id = $_GET['id'];

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

            // Requête SQL pour récupérer les détails du projet spécifique
            $sql = "SELECT titre, date_publication, texte1, texte2, texte3, image1, image2, image3 FROM projets WHERE id = $id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Affichage des détails du projet
                $row = $result->fetch_assoc();
                echo '<h2>' . $row["titre"] . '</h2>';
                echo '<p>Date de publication: ' . $row["date_publication"] . '</p>';
                echo '<div class="project-content">';
                echo '<div class="text-image">';
                echo '<p>' . $row["texte1"] . '</p>';
                echo '<img src="' . $row["image1"] . '" alt="Image 1">';
                echo '</div>';
                echo '<div class="text-image">';
                echo '<p>' . $row["texte2"] . '</p>';
                echo '<img src="' . $row["image2"] . '" alt="Image 2">';
                echo '</div>';
                echo '<div class="text-image">';
                echo '<p>' . $row["texte3"] . '</p>';
                echo '<img src="' . $row["image3"] . '" alt="Image 3">';
                echo '</div>';
                echo '</div>';
            } else {
                echo "Projet non trouvé.";
            }
            $conn->close();
        } else {
            echo "ID de projet non spécifié.";
        }
        ?>
    </div>
    <div class="spacex"></div>
    <div class="bu">
        <a href="index.php" class="button"><p class="text-button">Voir les autres Projets</p></a>
    </div>
</body>
</html>
