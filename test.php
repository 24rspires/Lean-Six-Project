<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        $addr = explode(',', $_POST['address']);
        $stateZip = array_pop($addr);
        $stateZip = explode(' ', $stateZip);
        $addr = array_merge($addr, $stateZip);

        $address = trim(urlencode($addr[0]));
        $city = trim($addr[1]);

        //print_r($addr);
        header("Location: ./search.php?address={$address}&city={$city}&state={$addr[3]}&zipcode={$addr[4]}");
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
        <input id="myInput" type="text" name="address" placeholder="Address">
    </div>
    <input type="submit" value="Sumbit" name="submit">
</form>
<script src="scripts/autocomplete.js"></script>
</body>
</html>
