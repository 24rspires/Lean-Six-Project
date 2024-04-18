<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/d316673763.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <div id="screenSize"></div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(window).on('load', function() {
        // Loop through 30 images
        for (var i = 0; i < 30; i++) {
            var imageUrl = 'images/' + i + '.jpg';
            var carouselItemClass = i === 0 ? 'carousel-item active' : 'carousel-item';
            var image = $('<img>').attr('src', imageUrl).addClass('d-block w-100').attr('alt', 'Image ' + (i + 1));
            var carouselItem = $('<div>').addClass(carouselItemClass).append(image);
            $('.carousel-inner').append(carouselItem);
        }
    });

    // Function to get current Bootstrap screen size
    function getBootstrapScreenSize() {
        if ($(window).width() < 576) {
            return 'xs';
        } else if ($(window).width() >= 576 && $(window).width() < 768) {
            return 'sm';
        } else if ($(window).width() >= 768 && $(window).width() < 992) {
            return 'md';
        } else if ($(window).width() >= 992 && $(window).width() < 1200) {
            return 'lg';
        } else {
            return 'xl';
        }
    }

    // Display the current Bootstrap screen size
    $(document).ready(function(){
        $('#screenSize').text('Current Bootstrap Screen Size: ' + getBootstrapScreenSize());
    });

    // Update screen size when window is resized
    $(window).resize(function(){
        $('#screenSize').text('Current Bootstrap Screen Size: ' + getBootstrapScreenSize());
    });
</script>


<div id="main" class="container">
    <div class="row" id="imageRow">
        <div class="col-xl">
            <img src="https://placehold.co/600x600" style="width: 100%; height: auto; margin-bottom: 5px;" alt="" data-bs-toggle="modal" data-bs-target="#imageModal">
        </div>
        <div class="col-xl">
            <div class="row g-3 d-none d-xl-flex">
                <div class="col">
                    <img src="https://placehold.co/200x200" style="width: 100%;" alt="" data-bs-toggle="modal" data-bs-target="#imageModal">
                </div>
                <div class="col">
                    <img src="https://placehold.co/200x200" style="width: 100%; margin-bottom: 15px;" alt="" data-bs-toggle="modal" data-bs-target="#imageModal">
                </div>
            </div>
            <div class="row g-3 d-none d-md-flex">
                <div class="col">
                    <img src="https://placehold.co/200x200" style="width: 100%;" alt="" data-bs-toggle="modal" data-bs-target="#imageModal">
                </div>
                <div class="col">
                    <img src="https://placehold.co/200x200" style="width: 100%; margin-bottom: 15px;" alt="" data-bs-toggle="modal" data-bs-target="#imageModal">
                </div>
            </div>
        </div>
    </div>
    <!-- information row -->
    <div class="row">
        <div class="col-5">
            <h2>$320,000</h2>
            <p style="padding: 0;">614 Boker Drive, Bokerville, BO 12345</p>
        </div>
        <div class="col-5" style="justify-content: space-between;">
            <div class="row">
                <div class="col-4">
                    <p><i style="color: rgb(200, 200, 200);" class="fa-solid fa-bed"></i> <b style="font-size: 1.5rem;">3</b> beds</p>
                </div>
                <div class="col-4">
                    <p><i style="color: rgb(200, 200, 200);" class="fa-solid fa-bath"></i> <b style="font-size: 1.5rem;">3</b> baths</p>
                </div>
                <div class="col-4">
                    <p><i style="color: rgb(200, 200, 200);" class="fa-solid fa-ruler"></i> <b style="font-size: 1.25rem;">1,803</b> sqft</p>
                </div>
            </div>
        </div>
        <div class="col-2" style="align-items: center; justify-content: center; text-align: center;">
            <a href="javascript:dispMessage()">Contact agent</a>
        </div>
    </div>
</div>
<!-- Google Maps Iframe -->
<div class="row">

</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Image Gallery</h5>
                <!-- Add image counter -->
                <span id="imageCounter" class="ms-auto"></span>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Carousel here -->
                <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <!-- php for loop to go through all images for a given property -->
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Another Example of Image Modal with property information on right hand side of image -->
<!-- <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Image Gallery</h5>
                <span id="imageCounter" class="ms-auto"></span>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-9">
                        <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-right">
                            <h5>Additional Information</h5>
                            <p>This is where you can display additional information about the image or property.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->


<!-- Script to update image counter -->
<script>

    function dispMessage() {
        alert('feature not currently avaliable');
    }

    $(window).on('load', function() {
        var carousel = document.getElementById('imageCarousel');
        var imageCounter = document.getElementById('imageCounter');
        var imagesInitialized = false;

        // Function to update image counter
        function updateImageCounter() {
            var currentIndex = Array.from(carousel.querySelectorAll('.carousel-item')).indexOf(carousel.querySelector('.carousel-item.active'));
            var totalItems = document.querySelectorAll('#imageCarousel .carousel-item').length;
            imageCounter.textContent = (currentIndex + 1) + ' of ' + totalItems;
        }

        // Update image counter when the carousel slides
        carousel.addEventListener('slid.bs.carousel', updateImageCounter);

        // Bind click event listener to each image on the main page
        function initializeImageClickEventListeners() {
            if (!imagesInitialized) {
                var images = document.querySelectorAll('.main-page-image');
                images.forEach(function(image) {
                    image.addEventListener('click', function() {
                        // Set default text content for the image counter
                        imageCounter.textContent = '1 of ' + images.length;
                        // Open the modal when an image is clicked
                        $('#imageModal').modal('show');
                    });
                });
                imagesInitialized = true;
            }
        }
        // Trigger the image counter update manually to initialize it
        updateImageCounter();
    });
</script>

</body>
</html>