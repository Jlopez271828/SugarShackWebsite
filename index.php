<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Sugar Shack and Snacks of New Mexico, mobile bakery making snacks for albuquerque. Check out our repertoire or make a custom request">
  <title>Sugar Shack of New Mexico</title>
  <!-- Google Font -->
  <!-- <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet"> -->
  <link href="https://fonts.googleapis.com/css2?family=DynaPuff:wght@400..700&display=swap" rel="stylesheet">
  <style>
    /* Reset & base styles */
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: "DynaPuff", cursive;
      line-height: 1.5;
      color: #333;
      background:rgb(236, 203, 229);
      display: flex;
      justify-content: center;
      padding: 1rem;
    }
    a { text-decoration: none; color: inherit; }
    img { max-width: 100%; display: block; }

    /* Main container */
    .container {
      width: 100%;
      max-width: 1200px;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 2rem;
    }

    /* Logo & Title */
    .logo-title {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 0.5rem;
    }
    .logo-title img {
      height: 80px;
    }
    .logo-title h1 {
      font-size: 2.5rem;
    }

    /* Navigation as section */
    nav {
      display: flex;
      gap: 2rem;
      justify-content: center;
      flex-wrap: wrap;
    }
    nav a {
      font-size: 1.25rem;
      padding: 0.5rem 1rem;
      border: 2px solid #333;
      border-radius: 8px;
      transition: background 0.3s;
      background-color: white;
    }
    nav a:hover {
      background: rgb(239, 213, 235);
    }

    /* Carousel */
    .carousel {
      width: 100%;
      overflow: hidden;
    }
    .slides {
      display: flex;
      transition: transform 0.5s ease-in-out;
    }
    .slides img {
      width: calc(100% / 3);
      flex-shrink: 0;
    }

    /* Sections centered */
    section {
      width: 100%;
      max-width: 800px;
      text-align: center;
    }
    section h2 {
      font-size: 2rem;
      margin-bottom: 1rem;
    }
    .events, .announcements {
      background: #fff;
      padding: 1rem;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      font-size: 1.5rem;
    }
    .events ul {
      list-style: none;
    }
    .events li {
      margin: 0.5rem 0;
    }

    /* Social Media Embeds */
    .social {
      display: flex;
      gap: 1rem;
      justify-content: center;
      flex-wrap: wrap;
      flex-direction: column;
      align-items: center;
    }
    .social iframe {
      flex: 1;
      min-width: 450px;
      border: none;
      min-height: 300px;
      border-radius: 8px;
    }

    /* Location Image */
    .location {
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .subscribe {
      text-align: center;
      background: #fff;
      padding: 1rem;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      max-width: 400px;
      margin: 2rem auto;
    }
    .subscribe input[type="email"] {
      width: 70%;
      padding: 0.5rem;
      border: 1px solid #ccc;
      border-radius: 4px;
      margin-right: 0.5rem;
    }
    .subscribe button {
      padding: 0.5rem 1rem;
      border: none;
      background: #333;
      color: #fff;
      border-radius: 4px;
      cursor: pointer;
      margin-top: 5px;
    }
    .subscribe-message {
      margin-top: 1rem;
      font-size: 1rem;
    }

    /* Responsive tweaks */
    @media (max-width: 600px) {
      .slides img { width: calc(100% / 1); }
    }
  </style>
</head>
<body>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v23.0"></script>
    <div class="container">
    <!-- Logo & Title -->
    <div class="logo-title">
      <img src="images/logo.jpg" alt="Bakery Logo">
      <h1>Sugar Shack and Brew</h1>
      <h3>Baking Snacks For Albuquerque</h3>
    </div>

    <!-- Navigation -->
    <nav>
      <a href="Repertoire">Repertoire</a>
      <a href="AboutUs">About Us</a>
      <a href="Order">Custom Requests</a>
    </nav>

    <!-- Carousel -->
    <div class="carousel" id="carousel">
      <div class="slides">
        <img src="images/items/1.webp" alt="Cake 1">
        <img src="images/items/5.webp" alt="Cake 2">
        <img src="images/items/12.webp" alt="Pastry 1">
        <img src="images/items/16.webp" alt="Bread 1">
        <img src="images/items/3.webp" alt="Tart 1">
      </div>
    </div>

    <!-- Announcements -->
    <section>
      <h2>Announcements</h2>
      <div class="announcements">
        <p>This is our First Announcement!</p>
      </div>
    </section>

    <!-- Upcoming Events -->
    <section>
      <h2>Upcoming Events</h2>
      <div class="events">
        <p>Schedule TBD</p>
      </div>
    </section>

    <!-- Email List -->
    <section class="subscribe">
      <h2>Subscribe to Our Email List</h2>
      <form id="subscribeForm">
        <input type="email" id="emailInput" placeholder="your@email.com" required>
        <button type="submit">Subscribe</button>
      </form>
      <div class="subscribe-message" id="subscribeMessage"></div>
    </section>

    

    <!-- Social Media Iframes -->
    <section>
      <h2>Follow Us</h2>
      <div class="social">
      <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fprofile.php?id=61553130861732&tabs=timeline&width=450" allow="encrypted-media"></iframe>
      <!-- <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fprofile.php?id=61553130861732facebook&tabs=timeline&width=450&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=false&appId" width="450" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>  
       -->
      </div>
      
      
    </section>
    

    <!-- Location -->
    <section>
      <h2>Our Last Location</h2>
      <h3>1504 Cherry Rd NE</h3>
      <div class="location">
        <img src="images/location.png" alt="Our Bakery Location">
      </div>
    </section>
  </div>

  <script>
    // Carousel: show 3 at a time, slide one
    (function() {
      const slides = document.querySelector('#carousel .slides');
      const imgs = slides.children;
      const total = imgs.length;
      let index = 0;
      const visible = window.innerWidth > 600 ? 3 : 1;
      setInterval(() => {
        index = (index + 1) % (total - visible + 1);
        slides.style.transform = `translateX(-${index * (100/visible)}%)`;
      }, 4000);
    })();

    // Subscribe form handler
    document.getElementById('subscribeForm').addEventListener('submit', function(e) {
      e.preventDefault();
      const emailInput = document.getElementById('emailInput');
      const messageDiv = document.getElementById('subscribeMessage');
      const email = emailInput.value.trim();

      // Simple email format check
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      if (!emailRegex.test(email)) {
        messageDiv.textContent = 'Please enter a valid email address.';
        messageDiv.style.color = 'red';
      } else {

        data = {

            email: email

        }
        // Send to PHP via fetch
        fetch('/PHP/addToEmailList.php', {
          method: 'POST',
          headers: {"Content-Type": "application/json"},
          body: JSON.stringify(data)
        })
        .then(response => response.text())
        .then(data => {
          messageDiv.textContent = 'Thank you for subscribing!';
          messageDiv.style.color = 'green';
          emailInput.value = '';
        })
        .catch(error => {
          messageDiv.textContent = 'There was an error. Please try again later.';
          messageDiv.style.color = 'red';
        });
      }
    });
  </script>
</body>
</html>
