<?php
/**
 * Program: index.php
 * PHP version 7.1
 * @category WebPage
 * @package  Sample
 * @author   "Rob Crothall" <rob@crothall.co.za>
 * @license  GPL 1.0 or later
 * @version  GIT: <git_id>
 * @link     http://www.sprv.co.za
 */
// display errors, warnings, and notices
//include_once "inc/config.php";
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>University of the Third Age - U3A</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!--<link href="public/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/print.css" rel="stylesheet" media="print">
    <!-- <link href="css/w3.css" rel="stylesheet"> -->
    <!--<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">-->
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <style>
      body {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
      }
      .hero {
        /* background: url('img/parked-bg.jpg') center/cover no-repeat; */
        background: url('../img/parked-bg.jpg') center/cover;
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
<!--    <header class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="#">University of the Third Age - U3A (w1)</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="#home">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
            <li class="nav-item"><a class="nav-link" href="#events">Events</a></li>
            <li class="nav-item"><a class="nav-link" href="#membership">Membership</a></li>
            <li class="nav-item"><a class="nav-link" href="../page/recordings.php">Recordings</a></li>
            <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
            <li class="nav-item"><a class="nav-link" href="../page/register.php">Register</a></li>
            <li class="nav-item"><a class="nav-link" href="../page/login.php">Login</a></li>
          </ul>
        </div>
      </div> -->
<?php
include "../inc/menu4.php";
?>      
<!--    </header> -->

    <main class="flex-grow-1">
      <section id="home" class="hero d-flex align-items-center position-relative">
        <div class="container text-center py-5">
          <img src="../img/U3A_Logo.jpg" class="rounded shadow-sm" alt="U3A Logo" 
                  style="object-fit: cover; width: 50%; height: 50%;">
          <h1 class="display-5 fw-bold">University of the Third Age - U3A</h1>
          <p class="lead mb-4">Learning for leisure and pleasure
          </p>

          <p class="mb-4">The “University of the Third Age”, or U3A as it is usually known, 
            is a learning and social community organized by and for people who can best be 
            described as in active retirement – the “Third Age” of their lives.</p>
          <p class="mb-4">The overall aim is to provide members with both the stimulus of 
            mental activity and the satisfaction of suitable activities with people of a similar age.
          </p>
          <a href="#about" class="btn btn-primary btn-lg me-2">Learn More</a>
          <a href="#membership" class="btn btn-outline-light btn-lg">Join Us</a>
        </div>
      </section>

      <section id="about" class="py-5">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-6">
              <h2>About U3A</h2>
              <a class="nav-link active" aria-current="page" href="#home">Home</a>
              <p>The University of the Third Age is dedicated to providing educational and social opportunities for older adults. We maintain a vibrant community of learners who engage in a wide range of activities, from academic discussions to creative pursuits.</p>
              <p>Our programs are designed to foster intellectual curiosity, personal growth, and meaningful connections within our diverse membership.</p>
              <p>We welcome individuals from all walks of life to join us in celebrating lifelong learning and community engagement.</p>
              <p>Our primary activity is hosting two presentations per month, on the second and fourth Thursday of each month, at the Settlers Park Don Powis Hall. These presentations cover a variety of topics, including history, science, arts, and culture.</p>
            </div>
            <div class="col-lg-6">
              <div class="ratio ratio-16x9">
                <img src="../img/U3A_PortAlfred_Committee_2024_v2.jpg" class="rounded shadow-sm" alt="U3A Committee" 
                  style="object-fit: cover; width: 100%; height: 100%;">
              </div>
            </div>
          </div>
        </div>
      </section>

      <section id="events" class="py-5 bg-light">
        <div class="container">
          <div class="text-center mb-5">
            <a class="nav-link active" aria-current="page" href="#home">Home</a>
            <h2>Upcoming and recent events</h2>
            <p class="text-muted">Attend our meetings on the second and fourth Thursday of each month 
              in the Settlers Park Don Powis Hall at 09h30 for 10h00.
              Enjoy a cup of tea or coffee and chat before the meeting. 
              The presentations are followed by a Q&A session with the presenter.
            </p>
          </div>
          <div class="row g-4">
            <div class="col-md-4">
              <div class="card h-100 shadow-sm">
                <div class="card-body">
                  <div class="feature-icon">🏛️</div>
                  <h5 class="card-title"> 2026-06-11</h5>
                  <p class="card-text">Lucy Hattingh - Stories and experiences from a recent visit to Japan.</p> 
                  <p class="card-text">Anyone who saw Lucy`s previous presentation on a trip to Greenland 
                    will know what to expect – beautiful photographs, interesting facts, 
                    and wonderful experiences.</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card h-100 shadow-sm">
                <div class="card-body">
                  <div class="feature-icon">🗂️</div>
                  <h5 class="card-title"> 2026-05-14</h5>
                  <p class="card-text">Prof Don Kurtz - ARTEMIS: Back to the moon and on to Mars.</p> 
                  <p class="card-text">Under Artemis, NASA will send astronauts on increasingly difficult 
                    missions to explore more of the Moon for scientific discovery, economic benefits, 
                    and to build on our foundation for the first crewed missions to Mars.  
                    Don explained how the phases of the Artemis programme will lead us to establish a 
                    permanent base near the South Pole of the moon and use that to send our first 
                    manned mission to Mars.</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card h-100 shadow-sm">
                <div class="card-body">
                  <div class="feature-icon">🤝</div>
                  <h5 class="card-title">2026-05-28</h5>
                  <p class="card-text">Dr Ben Gaunt - What we learned in Zithulele.</p>
                  <p class="card-text">Drs Ben and Taryn Gaunt, both medical doctors, worked in 
                    Zithulele hospital, about 100km from Mthatha, since 2005 
                    (respectively as clinical manager and medical officer in charge of paediatrics), 
                    helping to transform it from an understaffed and somewhat dysfunctional 55-bed facility 
                    into a celebrated 150-bed hospital with a multidisciplinary clinical team of 40 people.  
                    Both doctors avoided telling us about medical triumphs, but talked about relationships, 
                    and people, and how we can all learn from each other.  
                    It was a very powerful presentation.</p>
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
              <p>Join U3A Port Alfred and enjoy member benefits such as meeting notifications, a monthly 
                newsletter, access to recordings of presentations,and a discounted meeting fee.</p>
              <ul class="list-unstyled">
                <li>• Annual membership for individuals - R50-00</li>
                <li>• Annual Membership for couples - R80-00</li>
                <li>• Meeting fee for members - R5-00</li>
                <li>• Meeting fee for non-members - R10-00</li>
              </ul>
              <p>
              </p>
            </div>
            <div class="col-lg-5">
              <div class="card border-primary shadow-sm">
                <div class="card-body">
                  <h5 class="card-title">Join today</h5>
                  <p class="card-text">Download a membership form 
                <a href="../docs/U3A_Mem_Appl_20230317.pdf" target="_blank">here</a> 
                and hand it in at the next meeting.  If you have paid the membership 
                fee online, please attach the confirmation of payment to the form.</p>
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
            <p class="mb-1">University of the Third Age - U3A</p>
            <p class="mb-1">c/o Settlers Park, Horton Road, Port Alfred OR</p>
            <p class="mb-0"><a href="mailto:info@u3aportalfred.org.za">info@u3aportalfred.org.za</a></p>
            <p class="mb-0"><a href="mailto:membership@u3aportalfred.org.za">membership@u3aportalfred.org.za</a></p>
            <p class="mb-0"><a href="mailto:secretary@u3aportalfred.org.za">secretary@u3aportalfred.org.za</a></p>
            <p class="mb-0"><a href="mailto:chairman@u3aportalfred.org.za">chairman@u3aportalfred.org.za</a></p>
            <p class="mb-0"><a href="mailto:speakerseeker@u3aportalfred.org.za">speakerseeker@u3aportalfred.org.za</a></p>
          </div>
          <div class="col-md-6 text-md-end">
            <h5>Follow Us</h5>
            <p class="mb-0">Stay connected for event updates in the newsletters, 
              Talk of the Town, and The Announcer.</p>
          </div>
        </div>
      </div>
    </footer>
    <script src="../js/bootstrap.bundle.min.js"></script>
    </body>
</html>
