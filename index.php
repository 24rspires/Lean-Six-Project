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

        if (isset($_SESSION['user_account']))
        {
            $currentUser = unserialize($_SESSION['user_account']);
            print "Current user: $currentUser->username<br>";
        }
        else
        {
            print "No user logged in<br>";
        }
        
        ?>
        <a href="login.php">Login</a><br/>
    </body>
</html>