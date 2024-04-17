

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="dynamicTitle">boker search</title>
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
    include_once "Account.php";
    include_once "Properties.php";
    
    $boker_words = array(
        'city', 'zipcode',
        'price_min', 'price_max',
        'square_feet_min', 'square_feet_max',
        'bedroom_min', 'bedroom_max',
        'bathroom_min', 'bathroom_max',
    );
    
    foreach ($boker_words as $boker_key)
    {
        if (!isset($_GET[$boker_key]))
        {
            $_GET[$boker_key] = NULL;
        }
    }

    $result = Properties::searchByFilter(
        $_GET['city'],
        $_GET['zipcode'],
        $_GET['price_min'],
        $_GET['price_max'],
        $_GET['square_feet_min'],
        $_GET['square_feet_max'],
        $_GET['bedroom_min'],
        $_GET['bedroom_max'],
        $_GET['bathroom_min'],
        $_GET['bathroom_max'],
    );
    
    // print_r($result[0]->getImages());

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

        <script>
            var defaults = {
                'city': '',
                'zipcode': '',
                'price_min': 0,
                'price_max': 1000000,
                'bathroom': 0,
                'bedroom': 0
            };
            $("#sumbit").click(function(){
                var formData = new FormData(document.getElementById("form"));
                var urlEncodedData = [];
                
                for (var pair of formData.entries()) {
                    var key = pair[0];
                    var val = pair[1];
                    
                    console.log(typeof val);
                    console.log(key);

                    var defaultValue = defaults[key];
                    if (defaults.hasOwnProperty(key))
                    {
                        if (val == defaultValue)
                        {
                            continue;
                        }
                    }

                    urlEncodedData.push(
                        encodeURIComponent(key) + '=' + encodeURIComponent(pair[1])
                    );
                }
                
                var minPrice = $("#slider-range").slider("values", 0);
                var maxPrice = $("#slider-range").slider("values", 1);
                
                urlEncodedData.push(encodeURIComponent("price_min")+"="+encodeURIComponent(minPrice))
                urlEncodedData.push(encodeURIComponent("price_max")+"="+encodeURIComponent(maxPrice))
                // get the price range and append to url encoded data
                
                var urlEncodedString = urlEncodedData.join('&');
                
                window.location.href = "search.php?" + urlEncodedString;
            })
        </script>
    </form>
</body>
</html>