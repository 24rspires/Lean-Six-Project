<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/autocomplete.css">
</head>
<body>

<h2>Autocomplete</h2>

<p>Start typing:</p>

<form autocomplete="off" action="/action_page.php">
    <div class="autocomplete" style="width:300px;">
        <input id="myInput" type="text" name="myCountry" placeholder="Country">
    </div>
    <input type="submit">
</form>
<script src="scripts/autocomplete.js"></script>
</body>
</html>
