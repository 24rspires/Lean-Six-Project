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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="./css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/nav-bar.css">
    <link rel="stylesheet" href="./css/autocomplete.css">
    <script src="./js/main.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body id="margin-fix">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand nav-text" href="index.php">Boker</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item nav-text">
                <a class="nav-link active nav-text" aria-current="page" href="agents.php">Agents</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active nav-text" aria-current="page" href="FAQ.php">FAQ</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <div class="dropdown-center mx-2">
                <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Big Aaron
                </button>
                <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                    <li><a class="dropdown-item nav-font" href="profile.php">Profile</a></li>
                    <li>
                        <form class="dropdown-item" method='post'>
                            <input type='submit' class="logout-btn h-100 w-100 text-start bg-none" value='Logout' name='logout'>
                        </form>
                    </li>
                    <!-- <li><a class="dropdown-item nav-font" href="#">Something else here</a></li> -->
                </ul>
            </div>
            <div class="navbar-create-icon align-items-center">
                <a href="create-property.php" class="text-white create-icon text-center">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
            </div>
            <div class="navbar-create-text">
                <a href="create-property.php" class="text-white navbar-text-style">
                    Create Property
                </a>
            </div>
        </ul>
        <!-- <div class="nav-item dropdown me-auto mb-2 mb-lg-0">
            <a class="nav-link dropdown-toggle nav-text" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown
            </a>
            <span class="justify-content-center">
                <ul class="dropdown-menu me-auto">
                    <li><a class="dropdown-item nav-font" href="#">Action</a></li>
                    <li><a class="dropdown-item nav-font" href="#">Another action</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item nav-font" href="#">Something else here</a></li>
                </ul>
            </span>
        </div> -->
        <!-- <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form> -->
        </div>
    </div>
    </nav>
    <!-- <section class='nav'> -->
        
        <!-- <div class="row w-100 justify-content-end">
            <div class="col">
                <div class="row">
                    <div class="col-2">
                        <button>
                            boker
                        </button>
                    </div>
                    <div class="col-2">
                        <button>
                            boker
                        </button>
                    </div>
                    <div class="col-2">
                        <button>
                            boker
                        </button>
                    </div>
                </div>
            </div>
            <div class="col d-flex justify-content-end">
                <button>
                    boker
                </button>
            </div>
        </div> -->
        <!-- <div class='container p-0 m-0'>
            <div class='row justify-content-center d-flex'>
                <div class="col-8 d-flex">
                    <div class="row g-0">
                        <div class='col'>
                            <a href='index.php'>Home</a>
                        </div>
                        <div class='col'>
                            <a href='agents.php'>Agents</a>
                        </div>
                        <div class='col'>
                            <a href='FAQ.php'>FAQ</a>
                        </div>
                    </div>
                </div>
                <div class='col-4'>
                    <div class='dropdown align-items-end justify-content-end text-end d-flex'>
                        <button class='btn btn-secondary dropdown-toggle logout' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            Big Aaron
                        </button>
                        <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                            <a class='' id='color' href='profile.php'>Account Settings</a>
                            <form method='post'>
                            <input id='color' type='submit' value='Logout' name='logout' >
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    <!-- </section> -->
<!-- <?php include_once "UIHelper.php"; UIHelper::navBar(); ?> -->
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

        <div class="de-box">
            <a href="#"><div class="box">
                <div class="image">
                    <img src="./images/property1.jpg" alt="">
                </div>

                <div class="price-name">
                    <h4>$729,900</h4>
                </div>

                <div class="location-detail">
                    <p><img src="./images/location.svg"> 614 Boker Dr, Delaware, OH</p>
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
                    <p><img src="./images/location.svg"> 5544 Butter Dr, Delaware, OH</p>
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
                    <p class="row-sm-1"><img src="./images/location.svg"> 1949 Linden St, Delaware, OH</p>
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
            <a href="./search.php">Explore All</a>
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
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
<script src="./js/main.js"></script>

</body>
</html>