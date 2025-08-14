<?php
session_start();
include('config.php');
    $pageTitle = 'Sign up Form';
    include('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitZone Gym - Transform Your Body, Transform Your Life</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
    <script src="animations.js"></script>
    <script src="animation.js" defer></script>
    <style>
       
    </style>
</head>
<body>
    <?php
    // PHP variables for dynamic content
    $gym_name = "FitZone Gym";
    $tagline = "Transform Your Body, Transform Your Life";
    $phone = "0378598245";
    $email = "infofitzone@gmail.com";
    $address = "No 17, Kuruneala";
    
    // Services data
    $services = [
        [
            'icon' => 'fas fa-dumbbell',
            'title' => 'Weight Training',
            'description' => 'Build strength and muscle with our comprehensive weight training programs and top-quality equipment.'
        ],
        [
            'icon' => 'fas fa-running',
            'title' => 'Cardio Workouts',
            'description' => 'Improve your cardiovascular health with our variety of cardio equipment and group classes.'
        ],
        [
            'icon' => 'fas fa-user-friends',
            'title' => 'Group Classes',
            'description' => 'Join our energetic group fitness classes including yoga, pilates, spinning, and more.'
        ],
        [
            'icon' => 'fas fa-user',
            'title' => 'Personal Training',
            'description' => 'Get personalized attention and customized workout plans from our certified trainers.'
        ]
        
    ];
    
    // Trainers data
// Trainers data
$trainers = [
    [
        'name' => 'Sarah Johnson',
        'specialty' => 'Strength & Conditioning Coach',
        'icon' => 'fas fa-female'
    ],
    [
        'name' => 'Mike De Periz',
        'specialty' => 'Personal Trainer & Nutritionist',
        'icon' => 'fas fa-male'
    ],
    [
        'name' => 'Ama Jayasingha',
        'specialty' => 'Yoga & Pilates Instructor',
        'icon' => 'fas fa-spa'
    ],
    // Additional trainers (will be hidden at first)
    [
        'name' => 'David Silva',
        'specialty' => 'CrossFit Specialist',
        'icon' => 'fas fa-running'
    ],
    [
        'name' => 'Emily Carter',
        'specialty' => 'Zumba & Dance Instructor',
        'icon' => 'fas fa-music'
    ],
    [
        'name' => 'James Lee',
        'specialty' => 'Martial Arts Coach',
        'icon' => 'fas fa-fist-raised'
    ]
];

    ?>

 

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="overlay"></div>
        <div class="hero-content">
            <h1>Transform Your <span class="highlight">Body</span><br>Transform Your <span class="highlight">Life</span></h1>
            <p>Join <?php echo $gym_name; ?> and discover the strongest version of yourself. Our state-of-the-art facility and expert trainers are here to guide you on your fitness journey.</p>
            <div class="hero-buttons">
                <a href="#contact" class="btn-primary">Start Your Journey</a>
                <a href="#services" class="btn-secondary">Explore Services</a>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services">
        <div class="container">
            <div class="section-title">
                <h2>Our Services</h2>
                <p>We offer a comprehensive range of fitness services designed to help you achieve your health and wellness goals.</p>
            </div>
            <div class="services-grid">
                <?php foreach ($services as $service): ?>
                <div class="service-card">
                    <i class="<?php echo $service['icon']; ?>"></i>
                    <h3><?php echo $service['title']; ?></h3>
                    <p><?php echo $service['description']; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h2>Why Choose <?php echo $gym_name; ?>?</h2>
                    <p>At <?php echo $gym_name; ?>, we believe fitness is more than just working out—it's about creating a lifestyle that empowers you to be your best self. Our modern facility, expert trainers, and supportive community provide everything you need to succeed.</p>
                    <p>Whether you're a beginner taking your first steps into fitness or an experienced athlete looking to push your limits, we have the tools, knowledge, and motivation to help you reach your goals.</p>
                    <div class="stats">
                        <div class="stat-item">
                            <div class="stat-number">500+</div>
                            <div class="stat-label">Happy Members</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">15+</div>
                            <div class="stat-label">Expert Trainers</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">24/7</div>
                            <div class="stat-label">Access Available</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">5+</div>
                            <div class="stat-label">Years Experience</div>
                        </div>
                    </div>
                </div>
                <div class="about-image">
                    <i class="fas fa-heart" style="font-size: 8rem; margin-bottom: 1rem;"></i>
                    <h3>Your Fitness Journey Starts Here</h3>
                    <p>Join our community and transform your life with us!</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Trainers Section -->
<section id="trainers" class="trainers">
    <div class="container">
        <div class="section-title">
            <h2>Meet Our Trainers</h2>
            <p>Our certified trainers are passionate about helping you achieve your fitness goals with personalized guidance and motivation.</p>
        </div>
        <div class="trainers-grid">
            <?php foreach ($trainers as $index => $trainer): ?>
            <div class="trainer-card 
            <?php echo $index > 2 ? 'hidden-trainer' : ''; ?>">
                <div class="trainer-image">
                    <i class="<?php echo $trainer['icon']; ?>"></i>
                </div>
                <div class="trainer-info">
                    <h3><?php echo $trainer['name']; ?></h3>
                    <p><?php echo $trainer['specialty']; ?></p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- See All Trainers Button -->
        <div style="text-align:center; margin-top: 20px;">
            <button id="seeAllTrainers" class="btn-primary">See All Trainers</button>
        </div>
    </div>
</section>

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="container">
            <div class="contact-content">
                <div class="contact-info">
                    <h2>Get In Touch</h2>
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h4>Address</h4>
                            <p><?php echo $address; ?></p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            <h4>Phone</h4>
                            <p><?php echo $phone; ?></p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <h4>Email</h4>
                            <p><?php echo $email; ?></p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-clock"></i>
                        <div>
                            <h4>Hours</h4>
                            <p>Mon-Fri: 5AM-11PM<br>Sat-Sun: 6AM-10PM</p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> <?php echo $gym_name; ?>. All rights reserved. | Designed with ❤️ for fitness enthusiasts</p>
        </div>
    </footer>

    <?php
    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone'] ?? '');
        $message = htmlspecialchars($_POST['message']);
        
        // Here you would typically send an email or save to database
        echo "<script>alert('Thank you for your message, $name! We will get back to you soon.');</script>";
    }
    ?>

    <script>
   
    </script>
    <?php include('include/footer.php'); ?>
</body>
</html>
