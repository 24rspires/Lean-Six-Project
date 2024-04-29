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

                    <?php UIHelper::agentCard("https://media.licdn.com/dms/image/C5603AQGbOrvlUH8lmA/profile-displayphoto-shrink_200_200/0/1517250463559?e=1719446400&v=beta&t=nKDj9NFaoi4g3AzjcD9dfwtDKDoyTx3-jSUn1vOkszs", "Wil Donald-Duck Rowland", "740-201-3223", "waynes@delawareareacc.org", "https://www.delawareareacc.org/o/dacchs/page/app-dev-programming"); ?>

                    <?php UIHelper::agentCard("https://media.licdn.com/dms/image/D5603AQFrnmuuWFCMUQ/profile-displayphoto-shrink_100_100/0/1708370945347?e=1719446400&v=beta&t=DA7wpfo0NKjAND-2q8ZUqvhPptUKn8p98HnbJdYEiVc", "Josh Business Professionals of America Gallagan", "740-201-3258", "waynes@delawareareacc.org", "https://www.delawareareacc.org/o/dacchs/page/digital-design"); ?>

                    <?php UIHelper::agentCard("https://media.licdn.com/dms/image/C5603AQF4HxhEDasUWw/profile-displayphoto-shrink_100_100/0/1597240765428?e=1719446400&v=beta&t=yMSmqPc4Z9hRcbFpyQTV6aSyImkuff5YWIsYhMcVFs0", "Jeff Got That Beast In Him Fuller", "740-480-1783", "waynes@delawareareacc.org", "https://www.delawareareacc.org/o/dacchs/page/digital-design"); ?>

                    <?php UIHelper::agentCard("https://media.licdn.com/dms/image/C4E03AQFZtxvPJ_SRRA/profile-displayphoto-shrink_200_200/0/1620923851623?e=1719446400&v=beta&t=UjPgGWeGClHQigIejqB5kMUReT-6GP_b6LEc00ep3Bg", "Simon Computer-Fixer Bates", "740-203-2261", "waynes@delawareareacc.org", "https://www.delawareareacc.org/o/dacchs/page/digital-design"); ?>

                    <?php UIHelper::agentCard("https://media.licdn.com/dms/image/C4E03AQGgHWOYW3Pyqw/profile-displayphoto-shrink_200_200/0/1636572540301?e=1719446400&v=beta&t=AggmevXILXSpZuk3YD_BkjlnsaUeT2_J6Fj_S3YOJ50", "Mitch YOU-PUT-A-DUCKY-IN-MY-SYSTEM Buchanan", "740-203-2252", "waynes@delawareareacc.org", "https://www.delawareareacc.org/o/dacchs/page/digital-design"); ?>

                    <?php UIHelper::agentCard("https://media.licdn.com/dms/image/D5603AQF9n7ZG58ZnKg/profile-displayphoto-shrink_100_100/0/1714146404358?e=1719446400&v=beta&t=K79cNQBJYePENrKPsstWSeFmqGY4OYv8paO6-Bw4luw", "Liam Toemas Thomas", "740-972-5496", "messedupelican12@gmail.com", "https://www.delawareareacc.org/o/dacchs/page/digital-design"); ?>
                </div>
            </div>
        </section>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>