<?php
include_once "Account.php";
include_once "Properties.php";
include_once "UIHelper.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="dynamicTitle">boker search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/aspect-ratio.css">
    <link rel="stylesheet" href="css/nav-bar.css">
    <link rel="stylesheet" href="css/search.css">
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
    UIHelper::navBar();
    ?>
    <form method="GET" id="form">
        <div class="container py-4 justify-content-center align-items-center text-center">
            <div class="d-flex justify-content-center">
                <div class="row g-1">
                    <div class="col dropdown">
                        <button class="btn btn-dark dropdown-toggle" data-bs-auto-close="outside" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Location
                        </button>
                        <div class="dropdown-menu p-2">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" class="form-control">
                            <label for="zipcode">Zipcode</label>
                            <input type="number" id="zipcode" name="zipcode" class="form-control">
                        </div>
                    </div>
                    <div class="col dropdown">
                        <button id="rooms" class="btn btn-dark dropdown-toggle" data-bs-auto-close="outside" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Rooms
                        </button>
                        <div class="dropdown-menu text-center p-2">
                            <div class="row">
                                <h2>Bathrooms</h2>
                                <div class="btn-group" id="bathroomRadios" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check" name="bathroom" id="bathany" value="0" autocomplete="off" checked>
                                    <label class="btn btn-outline-secondary shadow-none" for="bathany">Any</label>

                                    <input type="radio" class="btn-check" name="bathroom" id="bath1" value="1" autocomplete="off">
                                    <label class="btn btn-outline-secondary shadow-none" for="bath1">1+</label>

                                    <input type="radio" class="btn-check" name="bathroom" id="bath2" value="2" autocomplete="off">
                                    <label class="btn btn-outline-secondary shadow-none" for="bath2">2+</label>

                                    <input type="radio" class="btn-check" name="bathroom" id="bath3" value="3" autocomplete="off">
                                    <label class="btn btn-outline-secondary shadow-none" for="bath3">3+</label>

                                    <input type="radio" class="btn-check" name="bathroom" id="bath4" value="4" autocomplete="off">
                                    <label class="btn btn-outline-secondary shadow-none" for="bath4">4+</label>

                                    <input type="radio" class="btn-check" name="bathroom" id="bath5" value="5" autocomplete="off">
                                    <label class="btn btn-outline-secondary shadow-none" for="bath5">5+</label>
                                </div>
                                <!-- <div class="row m-0 p-0 justify-content-center" id="bathroomRadios">
                                    <button class="radio" checked name="bathroom" value="0" type="button">
                                        Any
                                    </button>
                                    <button class="radio" name="bathroom" value="1" type="button">
                                        1+
                                    </button>
                                    <button class="radio" name="bathroom" value="2" type="button">
                                        2+
                                    </button>
                                    <button class="radio" name="bathroom" value="3" type="button">
                                        3+
                                    </button>
                                    <button class="radio" name="bathroom" value="4" type="button">
                                        4+
                                    </button>
                                    <button class="radio" name="bathroom" value="5" type="button">
                                        5+
                                    </button>
                                </div> -->
                            </div>
                            <div class="row">
                                <h2>Bedrooms</h2>
                                <div class="btn-group" role="group">
                                    <input type="radio" class="btn-check" name="bedroom" id="bedany" value="0" autocomplete="off" checked>
                                    <label class="btn btn-outline-secondary shadow-none" for="bedany">Any</label>

                                    <input type="radio" class="btn-check" name="bedroom" id="bed1" value="1" autocomplete="off">
                                    <label class="btn btn-outline-secondary shadow-none" for="bed1">1+</label>

                                    <input type="radio" class="btn-check" name="bedroom" id="bed2" value="2" autocomplete="off">
                                    <label class="btn btn-outline-secondary shadow-none" for="bed2">2+</label>

                                    <input type="radio" class="btn-check" name="bedroom" id="bed3" value="3" autocomplete="off">
                                    <label class="btn btn-outline-secondary shadow-none" for="bed3">3+</label>

                                    <input type="radio" class="btn-check" name="bedroom" id="bed4" value="4" autocomplete="off">
                                    <label class="btn btn-outline-secondary shadow-none" for="bed4">4+</label>

                                    <input type="radio" class="btn-check" name="bedroom" id="bed5" value="5" autocomplete="off">
                                    <label class="btn btn-outline-secondary shadow-none" for="bed5">5+</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col dropdown">
                        <button class="btn btn-dark dropdown-toggle" type="button" data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-expanded="false">
                            Location
                        </button>
                        <div class="dropdown-menu p-4">
                            <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
                            <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
                            <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
                            <script>
                            $(function() {
                                $( "#slider-range").slider({
                                range: true,

                                min: 0,
                                max: 1000000,
                                step: 50000,
                                values: [ 0, 1000000 ],
                                slide: function( event, ui ) {
                                    $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
                                }
                                });
                                $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
                                " - $" + $( "#slider-range" ).slider( "values", 1 ) );
                            });
                            </script>
                            <label for="amount">Price range:</label>
                            <input type="text" class="slider-data" id="amount" readonly="">
                            <div id="slider-range" class="my-2" style="slider-data"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row py-3">
                <div class="col">
                    <button type="button" class="btn btn-dark" id="sumbit">Apply filter</button>
                    <script src="scripts/searchForm.js"></script>
                </div>
            </div>
        </div>
    </form>
    <style>
        #slider-range {
            width: 80%;
        }

        .roomFrame {
            height: 15em;
            width: 30em;
        }

        .slider-dropdown {
            height: 5em;
            width: 20em;
        }

        .modal-dialog,
        .modal-content {
            /* 80% of window height */
            height: 100%;
            margin: 0; /* Remove default margin */
            padding: 0; /* Remove default padding */
        }
        .modal-body-no-scroll {
            overflow: hidden;
            scrollbar-width: none;
            margin: 0; /* Remove default margin */
            padding: 0; /* Remove default padding */
        }
        .modal-dialog {
            width: 70vw; /* Adjust as needed */
            max-width: 100%;
            margin: 0 auto;
        }

        .modal-content {
            background-color: transparent; /* Transparent background */
        }

        .modal-body {
            height: calc(100% - 56px); /* Adjust according to your modal header height */
            background-color: transparent; /* Transparent background */
            position: relative; /* Position relative for absolute positioning */
        }

        .modal-iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        .btn-close {
            position: absolute;
            top: 15px;
            right: 25px;
            z-index: 1050; /* Ensure it's above the modal */
        }

        .radio {
            width: 50px;
            height: 50px;
            padding: 0px !important;
            margin: 0px !important;
            border-right: 0;
            border-left: 0;
            border-top: 2;
            border-bottom: 2;
        }

        .radio:first-child {
            border-left: 2px solid #767676;
            border-top-left-radius: 6px;
            border-bottom-left-radius: 6px;
        }

        .radio:last-child {
            border-right: 2px solid #767676;
            border-top-right-radius: 6px;
            border-bottom-right-radius: 6px;
        }

        .radio {
            border-top: 2px solid #767676;
            border-bottom: 2px solid #767676;
        }

        .radio[checked] {
            background-color: #aeaeae;
        }

        .radio[checked]:hover {
            background-color: #aeaeae;
        }

        .radio:hover {
            background-color: #e3e2e2;
        }
    </style>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                    <button type="button" id="mainCloseButton" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body modal-body-no-scroll">
                    <iframe id="bokerFrame" class="modal-iframe" src="" width="100%" height="100%" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>


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
        </div>
        <div class="justify-content-center d-flex mt-4 mb-4">
            <button id='prev-btn' class="btn btn-dark mx-1"><i class="fa-solid fa-arrow-left"></i></button>
            <button id='next-btn' class="btn btn-dark mx-1"><i class="fa-solid fa-arrow-right"></i></button>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <!-- <script src="scripts/property-card-clicker"> -->
        <script>
            $('.property-container').click(function()
            {
                var propertyId = $(this).attr('pid');
                var target = event.target;
                if (propertyId && $(target).attr('click-ignore') === undefined)
                {
                    $(".modal-body").find("iframe").attr("src", "property.php?id=" + propertyId);
                    $("#staticBackdrop").modal("show");
                }
            })

            let bokerFrame = document.getElementById('bokerFrame');

            bokerFrame.addEventListener('load', function() {
                let bigImage = bokerFrame.contentWindow.document.getElementById('bigImage');
                let frameCloseButton = bokerFrame.contentWindow.document.getElementById('frameCloseButton');
                let agentContainer = bokerFrame.contentWindow.document.getElementById('agentContainer');
                let links = bokerFrame.contentWindow.document.getElementsByClassName('boker');

                bigImage.addEventListener('click', function() {
                    console.log('clicked');
                    $("#mainCloseButton").hide();
                })

                frameCloseButton.addEventListener('click', function() {
                    console.log('clicked');
                    $("#mainCloseButton").show();
                })

            });


            $(".carousel-control-prev").click(function()
            {
                console.log("prev");
                $(this).parent().parent().carousel("prev");
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

                <?php

                if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id'])) {
                    $property_id = $_GET['id'];

                    echo "
                    $('.modal-body').find('iframe').attr('src', 'property.php?id=$property_id');
                    $('#staticBackdrop').modal('show');
                    ";
                }

                ?>
            })
        </script>
    <div>
</body>
</html>