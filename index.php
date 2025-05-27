<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>KD STUDIO</title>

  <link rel="stylesheet" href="style.css" />
  <script src="script.js"></script>
  
</head>

<body>
  <header>
    <nav class="navbar section-content">
      <a href="#" class="nav-logo">
        <h2 class="logo-text">KDSTUDIO</h2>
      </a>
      <ul class="nav-menu">
        <li class="nav-item"><a href="#" class="nav-link">Home</a></li>
        <li class="nav-item"><a href="#menu-section" class="nav-link">My Events</a></li>
        <li class="nav-item"><a href="#gallery-section" class="nav-link">Gallery</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Contact</a></li>
        <li class="nav-item"><a href="#" class="nav-link">About</a></li>
        <li class="nav-item"><a href="admin.php" class="nav-link">Admin Login</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <!-- Static Hero Section -->
    <section class="hero-section">
      <div class="section-content">
        <div class="hero-details">
          <h2 class="title">KD STUDIO</h2>
          <h3 class="subtitle">Capturing Life, One Frame at a Time</h3>
          <p class="description">
            "KD Studio captures your special moments with creativity and care. From portraits to events, we focus on real emotions and timeless images that you’ll cherish forever."
          </p>
          <div class="buttons">
            <a href="#" class="button contact-us">Contact Us</a>
          </div>
        </div>
        <div class="hero-image-wrapper">
          <img src="images/20230729_092007_0000.png" alt="Hero Image" class="hero-image" />
        </div>
      </div>
    </section>

    <!-- Events Section -->
    <section id="menu-section" class="menu-section">
      <div class="section-content">
        <h2>My Events</h2>
        <ul>
          <li>Graduation</li>
          <li>Wedding</li>
          <li>Birthday</li>
          <li>Other Events</li>
        </ul>
      </div>
    </section>

    <!-- Static Gallery Section -->
    <section id="gallery-section" class="gallery-section">
      <div class="section-content">
        <div class="gallery-filters">
          <button data-category="all" class="active">All</button>
          <button data-category="graduation">Graduation</button>
          <button data-category="wedding">Wedding</button>
          <button data-category="birthday">Birthday</button>
          <button data-category="other">Other Events</button>
        </div>

        <div class="gallery-grid">
          <!-- Static images: palitan mo lang 'to ng mga sarili mong files -->
          <img src="images/grad1.jpg" alt="Graduation" data-category="graduation" />
          <img src="images/grad2.jpg" alt="Graduation" data-category="graduation" />
          <img src="images/wed1.jpg" alt="Wedding" data-category="wedding" />
          <img src="images/wed2.jpg" alt="Wedding" data-category="wedding" />
          <img src="images/b1.jpg" alt="Birthday" data-category="birthday" />
          <img src="images/other1.jpg" alt="Other Events" data-category="other" />
        </div>
      </div>
    </section>
  </main>
</body>
</html>
