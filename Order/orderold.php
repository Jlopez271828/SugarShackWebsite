<!DOCTYPE html>
<html>


  <head>

    <title>Custom Orders</title>
    <link rel="stylesheet" href="order.css">
    
  </head>
  <body>

    <div id='main'>

      <form method='POST' action='../PHP/recieveOrder.php' id="mainForm">

        <label for="name" class="lbl">Name: </label>
        <input type="text" name="name" id="name">
        <br>

        <label for="contact" class="lbl"> Your Email or Phone number: </label>
        <input type="text" name="contact" id="contact">

        <br>

        <label for="request"> Your request: </label>
        <textarea id="request" name="request" rows="4" cols="50"> </textarea>
        <br>

        <button id="submitBtn"> Submit </button>

        

      </form>

    </div>


  </body>


</html>