<?php
// admin/blogs/delete_blog.php
session_start();
require_once '../../auth_functions.php'; 
require_once '../../db_connect.php'; 

require_login(); 

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_blog = $_GET['id'];

    // --- 1. Récupérer l'URL de l'image (pour la supprimer du serveur) ---
    $sql_img = "SELECT image_url FROM blogs WHERE id_blog = ?";
    if ($stmt_img = $conn->prepare($sql_img)) {
        $stmt_img->bind_param("i", $id_blog);
        $stmt_img->execute();
        $result_img = $stmt_img->get_result();
        if ($result_img->num_rows === 1) {
            $blog = $result_img->fetch_assoc();
            $file_path = '../' . $blog['image_url']; // Chemin complet
            
            // Supprimer le fichier image du serveur
            if (!empty($blog['image_url']) && file_exists($file_path)) {
                unlink($file_path);
            }
        }
        $stmt_img->close();
    }

    // --- 2. Supprimer l'entrée de la base de données ---
    $sql_delete = "DELETE FROM blogs WHERE id_blog = ?";
    if ($stmt_delete = $conn->prepare($sql_delete)) {
        $stmt_delete->bind_param("i", $id_blog);
        $stmt_delete->execute();
        $stmt_delete->close();
        
        header('Location: manage_blogs.php?status=deleted');
        exit;
    }
}

// Rediriger en cas d'erreur
header('Location: manage_blogs.php?status=error');
exit;
?>
