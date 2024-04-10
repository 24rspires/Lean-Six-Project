<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <title>Document</title>
</head>
<body>
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
                    <ul class="agents-list">
                        <li class="agent">
                            <img src="" alt="Agent 1 Profile Picture" class="agent-pfp">
                            <div class="agent-info">
                                <h3>Fuck Face Farmer</h3>
                                <a href="tel:6145571566">614-557-1566</a><br />
                                <p>Email: agent1@example.com</p>
                            </div>
                        </li>
                        <br><br>
                        <li class="agent">
                            <img src="" alt="Agent 2 Profile Picture" class="agent-pfp">
                            <div class="agent-info">
                                <h3>Agent 2</h3>
                                <p>Position: Agent</p>
                                <p>Email: agent2@example.com</p>
                            </div>
                        </li>
                        <br><br>
                        <li class="agent">
                            <img src="" alt="Agent 3 Profile Picture" class="agent-pfp">
                            <div class="agent-info">
                                <h3>Agent 3</h3>
                                <p>Position: Agent</p>
                                <p>Email: agent3@example.com</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</body>
</html>