<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>Boker Real Estate | Home</title>
    </head>
    <body>
    <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
        <?PHP
        include_once "General.php";
        include_once "Account.php";

        startSessionIfNotStarted();
        $currentUser = Account::loadSession();

        if ($currentUser !== NULL)
        {
            print "Current user: $currentUser->username<br>";
            echo '
            <script>
                function logout() {
                    var xhttp = new XMLHttpRequest();
                    xhttp.open("GET", "logout.php", true);
                    xhttp.send();
                }
            </script>

            <button onclick="logout()">Logout</button>
            ';
        }
        else
        {
            print "No user logged in<br>";
        }
        
        ?>
        
    </body>
</html>