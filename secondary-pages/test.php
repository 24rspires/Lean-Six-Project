<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overlay Example with Bootstrap</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles */
        .overlay {
            /* Semi-transparent black background */
            top: 0;
        }
    </style>
</head>
<body>
<!--overlay should be centered-->
<div class="container d-flex jus align-items-center justify-content-center ">
    <div class="overlay position-fixed w-50 h-100 align-items-center justify-content-center">
        <div class="align-items-center justify-content-center text-center">
                <div class="row">
                    <div class="col">
                        <img src="https://placehold.co/600x400" alt="">
                    </div>
                </div>
                <div class="row py-3">
                    <div class="col">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3060.3298203139498!2d-82.78486692373806!3d39.91163468622603!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88387b2623b305a7%3A0x6f4bb6d5cdccb725!2sAndrew%20Bokor%2C%20MD!5e0!3m2!1sen!2sus!4v1713974858448!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
        </div>
    </div>
</div>


<div class="container align-items-center justify-content-center text-center p-0">
    <!-- Your main content goes here -->
    <h1>Welcome to my website</h1>
    <p>This is some content on the page.</p>
</div>

<!-- Bootstrap JS (optional) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
