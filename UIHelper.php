
<?PHP

include_once "Account.php";

class UIHelper
{
    public static function checkField(string $name) : FALSE|string
    {
        if (!isset($_POST[$name]) || empty($_POST[$name])) {
            return false;
        }
        return $_POST[$name];
    }

    public static function navBar(): void {

        $account = Account::loadSession();
        $loginButton = "<a href='login.php'>Login</a>";

        if ($account !== null) $loginButton = "
                                <form method='post'>
                                    <input type='submit' value='Logout' name='logout' class='logout'>
                                </form>";
        // include account because logout will be in navbar
        // possibly consider adding two navbar functions
        // one with paramater for user and a separate version for logged out mode
        print '
            <section class="nav">
            <div class=" d-flex container justify-content-center">
                <div class="row ">
                    <div class="col">
                        <a href="index.php">Home</a>
                    </div>
                    <div class="col">
                        <a href="agents.php">Agents</a>
                    </div>
                    <div class="col">
                        <a href="login.php">Login</a>
                    </div>
                </div>
            </div>
        </section>';

        if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['logout']))
        {
            Account::unloadSession();

            header("Location: ".  (empty($_SERVER['HTTPS']) ? 'http' : 'https') ."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        }
    }

    public static function validEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function validPhone(string $phone): bool
    {
        return preg_match('/^\d{10}$/', $phone) === 1;
    }

    public static function validPassword(string $password): bool
    {
        $length = strlen($password);
        $numbers = preg_match_all('/\d/', $password, $matches);
        
        return $length >= 8 && $numbers >= 2 && $length < 100;
    }
    
    public static function toMoney($number)
    {        
        $number_str = (string)$number;
        
        $parts = explode('.', $number_str);
        
        $whole_part = '';
        $len = strlen($parts[0]);
        for ($i = $len - 1, $j = 0; $i >= 0; $i--, $j++) {
            $whole_part = $parts[0][$i] . $whole_part;
            if ($j % 3 == 2 && $i != 0) {
                $whole_part = ',' . $whole_part;
            }
        }
        
        $formatted = '$' . $whole_part . (isset($parts[1]) ? '.' . $parts[1] : '');
        
        return $formatted;
    }
    
    public static function agentCard(string $pfpUrl, string $name, string $phone, string $email): void
    {
        print "
            <li class='agent'>
                <img src='{$pfpUrl}' alt='{$name} Profile Picture' class='agent-pfp'>
                <div class='agent-info'>
                    <h3>{$name}</h3>
                    <p>Phone Number: <a href='tel:${phone}''>${phone}</a></p>
                    <p>Email: <a href='mailto:${email}'>${email}</a></p>
                </div>
            </li>
        ";
    }

    public static function propertyCard(int $pid, string $price, int $bds, float $ba, float $sqft, string $address, string $realtor, array $images): void
    {
        // data to get
        // images (click view in progress)
        // 

        $realtor = "Boker realty"; // temporary
        $missing = "images/nohouseimage.jpg";
        if (isset($images[0]))
        {
            $first_image = $images[0];
        }
        
        $imageString = "";

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
                <img class='d-block w-100 rounded-property-image' src='$missing' alt='Missing House Image 404'>
                </div>
            ";
        }

        print "
            <div class='col-sm-5 col-lg-3 col-md-4 col-xl-3 property-container m-2' pid='$pid'>
                <div id='$pid' class='carousel slide' data-ride='carousel'>
                    <div class='carousel-inner rounded-property-image'>
                        $imageString
                    </div>
                    <a class='carousel-control-prev' href='#$pid' role='button' data-slide='prev'>
                        <span class='carousel-control-prev-icon' click-ignore aria-hidden='true'></span>
                        <span class='sr-only'>Previous</span>
                    </a>
                    <a class='carousel-control-next' href='#$pid' role='button' data-slide='next'>
                        <span class='carousel-control-next-icon' click-ignore aria-hidden='true'></span>
                        <span class='sr-only'>Next</span>
                    </a>
                </div>
                <div class='row'>
                    <h6 class='property-price'>$price</h6>
                </div>
                <div class='data-holder'>
                    <div class='row'>
                        <p class='data-row'><span class='data'>$bds</span> bds <span class='data'>|</span> <span class='data'>$ba</span> ba <span class='data'>|</span> <span class='data'>$sqft</span> sqft<p>
                        <p class='data-row address'>$address</p>
                        <p class='realtor'>$realtor</p>
                    </div>
                </div>
            </div>
        ";
    }

    public static function printError($errorMessage)
    {
        print "
            <link rel='preconnect' href='https://fonts.googleapis.com'>
            <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
            <link href='https://fonts.googleapis.com/css2?family=Arvo&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Rubik&display=swap' rel='stylesheet'>
            <style>
                .error-text {
                    font-family: 'Montserrat', sans-serif;
                    font-weight: 500;
                    font-style: normal;
                    font-size: 50px;
                }
        
                .sub-text {
                    font-family: 'Montserrat', sans-serif;
                    font-weight: 500;
                    font-style: normal;
                    font-size: 20px;
                }
            </style>
            <div class='container'>
                <div class='py-4 text-center'>
                    <h1 class='error-text'>An error has occurred!</h1>
                    <h4 class='sub-text'>Error message:</h1>
                <div>
                <p>
                    $errorMessage
                </p>
            </div>
        ";
    }
}
?>