<?php
include_once "UIHelper.php";
include_once "Account.php";
include_once "Properties.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agent Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/nav-bar.css">
    <link rel="stylesheet" href="./css/agent.css">
    <link rel="stylesheet" href="./css/search.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="./css/aspect-ratio.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>
<body>
    <?php
    

    UIHelper::navBar();

    $id = $_GET['id'] ?? -1;

    define('USER', Account::getFromId($id));
    ?>
    <main class="d-flex align-items-center justify-content-center">
        <?php if (USER === null || USER->type < 1) UIHelper::printError("The account with $id id is not an agent account", "agents.php"); else { ?>

        <div class="container">
            <div class="row py-4 justify-content-center align-items-center text-center">
                <img id="pfp" class="rounded-circle p-0 m-0" src="<?= USER->getProfilePicture(); ?>" alt="Agent <?=$id?> PFP" />
                <h1><?= implode(" ", [USER->first_name, USER->last_name]); ?></h1>
            </div>
            <div class="row justify-content-center align-items-center text-center">
                <p class="text-center">
                    <i class="fa-solid fa-user"></i>
                    <a class="text-dark pfp-link" href="mailto:<?=USER->email?>"><?= USER->email; ?></a>
                </p>
            </div>
            <div class="row justify-content-center align-items-center text-center">
                <p class="text-center">
                    <i class="fa-solid fa-phone"></i>
                    <a class="text-dark pfp-link" href="tel:<?=USER->phone?>"><?= UIHelper::formatAgentNumber(USER->phone); ?></a>
                </p>
            </div>

            <div class="row justify-content-center align-items-center text-center">
                <h1 class="text-center mb-4">Property List</h1>
            </div>

            <div class="row justify-content-center align-items-center text-center">
                <?php
                $properties = Properties::getAllFromAgentId($id);
                if (count($properties) > 0) {
                    foreach ($properties as $property) {
                        UIHelper::propertyCard($property->property_id, UIHelper::toMoney($property->price), $property->bedrooms, $property->bathrooms, $property->square_feet, $property->formatAddress(), implode(" ", [USER->first_name, USER->last_name]), $property->getImages());
                    }
                } else {
                    echo "<h3>This agent has no properties listed!</h3>";
                }
                ?>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <script>
            $('.property-container').click(function()
            {
                console.log('clicked')
                var propertyId = $(this).attr('pid');
                var target = event.target;
                if (propertyId && $(target).attr('click-ignore') === undefined)
                {
                    window.location.href = "search.php?id=" + propertyId;
                }
            })

        </script>
        <?php } ?>
    </main>
</body>
</html>