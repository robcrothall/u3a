<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>University of the Third Age - U3A</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
      }
      .hero {
        background: url('public/img/LAHS_Logo.png') center/cover no-repeat;
        color: #fff;
        /* min-height: 120vh; */
        /* min-height: 70vh; */
         /* Adjust as needed for your image and content */
         width: 100%;
         height: 100vh;
      }
      .hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.45);
      }
      .hero .container {
        position: relative;
        z-index: 1;
      }
      .hero h1,
      .hero p {
        text-shadow: 0 0 12px rgba(0,0,0,0.5);
      }
      .feature-icon {
        width: 3rem;
        height: 3rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 1rem;
        background: #0d6efd;
        color: #fff;
        margin-bottom: 1rem;
      }
    </style>
  </head>
  <body>
    <header class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="#">Lower Albany Historical Society (w1 - php 1)</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="#home">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
            <li class="nav-item"><a class="nav-link" href="#events">Events</a></li>
            <li class="nav-item"><a class="nav-link" href="#membership">Membership</a></li>
            <li class="nav-item"><a class="nav-link" href="app/page/toposcope.php">Toposcope</a></li>
            <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
          </ul>
        </div>
      </div>
    </header>

    <main class="flex-grow-1">
      <section id="home" class="hero d-flex align-items-center position-relative">
        <div class="container text-center py-5">
          <h1 class="display-5 fw-bold">Preserving the Story of Lower Albany</h1>
          <p class="lead mb-4">Discover our local heritage through historic sites, archives, and community events.</p>
          <a href="#about" class="btn btn-primary btn-lg me-2">Learn More</a>
          <a href="#membership" class="btn btn-outline-light btn-lg">Join Us</a>
        </div>
      </section>

      <section id="about" class="py-5">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-6">
              <h2>About Our Society</h2>
              <p>The Lower Albany Historical Society is dedicated to preserving and sharing the history of our region. We maintain archives, collect artifacts, and host programs that celebrate the people, places, and stories that shaped our community.</p>
              <p>From early settlement to modern heritage preservation, our work brings Lower Albany's past to life for residents and visitors alike.</p>
            </div>
            <div class="col-lg-6">
              <div class="ratio ratio-16x9">
                <img src="public/img/harbour.jpg" class="rounded shadow-sm" alt="Kowie Harbour" style="object-fit: cover; width: 100%; height: 100%;">
              </div>
            </div>
          </div>
        </div>
      </section>

      <section id="events" class="py-5 bg-light">
        <div class="container">
          <div class="text-center mb-5">
            <h2>Upcoming Events</h2>
            <p class="text-muted">Join our tours, lectures, and community celebrations throughout the year.</p>
          </div>
          <div class="row g-4">
            <div class="col-md-4">
              <div class="card h-100 shadow-sm">
                <div class="card-body">
                  <div class="feature-icon">🏛️</div>
                  <h5 class="card-title"> Guided tours</h5>
                  <p class="card-text">Explore historic homes, landmarks, and interpretive exhibits with knowledgeable guides.</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card h-100 shadow-sm">
                <div class="card-body">
                  <div class="feature-icon">🗂️</div>
                  <h5 class="card-title">Archive access</h5>
                  <p class="card-text">Research local history with our collections, photographs, documents, and oral histories.</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card h-100 shadow-sm">
                <div class="card-body">
                  <div class="feature-icon">🤝</div>
                  <h5 class="card-title">Community programs</h5>
                  <p class="card-text">Attend lectures, presentations, and family-friendly events that connect generations.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section id="membership" class="py-5">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-7">
              <h2>Become a Member</h2>
              <p>Support history preservation and enjoy member benefits such as meeting notifications and the Toposcope Journal.</p>
              <ul class="list-unstyled">
                <li>• Annual membership levels for individuals and families</li>
                <li>• Volunteer opportunities and archive assistance</li>
                <li>• Invitations to members-only events and exhibits</li>
              </ul>
            </div>
            <div class="col-lg-5">
              <div class="card border-primary shadow-sm">
                <div class="card-body">
                  <h5 class="card-title">Join today</h5>
                  <p class="card-text">Help preserve Lower Albany’s history and make a difference in our community.</p>
                  <a href="#contact" class="btn btn-primary">Contact Us</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

    <footer id="contact" class="bg-dark text-white py-4">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h5>Contact</h5>
            <p class="mb-1">Lower Albany Historical Society</p>
            <p class="mb-1">c/o Settlers Park, Horton Road, Port Alfred OR</p>
            <p class="mb-0">Email: info@lahs.co.za</p>
          </div>
          <div class="col-md-6 text-md-end">
            <h5>Follow Us</h5>
            <p class="mb-0">Stay connected for event updates and heritage news.</p>
          </div>
        </div>
      </div>
    </footer>
    <script src="public/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
