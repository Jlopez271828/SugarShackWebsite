<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Custom Request</title>
  <!-- <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet"> -->
  <link href="https://fonts.googleapis.com/css2?family=DynaPuff:wght@400..700&display=swap" rel="stylesheet">
  <script src="order.js"></script>
  <style>
    body {
      margin: 0;
      font-family: 'DynaPuff', cursive;
      background-color: rgb(236, 203, 229);
      color: #4b2e2e;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      min-height: 100vh;
      padding: 2rem 1rem;
    }

    a.back-link {
      position: fixed;
      top: 1rem;
      left: 1rem;
      background-color: #ffb6c1;
      color: white;
      padding: 0.5rem 1rem;
      border-radius: 20px;
      text-decoration: none;
      font-size: 1.2rem;
      box-shadow: 2px 2px 5px rgba(0,0,0,0.2);
      z-index: 10;
      transition: background-color 0.3s;
    }

    a.back-link:hover {
      background-color: #ff69b4;
    }

    h1 {
      font-size: 2.5rem;
      margin-bottom: 1rem;
      text-align: center;
    }

    form {
      width: 100%;
      max-width: 500px;
      background: white;
      padding: 2rem;
      border-radius: 20px;
      box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    }

    label {
      display: block;
      font-size: 1.3rem;
      margin-bottom: 0.3rem;
      margin-top: 1rem;
    }

    p{

      display: block;
      font-size: 1.3rem;
      margin-top: 1rem;
      margin-bottom: 0.3rem;

    }

    input, textarea {
      width: 100%;
      padding: 0.8rem;
      font-size: 1.1rem;
      border: 2px solid #ffb6c1;
      border-radius: 10px;
      background-color: #fffafc;
      box-sizing: border-box;
      font-family: default;
    }

    textarea {
      resize: vertical;
      min-height: 100px;
    }

    .submit-btn {
      display: inline-block;
      margin-top: 1.5rem;
      background-color: #ff69b4;
      color: white;
      font-size: 1.4rem;
      padding: 0.7rem 2rem;
      border: none;
      border-radius: 30px;
      cursor: pointer;
      box-shadow: 3px 3px 6px rgba(0, 0, 0, 0.2);
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .submit-btn:hover {
      background-color: #ff1493;
      transform: translateY(-2px);
    }
  </style>
</head>
<body>

  <a href="/" class="back-link">← Home</a>

  <h1>Make A Custom Request</h1>

  <form onsubmit="return false">
    <p>Want something that is not on our menue?</p>

    <p>Send a request for an item to be made for you! You could pick it up the next time we are out selling. </p>

    <p>Or, ask if we can make you a custom cake, batch of cupcakes, or other request!</p>

    <label for="name">Your Name</label>
    <input type="text" id="name" name="name" required>

    <label for="contact">Email or Phone</label>
    <input type="text" id="contact" name="contact" required>

    <label for="request">Your Request</label>
    <textarea id="request" name="request" required></textarea>

    <button id="submitBtn" class="submit-btn" type="button">Submit</button>
  </form>

</body>
</html>
