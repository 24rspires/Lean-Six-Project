<?php
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="./css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/nav-bar.css">
    <link rel="stylesheet" href="./css/autocomplete.css">
    <script src="./js/main.js" defer></script>
</head>

<body id="margin-fix">
<?php include_once "UIHelper.php"; UIHelper::navBar(); ?>
<main>
    
    













    <div class="home">
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
                    <input type="submit" value="Sumbit" name="submit">
                </form>
                <script src="./scripts/autocomplete.js"></script>
            </div> 
        </div>
    </div>

    <div class="property">
        <div class="prop-h">
            <h2>Trending Properties</h2>
            <p>Explore our trending properties showcasing premier locations and exceptional value!</p>
        </div>

        <div class="de-box">
            <a href="#"><div class="box">
                <div class="image">
                    <img src="./images/property1.jpg" alt="">
                </div>

                <div class="price-name">
                    <h4>$729,900</h4>
                </div>

                <div class="location-detail">
                    <p><img src="./images/location.svg"> 5723 Piatt Rd, Lewis Center, OH</p>
                    <div class="detail">
                        <ul>
                            <li>
                                <img src="./images/bed.svg">4 Beds
                            </li>

                            <li>
                                <img src="./images/bath.svg">4 Baths
                            </li>

                            <li>
                                <img src="./images/sqft.svg">2,812 Sqft
                            </li>
                        </ul>
                    </div>
                </div>
                </div></a>

            <a><div class="box">
                <div class="image">
                    <img src="./images/property2.jpg" alt="">
                </div>

                <div class="price-name">
                    <h4>$774,762</h4>
                </div>

                <div class="location-detail">
                    <p><img src="./images/location.svg"> 5544 Butternut Dr, Lewis Center, OH</p>
                    <div class="detail">
                        <ul>
                            <li>
                                <img src="./images/bed.svg">3 Beds
                            </li>

                            <li>
                                <img src="./images/bath.svg">3 Baths
                            </li>

                            <li>
                                <img src="./images/sqft.svg">2,453 Sqft
                            </li>
                        </ul>
                    </div>
                </div>
                </div></a>

            <a><div class="box">
                <div class="image">
                    <img src="./images/property3.jpg" alt="">
                </div>

                <div class="price-name">
                    <h4>$672,500</h4>
                </div>

                <div class="location-detail">
                    <p><img src="./images/location.svg"> 1949 Linden St, Lewis Center, OH</p>
                    <div class="detail">
                        <ul>
                            <li>
                                <img src="./images/bed.svg">5 Beds
                            </li>

                            <li>
                                <img src="./images/bath.svg">4 Baths
                            </li>

                            <li>
                                <img src="./images/sqft.svg">2,951 Sqft
                            </li>
                        </ul>
                    </div>
                </div>
            </div></a>
        </div>

        <div class="explore">
            <a href="#">Explore All</a>
        </div>
    </div>

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
<script src="./js/main.js"></script>
</body>
</html>