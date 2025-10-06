<?php
// Fichier : public_events.php

// 1. Initialisation des variables
$events = [];
$error = '';
$conn = null; 

// --- DÉFINITION DES CHEMINS ABSOLUS ---
// Ces chemins sont basés sur l'accès via /ONG/
$base_db_image_path = '/ong/api/admin/uploads/events/'; 
$default_image_path = '/ong/img/default_event.jpg'; 

try {
    // 2. Tenter d'inclure le fichier de connexion
    // require __DIR__ . '/vendor/autoload.php';
    require_once 'api/db_connect.php'; 


    // 3. Vérification si l'objet de connexion a été créé et a échoué
    // Cela gère les cas où db_connect.php ne lance pas d'erreur fatale (car il ne devrait pas)
    if ($conn === null || $conn->connect_error) {
        throw new Exception("Échec de la connexion à la base de données. Vérifiez db_connect.php.");
    }
    
    // 4. Exécuter la requête
    $sql = "SELECT id_evenement, titre, description, date_evenement, heure_evenement, lieu, image_url 
            FROM evenements 
            WHERE date_evenement >= CURDATE() 
            ORDER BY date_evenement ASC 
            LIMIT 4";

    $result = $conn->query($sql);

    if (!$result) {
        // Lance une exception en cas d'erreur SQL
        throw new Exception("Erreur de base de données : " . $conn->error);
    }
    
    // Récupération des données
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
    }

} catch (Exception $e) {
    // 5. Capture de toute erreur (inclusion, connexion, ou requête)
    $error = $e->getMessage();
    $events = []; 
} finally {
    // // 6. S'assure de fermer la connexion si elle a été établie
    // if ($conn instanceof mysqli) {
    //     $conn->close();
    // }
}
?>

<div class="event">
    <div class="container">
        <div class="section-header text-center">
            <p>Upcoming Events</p>
            <h2>Be ready for our upcoming charity events</h2>
        </div>
        
        <?php if ($error): ?>
            <div class="alert alert-danger text-center"><?= htmlspecialchars($error) ?></div>
        <?php elseif (empty($events)): ?>
            <div class="alert alert-info text-center">Aucun événement à venir n'est planifié pour le moment.</div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($events as $event): 
                    
                    // Formatage de la date et de l'heure
                    $date_formatted = date('d-M-Y', strtotime($event['date_evenement']));
                    $time_formatted = $event['heure_evenement'] ? date('H:i', strtotime($event['heure_evenement'])) : 'Heure non spécifiée';
                    
                    // Snippet de description
                    $description_snippet = substr(strip_tags($event['description']), 0, 180);
                    if (strlen($event['description']) > 180) { $description_snippet .= '...'; }

                    // --- CONSTRUCTION DU CHEMIN DE L'IMAGE (Corrigé) ---
                    $db_stored_path = htmlspecialchars($event['image_url']);
                    
                    // Nettoyage : On récupère uniquement le nom du fichier
                    $cleaned_filename = basename($db_stored_path); 

                    // Détermination du chemin final
                    if (!empty($cleaned_filename) && $cleaned_filename != basename($default_image_path)) {
                        $image_src = $base_db_image_path . $cleaned_filename;
                    } else {
                        $image_src = $default_image_path;
                    }
                ?>
                    <div class="col-lg-6"> 
                        <div class="event-item">
                            <img class="img-fluid" src="<?= $image_src ?>" alt="<?= htmlspecialchars($event['titre']) ?>" style="height: 410px; object-fit: cover;">
                            <div class="event-content">
                                <div class="event-meta">
                                    <p><i class="fa fa-calendar-alt"></i><?= $date_formatted ?></p>
                                    <p><i class="far fa-clock"></i><?= $time_formatted ?></p>
                                    <p><i class="fa fa-map-marker-alt"></i><?= htmlspecialchars($event['lieu']) ?></p>
                                </div>
                                <div class="event-text">
                                    <h3><?= htmlspecialchars($event['titre']) ?></h3>
                                    <p>
                                        <?= htmlspecialchars($description_snippet) ?>
                                    </p>
                                    <a class="btn btn-custom" href="event_detail.php?id=<?= $event['id_evenement'] ?>">Détails</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>