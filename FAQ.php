<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/nav-bar.css">
    <link rel="stylesheet" href="./css/faq.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Frequently Asked Questions</title>
    <style>
        i {
            height: 100%;
        }
    </style>
</head>
<?php include_once "UIHelper.php"; UIHelper::navBar(); ?>
<body>
    <div class="d-flex container justify-content-center my-4">
        <div class="row">
            <h1>Frequently Asked Questions</h1>
        </div>
    </div>

    <main role="main" class="container">
        <div class="wrap">
           
            <div class="bd-example">
                <div class="accordion" id="accordionExample">

                    <?php

                        const FAQ_CARDS = [
                            ["question"=>"Can Users Create PFPs?", "answer"=>"Only admin and agents can create a pfp."],
                            ["question"=>"What are the responsibilities of a real estate agent?", "answer"=>"A real estate agent is responsible for selling and renting properties.<br> They are also responsible for managing the property's finances, including paying rent and taxes."],
                            ["question"=>"How can I stage my home to maximize its appeal to potential buyers?", "answer"=>"Make sure to include lots of pictures of your home in a nice, clean manner."],
                            ["question"=>"What are the best times to sell a home?", "answer"=>"The best time to sell a home is during the off-season, when the market is at its lowest."],
                            ["question"=>"How can I avoid common pitfalls when investing in real estate?", "answer"=>"Be sure to do your research and work with one of our reputable real estate agents."],
                            ["question"=>"What are the legal requirements for buying a home?", "answer"=>"You will need to meet the following requirements:<br> - You must be at least 18 years old<br> - You must have a valid driver's license<br> - You must have a credit score of at least 600<br> - You must be able to pay the monthly mortgage payment"]
                        ];

                        foreach (FAQ_CARDS as $idx=>$card) {
                            UIHelper::printFAQCard($card["question"], $card["answer"], $idx);
                        }
                    ?>


                </div>
            </div>

        </div>
    </main><!-- /.container -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>