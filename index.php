<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/nav-bar.css">
        <title>Boker Real Estate | Home</title>
    </head>

    <?php
    include_once "General.php";
    include_once "Account.php";
    include_once "Properties.php";
    include_once "UIHelper.php";
    ?>

    <body>
        <?php
        startSessionIfNotStarted();

        $currentUser = Account::loadSession();

        UIHelper::navBar();

        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            // user has interacted

            // check if user searched
            if (isset($_POST['search']))
            {
                // redirect with get page
            }
        }

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
        
        
        <div class="d-flex container justify-content-center">
            <div class="bg-box">
                <form method="POST">
                    <input type="text" name="city" placeholder="city">
                    <input type="text" name="state" placeholder="state">
                    <input type="text" name="zip" placeholder="zip">
                    <input type="submit" value="Sumbit" name="sumbit">
                </form>



    <!--                    <div class="container">-->
    <!--                        <div class="dropdown">-->
    <!--                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Dropdown Example-->
    <!--                                <span class="caret"></span></button>-->
    <!--                            <ul class="dropdown-menu">-->
    <!--                                <li><a href="#">HTML</a></li>-->
    <!--                                <li><a href="#">CSS</a></li>-->
    <!--                                <li><a href="#">JavaScript</a></li>-->
    <!--                            </ul>-->
    <!--                        </div>-->
    <!--                    </div>-->


                <?php
                    if ($_SERVER["REQUEST_METHOD"] === "POST") {
                        if (isset($_POST['search'])) {
                            $city = "";
                            header("Location: ./search.php");
                        }
                    }
                ?>
            </div>
        </div>
    </body>
</html>