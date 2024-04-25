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
                        <hr class="my-4">
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">

                    <?php UIHelper::agentCard("images/agents/agent1.jpg", "Michael Harris", "614-629-9648", "HarrisM@gmail.com"); ?>

                    <?php UIHelper::agentCard("images/agents/agent3.jpg", "Jennifer Lee", "614-496-3284", "JenLee@yahoo.com"); ?>

                    <?php UIHelper::agentCard("images/agents/agent4.jpg", "Rachael Miller", "740-573-8495", "RachMill@gmail.com"); ?>
                </div>
            </div>
        </section>
    </body>
</html>