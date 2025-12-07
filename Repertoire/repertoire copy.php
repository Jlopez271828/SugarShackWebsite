<!DOCTYPE html>

<html>
  <head>
    <title>Repertoire</title>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="repertoire.css">
    <meta http-equiv="expires" content="0">
    <script src="repertoire.js"></script>

  </head>

  <body id="body">
    <h1 id="title">Our Repertoire</h1>

    <a href="/" class="back-link">← Home</a>

    <div id="container">

      <?php include("../PHP/getCards.php")?>
      

      
      
    </div>

    <!-- Modal -->
    <div class="modal-overlay" id="modalOverlay">
      <div class="modal" id="alertModal">
        <button class="modal-close" id="modalClose">&times;</button>
        <h2>We'll email you when we are selling this item</h2>
        <input type="email" id="emailInput" placeholder="your@email.com" />
        <div class="error" id="emailError"></div>
        <button id="submitEmail">Submit</button>
        <div class="subscribe-message" id="subscribeMessage"></div>
      </div>
    </div>


    <?php include("../PHP/footer.php"); ?>
    
  </body>



</html>
