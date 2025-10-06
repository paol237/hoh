<?php
// admin/events/delete_event.php
session_start();
require_once '../../auth_functions.php'; 
require_once '../../db_connect.php'; 

require_login(); 

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_evenement = $_GET['id'];

    // --- 1. Récupérer l'URL de l'image (pour la supprimer du serveur) ---
    $sql_img = "SELECT image_url FROM evenements WHERE id_evenement = ?";
    if ($stmt_img = $conn->prepare($sql_img)) {
        $stmt_img->bind_param("i", $id_evenement);
        $stmt_img->execute();
        $result_img = $stmt_img->get_result();
        if ($result_img->num_rows === 1) {
            $event = $result_img->fetch_assoc();
            $file_path = '../' . $event['image_url']; // Chemin complet du fichier
            
            // Supprimer le fichier image du serveur s'il existe
            if (!empty($event['image_url']) && file_exists($file_path)) {
                unlink($file_path);
            }
        }
        $stmt_img->close();
    }

    // --- 2. Supprimer l'entrée de la base de données ---
    $sql_delete = "DELETE FROM evenements WHERE id_evenement = ?";
    if ($stmt_delete = $conn->prepare($sql_delete)) {
        $stmt_delete->bind_param("i", $id_evenement);
        $stmt_delete->execute();
        $stmt_delete->close();
        
        // Rediriger vers la page de gestion avec un message de succès (optionnel)
        header('Location: manage_events.php?status=deleted');
        exit;
    }
}

// Rediriger en cas d'erreur ou d'ID manquant
header('Location: manage_events.php?status=error');
exit;
?>