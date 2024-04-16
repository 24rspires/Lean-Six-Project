<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
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

        <section>
            <div class="container">
                <div class="bg-box">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3045.9908816514417!2d-83.04148932347631!3d40.23150496689128!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8838f057158834c1%3A0xefcdfe7e59a24f21!2sDelaware%20Area%20Career%20Center%20South%20Campus!5e0!3m2!1sen!2sus!4v1712858502536!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
        </section>
    </body>
</html>