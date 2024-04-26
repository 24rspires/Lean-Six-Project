<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/agents.css">
        <link rel="stylesheet" href="./css/nav-bar.css">
        <title>Document</title>
    </head>

    <body class="agents-background">

        <?php
        include_once "General.php";
        include_once "Account.php";
        include_once "UIHelper.php";
        UIHelper::navBar()
      ?>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading">Our Agents</h2>
                        <hr class="my-4">`
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">

                    <?php UIHelper::agentCard("https://media.licdn.com/dms/image/C5603AQFfXDHgxMpdiw/profile-displayphoto-shrink_200_200/0/1651248798288?e=1719446400&v=beta&t=Wgr-pRFECQFJ9LuD8TrMb6k0gtnFkTs5bOPquDQa9GU", "Greg Keyboard-Guardian McDonough", "740-201-3226", "mcdonoughg@delawareareacc.org", "https://www.delawareareacc.org/o/dacchs/page/app-development"); ?>

                    <?php UIHelper::agentCard("https://media.licdn.com/dms/image/C4E03AQGwFDPOLGzSjA/profile-displayphoto-shrink_100_100/0/1619440657993?e=1719446400&v=beta&t=U8VIPI5hjq70S1aAFDD4siQluSLizSDwQGgqq7-HaXw", "Eli CyberBoy Cochran", "740-203-2216", "cochrane@delawareareacc.org", "https://www.delawareareacc.org/o/dacchs/page/cybersecurity"); ?>

                    <?php UIHelper::agentCard("https://media.licdn.com/dms/image/D5603AQGC2-_P5rj0aw/profile-displayphoto-shrink_100_100/0/1674150794425?e=1719446400&v=beta&t=pwTeh4xoZvie_artAgH0Lu_tViIZ4Ll-m27O2dmuPi0", "Wayne Lean-Six Strunk", "740-203-2400", "waynes@delawareareacc.org", "https://www.delawareareacc.org/o/dacchs/page/app-dev-programming"); ?>
                </div>
            </div>
        </section>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>