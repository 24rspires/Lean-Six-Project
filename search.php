

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="dynamicTitle">boker search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
</head>
<body>
    <?PHP
    // if startSessionIfNotStarted() is not called before
    // the headers are sent the page will error
    // do not move the includes
    include_once "Account.php";
    include_once "Properties.php";
    include_once "UIHelper.php";
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
    <!-- end of form search content goes under here -->
    <style>
        .result-header {
            text-align: center;
            padding: 40px
        }

        .property-container {
            border-radius: 7px;
            padding: 0px;
            /* padding: 0px 10px 0px 10px; */
            text-decoration: none;
            color: black;

            border: 1px solid transparent;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .property-image {
            object-fit: cover;
            width: 100%;
            /* height: 20%; */
            border-top-left-radius: 7px;
            border-top-right-radius: 7px;
        }
        
        .property-price {
            padding-top: 0px;
            padding-bottom: 0px;
            margin: 4px;
            font-weight: bold;
        }

        .data {
            font-weight: 400;
            color: gray;
        }

        .data-row {
            margin: 0px;
        }

        .data-holder {
            padding: 0px 8px 0px 8px;
            margin: 0px;
        }

        .realtor {
            font-weight: 400;
            color: gray;
            font-size: 10px;
            margin: 0px
        }

        .address {
            font-size: 80%;
        }
    </style>
    
    <div id="screenSizeDisplay"></div>

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
</script>
    <div class="container">
        <h1 class="result-header">Results</h1>
        <div class="row d-flex justify-content-center">
            <?PHP
            // query for data
            // load results
            if ($_SERVER['REQUEST_METHOD'] == "GET")
            {
                $PAGE_SIZE = 50;
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

                foreach ($result as $property)
                {
                    $formatted_price = UIHelper::toMoney($property->price);
                    $images = $property->getImages();
                    $address = $property->address;
                    $state = "OH";
                    $city = $property->city;
                    $zip = $property->zip;
                    $formatted_address = "$address, $city, $state $zip";

                    UIHelper::propertyCard(
                        $property->id,
                        $formatted_price,
                        $property->beds,
                        $property->bath,
                        $property->squareFoot,
                        $formatted_address,
                        "Boker Realty", // we don't have a realtor in the db
                        $images
                    );
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
        
    <div>
</body>
</html>