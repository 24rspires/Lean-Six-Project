<?php
include_once "Properties.php";
include_once "Account.php";
include_once "UIHelper.php";

$account = Account::loadSession();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Document</title>

    <style>
        label {
            text-align: left;
            margin-bottom: 3px;
            font-size: 1.5rem;
            font-weight: bold;
        }
    </style>
</head>
<body>

<?PHP
if (!isset($account)) {
    UIHelper::printError("Must be signed in to view page");
    return;
}

if ($account->type < 1) {
    UIHelper::printError("Must be agent to create property");
    return;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['submit'])) {
        $agentId = $account->account_id;
        $address = $_POST['address'];
        $city = $_POST['city'];
        $stateId = intval($_POST['stateId']);
        $zip = $_POST['zip'];
        $price = $_POST['price'];
        $square_feet = $_POST['square_feet'];
        $bedrooms = $_POST['bedrooms'];
        $bathrooms = $_POST['bathrooms'];

        // Create a new property object with the given properties
        $property = new Properties(0, $agentId, $address, $city, $stateId, $zip, $price, $square_feet, $bedrooms, $bathrooms, "");

        // insert the property into the database
        $property->insert();
    }
}
?>
<div class="container justify-content-center align-items-center" id="main">
    <div class="row">
        <div class="col-lg-12 py-5">
            <h1 class="text-center">Create Property</h1>
            <form action="" method="post">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" class="form-control p-3 fs-5" placeholder="614 Boker Drive"> <br>
                <label for="city">City</label>
                <input type="text" name="city" id="city" class="form-control p-3 fs-5" placeholder="Bokerville"> <br>
                <label for="stateId">StateId</label>
                <input type="number" name="stateId" id="stateId" class="form-control p-3 fs-5" placeholder="35"> <br>
                <label for="zip">Zip</label>
                <input type="text" name="zip" id="zip" class="form-control p-3 fs-5" placeholder="12345"> <br>
                <label for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control p-3 fs-5" placeholder="320000"> <br>
                <label for="square_feet">Square Feet</label>
                <input type="text" name="square_feet" id="square_feet" class="form-control p-3 fs-5" placeholder="1803"> <br>
                <label for="bedrooms">Bedrooms</label>
                <input type="text" name="bedrooms" id="bedrooms" class="form-control p-3 fs-5" placeholder="3"> <br>
                <label for="bathrooms">Bathrooms</label>
                <input type="text" name="bathrooms" id="bathrooms" class="form-control p-3 fs-5" placeholder="3"> <br>
                <button type="submit" name="submit" class="btn btn-primary form-control p-3 fs-5">Submit</button>
            </form>
        </div>
    </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>



