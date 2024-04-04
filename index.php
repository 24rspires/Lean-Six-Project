<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Homepage</title>
    </head>
    <body>
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
        <a href="login.php">Login</a><br/>
    </body>
</html>