<?php

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/property.css">
    <title>Document</title>
</head>
<body>

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

<div id="boker" class="d-flex container  align-items-center">
<!--        <div class="col">-->
            <div class="col">
                <div class="row row-sm-1 row-md-1 row-lg-4 ms-auto">
                    <img src="https://placehold.co/400x400" alt="placeholder600x600" id="mainImg">
                    <div class="col" id="quad">
                        <div class="col" id="smallRow">
                            <div class="row" id="top">
                                <img src="https://placehold.co/200x200" alt="" id="smallImg">
                                <img src="https://placehold.co/200x200" alt="" id="smallImg">
                            </div>
                            <!--                    <div class="row" id="bottom">-->
                            <!--                        <img src="https://placehold.co/200x200" alt="" id="smallImg">-->
                            <!--                    </div>-->
                        </div>
                        <div class="row" id="smallRow">
                            <div class="col" id="top">
                                <img src="https://placehold.co/200x200" alt="" id="smallImg">
                                <img src="https://placehold.co/200x200" alt="" id="smallImg">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row ms-auto">
                    <div class="col">
                        <p>TETS</p>
                    </div>
                </div>
            </div>
        </div>
<!--    </div>-->
</body>
</html>