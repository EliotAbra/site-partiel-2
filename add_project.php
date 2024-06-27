<?php
session_start();

// Vérifier si l'utilisateur est authentifié
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Projet</title>
    <link rel="stylesheet" href="add_project.css">
</head>
<body>
    <div class="container">
        <h1>Ajouter un Projet</h1>
        <form action="insert_project.php" method="post" enctype="multipart/form-data">
            <label>Titre:</label>
            <input type="text" name="titre" required><br><br>
            <label>Date de publication:</label>
            <input type="date" name="date_publication"><br><br>
            <label>Texte 1:</label>
            <textarea name="texte1"></textarea><br><br>
            <label>Texte 2:</label>
            <textarea name="texte2"></textarea><br><br>
            <label>Texte 3:</label>
            <textarea name="texte3"></textarea><br><br>
            <label>Image 1:</label>
            <input type="file" name="image1"><br><br>
            <label>Image 2:</label>
            <input type="file" name="image2"><br><br>
            <label>Image 3:</label>
            <input type="file" name="image3"><br><br>
            <input type="submit" value="Ajouter le Projet">
        </form>
        <a href="logout.php" class="deconect">Se déconnecter</a>
    </div>
</body>
</html>
