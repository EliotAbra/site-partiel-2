<!-- supprimer_projet.php -->
<?php
// Vérifier si l'ID du projet à supprimer est spécifié dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Récupérer l'ID du projet depuis l'URL
    $id_projet = $_GET['id'];

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

    // Préparer la requête SQL pour supprimer le projet
    $sql = "DELETE FROM projets WHERE id = $id_projet";

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
