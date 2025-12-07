
<!DOCTYPE html>
<html>
    <head>

        <title>Login</title>
        <link rel="stylesheet" href="login.css">


    </head>

    <body>


        <form method="POST" action="../PHP/login.php">

            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <br>
            <button type="submit">Login</button>

        </form>


    </body>



</html>