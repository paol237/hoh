<!DOCTYPE html>
<html lang="en">
<?php
// Fichier : about_events_full.php (À inclure dans about.php)
// Affichage de tous les événements à venir et des articles de blog.

// Assurez-vous que le chemin est correct pour la connexion DB.
// Puisque ce fichier sera inclus dans about.php (qui est probablement à la racine /ONG/), 
// le chemin relatif 'api/db_connect.php' est utilisé.
require_once 'api/db_connect.php'; 

// 1. Initialisation des variables pour les ÉVÉNEMENTS

$conn_status = $conn; // Stocker l'objet pour la vérification de fermeture



// 1b. Initialisation des variables pour les BLOGS
$blogs = [];
$blog_error = '';
// Nouveaux chemins pour les images de blog
$base_db_blog_image_path = '/ong/api/admin/uploads/blogs/'; 
$default_blog_image_path = '/ONG/img/default_blog.jpg';

try {
    // 2. Vérification critique de la connexion
    if ($conn_status === null || $conn_status->connect_error) {
        // CHANGEMENT ICI : Afficher l'erreur spécifique si elle existe, sinon le message générique.
        $error_message = $conn_status ? $conn_status->connect_error : "Échec de l'initialisation de la connexion à la base de données. (Vérifiez api/db_connect.php)";
        throw new Exception($error_message);
    }
    
    // 3a. Exécuter la requête pour TOUS les événements futurs
    $sql_events = "SELECT id_evenement, titre, description, date_evenement, heure_evenement, lieu, image_url 
            FROM evenements 
            WHERE date_evenement >= CURDATE() 
            ORDER BY date_evenement ASC"; 

    $result_events = $conn_status->query($sql_events);

    if (!$result_events) {
        $event_error = "Erreur de base de données (événements) : " . $conn_status->error;
    } else {
        if ($result_events->num_rows > 0) {
            while ($row = $result_events->fetch_assoc()) {
                $events[] = $row;
            }
        }
    }
    
    // 3b. Exécuter la requête pour TOUS les articles de blog
    // REQUÊTE : Nous récupérons id_utilisateur (l'auteur) et date_publication (la date de création)
    $sql_blogs = "SELECT id_blog, titre, contenu, date_publication, image_url, id_utilisateur
            FROM blogs
            ORDER BY date_publication DESC";

    $result_blogs = $conn_status->query($sql_blogs);

    if (!$result_blogs) {
        $blog_error = "Erreur de base de données (blogs) : " . $conn_status->error;
    } else {
        if ($result_blogs->num_rows > 0) {
            while ($row = $result_blogs->fetch_assoc()) {
                $blogs[] = $row;
            }
        }
    }


} catch (Exception $e) {
    // 4. Capture de toute erreur (inclusion, connexion, ou requête)
    $event_error = $e->getMessage();
    $blog_error = $e->getMessage();
    $events = []; 
    $blogs = [];
} finally {
    // La connexion doit rester ouverte si d'autres scripts en ont besoin sur la page.
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
        <div class="page-header blogs">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>From Blog</h2>
                    </div>
                    <div class="col-12">
                        <a href="">Home</a>
                        <a href="">Blog</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->
        
        
        <!-- Blog Start -->
        <!-- <div class="blog">
            <div class="container">
                <div class="section-header text-center">
                    <p>Our Blog</p>
                    <h2>Latest news & articles directly from our blog</h2>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="blog-item">
                            <div class="blog-img">
                                <img src="img/event_4.jpeg" alt="Image" style=" height: 300px; object-fit: cover;">
                            </div>
                            <div class="blog-text">
                                <h3><a href="#">Free Mental Health Consultations in Mfou</a></h3>
                                <p>
                                    In the lead-up to World Mental Health Day, our team offered free consultations to 30+ individuals, helping identify and treat critical cases.
                                </p>
                            </div>
                            <div class="blog-meta">
                                <p><i class="fa fa-user"></i><a href="">Admin</a></p>
                                <p><i class="fa fa-comments"></i><a href="">5 Comments</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="blog-item">
                            <div class="blog-img">
                                <img src="img/tvappearent.webp" alt="Image" style=" height: 300px; object-fit: cover;">
                            </div>
                            <div class="blog-text">
                                <h3><a href="#">National TV Appearance to Promote Awareness</a></h3>
                                <p>
                                    We appeared on the national TV show "Nous Chez Vous" to promote mental health services and raise awareness across the country.
                                </p>
                            </div>
                            <div class="blog-meta">
                                <p><i class="fa fa-user"></i><a href="">Admin</a></p>
                                <p><i class="fa fa-comments"></i><a href="">8 Comments</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="blog-item">
                            <div class="blog-img">
                                <img src="img/work4.webp" alt="Image" style=" height: 300px; object-fit: cover;">
                            </div>
                            <div class="blog-text">
                                <h3><a href="#">Attending WHO Mental Health Day Conference</a></h3>
                                <p>
                                    Our participation at the WHO conference emphasized making mental health a global priority, with inspiring testimonies from recovered patients.
                                </p>
                            </div>
                            <div class="blog-meta">
                                <p><i class="fa fa-user"></i><a href="">Admin</a></p>
                                <p><i class="fa fa-comments"></i><a href="">10 Comments</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="blog-item">
                            <div class="blog-img">
                                <img src="img/blog-1.jpg" alt="Image">
                            </div>
                            <div class="blog-text">
                                <h3><a href="#">Free Mental Health Consultations in Mfou</a></h3>
                                <p>
                                    In the lead-up to World Mental Health Day, our team offered free consultations to 30+ individuals, helping identify and treat critical cases.
                                </p>
                            </div>
                            <div class="blog-meta">
                                <p><i class="fa fa-user"></i><a href="">Admin</a></p>
                                <p><i class="fa fa-comments"></i><a href="">5 Comments</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="blog-item">
                            <div class="blog-img">
                                <img src="img/blog-2.jpg" alt="Image">
                            </div>
                            <div class="blog-text">
                                <h3><a href="#">National TV Appearance to Promote Awareness</a></h3>
                                <p>
                                    We appeared on the national TV show "Nous Chez Vous" to promote mental health services and raise awareness across the country.
                                </p>
                            </div>
                            <div class="blog-meta">
                                <p><i class="fa fa-user"></i><a href="">Admin</a></p>
                                <p><i class="fa fa-comments"></i><a href="">8 Comments</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="blog-item">
                            <div class="blog-img">
                                <img src="img/blog-3.jpg" alt="Image">
                            </div>
                            <div class="blog-text">
                                <h3><a href="#">Attending WHO Mental Health Day Conference</a></h3>
                                <p>
                                    Our participation at the WHO conference emphasized making mental health a global priority, with inspiring testimonies from recovered patients.
                                </p>
                            </div>
                            <div class="blog-meta">
                                <p><i class="fa fa-user"></i><a href="">Admin</a></p>
                                <p><i class="fa fa-comments"></i><a href="">10 Comments</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->



        <!-- Blog Start -->
        <div class="blog">
            
            <?php if ($blog_error): ?>
                <!-- Afficher l'erreur de connexion ou de requête pour les blogs -->
                <div class="container"><div class="alert alert-danger text-center">
                    Erreur lors du chargement des articles de blog : <?= htmlspecialchars($blog_error) ?>
                    <hr>
                    <small class="d-block text-muted">
                        **Diagnostic :** L'erreur de connexion est critique. Veuillez vérifier les informations (hôte, utilisateur, mot de passe) dans le fichier **`api/db_connect.php`** et assurez-vous que votre serveur MySQL est démarré.
                    </small>
                </div></div>
            <?php elseif (empty($blogs)): ?>
                <!-- Message si aucun article de blog n'est trouvé -->
                <div class="container"><div class="alert alert-info text-center">
                    <strong>Aucun article de blog n'est disponible pour le moment.</strong>
                    <?php 
                    // Aide au diagnostic: Si $result_blogs est disponible, afficher le nombre de lignes retournées.
                    if (isset($result_blogs) && $result_blogs) {
                        $rows_count = $result_blogs->num_rows;
                    ?>
                        <hr>
                        <small class="d-block text-muted">
                            **Diagnostic :** La requête a été exécutée mais a retourné **<?= $rows_count ?> ligne(s)**.
                            <br>Vérifiez que :
                            <br>1. Le nom de la table dans la requête (`blogs`) correspond exactement au nom dans votre base de données.
                            <br>2. Votre table `blogs` contient des articles publiés.
                        </small>
                    <?php } ?>
                </div></div>
            <?php else: ?>
                
                <?php foreach ($blogs as $index => $blog): 
                    
                    // Formatage des données
                    // CHANGEMENT ICI : date_creation remplacé par date_publication
                    $blog_date_formatted = date('d-M-Y', strtotime($blog['date_publication']));
                    $blog_description_snippet = substr(strip_tags($blog['contenu']), 0, 100); // Raccourcir le contenu
                    if (strlen($blog['contenu']) > 100) { $blog_description_snippet .= '...'; }
                    
                    // Valeurs par défaut : nous utilisons 'Admin' car la table utilisateurs n'est pas jointe ici
                    $auteur = 'Admin';
                    
                    // nombre_commentaires n'est pas dans le schéma, on le force à 0
                    // Nous récupérons la valeur si elle existe (par exemple si vous l'ajoutez plus tard), sinon 0.
                    $comment_count = htmlspecialchars($blog['nombre_commentaires'] ?? '0'); 


                    // --- DÉBUT DE LA LOGIQUE CORRIGÉE POUR L'IMAGE DU BLOG ---
                    $db_stored_path = htmlspecialchars($blog['image_url']);
                    $image_src = $default_blog_image_path; // Par défaut, l'image est celle par défaut

                    if (!empty($db_stored_path)) {
                        // Nous supposons que le chemin stocké en BD est seulement le nom du fichier.
                        $cleaned_filename = basename($db_stored_path); 
                        
                        // Si le chemin nettoyé est différent de l'image par défaut, on construit le chemin complet.
                        if ($cleaned_filename != basename($default_blog_image_path)) {
                            // Utilise le chemin absolu vers le dossier d'upload
                            $image_src = $base_db_blog_image_path . $cleaned_filename;
                        }
                    }
                    // --- FIN DE LA LOGIQUE CORRIGÉE POUR L'IMAGE DU BLOG ---
                ?>

                    <?php 
                    // ----------------------------------------------------
                    // LOGIQUE D'OUVERTURE ET FERMETURE DU STYLE DU MODÈLE (3 colonnes)
                    // ----------------------------------------------------
                    
                    // Si c'est le premier élément (index 0) ou si l'index est divisible par 3 (3, 6, 9...), 
                    // on ouvre un nouveau bloc CONTAINER et ROW, car c'est le début d'une nouvelle ligne de 3.
                    if ($index % 3 == 0): ?>
                        
                        <?php if ($index == 0): ?>
                            <!-- Début du premier Container qui contient l'en-tête -->
                            <div class="container">
                                <!-- En-tête de section, affiché une seule fois au début -->
                                <div class="section-header text-center">
                                    <p>Our Blog</p>
                                    <h2>Latest news & articles directly from our blog</h2>
                                </div>
                                <div class="row">
                        <?php else: ?>
                            <!-- Début d'un nouveau Container/Row pour la ligne suivante (strictement selon le modèle) -->
                            <div class="container">
                                <div class="row">
                        <?php endif; ?>
                    <?php endif; ?>

                    <!-- Bloc d'article (col-lg-4) -->
                    <div class="col-lg-4"> 
                        <div class="blog-item">
                            <div class="blog-img">
                                <img class="img-fluid" src="<?= $image_src ?>" alt="<?= htmlspecialchars($blog['titre']) ?>" style="height: 300px; object-fit: cover;">
                            </div>
                            <div class="blog-text">
                                <h3><a href="blog_detail.php?id=<?= $blog['id_blog'] ?>"><?= htmlspecialchars($blog['titre']) ?></a></h3>
                                <p>
                                    <?= htmlspecialchars($blog_description_snippet) ?>
                                </p>
                            </div>
                            <div class="blog-meta">
                                <p><i class="fa fa-user"></i><a href=""><?= $auteur ?></a></p>
                                <p><i class="fa fa-comments"></i><a href="blog_detail.php?id=<?= $blog['id_blog'] ?>"><?= $comment_count ?> Comments</a></p>
                            </div>
                        </div>
                    </div>

                    <?php 
                    // Si (l'index est le dernier élément de la ligne, c'est-à-dire % 3 == 2) OU (si c'est le dernier élément total),
                    // on ferme le ROW et le CONTAINER pour terminer la mise en page.
                    if ($index % 3 == 2 || $index == count($blogs) - 1): ?>
                        </div><!-- Ferme la div.row -->
                    </div><!-- Ferme la div.container -->
                    <?php endif; ?>

                <?php endforeach; ?>
            <?php endif; ?>
            
        </div><!-- Ferme la div.blog -->
        <!-- Blog End -->





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
                                <a class="btn btn-custom" href="" target="_blank"><i class="fab fa-twitter"></i></a>
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
