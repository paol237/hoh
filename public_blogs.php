<?php
// Fichier : public_blogs.php
// Assurez-vous que le chemin est correct depuis la racine de votre projet public
// require __DIR__ . '/vendor/autoload.php';
require_once 'api/db_connect.php'; 

$blogs = [];
$error = '';

// Requête pour sélectionner les 3 derniers articles (vous pouvez ajuster la limite)
$sql = "SELECT id_blog, titre, contenu, image_url, date_publication 
        FROM blogs 
        ORDER BY date_publication DESC 
        LIMIT 3";

$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $blogs[] = $row;
        }
    }
} else {
    $error = "Erreur de base de données : " . $conn->error;
}
// $conn->close();

// --- DÉFINITION DES CHEMINS ABSOLUS ---

// Chemin de base pour les images de la DB (doit être l'URL complète jusqu'au dossier)
$base_db_image_path = '/ong/api/admin/uploads/blogs/'; 
                    
// Chemin pour l'image par défaut (qui est à la racine /ONG/img/)
$default_image_path = '/ONG/img/default_blog.jpg'; 
?>

<div class="blog">
    <div class="container mt-5">
        <div class="section-header text-center">
            <p>Our Blog</p>
            <h2>Latest news & articles directly from our blog</h2>
        </div>
        
        <?php if ($error): ?>
            <div class="alert alert-danger text-center"><?= htmlspecialchars($error) ?></div>
        <?php elseif (empty($blogs)): ?>
            <div class="alert alert-info text-center">Aucun article de blog n'est disponible pour le moment.</div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($blogs as $blog): 
                    // Pour afficher une version courte du contenu dans le bloc
                    $snippet = substr(strip_tags($blog['contenu']), 0, 100); 
                    if (strlen($blog['contenu']) > 100) { $snippet .= '...'; }
                    
                    // --- CORRECTION DU CHEMIN DE L'IMAGE DE LA DB ---
                    
                    $db_stored_path = htmlspecialchars($blog['image_url']);
                    
                    // Nettoyage : On retire tout chemin relatif stocké par erreur (ex: ../uploads/blogs/)
                    // Nous n'avons besoin que du nom du fichier.
                    $cleaned_filename = basename($db_stored_path); 

                    // DÉTERMINATION DU CHEMIN FINAL DE L'IMAGE
                    if (!empty($cleaned_filename)) {
                        // Concaténation : Chemin de base absolu + Nom du fichier propre
                        $image_src = $base_db_image_path . $cleaned_filename;
                    } else {
                        // Utilisation de l'image par défaut si aucune image n'est trouvée
                        $image_src = $default_image_path;
                    }
                ?>
                    <div class="col-lg-4">
                        <div class="blog-item">
                            <div class="blog-img">
                                <img src="<?= $image_src ?>" alt="<?= htmlspecialchars($blog['titre']) ?>" style="height: 300px; object-fit: cover;">
                            </div>
                            <div class="blog-text">
                                <h3><a href="blog_detail.php?id=<?= $blog['id_blog'] ?>"><?= htmlspecialchars($blog['titre']) ?></a></h3>
                                <p>
                                    <?= htmlspecialchars($snippet) ?>
                                </p>
                            </div>
                            <div class="blog-meta">
                                <p><i class="fa fa-user"></i><a href="">Admin</a></p>
                                <p><i class="fa fa-calendar"></i><a href=""><?= date('d M Y', strtotime($blog['date_publication'])) ?></a></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>