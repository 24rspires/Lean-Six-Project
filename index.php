<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/style.css">
        <title>Boker Real Estate | Home</title>
    </head>

    <nav>
        <ul class="Nav-Bar">
            <li><a href="index.php">Home</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </nav>

    <body>
        <?PHP
        include_once "General.php";
        include_once "Account.php";

        startSessionIfNotStarted();

        if (isset($_POST['logout']))
        {
            Account::unloadSession();
        }

        $currentUser = Account::loadSession();

        if ($currentUser !== NULL)
        {
            print "Current user: $currentUser->username<br>";

            print '
            <form method="post">
            <input type="submit" value="Logout" name="logout">
            </form>
            ';
        }
        else
        {
            print "No user logged in<br>";
        }
        ?>

        <form>
            <input type="text" name="field" placeholder="Search for Zipcode, Address or State">
            <br>
            <input type="submit" value="submit" name="search">
        </form>
        
    </body>
</html>