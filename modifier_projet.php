<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Projet</title>
    <link rel="stylesheet" href="modifier_projet.css">
</head>
<body>
    <div class="container">
        <h1>Modifier Projet</h1>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "portfolio";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Traitement des modifications
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $titre = isset($_POST['titre']) ? $_POST['titre'] : '';
            $date_publication = isset($_POST['date_publication']) ? $_POST['date_publication'] : '';
            $texte1 = isset($_POST['texte1']) ? $_POST['texte1'] : '';
            $texte2 = isset($_POST['texte2']) ? $_POST['texte2'] : '';
            $texte3 = isset($_POST['texte3']) ? $_POST['texte3'] : '';

            $image1 = !empty($_FILES['image1']['name']) ? $_FILES['image1']['name'] : null;
            $image2 = !empty($_FILES['image2']['name']) ? $_FILES['image2']['name'] : null;
            $image3 = !empty($_FILES['image3']['name']) ? $_FILES['image3']['name'] : null;

            $target_dir = "uploads/";

            if ($image1) {
                move_uploaded_file($_FILES['image1']['tmp_name'], $target_dir . $image1);
            }
            if ($image2) {
                move_uploaded_file($_FILES['image2']['tmp_name'], $target_dir . $image2);
            }
            if ($image3) {
                move_uploaded_file($_FILES['image3']['tmp_name'], $target_dir . $image3);
            }

            $sql = "UPDATE projets SET titre=?, date_publication=?, texte1=?, texte2=?, texte3=?";
            $params = [$titre, $date_publication, $texte1, $texte2, $texte3];

            if ($image1) {
                $sql .= ", image1=?";
                $params[] = $image1;
            }
            if ($image2) {
                $sql .= ", image2=?";
                $params[] = $image2;
            }
            if ($image3) {
                $sql .= ", image3=?";
                $params[] = $image3;
            }
            $sql .= " WHERE id=?";
            $params[] = $id;

            $stmt = $conn->prepare($sql);
            $types = str_repeat('s', count($params) - 1) . 'i';
            $stmt->bind_param($types, ...$params);

            if ($stmt->execute()) {
                echo "<p>Modifications enregistrées avec succès.</p>";
                echo "<a href='liste_projet.php'>Retour à la liste des projets</a>";
            } else {
                echo "Erreur de mise à jour: " . $stmt->error;
            }

            $stmt->close();
        } elseif (isset($_GET['id']) && !empty($_GET['id'])) {
            // Affichage du formulaire de modification
            $id_projet = $_GET['id'];
            $sql = "SELECT * FROM projets WHERE id = $id_projet";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>
                <form action="modifier_projet.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    
                    <label for="titre">Titre:</label><br>
                    <input type="text" id="titre" name="titre" value="<?php echo $row['titre']; ?>"><br><br>
                    
                    <label for="date_publication">Date de publication:</label><br>
                    <input type="date" id="date_publication" name="date_publication" value="<?php echo $row['date_publication']; ?>"><br><br>
                    
                    <label for="texte1">Texte 1:</label><br>
                    <textarea id="texte1" name="texte1"><?php echo $row['texte1']; ?></textarea><br><br>
                    
                    <label for="texte2">Texte 2:</label><br>
                    <textarea id="texte2" name="texte2"><?php echo $row['texte2']; ?></textarea><br><br>
                    
                    <label for="texte3">Texte 3:</label><br>
                    <textarea id="texte3" name="texte3"><?php echo $row['texte3']; ?></textarea><br><br>
                    
                    <label for="image1">Image 1:</label><br>
                    <input type="file" id="image1" name="image1"><br><br>
                    
                    <label for="image2">Image 2:</label><br>
                    <input type="file" id="image2" name="image2"><br><br>
                    
                    <label for="image3">Image 3:</label><br>
                    <input type="file" id="image3" name="image3"><br><br>
                    
                    <input type="submit" value="Enregistrer les Modifications">
                </form>
                <?php
            } else {
                echo "Aucun projet trouvé.";
            }
        } else {
            echo "ID de projet non spécifié.";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
