<?php
// admin/blogs/manage_blogs.php
session_start();
require_once '../../auth_functions.php'; 
require_once '../../db_connect.php'; 

require_login(); 

$blogs = [];
$error = '';

// Récupérer tous les blogs, triés par date de publication la plus récente
$sql = "SELECT id_blog, titre, image_url, date_publication 
        FROM blogs 
        ORDER BY date_publication DESC";

$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $blogs[] = $row;
        }
    }
} else {
    $error = "Erreur lors de la récupération des articles de blog : " . $conn->error;
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les Blogs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <?php include '../../includes/admin_styles.php'; ?>
    <style>
        .blog-img { width: 80px; height: 50px; object-fit: cover; border-radius: 5px; }
    </style>
</head>
<body>
    <?php include '../sidebar.php'; ?>
    
    <div class="content-wrapper p-4">
        <h1>Gestion des Articles de Blog</h1>

        <a href="create_blog.php" class="btn btn-success mb-3" style="background-color: #28a745; border-color: #28a745;">
            + Ajouter un nouvel article
        </a>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        
        <?php if (empty($blogs)): ?>
            <div class="alert alert-info">Aucun article de blog n'a encore été publié.</div>
        <?php else: ?>
            <table class="table table-striped table-hover">
                <thead class="bg-primary text-white" style="background-color: #004085 !important;">
                    <tr>
                        <th>Image</th>
                        <th>Titre de l'article</th>
                        <th>Date de publication</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($blogs as $blog): ?>
                        <tr>
                            <td>
                                <?php if ($blog['image_url']): ?>
                                    <img src="<?= htmlspecialchars($blog['image_url']) ?>" alt="Image <?= htmlspecialchars($blog['titre']) ?>" class="blog-img">
                                <?php else: ?>
                                    Aucune
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($blog['titre']) ?></td>
                            <td><?= date('d/m/Y', strtotime($blog['date_publication'])) ?></td>
                            <td>
                                <a href="edit_blog.php?id=<?= $blog['id_blog'] ?>" class="btn btn-sm btn-info">Modifier</a>
                                <a href="delete_blog.php?id=<?= $blog['id_blog'] ?>" 
                                   class="btn btn-sm btn-danger" 
                                   onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?');">
                                    Supprimer
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>