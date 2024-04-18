<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        if ($_POST['type'] === 'county') {
            header("Location: ./search.php?city={$_POST['query']}");
        } else if ($_POST['type'] === 'zipcode') {
            header("Location: ./search.php?zipcode={$_POST['query']}");
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
        <input id="myInput" type="text" name="query" placeholder="614 Boker Dr, Bokerville, BO 12345">
        <input id="typeInput" name="type" type="hidden" />
        <input id="propId" name="propId" type="hidden" />
    </div>
    <input type="submit" value="Sumbit" name="submit">
</form>
<script src="scripts/autocomplete.js"></script>
</body>
</html>
