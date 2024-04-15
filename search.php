

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="dynamicTitle">boker search</title>
    <script type="text/javascript">
        var index = 0;
        var titles = [
            "🅱oker",
            "🍺🍺🍺🍺",
            "✡✡✡✡",
            "🐒🐒🐒🐒",
        ];

        function changeTitle() {
            var newTitle = titles[index];
            document.getElementById("dynamicTitle").innerText = newTitle;
            index += 1
            if (index >= titles.length)
            {
                index = 0
            }
        }

        setInterval(changeTitle, 1);
    </script>
</head>
<body>
    <?PHP
    include_once "Account.php";
    include_once "Properties.php";
    
    $boker_words = array(
        'city', 'zipcode',
        'price_min', 'price_max',
        'square_feet_min', 'square_feet_max',
        'bedroom_min', 'bedroom_max',
        'bathroom_min', 'bathroom_max',
    );

    foreach ($boker_words as $boker_key)
    {
        if (!isset($_GET[$boker_key]))
        {
            $_GET[$boker_key] = NULL;
        }
    }

    $result = Properties::searchByFilter(
        $_GET['city'],
        $_GET['zipcode'],
        $_GET['price_min'],
        $_GET['price_max'],
        $_GET['square_feet_min'],
        $_GET['square_feet_max'],
        $_GET['bedroom_min'],
        $_GET['bedroom_max'],
        $_GET['bathroom_min'],
        $_GET['bathroom_max'],
    );
    print_r($result);
    ?>
    <form method="GET">
        
    </form>
</body>
</html>