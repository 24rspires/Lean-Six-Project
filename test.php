<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        if ($_POST['type'] === 'address') {

            $addr = explode(',', $_POST['query']);
            $stateZip = array_pop($addr);
            $stateZip = explode(' ', $stateZip);
            $addr = array_merge($addr, $stateZip);

            $address = trim(urlencode($addr[0]));
            $city = urlencode(ltrim($addr[1]));



            //print_r($addr);
            header("Location: ./search.php?address={$address}&city={$city}&zipcode={$addr[4]}");

        } else if ($_POST['type'] === 'county') {
            header("Location: ./search.php?city={$_POST['query']}");
        }



    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/autocomplete.css">
</head>
<body>

<h2>Autocomplete</h2>

<p>Start typing:</p>

<form autocomplete="off" method="post">
    <div class="autocomplete" style="width:300px;">
        <input id="myInput" type="text" name="query" placeholder="Address">
        <input id="typeInput" name="type" type="hidden" />
    </div>
    <input type="submit" value="Sumbit" name="submit">
</form>
<script src="scripts/autocomplete.js"></script>
</body>
</html>
