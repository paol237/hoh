<?php
// admin/blogs/create_blog.php
session_start();
require_once '../../auth_functions.php'; 
require_once '../../db_connect.php'; 

require_login(); 

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = trim($_POST['titre'] ?? '');
    $contenu = trim($_POST['contenu'] ?? '');
    $id_utilisateur = $_SESSION['user_id'];
    $image_url = '';

    // --- 1. Gestion de l'Upload d'Image ---
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "../uploads/blogs/"; // Créez ce dossier !
        
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $file_name = basename($_FILES["image"]["name"]);
        $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $new_file_name = time() . uniqid() . "." . $file_extension;
        $target_file = $target_dir . $new_file_name;

        // Vérifications de sécurité
        if ($_FILES["image"]["size"] > 5000000) { // 5MB max
            $error = "Désolé, votre fichier est trop volumineux.";
        } elseif (!in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif'])) {
            $error = "Seuls les fichiers JPG, JPEG, PNG & GIF sont autorisés.";
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image_url = "../uploads/blogs/" . $new_file_name; // Chemin relatif pour la DB
            } else {
                $error = "Erreur lors du téléchargement du fichier.";
            }
        }
    }

    // --- 2. Insertion en Base de Données ---
    if (!$error && $titre && $contenu) {
        $sql = "INSERT INTO blogs (titre, contenu, image_url, id_utilisateur) 
                VALUES (?, ?, ?, ?)";
        
        if ($stmt = $conn->prepare($sql)) {
            // Note: $image_url peut être vide si aucune image n'a été uploadée
            $stmt->bind_param("sssi", $titre, $contenu, $image_url, $id_utilisateur);

            if ($stmt->execute()) {
                $message = "Article de blog ajouté avec succès !";
            } else {
                $error = "Erreur SQL : " . $conn->error;
            }
            $stmt->close();
        } else {
            $error = "Erreur de préparation de la requête: " . $conn->error;
        }
    } elseif (!$error) {
        $error = "Veuillez remplir le titre et le contenu de l'article.";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Blog</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <?php include '../../includes/admin_styles.php'; // Votre fichier de styles ?>
</head>
<body>
    <?php include '../sidebar.php'; // Incluez la sidebar ?>
    
    <div class="content-wrapper p-4">
        <h1>Ajouter un Nouvel Article de Blog</h1>

        <?php if ($message): ?>
            <div class="alert alert-success"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="create_blog.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="titre">Titre de l'article *</label>
                <input type="text" class="form-control" id="titre" name="titre" required>
            </div>
            
            <div class="form-group">
                <label for="contenu">Contenu de l'article *</label>
                <textarea class="form-control" id="contenu" name="contenu" rows="10" required></textarea>
            </div>

            <div class="form-group">
                <label for="image">Image Principale (Max 5MB)</label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
            </div>
            
            <button type="submit" class="btn btn-primary" style="background-color: #004085; border-color: #004085;">
                Publier l'article
            </button>
            <a href="manage_blogs.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>
</html>