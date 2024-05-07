<?php
include_once "UIHelper.php"; 
include_once "Properties.php";
include_once "UIHelper.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        if ($_POST['type'] === 'county') {
            header("Location: ./search.php?city={$_POST['query']}");
        } else if ($_POST['type'] === 'zipcode') {
            header("Location: ./search.php?zipcode={$_POST['query']}");
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home | Boker Real Estate</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="title" content="Boker Real Estate">
    <meta name="description" content="This is our Lean Six project">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="./css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/nav-bar.css">
    <link rel="stylesheet" href="./css/autocomplete.css">
    <link rel="stylesheet" href="./css/search.css">
    <link rel="stylesheet" href="./css/aspect-ratio.css">
    <script src="./js/main.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body id="margin-fix">
 <?php 
    UIHelper::navBar();
 ?>
    <main>
    <div class="container1 justify-content-center home">
        <div class="home-image">
            <div class="home-text">
                <h1>Welcome to Boker Real Estate</h1>
                <p>Your Gateway to Dream Homes and Investment Opportunities!</p>
                <form autocomplete="off" method="post">
                    <div class="autocomplete" style="width:300px;">
                        <input id="myInput" type="text" name="query" placeholder="614 Boker Dr, Bokerville, BO 12345">
                        <input id="typeInput" name="type" type="hidden" />
                        <input id="propId" name="propId" type="hidden" />
                    </div>
                    <input class="input" type="submit" value="Sumbit" name="submit">
                </form>
                <script src="./scripts/autocomplete.js"></script>
            </div> 
        </div>
    </div>
    <div class="container2 property">
        <div class="prop-h">
            <h2>Trending Properties</h2><br>
            <p>Explore our trending properties showcasing premier locations and exceptional value!</p>
        </div>
        <div class="row d-flex align-items-center justify-content-center">
            <?PHP
                    $prop1=Properties::getFromId(256);
                    UIHelper::propertyCard(
                       $prop1->property_id,
                       UIHelper::toMoney($prop1->price),
                       $prop1->bedrooms,
                       $prop1->bathrooms,
                       $prop1->square_feet,
                       $prop1->formatAddress(),
                       "Boker Realty", // we don't have a realtor in the db
                       $prop1->getImages(),
                   );

                   $prop2=Properties::getFromId(155);
                    UIHelper::propertyCard(
                       $prop2->property_id,
                       UIHelper::toMoney($prop2->price),
                       $prop2->bedrooms,
                       $prop2->bathrooms,
                       $prop2->square_feet,
                       $prop2->formatAddress(),
                       "Boker Realty", // we don't have a realtor in the db
                       $prop2->getImages()
                       
                   );

                   $prop3=Properties::getFromId(169);
                    UIHelper::propertyCard(
                       $prop3->property_id,
                       UIHelper::toMoney($prop3->price),
                       $prop3->bedrooms,
                       $prop3->bathrooms,
                       $prop3->square_feet,
                       $prop3->formatAddress(),
                       "Boker Realty", // we don't have a realtor in the db
                       $prop3->getImages()
                   );
                ?>
                <div class="explore py-4">
                    <a href="./search.php">Explore All</a>
                </div>
        </div>
    </div>
        <div id="container ">
            <div class="footer">
                <div class="footer-box">
                    <div class="box">
                        <div class="logo">
                            <img src="./images/Boker%20Real%20Estate-logos.jpeg" alt="">
                        </div>
                        <p>Unlock Home Dreams with Boker!</p>
                    </div>

                <div class="box">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="agents.php">Agents</a></li>
                        <li><a href="FAQ.php">FAQ</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
    
</main>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
<script>
    const cards = document.querySelectorAll('.property-container');

    cards[0].addEventListener('click', function() {
        window.location.href = 'search.php?id=<?=$prop1->property_id?>';
    });

    cards[1].addEventListener('click', function() {
        window.location.href = 'search.php?id=<?=$prop2->property_id?>';
    });

    cards[2].addEventListener('click', function() {
        window.location.href = 'search.php?id=<?=$prop3->property_id?>';
    });
</script>

</body>
</html>