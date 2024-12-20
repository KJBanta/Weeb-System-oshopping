<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Three Bears</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles (1).css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-neutral-100 text-gray-800">
    <!-- Header -->
    <header class="bg-gradient-to-r from-amber-100 to-yellow-100 p-4">
        <div class="max-w-6xl mx-auto flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <img src="images/ThreeBearsLogo.png" alt="Logo" class="h-12 w-12 rounded-full object-cover">
                <div>
                    <h1 class="text-xl font-semibold text-orange-600">THE THREE BEARS</h1>
                    <p class="text-sm text-gray-600">Sweet as honey, soft as fur</p>
                </div>
            </div>
            <nav class="flex items-center space-x-6 text-gray-700">
                <a href="contact-us.php" class="hover:text-orange-500">Contact-Us</a> <!-- Link to the shop page -->
                <a href="about-us.php" class="hover:text-orange-500">All About Us</a>
                <!-- Bootstrap User Icon for My Account -->
                <a href="login_forms.php" class="hover:text-orange-500">
                    <i class="bi bi-person-circle text-2xl"></i>
                </a>
            </nav>
        </div>
    </header>

<!-- Account Login indicator -->
<nav class="navbar navbar-expand-1g navbar-dark bg-secondary"> 
  <div class="container-fluid">
    <ul class="navbar-nav d-flex flex-row">
      <li class="nav-item">
        <a class="nav-link" href="#">Welcome Guest!</a>
      </li>
      <li class="nav-item ms-3"> <!-- ms-3 adds margin on the left side of the Login link -->
        <a class="nav-link" href="#">Login</a>
      </li>
    </ul>
  </div>
</nav>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto p-4">
        <!-- Intro Section -->
        <section class="text-center my-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">A warm embrace for your taste buds</h2>
            <p class="text-gray-600 leading-7 max-w-2xl mx-auto">
                Welcome to our cozy corner of the woods.
    Step into a world of wonder, where food is as magical as a fairy tale. 
Indulge in our delectable creations, inspired by the beloved tale of the Three Bears.

            </p>
        </section>

        <!-- Carousel Section -->
        <section class="my-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Customer Favorite!</h3>
            <div id="carouselExampleCaptions" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="images/grizzly burger.jpg" class="d-block w-100" alt="The Grizzly Burger">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>The Grizzly Burger</h5>
                            <p>A massive burger with extra patties, cheese, bacon, and fries.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="images/choco chip3.jpg" class="d-block w-100" alt="Chocolate Teddy Bear Cookies:">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Chocolate Teddy Bear Cookies:</h5>
                            <p>Classic chocolate chip cookies shaped like teddy bears..</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="images/panda express2.png" class="d-block w-100" alt="Panda Express">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Panda Express</h5>
                            <p>A fruity and refreshing drink made with pineapple juice, orange juice, and a splash of cranberry juice.</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>

        <!-- Reviews Section -->
        <section class="reviews my-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 text-center">Meal You May Also Like</h3>
            <div class="grid md:grid-cols-3 gap-4">
                <div class="review-card">
                    <img src="images/grizzly coffee.jpg" alt="Grizzly Coffee">
                    <h4>Grizzly Coffee</h4>
                    <p>"A rich and bold mocha with a hint of chocolate and coffee.
                       Top with whipped cream and a sprinkle of chocolate shavings."</p>
                </div>
                <div class="review-card">
                    <img src="images/Teddy Bear Pizza1.jpg" alt="Teddy Bear Pizza">
                    <h4>Teddy Bear Pizza</h4>
                    <p>"A classic round pizza topped with your favorite ingredients."</p>
                </div>
                <div class="review-card">
                    <img src="images/Bear-Bread2.jpg" alt="Bear Bread">
                    <h4>Bear Bread</h4>
                    <p>"A classic, soft and fluffy bread shaped like a teddy bear.
                        Raisins or chocolate chips can be used for eyes, nose, and mouth."</p>
                </div>
            </div>
        </section>

        <!-- Subscribe Section -->
        <section class="subscribe my-8">
            <h3>Subscribe to our emails</h3>
            <p>Subscribe to our mailing list for insider news, product launches, and more.</p>
            <form>
                <input type="email" placeholder="Email">
                <button type="submit">Subscribe</button>
            </form>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy;  2024 The Three Bears Dining. All rights reserved.</p>
        <p>Indulge Your Senses, One Bite at a Time.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
