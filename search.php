

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="dynamicTitle">boker search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/search.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/aspect-ratio.css">
    <link rel="stylesheet" href="css/nav-bar.css">
    <script type="text/javascript">
        var index = 0;
        var titles = [
            "🅱oker",
            "🍺🍺🍺🍺",
            "✡✡✡✡",
            "🐒🐒🐒🐒",
        ];

        function changeTitle() {
            var newTitle = titles[index];
            document.getElementById("dynamicTitle").innerText = newTitle;
            index += 1
            if (index >= titles.length)
            {
                index = 0
            }
        }

        setInterval(changeTitle, 1);
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <?PHP
    // if startSessionIfNotStarted() is not called before
    // the headers are sent the page will error
    // do not move the includes
    include_once "Account.php";
    include_once "Properties.php";
    include_once "UIHelper.php";
    UIHelper::navBar();
    ?>
    <form method="GET" id="form">
        <label for="city">City</label>
        <input type="text" name="city" id="city">
        <label for="zipcode">Zipcode</label>
        <input type="number" name="zipcode" id="zipcode">
        <br>
        <!-- todo style the radio buttons -->
        <br>
        <h2>Bathrooms</h2>
        <input type="radio" name="bathroom" id="any" value="0" checked>
        <label for="any">Any</label>
        <input type="radio" name="bathroom" id="1" value="1">
        <label for="1">1+</label>
        <input type="radio" name="bathroom" id="2" value="2">
        <label for="2">2+</label>
        <input type="radio" name="bathroom" id="3" value="3">
        <label for="3">3+</label>
        <input type="radio" name="bathroom" id="4" value="4">
        <label for="4">4+</label>
        <input type="radio" name="bathroom" id="5" value="5">
        <label for="5">5+</label>
        <br>
        <h2>Bedrooms</h2>
        <input type="radio" name="bedroom" id="any" value="0" checked>
        <label for="any">Any</label>
        <input type="radio" name="bedroom" id="1" value="1">
        <label for="1">1+</label>
        <input type="radio" name="bedroom" id="2" value="2">
        <label for="2">2+</label>
        <input type="radio" name="bedroom" id="3" value="3">
        <label for="3">3+</label>
        <input type="radio" name="bedroom" id="4" value="4">
        <label for="4">4+</label>
        <input type="radio" name="bedroom" id="5" value="5">
        <label for="5">5+</label>
        
        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <script>
        $( function() {
            $( "#slider-range").slider({
            range: true,
            min: 0,
            max: 1000000,
            step: 50000,
            values: [ 0, 1000000 ],
            slide: function( event, ui ) {
                $( "#amount" ).val( "Minimum: $" + ui.values[ 0 ] + " - Maximum: $" + ui.values[ 1 ] );
            }
            });
            $( "#amount" ).val( "Minimum: $" + $( "#slider-range" ).slider( "values", 0 ) +
            " - Maximum: $" + $( "#slider-range" ).slider( "values", 1 ) );
        });
        </script>
        <!-- todo remove inline hardcoded width -->
        <p>
        <label for="amount">Price range:</label>
        <input type="text" id="amount" readonly="" style="width: 400px;border:0; color:#33cc33; font-weight:bold;">
        </p>
        
        <div id="slider-range" style="width:300px;"></div>
        
        <button type="button" id="sumbit">sumbit</button>
        <script src="scripts/searchForm.js"></script>
    </form>
    
    <!-- <div id="screenSizeDisplay"></div>

<script>
    // Function to get Bootstrap's current screen size
    function getBootstrapScreenSize() {
        const width = window.innerWidth;
        if (width < 576) {
            return 'xs';
        } else if (width >= 576 && width < 768) {
            return 'sm';
        } else if (width >= 768 && width < 992) {
            return 'md';
        } else if (width >= 992 && width < 1200) {
            return 'lg';
        } else {
            return 'xl';
        }
    }

    // Update screen size display on page load and resize
    function updateScreenSizeDisplay() {
        const screenSize = getBootstrapScreenSize();
        document.getElementById('screenSizeDisplay').innerText = 'Current Bootstrap Screen Size: ' + screenSize;
    }

    // Call the function when the page loads and when the window resizes
    window.addEventListener('load', updateScreenSizeDisplay);
    window.addEventListener('resize', updateScreenSizeDisplay);
</script> -->
    <div>
        <h1 class="result-header">Results</h1>
        <div class="row d-flex justify-content-center">
            <?PHP
            if ($_SERVER['REQUEST_METHOD'] == "GET")
            {
                $PAGE_SIZE = 15;
                $PAGE_NUMBER = 0;
                $boker_words = array(
                    'city', 'zipcode',
                    'price_min', 'price_max',
                    'square_feet_min', 'square_feet_max',
                    'bedroom', 'bathroom',
                    'page'
                );
                
                foreach ($boker_words as $boker_key)
                {
                    if (!isset($_GET[$boker_key]))
                    {
                        $_GET[$boker_key] = NULL;
                    }
                }

                if ($_GET['page'] !== NULL)
                {
                    $PAGE_NUMBER = $_GET['page'];
                }
                
                $result = Properties::searchByFilter(
                    $_GET['city'],
                    $_GET['zipcode'],
                    $_GET['price_min'],
                    $_GET['price_max'],
                    $_GET['square_feet_min'],
                    $_GET['square_feet_max'],
                    $_GET['bedroom'],
                    $_GET['bathroom'],
                    $PAGE_SIZE,
                    $PAGE_NUMBER
                );

                if (!empty($result))
                {
                    foreach ($result as $property)
                    {
                        $formatted_price = UIHelper::toMoney($property->price);
                        $images = $property->getImages();
                        $city = $property->city;
                        $zip = $property->zipcode;
                        $formatted_address = $property->formatAddress();

                        UIHelper::propertyCard(
                            $property->property_id,
                            $formatted_price,
                            $property->bedrooms,
                            $property->bathrooms,
                            $property->square_feet,
                            $formatted_address,
                            "Boker Realty", // we don't have a realtor in the db
                            $images
                        );
                    }
                }
                else
                {
                    print "
                    <div class='justify-content-center'>
                        <h1 class='text-center mb-5'>No results!</h1>
                    </div>
                    ";
                }
            }
            // $format_price = UIHelper::toMoney(300000);
            // UIHelper::propertyCard(
            //     129,
            //     $format_price,
            //     4,
            //     5,
            //     2000,
            //     "boker street 43015",
            //     "boker realty",
            //     array()
            // );
            ?>
            
            <!-- <div class="col-sm-5 col-lg-3 col-md-4 col-xl-3 property-container m-2" pid='129'>
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-target='boker'>
                    <div class="carousel-inner rounded-property-image">
                        <div class="carousel-item active">
                        <img class="d-block w-100 rounded-property-image" src="images/houses/129/0.jpg" alt="First slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100 rounded-property-image" src="images/houses/129/1.jpg" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100 rounded-property-image" src="images/houses/129/2.jpg" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" click-ignore aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" click-ignore aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <div class="row">
                    <h6 class="property-price">$500,000</h6>
                </div>
                <div class="data-holder">
                    <div class="row">
                        <p class="data-row"><span class="data">5</span> bds <span class="data">|</span> <span class="data">4</span> ba <span class="data">|</span> <span class="data">3,711</span> sqft<p>
                        <p class="data-row address">911 Boker Rd, Bokerville, OH 43015</p>
                        <p class="realtor">Boker realty</p>
                    </div>
                </div>
            <div> -->
            <!-- <a class="col-sm-5 col-lg-3 col-md-4 col-xl-2 property-container m-2" href="house/id">
                <img class="property-image" src="images/houses/129/0.jpg">
                <div class="row">
                    <h6 class="property-price">$500,000</h6>
                </div>
                <div class="data-holder">
                    <div class="row">
                        <p class="data-row"><span class="data">5</span> bds <span class="data">|</span> <span class="data">4</span> ba <span class="data">|</span> <span class="data">3,711</span> sqft<p>
                        <p class="data-row address">911 Boker Rd, Bokerville, OH 43015</p>
                        <p class="realtor">Boker realty</p>
                    </div>
                </div>
            </a> -->
        </div>
        <div class="justify-content-center d-flex mt-4 mb-4">
            <button id='prev-btn' class="btn btn-dark mx-1"><i class="fa-solid fa-arrow-left"></i></button>
            <button id='next-btn' class="btn btn-dark mx-1"><i class="fa-solid fa-arrow-right"></i></button>
        </div>
        
        <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <script>
            $('.property-container').click(function()
            {
                var propertyId = $(this).attr('pid');
                var target = event.target;
                if (propertyId && $(target).attr('click-ignore') === undefined)
                {
                    window.location.href = "property.php?id="+propertyId;
                }
            })

            $(document).ready(function()
            {
                function move(up)
                {
                    const url = new URL(window.location.href);
                    
                    movement = up == 1 ? 1 : -1
                    pageNumber = parseInt(url.searchParams.get("page")) || 0;
                    
                    if (pageNumber <= 0 && movement <= -1)
                    {
                        return;
                    }
                    
                    url.searchParams.set("page", pageNumber + movement);
                    var newUrl = url.toString();
                    window.location.href = newUrl;
                }
                $('#prev-btn').click(function()
                {
                    move(-1);
                })
                $('#next-btn').click(function()
                {
                    move(1);
                })
            })
        </script>
    <div>
</body>
</html>