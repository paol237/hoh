<!DOCTYPE html>
<html lang="en">
    <?php
// Fichier : about_events_full.php (À inclure dans about.php)
// Affichage de tous les événements à venir.

// Assurez-vous que le chemin est correct pour la connexion DB.
// Puisque ce fichier sera inclus dans about.php (qui est probablement à la racine /ONG/), 
// le chemin relatif 'api/db_connect.php' est utilisé.
require_once 'api/db_connect.php'; 

// 1. Initialisation des variables
$events = [];
$error = '';
$conn_status = $conn; // Stocker l'objet pour la vérification de fermeture

// --- DÉFINITION DES CHEMINS ABSOLUS ---
// Basé sur l'hypothèse que vos images sont dans /ONG/api/admin/uploads/events/
$base_db_image_path = '/ONG/api/admin/uploads/events/'; 
$default_image_path = '/ONG/img/default_event.jpg'; 

try {
    // 2. Vérification critique de la connexion
    if ($conn_status === null || $conn_status->connect_error) {
        throw new Exception("Échec de la connexion à la base de données.");
    }
    
    // 3. Exécuter la requête pour TOUS les événements futurs
    $sql = "SELECT id_evenement, titre, description, date_evenement, heure_evenement, lieu, image_url 
            FROM evenements 
            WHERE date_evenement >= CURDATE() 
            ORDER BY date_evenement ASC"; // Pas de LIMIT pour afficher tous les événements

    $result = $conn_status->query($sql);

    if (!$result) {
        throw new Exception("Erreur de base de données : " . $conn_status->error);
    }
    
    // Récupération des données
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
    }

} catch (Exception $e) {
    // 4. Capture de l'erreur
    $error = $e->getMessage();
    $events = []; 
} finally {
    // IMPORTANT : Ne pas fermer la connexion ici. Elle sera fermée à la fin de la page principale (index.php ou about.php).
    // if ($conn_status instanceof mysqli) { $conn_status->close(); }
}
?>
    <head>
        <meta charset="utf-8">
        <title>Hand on Heart</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Free Website Template" name="keywords">
        <meta content="Free Website Template" name="description">

        <!-- Favicon -->
        <link rel="shortcut icon" href="img/logo-no-bg.png" type="image/x-icon">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>
        <!-- Top Bar Start -->
        <div class="top-bar d-none d-md-block">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="top-bar-left">
                            <div class="text">
                                <i class="fa fa-phone-alt"></i>
                                <p>+237 655 726 217 (Cameroon – French)</p>
                            </div>
                            <div class="text">
                                <i class="fa fa-envelope"></i>
                                <p>contact@handonheartcameroon.com</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="top-bar-right">
                            <div class="social">
                                <a href="#"><i class="fab fa-twitter" target="_blank"></i></a>
                                <a href="https://www.facebook.com/associationhandonheart" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                <a href="https://www.linkedin.com/company/handonheartcameroon/" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                <!-- <a href="#"><i class="fab fa-instagram"></i></a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Top Bar End -->

        <!-- Nav Bar Start -->
        <div class="navbar navbar-expand-lg bg-dark navbar-dark">
            <div class="container-fluid">
                <a href="index.php" class="navbar-brand">
                    <img class="img-fluid" src="img/logo-no-bg.png" alt="">
                    <span class="h3 text-warning">Hand on Heart</span> <br>
                    <small class="h6">Cameroon</small>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav ml-auto">
                        <a href="index.php" class="nav-item nav-link">Home</a>
                        <a href="about.php" class="nav-item nav-link">About</a>
                        <a href="causes.php" class="nav-item nav-link">Causes</a>
                        <a href="event.php" class="nav-item nav-link">Events</a>
                        <a href="blog.php" class="nav-item nav-link">Blog</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu">
                                <a href="single.php" class="dropdown-item">Detail Page</a>
                                <a href="service.php" class="dropdown-item">What We Do</a>
                                <a href="team.php" class="dropdown-item">Meet The Team</a>
                                <a href="donate.php" class="dropdown-item">Donate Now</a>
                                <a href="volunteer.php" class="dropdown-item">Become A Volunteer</a>
                            </div>
                        </div>
                        <a href="contact.php" class="nav-item nav-link">Contact</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Nav Bar End -->
        
        
        <!-- Page Header Start -->
        <div class="page-header events">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Upcoming Events</h2>
                    </div>
                    <div class="col-12">
                        <a href="">Home</a>
                        <a href="">Events</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->
        
        
        <!-- Event Start -->
        <!-- <div class="event">
            <div class="container">
                <div class="section-header text-center">
                    <p>Upcoming Events</p>
                    <h2>Be ready for our upcoming charity events</h2>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="event-item">
                            <img class="img-fluid" src="img/cause_2.jpeg" alt="Visit to Mfou Hospital" style="height: 410px; object-fit: cover;">
                            <div class="event-content">
                                <div class="event-meta">
                                    <p><i class="fa fa-calendar-alt"></i>01-Aug-2025</p>
                                    <p><i class="far fa-clock"></i>08:00 - 14:00</p>
                                    <p><i class="fa fa-map-marker-alt"></i>Hôpital District  Mfou</p>
                                </div>
                                <div class="event-text">
                                    <h3> Visit to Mfou Hospital</h3>
                                    <p>
                                        Our team will visit the Mfou District Hospital to conduct a mental health awareness session for patients and staff.
                                        This event includes screenings, educational talks, and the distribution of awareness materials.
                                    </p>
                                    <a class="btn btn-custom" href="#">Join Now</a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="event-item">
                            <img src="img/presentation.jpg" alt="Biagne App Presentation">
                            <div class="event-content">
                                <div class="event-meta">
                                    <p><i class="fa fa-calendar-alt"></i>16-Aug-2025</p>
                                    <p><i class="far fa-clock"></i>18:00 - 20:00</p>
                                    <p><i class="fa fa-map-marker-alt"></i> Yaoundé</p>
                                </div>
                                <div class="event-text">
                                    <h3>Launch of Biagne Mental Health App</h3>
                                    <p>
                                        Discover Biagne, our new mobile app designed to help individuals detect early signs of mental distress and access local support services. 
                                        The presentation will include a live demo, Q&A session, and free downloads for attendees.
                                    </p>
                                    <a class="btn btn-custom" href="#">Join Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="event-item">
                        <img src="img/schooltraining.jpg" alt="Training for school counselors" style="height: 410px; object-fit: cover;">
                        <div class="event-content">
                            <div class="event-meta">
                                <p><i class="fa fa-calendar-alt"></i>30-Aug-2025</p>
                                <p><i class="far fa-clock"></i>09:00 - 15:00</p>
                                <p><i class="fa fa-map-marker-alt"></i>University of Buea</p>
                            </div>
                            <div class="event-text">
                                <h3>Training for School Counselors</h3>
                                <p>
                                    A specialized workshop to train school counselors in recognizing signs of psychological distress and offering effective support to students. Certification provided.
                                </p>
                                <a class="btn btn-custom" href="#">Join Now</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="event-item">
                        <img src="img/event_3.jpeg" alt="Peer support group launch" style="height: 410px; object-fit: cover;">
                        <div class="event-content">
                            <div class="event-meta">
                                <p><i class="fa fa-calendar-alt"></i>14-Sep-2025</p>
                                <p><i class="far fa-clock"></i>16:00 - 18:00</p>
                                <p><i class="fa fa-map-marker-alt"></i>IMPACTIAFORALL</p>
                            </div>
                            <div class="event-text">
                                <h3>Mental Health Support Group Launch</h3>
                                <p>
                                    Launch of our new peer-led support groups focused on stress, anxiety, and depression. Open discussion sessions held weekly in a safe environment.
                                </p>
                                <a class="btn btn-custom" href="#">Join Now</a>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
        </div> -->

        <!-- Event Start -->
<div class="event">
    
    <?php if ($error): ?>
        <!-- Afficher l'erreur de connexion ou de requête -->
        <div class="container"><div class="alert alert-danger text-center">
            Erreur lors du chargement des événements : <?= htmlspecialchars($error) ?>
        </div></div>
    <?php elseif (empty($events)): ?>
        <!-- Message si aucun événement futur n'est trouvé -->
        <div class="container"><div class="alert alert-info text-center">
            Aucun événement à venir n'est planifié pour le moment.
        </div></div>
    <?php else: ?>
        
        <?php foreach ($events as $index => $event): 
            
            // Formatage des données
            $date_formatted = date('d-M-Y', strtotime($event['date_evenement']));
            $time_formatted = $event['heure_evenement'] ? date('H:i', strtotime($event['heure_evenement'])) : 'Heure non spécifiée';
            $description_snippet = substr(strip_tags($event['description']), 0, 180);
            if (strlen($event['description']) > 180) { $description_snippet .= '...'; }

            // --- CONSTRUCTION DU CHEMIN DE L'IMAGE ---
            $db_stored_path = htmlspecialchars($event['image_url']);
            $cleaned_filename = basename($db_stored_path); 

            if (!empty($cleaned_filename) && $cleaned_filename != basename($default_image_path)) {
                $image_src = $base_db_image_path . $cleaned_filename;
            } else {
                $image_src = $default_image_path;
            }
        ?>

            <?php 
            // ----------------------------------------------------
            // LOGIQUE D'OUVERTURE ET FERMETURE DU STYLE DU MODÈLE
            // ----------------------------------------------------
            
            // Si c'est le premier élément (index 0) ou si l'index est pair (2, 4, 6...), 
            // on ouvre un nouveau bloc CONTAINER et ROW, car c'est le début d'une nouvelle paire.
            if ($index % 2 == 0): ?>
                
                <?php if ($index == 0): ?>
                    <!-- Début du premier Container qui contient l'en-tête -->
                    <div class="container">
                        <!-- En-tête de section, affiché une seule fois au début -->
                        <div class="section-header text-center">
                            <p>Upcoming Events</p>
                            <h2>Be ready for our upcoming charity events</h2>
                        </div>
                        <div class="row">
                <?php else: ?>
                    <!-- Début d'un nouveau Container/Row pour la paire suivante (strictement selon le modèle) -->
                    <div class="container">
                        <div class="row">
                <?php endif; ?>
            <?php endif; ?>

            <!-- Bloc d'événement (col-lg-6) -->
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
                            <!-- Lien vers la page de détail -->
                            <a class="btn btn-custom" href="event_detail.php?id=<?= $event['id_evenement'] ?>">Détails</a>
                        </div>
                    </div>
                </div>
            </div>

            <?php 
            // Si l'index est impair (1, 3, 5...) OU si c'est le dernier élément (peu importe l'index), 
            // on ferme le ROW et le CONTAINER pour terminer la mise en page.
            if ($index % 2 != 0 || $index == count($events) - 1): ?>
                </div><!-- Ferme la div.row -->
            </div><!-- Ferme la div.container -->
            <?php endif; ?>

        <?php endforeach; ?>
    <?php endif; ?>
    
</div><!-- Ferme la div.event -->
<!-- Event End -->
        <!-- Event End -->


        <!-- Footer Start -->
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-contact">
                            <h2>Our Head Office</h2>
                            <p><i class="fa fa-map-marker-alt"></i>Mimboman, Dernier Poteau, Yaoundé, Cameroun</p>
                            <p><i class="fa fa-phone-alt"></i>+237 655 726 217 (Cameroon – French)</p>
                            <p><i class="fa fa-envelope"></i><a href="mail/contact@handonheartcameroon.com"></a>contact@handonheartcameroon.com</p>
                            <div class="footer-social">
                                <a class="btn btn-custom" href=""><i class="fab fa-twitter" target="_blank"></i></a>
                                <a class="btn btn-custom" href="https://www.facebook.com/associationhandonheart" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                <!-- <a class="btn btn-custom" href=""><i class="fab fa-youtube"></i></a> -->
                                <!-- <a class="btn btn-custom" href=""><i class="fab fa-instagram"></i></a> -->
                                <a class="btn btn-custom" href="https://www.linkedin.com/company/handonheartcameroon/" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                   <div class="col-lg-3 col-md-6">
                        <div class="footer-link">
                            <h2>Popular Links</h2>
                            <a href="about.html">About Us</a>
                            <a href="contact.html">Contact Us</a>
                            <a href="causes.html">Popular Causes</a>
                            <a href="event.html">Upcoming Events</a>
                            <a href="blog.html">Latest Blog</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-link">
                            <h2>Useful Links</h2>
                            <a href="#">Terms of use</a>
                            <a href="#">Privacy policy</a>
                            <a href="#">Cookies</a>
                            <a href="#">Help</a>
                            <a href="#">FQAs</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-newsletter">
                            <h2>Newsletter</h2>
                            <form>
                                <input class="form-control" placeholder="Email goes here">
                                <button class="btn btn-custom">Submit</button>
                                <label>Don't worry, we don't spam!</label>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container copyright">
                <div class="row">
                    <div class="col-md-6">
                        <p>&copy; <a href="#">Hand on Heart</a>, All Right Reserved.</p>
                    </div>
                    <div class="col-md-6">
                        <!-- <p>Designed By <a href="https://htmlcodex.com">HTML Codex</a></p> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

        <!-- Back to top button -->
        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
        
        <!-- Pre Loader -->
        <div id="loader" class="show">
            <div class="loader"></div>
        </div>

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/counterup/counterup.min.js"></script>
        <script src="lib/parallax/parallax.min.js"></script>
        
        <!-- Contact Javascript File -->
        <script src="mail/jqBootstrapValidation.min.js"></script>
        <script src="mail/contact.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>
</html>
