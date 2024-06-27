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

    // Requête SQL pour supprimer le projet spécifique
    $sql = "DELETE FROM projets WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Projet supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression du projet: " . $conn->error;
    }

    $conn->close();
} else {
    echo "ID de projet non spécifié.";
}
?>
