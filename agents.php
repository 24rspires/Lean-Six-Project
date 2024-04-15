<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
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
                <div class="col-lg-12">
                    <ul class="agents-list transition-test">
                        <?php UIHelper::agentCard("./images/agents/doughnut.png", "Luke Atkins", "6145571566", "agent1@example.com"); ?>
                        
                        <?php UIHelper::agentCard("./images/agents/doughnut.png", "John Doe", "1234567890", "agent2@example.com"); ?>
                        
                        <?php UIHelper::agentCard("./images/agents/doughnut.png", "McD", "1234567890", "agent3@example.com"); ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</body>
</html>