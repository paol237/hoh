<!DOCTYPE html>
<html lang="en">
    <?php
// Fichier : /ONG/index.php (DOIT ÊTRE LA PREMIÈRE CHOSE)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ... Reste du code PHP de votre index ...
?>
    <head>
        <meta charset="utf-8">
        <title>Hand on Heart</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Free Website Template" name="keywords">
        <meta content="Free Website Template" name="description">

        <!-- Favicon -->
        <!-- <link href="img/favicon.ico" rel="icon"> -->
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


        <!-- Carousel Start -->
        <div class="carousel">
            <div class="container-xxl">
                <div class="owl-carousel">
                    <div class="carousel-item">
                        <div class="carousel-img">
                            <img src="img/hero.jpg" alt="Image">
                        </div>
                        <div class="carousel-text">
                            <h1>Hand on Heart</h1>
                            <p>
                                Contributing to improve the living conditions of mentally ill people in Cameroon</p>
                            <div class="carousel-btn">
                                <a class="btn btn-custom" href="donate.html">Donate Now</a>
                                <a class="btn btn-custom btn-play" href="about.html">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="carousel-img">
                            <img src="image_rempla/hoh1.jpg" alt="Image">
                        </div>
                        <div class="carousel-text">
                            <h1>Get Involved with helping hand</h1>
                            <p>
                               Your support can change lives. Whether you volunteer, donate, or share our mission, every helping hand brings us closer to a world where mental health is a right, not a privilege.
                            </p>
                            <div class="carousel-btn">
                                <a class="btn btn-custom" href="donate.html">Donate Now</a>
                                <a class="btn btn-custom btn-play" href="about.html">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="carousel-img">
                            <img src="image_rempla/hoh2.jpg" alt="Image">
                        </div>
                        <div class="carousel-text">
                            <h1>Bringing smiles to millions</h1>
                            <p>
                                Every smile we restore is a step toward dignity, healing, and hope. Together, we’re breaking the silence around mental illness and building a world where no one is left behind.
                            </p>
                            <div class="carousel-btn">
                                <a class="btn btn-custom" href="donate.html">Donate Now</a>
                                <a class="btn btn-custom btn-play" href="about.html">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Carousel End -->

        <!-- Video Modal Start-->
        <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>        
                        <!-- 16:9 aspect ratio -->
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <!-- Video Modal End -->
        

        <!-- About Start -->
        <div class="about">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="about-img" data-parallax="scroll" data-image-src="image_rempla/hoh19.jpg"></div>
                    </div>
                    <div class="col-lg-6">
                        <div class="section-header">
                            <p>Learn About Us</p>
                            <h5><b>Most mentally ill people in Cameroon still don't have access to appropriate treatments.</b> <br>
                            We work to improve the living conditions of mentally ill people in Cameroon. Amongst others, our        
                             approach                    includes providing easily accessible information on the diseases and how to deal 
                              with them, raising social      
                             awareness and building a network of professional psychologists.</h5>
                        </div>
                        <div class="about-tab">
                            <ul class="nav nav-pills nav-justified">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="pill" href="#tab-content-1">Our Work</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#tab-content-2"> Our Mission</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#tab-content-3">Team</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div id="tab-content-1" class="container tab-pane active">
                                    We connect psychologists and patients to facilitate free consultations.
                                     We also organize educational sessions aimed at raising awareness among local populations about the 
                                      challenges and opportunities related to mental health.
                                    Through television and radio, we strengthen the visibility of our actions and promote a better 
                                     understanding of psychological well-being.
                                    Finally, we participate in major conferences and events, such as World Mental Health Day, to promote 
                                     our mission and share our expertise.
                                </div>
                                <div id="tab-content-2" class="container tab-pane fade">
                                    Hand On Heart is a non-profit organization founded in 2009 in Yaoundé, Cameroon, dedicated to improving 
                                         the living conditions of people with mental health disorders. We work to combat stigma, isolation, 
                                          and inhumane treatment—especially in rural areas—through awareness campaigns, educational 
                                           seminars with mental health professionals, and support for families. We also advocate for the 
                                            rights of patients, many of whom face social exclusion and abuse. In the long term, we aim to 
                                             build care and reintegration centers, develop donation banks (food, clothing, and medicine), 
                                              and offer vocational training to help patients achieve independence and sustainable 
                                               livelihoods.
                                </div>
                                <div id="tab-content-3" class="container tab-pane fade">
                                    We are a small down-to-earth international group, all of us having the passion for improving the 
                                     conditions mentally ill people in Cameroon live in. Our different cultural, professional and academic 
                                      backgrounds offer a perfect combination to achieve our goals. As we expand our organisation, we will 
                                       continue to rely on diversity as our core strength. 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->


        <!-- Service Start -->
        <div class="service">
            <div class="container">
                <div class="section-header text-center">
                    <p>What We Do?</p>
                    <h2>We believe that we can save more lifes with you</h2>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6 mb-4">
                        <div class="service-item">
                            <div class="service-icon">
                                <i class="flaticon-social-care"></i>
                            </div>
                            <div class="service-text">
                                <h3>Conferences</h3>
                                <p>
                                    We showcase our mission and work, for example on the annual Mental Health Day.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 mb-4">
                        <div class="service-item">
                            <div class="service-icon">
                                <i class="flaticon-television"></i>
                            </div>
                            <div class="service-text">
                                <h3>TV Exposure</h3>
                                <p>
                                    We use television and radio to raise public awareness of our events and of mental health in general.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 mb-4">
                        <div class="service-item">
                            <div class="service-icon">
                                <i class="flaticon-healthcare"></i>
                            </div>
                            <div class="service-text">
                                <h3>Educational outreach ahead of World Mental Health Day.</h3>
                                <p>
                                    On October 10th, for World Mental Health Day, Hand on Heart and Prosamcom held a successful round table on mental health awareness with 31 participants.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 mb-4">
                        <div class="service-item d-flex justify-content-center align-items-center">
                            <div class="service-icon text-center">
                                <i class="flaticon-education"></i>
                            </div>
                            <div class="service-text">
                                <h3>Education</h3>
                                <p>
                                    We organise educational sessions to inform the local population about the challenges and opportunities associated with mental health.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Service End -->
        
        
        <!-- Facts Start -->
        <div class="facts" data-parallax="scroll" data-image-src="img/facts.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="facts-item">
                            <i class="flaticon-home"></i>
                            <div class="facts-text">
                                <h3 class="facts-plus" data-toggle="counter-up">2</h3>
                                <p>Countries</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="facts-item">
                            <i class="flaticon-charity"></i>
                            <div class="facts-text">
                                <h3 class="facts-plus" data-toggle="counter-up">50</h3>
                                <p>Volunteers</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="facts-item">
                            <i class="flaticon-kindness"></i>
                            <div class="facts-text">
                                <h3 class="facts-dollar" data-toggle="counter-up">10000</h3>
                                <p>Our Goal</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="facts-item">
                            <i class="flaticon-donation"></i>
                            <div class="facts-text">
                                <h3 class="facts-dollar" data-toggle="counter-up">5000</h3>
                                <p>Raised</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Facts End -->
        
        
        <!-- Causes Start -->
        <div class="causes">
            <div class="container">
                <div class="section-header text-center">
                    <p>Popular Causes</p>
                    <h2>Let's know about charity causes around the world</h2>
                </div>
                <div class="owl-carousel causes-carousel">
                    <div class="causes-item">
                        <div class="causes-img">
                            <img src="image_rempla/hoh4.jpg" alt="Image">
                        </div>
                        <div class="causes-progress">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
                                    <span>60%</span>
                                </div>
                            </div>
                            <div class="progress-text">
                                <p><strong>Raised:</strong> $10000</p>
                                <p><strong>Goal:</strong> $60000</p>
                            </div>
                        </div>
                        <div class="causes-text">
                            <h3> Mental Health Worldwide</h3>
                            <p>Millions face mental illness without support. Charities worldwide are breaking stigma and offering care. Let’s learn and stand with them.</p>
                        </div>
                        <div class="causes-btn">
                            <a class="btn btn-custom" href="about.html">Learn More</a>
                            <a class="btn btn-custom" href="donate.html">Donate Now</a>
                        </div>
                    </div>
                    <div class="causes-item">
                        <div class="causes-img">
                            <img src="image_rempla/hoh5.jpg" alt="Image">
                        </div>
                        <div class="causes-progress">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                                    <span>70%</span>
                                </div>
                            </div>
                            <div class="progress-text">
                                <p><strong>Raised:</strong> $10000</p>
                                <p><strong>Goal:</strong> $70000</p>
                            </div>
                        </div>
                        <div class="causes-text">
                            <h3> Mental Health Worldwide</h3>
                            <p>Across cultures, organizations provide therapy, awareness, and hope to those battling mental illness. Together, we can make a difference.<p>
                        </div>
                        <div class="causes-btn">
                            <a class="btn btn-custom" href="about.html">Learn More</a>
                            <a class="btn btn-custom" href="donate.html">Donate Now</a>
                        </div>
                    </div>
                    <div class="causes-item">
                        <div class="causes-img">
                            <img src="image_rempla/hoh7.jpg" alt="Image">
                        </div>
                        <div class="causes-progress">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                    <span>50%</span>
                                </div>
                            </div>
                            <div class="progress-text">
                                <p><strong>Raised:</strong> $10000</p>
                                <p><strong>Goal:</strong> $50000</p>
                            </div>
                        </div>
                        <div class="causes-text">
                            <h3>Helping Minds Everywhere</h3>
                            <p>Mental illness isolates. Global efforts are bringing healing, education, and dignity to those in need. Support mental health for all.</p>
                        </div>
                        <div class="causes-btn">
                            <a class="btn btn-custom" href="about.html">Learn More</a>
                            <a class="btn btn-custom" href="donate.html">Donate Now</a>
                        </div>
                    </div>
                    <div class="causes-item">
                        <div class="causes-img">
                            <img src="image_rempla/hoh8.jpg" alt="Image">
                        </div>
                        <div class="causes-progress">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
                                    <span>60%</span>
                                </div>
                            </div>
                            <div class="progress-text">
                                <p><strong>Raised:</strong> $10000</p>
                                <p><strong>Goal:</strong> $60000</p>
                            </div>
                        </div>
                        <div class="causes-text">
                            <h3>Hope for Mental Health</h3>
                            <p>Despite barriers, change is happening. Charities worldwide offer care and advocacy for better mental health. Hope grows with action.</p>
                        </div>
                        <div class="causes-btn">
                             <a class="btn btn-custom" href="about.html">Learn More</a>
                            <a class="btn btn-custom" href="donate.html">Donate Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Causes End -->



        
        
        <!-- Donate Start -->
        <div class="donate" data-parallax="scroll" data-image-src="img/donate.jpg">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <div class="donate-content">
                            <div class="section-header">
                                <p>Donate Now</p>
                                <h2>Let's donate to needy people for better lives</h2>
                            </div>
                            <div class="donate-text">
                                <p>
                                    In order to do what we do, we face similar challenges to all grassroots organisations: Access to 
                                     funding.
                                     Help our organisation by donating today!
                                      All donations go directly to our cause.
                                </p>
                                <p class="text-warning fw-bold">Your support makes a difference!</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="donate-form">
                            <form>
                                <div class="control-group">
                                    <input type="text" class="form-control" placeholder="Name" required="required" />
                                </div>
                                <div class="control-group">
                                    <input type="email" class="form-control" placeholder="Email" required="required" />
                                </div>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-custom active">
                                        <input type="radio" name="options" checked> $10
                                    </label>
                                    <label class="btn btn-custom">
                                        <input type="radio" name="options"> $20
                                    </label>
                                    <label class="btn btn-custom">
                                        <input type="radio" name="options"> $30
                                    </label>
                                </div>
                                <div>
                                    <button class="btn btn-custom" type="submit">Donate Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Donate End -->
        
        
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
        </div> -->
            
                <?php 
        // Utilisez require_once ou include pour insérer le contenu du fichier.
        // Puisque public_blogs.php est à la racine, le chemin est direct.
        require_once 'public_events.php'; 
        ?>

        <!-- Team Start -->
        <div class="team">
            <div class="container">
                <div class="section-header text-center">
                    <p class="text-center">Meet Our Team</p>
                    <h2 class="text-center">Amazing people behind our charity activities</h2>
                </div>
                <div class="row owl-carousel team-caroucel">
                    <div class="col-lg-3 col-md-6">
                        <div class="team-item">
                            <div class="team-img">
                                <img src="img/sandrine_camer.jpg" alt="Team Image">
                            </div>
                            <div class="team-text">
                                <h2>Sandrine Magwa Épse Kameni</h2>
                                  <p>President-Founder, Family peer support worker</p>
                              
                                <div class="team-social">
                                    <a href=""><i class="fab fa-twitter"></i></a>
                                    <a href=""><i class="fab fa-facebook-f"></i></a>
                                    <a href=""><i class="fab fa-linkedin-in"></i></a>
                                    <a href=""><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="team-item">
                            <div class="team-img">
                                    <img src="img/Sandrine.jpg" alt="Team Image">
                            </div>
                            <div class="team-text">
                                <h2>Sandrine Hinrichs</h2>
                                <p>Strategic association management</p>
                                <div class="team-social">
                                    <a href=""><i class="fab fa-twitter"></i></a>
                                    <a href=""><i class="fab fa-facebook-f"></i></a>
                                    <a href=""><i class="fab fa-linkedin-in"></i></a>
                                    <a href=""><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="team-item">
                            <div class="team-img">
                                <img src="img/signé.jpg" alt="Team Image">
                            </div>
                            <div class="team-text">
                                <h2>Eponine Signe Noumbou Épse Nana</h2>
                                <p>Legal specialist, Family peer support worker</p>
                                <div class="team-social">
                                    <a href=""><i class="fab fa-twitter"></i></a>
                                    <a href=""><i class="fab fa-facebook-f"></i></a>
                                    <a href=""><i class="fab fa-linkedin-in"></i></a>
                                    <a href=""><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="team-item">
                            <div class="team-img">
                                <img src="img/odilon.jpg" alt="Team Image">
                            </div>
                            <div class="team-text">
                                <h2>Odilon Kentsop</h2>
                                <p>Translator and psychologist</p>
                                <div class="team-social">
                                    <a href=""><i class="fab fa-twitter"></i></a>
                                    <a href=""><i class="fab fa-facebook-f"></i></a>
                                    <a href=""><i class="fab fa-linkedin-in"></i></a>
                                    <a href=""><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                                        <div class="col-lg-3 col-md-6">
                        <div class="team-item">
                            <div class="team-img">
                                <img src="img/jule.jpg" alt="Team Image">
                            </div>
                            <div class="team-text">
                                <h2>Gomina Jules</h2>
                                <p>Projet Manager, Psychologist</p>
                                <div class="team-social">
                                    <a href=""><i class="fab fa-twitter"></i></a>
                                    <a href=""><i class="fab fa-facebook-f"></i></a>
                                    <a href=""><i class="fab fa-linkedin-in"></i></a>
                                    <a href=""><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="team-item">
                            <div class="team-img">
                                <img src="img/team_9.jpg" alt="Team Image">
                            </div>
                            <div class="team-text">
                                <h2>Sandali Liyanagoonawardena</h2>
                                <p>  Technical Focused </p>
                                <div class="team-social">
                                    <a href=""><i class="fab fa-twitter"></i></a>
                                    <a href=""><i class="fab fa-facebook-f"></i></a>
                                    <a href=""><i class="fab fa-linkedin-in"></i></a>
                                    <a href=""><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="team-item">
                            <div class="team-img">
                                <img src="img/team_8.jpg" alt="Team Image">
                            </div>
                            <div class="team-text">
                                <h2>Leona</h2>
                                <p>Public Health Expert</p>
                                <div class="team-social">
                                    <a href=""><i class="fab fa-twitter"></i></a>
                                    <a href=""><i class="fab fa-facebook-f"></i></a>
                                    <a href=""><i class="fab fa-linkedin-in"></i></a>
                                    <a href=""><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="team-item">
                            <div class="team-img">
                                <img src="img/patric-no-bg.png" alt="Team Image" style="object-fit: cover;">
                            </div>
                            <div class="team-text">
                                <h2>Patrick Chetchueng</h2>
                                <p>Innovation Manager</p>
                                <div class="team-social">
                                    <a href=""><i class="fab fa-twitter"></i></a>
                                    <a href=""><i class="fab fa-facebook-f"></i></a>
                                    <a href=""><i class="fab fa-linkedin-in"></i></a>
                                    <a href=""><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Team End -->
        
        
        <!-- Volunteer Start -->
        <div class="volunteer" data-parallax="scroll" data-image-src="img/volonteer2.jpg">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5">
                        <div class="volunteer-form">
                            <form>
                                <div class="control-group">
                                    <input type="text" class="form-control" placeholder="Name" required="required" />
                                </div>
                                <div class="control-group">
                                    <input type="email" class="form-control" placeholder="Email" required="required" />
                                </div>
                                <div class="control-group">
                                    <textarea class="form-control" placeholder="Why you want to become a volunteer?" required="required"></textarea>
                                </div>
                                <div>
                                    <button class="btn btn-custom" type="submit">Become a volunteer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="volunteer-content">
                            <div class="section-header">
                                <p>Become A Volunteer</p>
                                <h2>Let’s make a difference in the lives of others</h2>
                            </div>
                            <div class="volunteer-text">
                                <p>
                                   We welcome all forms of support and want your experience with us to be meaningful and enjoyable. You can help in many ways: from organizing awareness campaigns and events, to supporting field research, developing partnerships with universities, contributing to our website, or even offering clinical consultations in Cameroon. Every skill counts — let’s work together to improve mental health care and understanding.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Volunteer End -->
        
        
        <!-- Testimonial Start -->
        <div class="testimonial">
            <div class="container">
                <div class="section-header text-center">
                    <p>Testimonial</p>
                    <h2>What people are saying about our mental health initiatives</h2>
                </div>
                <div class="owl-carousel testimonials-carousel">
                    <div class="testimonial-item">
                        <div class="testimonial-profile">
                            <img src="image_rempla/t5.jpg" alt="Image">
                            <div class="testimonial-name">
                                <h3>Jade Payan</h3>
                                <p>Doctorante en sociologie </p>
                            </div>
                        </div>
                        <div class="testimonial-text">
                            <p>
                                J’ai connu Sandrine lorsque Hand on Hear commençait à se développer. J’ai été impressionnée, et je le                                           suis                          encore, par la détermination et le courage de Sandrine dans le lancement de ce très beau projet, qui, je                                l’espère, permettra encore d’aider de nombreuses personnes. Bravo à elle et à tous ceux qui l’ont rejoint                           pour mettre cette association sur pied !
                            </p>
                        </div>
                    </div>
                    <div class="testimonial-item">
                        <div class="testimonial-profile">
                            <img src="image_rempla/t1.jpg" alt="Image">
                            <div class="testimonial-name">
                                <h3>Jean-Claude M.</h3>
                                <p>Recovered Patient</p>
                            </div>
                        </div>
                        <div class="testimonial-text">
                            <p>
                                It was a truly fulfilling experience to spend the day with Hands On Heart Association, capturing their work through photos and video. Being part of their mission, even behind the camera, gave me a deep sense of purpose and joy.
                            </p>
                        </div>
                    </div>
                    <div class="testimonial-item">
                        <div class="testimonial-profile">
                            <img src="image_rempla/t4.jpg" alt="Image">
                            <div class="testimonial-name">
                                <h3>Pia Schlittenbauer </h3>
                                <p>Clinical psychologist </p>
                            </div>
                        </div>
                        <div class="testimonial-text">
                            <p>
                                The Hand on Heart team is doing outstanding work in mental health in Cameroon. With great passion, the association is driving impactful initiatives – being part of it has been a deeply rewarding and transformative experience for me.
                            </p>
                        </div>
                    </div>
                    <div class="testimonial-item">
                        <div class="testimonial-profile">
                            <img src="image_rempla/t2.jpg" alt="Image">
                            <div class="testimonial-name">
                                <h3>Lieselot Lauwers</h3>
                                <p>Social worker</p>
                            </div>
                        </div>
                        <div class="testimonial-text">
                            <p>
                                The people behind Hands on Heart all have passion, commitment and a beautiful heart for mental health. It was a pleasure to be able to experience their work, commitment and persistence every day.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial End -->
        
        
        <!-- Contact Start -->
        <div class="contact">
            <div class="container">
                <div class="section-header text-center">
                    <p>Get In Touch</p>
                    <h2>Contact for any query</h2>
                </div>
                <div class="contact-img">
                    <img src="image_rempla/hoh3.jpg" alt="Image">
                </div>
                <div class="contact-form">
                        <div id="success"></div>
                        <form name="sentMessage" id="contactForm" novalidate="novalidate">
                            <div class="control-group">
                                <input type="text" class="form-control" id="name" placeholder="Your Name" required="required" data-validation-required-message="Please enter your name" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <input type="email" class="form-control" id="email" placeholder="Your Email" required="required" data-validation-required-message="Please enter your email" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <input type="text" class="form-control" id="subject" placeholder="Subject" required="required" data-validation-required-message="Please enter a subject" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <textarea class="form-control" id="message" placeholder="Message" required="required" data-validation-required-message="Please enter your message"></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div>
                                <button class="btn btn-custom" type="submit" id="sendMessageButton">Send Message</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
        <!-- Contact End -->


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
                                <img src="img/mfou.jpg" alt="Image" style=" height: 300px; object-fit: cover;">
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
            </div>
        </div> -->

        <?php 
        // Utilisez require_once ou include pour insérer le contenu du fichier.
        // Puisque public_blogs.php est à la racine, le chemin est direct.
        require_once 'public_blogs.php'; 
        ?>

        <!-- Blog End -->

        <!-- partenaire-->

        <div class="partenaire mx-3">
            <div class="container">
                <div class="section-header text-center">
                    <p>Our Partners</p>
                    <h2>We are proud to collaborate with these organizations</h2>
                </div>
                <div class="owl-carousel partner-carousel px-5">
                    <div class="partner-item">
                        <img src="img/aspa_logo-no-bg.png" alt="Partner 1" >
                    </div>
                    <div class="partner-item">
                        <img src="img/mfou_logo-no-bg.png" alt="Partner 2">
                    </div>
                    <div class="partner-item">
                        <img src="image_rempla/Logo_Mcf.png" alt="Partner 3">
                    </div>

                    <div class="partner-item">
                        <img src="image_rempla/Logo_MSMQ.png" alt="Partner 3">
                    </div>

                    <div class="partner-item">
                        <img src="img/odd16.png" alt="Partner 3">
                    </div>
                    <div class="partner-item">
                        <img src="img/odd10.png" alt="Partner 3">
                    </div>
                    <div class="partner-item">
                        <img src="img/odd4.png" alt="Partner 3">
                    </div>
                    <div class="partner-item">
                        <img src="img/odd3.png" alt="Partner 3">
                    </div>
                    <div class="partner-item">
                        <img src="img/odd17.jpeg" alt="Partner 3">
                    </div>
                    
                </div>
            </div>
        <!-- partenaire end -->

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
