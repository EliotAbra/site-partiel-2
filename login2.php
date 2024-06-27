<?php
session_start();

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Remplacez par vos propres informations d'authentification
    $validUsername = 'eliot';
    $validPassword = '123';

    // Vérifier les informations d'authentification
    if ($username === $validUsername && $password === $validPassword) {
        $_SESSION['loggedin2'] = true;
        header('Location: liste_projet.php');
        exit();
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="login2s.css">
    <link rel="icon" href="logo-blanc-a.png" type="image/x-icon" />
</head>
<body>
    <div class="container">
        <h1>Connection - Modifier ou Supprimer un Projet</h1>
        <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
        <form action="login2.php" method="post">
            <label>Nom d'utilisateur:</label>
            <input type="text" name="username" required><br><br>
            <label>Mot de passe:</label>
            <input type="password" name="password" required><br><br>
            <input type="submit" value="Connexion">
        </form>
        <div class="space2"></div>
        <div class="text-links">
            <a href="administrateur.html" class="text-link">Retour à la Page Administrateur</a>
        </div>
    </div>
</body>
</html>
