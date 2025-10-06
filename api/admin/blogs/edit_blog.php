<?php
// admin/blogs/edit_blog.php
session_start();
require_once '../../auth_functions.php'; 
require_once '../../db_connect.php'; 

require_login(); 

$blog = null;
$message = '';
$error = '';

// --- 1. Récupération de l'article à modifier (GET) ---
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_blog = $_GET['id'];
    
    $sql = "SELECT id_blog, titre, contenu, image_url 
            FROM blogs 
            WHERE id_blog = ?";
            
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id_blog);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $blog = $result->fetch_assoc();
        } else {
            $error = "Article non trouvé.";
        }
        $stmt->close();
    } 
} elseif ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $error = "ID de l'article manquant.";
}

// --- 2. Traitement de la soumission du formulaire (POST) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_blog'])) {
    $id_blog = $_POST['id_blog'];
    $titre = trim($_POST['titre'] ?? '');
    $contenu = trim($_POST['contenu'] ?? '');
    $current_image_url = $_POST['current_image_url'] ?? '';
    $image_url = $current_image_url; 

    // Gestion de l'Upload de Nouvelle Image
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "../uploads/blogs/";
        $file_extension = strtolower(pathinfo(basename($_FILES["image"]["name"]), PATHINFO_EXTENSION));
        $new_file_name = time() . uniqid() . "." . $file_extension;
        $target_file = $target_dir . $new_file_name;

        // Vérifications de sécurité et déplacement
        if ($_FILES["image"]["size"] > 5000000) { 
            $error = "La nouvelle image est trop volumineuse.";
        } elseif (!in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif'])) {
            $error = "Seuls les JPG, JPEG, PNG & GIF sont autorisés.";
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image_url = "uploads/blogs/" . $new_file_name;
                
                // Supprimer l'ancienne image du serveur si elle existe
                if (!empty($current_image_url) && file_exists('../' . $current_image_url)) {
                    unlink('../' . $current_image_url);
                }
            } else {
                $error = "Erreur lors du téléchargement de la nouvelle image.";
            }
        }
    }
    
    // Si l'utilisateur a coché la case pour supprimer l'image
    if (isset($_POST['delete_image']) && $_POST['delete_image'] == 1 && !empty($current_image_url)) {
        if (file_exists('../' . $current_image_url)) {
            unlink('../' . $current_image_url);
        }
        $image_url = NULL; // Mettre le champ de la BD à NULL
    }
    
    // --- Mise à jour de la Base de Données ---
    if (!$error && $titre && $contenu) {
        $sql = "UPDATE blogs SET titre=?, contenu=?, image_url=? 
                WHERE id_blog=?";
        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sssi", $titre, $contenu, $image_url, $id_blog);

            if ($stmt->execute()) {
                $message = "Article mis à jour avec succès !";
                // Recharger les nouvelles données dans la variable $blog
                $blog['titre'] = $titre;
                $blog['contenu'] = $contenu;
                $blog['image_url'] = $image_url;
            } else {
                $error = "Erreur SQL lors de la mise à jour : " . $conn->error;
            }
            $stmt->close();
        } 
    }
}
$conn->close();

if (!$blog && empty($error)) {
    // Si on arrive ici sans erreur mais sans article (ID invalide), on redirige.
    header('Location: manage_blogs.php?status=error_not_found');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier le Blog</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <?php include '../../includes/admin_styles.php'; ?>
    <style> .current-img { max-width: 150px; height: auto; margin-top: 10px; border: 1px solid #ccc; } </style>
</head>
<body>
    <?php include '../sidebar.php'; ?>
    
    <div class="content-wrapper p-4">
        <h1>Modifier l'Article : <?= htmlspecialchars($blog['titre'] ?? 'Chargement...') ?></h1>

        <?php if ($message): ?>
            <div class="alert alert-success"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if ($blog): ?>
        <form method="POST" action="edit_blog.php?id=<?= $blog['id_blog'] ?>" enctype="multipart/form-data">
            <input type="hidden" name="id_blog" value="<?= htmlspecialchars($blog['id_blog']) ?>">
            <input type="hidden" name="current_image_url" value="<?= htmlspecialchars($blog['image_url']) ?>">
            
            <div class="form-group">
                <label for="titre">Titre de l'article *</label>
                <input type="text" class="form-control" id="titre" name="titre" 
                       value="<?= htmlspecialchars($blog['titre']) ?>" required>
            </div>
            
            <div class="form-group">
                <label for="contenu">Contenu de l'article *</label>
                <textarea class="form-control" id="contenu" name="contenu" rows="10" required><?= htmlspecialchars($blog['contenu']) ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="image">Image actuelle</label><br>
                <?php if ($blog['image_url']): ?>
                    <img src="../../<?= htmlspecialchars($blog['image_url']) ?>" alt="Image actuelle" class="current-img">
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" name="delete_image" value="1" id="delete_image">
                        <label class="form-check-label" for="delete_image">Supprimer l'image actuelle</label>
                    </div>
                <?php else: ?>
                    <p>Aucune image n'est actuellement définie.</p>
                <?php endif; ?>
                
                <label for="new_image" class="mt-3">Télécharger une nouvelle image (remplacera l'ancienne)</label>
                <input type="file" class="form-control-file" id="new_image" name="image" accept="image/*">
            </div>
            
            <button type="submit" class="btn btn-success" style="background-color: #28a745; border-color: #28a745;">
                Enregistrer les modifications
            </button>
            <a href="manage_blogs.php" class="btn btn-secondary">Retour à la gestion</a>
        </form>
        <?php endif; ?>
    </div>
</body>
</html>