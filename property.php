
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/property.css">
    <link rel="stylesheet" href="./css/aspect-ratio.css">
    <link rel="stylesheet" href="./css/nav-bar.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/d316673763.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<?PHP
include_once "Properties.php";
include_once "UIHelper.php";
include_once "State.php";
include_once "Account.php";

class ImageGetter
{
    function __construct($images)
    {
        $this->images = $images;
        $this->index = 0;
        $this->missingImages = ["images/nohouseimage.jpg",
            "images/nohouseimage2.jpg",
            "images/nohouseimage3.jpg",
            "images/nohouseimage4.jpg",];
        $this->missingIndex = 0;
    }
    function getImage()
    {
        if ($this->index < count($this->images))
        {
            $image = $this->images[$this->index];
            $this->index += 1;
            return $image;
        }
        else
        {
            return $this->missingImages[$this->missingIndex++];
        }
    }
    function getRemaining()
    {
        $length = count($this->images);
        $left = $length - $this->index;
        if ($left > 0)
        {
            $images = [];
            foreach ($this->images as $i => $image)
            {
                if ($i > $this->index)
                {
                    $images[] = $image;
                }
            }
            return $images;
        }
        return $this->missingImages;
    }
}

if (isset($_GET['id']))
{
    $property_id = $_GET['id'];
    $property = Properties::getFromId($property_id);
    if (isset($property) && !is_null($property))
    {
        $formatted_address = $property->formatAddress();
        $images = $property->getImages();
        $agent = Account::getFromId($property->agent_id);
        
        define("AGENT", $agent);
        define("IMAGEGETTER", new ImageGetter($images));
        define('PROPERTY', $property);
        define("PRICE", UIHelper::toMoney($property->price));
        define("ADDRESS", $formatted_address);
    }
    else
    {
        UIHelper::printError("No property for the ID provided");
        return;
    }
} else {
    UIHelper::printError("ID is missing");
}
?>

<div id="main" class="container">
    <div class="row d-flex" id="imageRow">
        <!-- change images -->
        <div class="row text-center justify-content-center align-items-center py-3">
            <img id="bigImage" src="<?=IMAGEGETTER->getImage()?>" class="big-image p-0 col-xl-11" data-bs-toggle="modal" data-bs-target="#imageModal">
        </div>
        <!-- <div class="col-xl image-container">
            <img src="<?=IMAGEGETTER->getImage()?>" class="image-container-image" alt="" data-bs-toggle="modal" data-bs-target="#imageModal">
        </div>
        <div class="col-xl">
            <div class="row g-3 d-none d-xl-flex">
                <div class="col">
                    <img src="<?=IMAGEGETTER->getImage()?>" style="width: 100%;" alt="" data-bs-toggle="modal" data-bs-target="#imageModal">
                </div>
                <div class="col">
                    <img src="<?=IMAGEGETTER->getImage()?>" style="width: 100%; margin-bottom: 15px;" alt="" data-bs-toggle="modal" data-bs-target="#imageModal">
                </div>
            </div>
            <div class="row g-3 d-none d-md-flex">
                <div class="col">
                    <img src="<?=IMAGEGETTER->getImage()?>" style="width: 100%;" alt="" data-bs-toggle="modal" data-bs-target="#imageModal">
                </div>
                <div class="col">
                    <img src="<?=IMAGEGETTER->getImage()?>" style="width: 100%; margin-bottom: 15px;" alt="" data-bs-toggle="modal" data-bs-target="#imageModal">
                </div>
            </div>
        </div> -->
    </div>
    <!-- information row -->
    <div class="row">
        <div class="col-5">
            <h2><?=PRICE?></h2>
            <p style="padding: 0;"><?=ADDRESS?></p>
        </div>
        <div class="col-5" style="justify-content: space-between;">
            <div class="row">
                <div class="col-4">
                    <p><i style="color: rgb(200, 200, 200);" class="fa-solid fa-bed"></i> <b style="font-size: 1.5rem;"><?=PROPERTY->bedrooms?></b> beds</p>
                </div>
                <div class="col-4">
                    <p><i style="color: rgb(200, 200, 200);" class="fa-solid fa-bath"></i> <b style="font-size: 1.5rem;"><?=PROPERTY->bathrooms?></b> baths</p>
                </div>
                <div class="col-4">
                    <p><i style="color: rgb(200, 200, 200);" class="fa-solid fa-ruler"></i> <b style="font-size: 1.25rem;"><?=PROPERTY->square_feet?></b> sqft</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-md-center justify-content-lg-start">
        <div class="col-md-10 col-lg-7 col-xl-6 agent-container p-3">
            <h3 class="text-center my-0 agent-title">Agent</h3>
            <div class="row align-items-center">
                <div class="col-5 text-center">
                    <img class="col-11 agent-image" src="<?=AGENT->getProfilePicture()?>">
                </div>
                <div class="col text-start">
                    <h4 class="agent-name"><?=UIHelper::formatAgentName(AGENT->first_name, AGENT->last_name)?></h4>
                    <div class="row my-2">
                        <div class="col-1">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div class="col">
                            <p class="agent-number"><?=UIHelper::formatAgentNumber(AGENT->phone)?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-1  py-0 my-0">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div class="col py-0">
                            <p class="agent-email py-0"><?=AGENT->email?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Image Gallery</h5>
                <!-- Add image counter -->
                <span id="imageCounter" class="ms-auto"></span>
                <button type="button" id="frameCloseButton" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Carousel here -->
                <div id="imageCarousel" class="carousel slide" data-interval="false">
                    <div class="carousel-inner">
                        <?PHP
                            $imageString = "";

                            $images = IMAGEGETTER->getRemaining();

                            if (!empty($images))
                            {
                                foreach ($images as $index => $image)
                                {
                                    if ($index == 0)
                                    {
                                        $imageString .= "
                                            <div class='carousel-item active'>
                                            <img class='d-block w-100 rounded-property-image' src='$image' alt='House Image ($image)'>
                                            </div>
                                        ";
                                    }
                                    else
                                    {
                                        $imageString .= "
                                            <div class='carousel-item'>
                                            <img class='d-block w-100 rounded-property-image' src='$image' alt='House Image ($image)'>
                                            </div>
                                        ";
                                    }
                                }
                            }
                            else
                            {
                                $imageString .= "
                                    <div class='carousel-item active'>
                                    <img class='d-block w-100 rounded-property-image' src='houses/missinghouseimage.jpg' alt='Missing House Image 404'>
                                    </div>
                                ";
                            }
                        
                            print $imageString;
                        ?>
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
        alert('jack says feature not currently avaliable with much love (big riley)');
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

    $('.carousel').carousel({
        interval: false
    });
</script>

</body>
</html>