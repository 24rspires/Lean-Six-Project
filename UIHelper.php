
<?PHP

include_once "Account.php";
include_once "State.php";

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
            <div class=' dropdown '>
                <button class='btn btn-secondary dropdown-toggle logout' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    $account->first_name  $account->last_name 
                </button>
                <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                    <form method='post'>
                    <input id='' type='submit' value='logout' name='logout' >
                    </form>
                    <a class='dropdown-item' href='#'>Another action</a>
                    <a class='dropdown-item' href='#'>Something else here</a>
                </div>
            </div>
            ";
        // include account because logout will be in navbar
        // possibly consider adding two navbar functions
        // one with paramater for user and a separate version for logged out mode
        print "
            <section class='nav'>
            <div class=' d-flex container justify-content-center'>
                <div class='row '>
                    <div class='col'>
                        <a href='index.php'>Home</a>
                    </div>
                    <div class='col'>
                        <a href='agents.php'>Agents</a>
                    </div>
                    <div class='col'>
                        $loginButton
                    </div>
                </div>
            </div>
        </section>";

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

    public static function validName(string $name): bool
    {
        return preg_match('/^[a-zA-Z]+$/', $name);
    }

    public static function validAddress(string $address): bool
    {
        // TODO: LUKE FIX NOW();
        return true;
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
            <div class='col-md-4 agent-card'>
                <img src='$pfpUrl' alt='Agent PFP $pfpUrl'>
                <h3>$name</h3>
                <p>Email Address: <a href='mailto:$email' class='agent-a'>$email</a></p>
                <p>Phone Number: <a href='tel:$phone' class='agent-a'>$phone</a></p>
                <a href='#' class='btn btn-primary'>Learn More</a>
            </div>
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
            <div class='col-sm-5 col-lg-3 col-md-4 col-xl-3 property-container m-2' data-bs-toggle='modal' data-bs-target='#staticBackdrop'  pid='$pid'>
                <div id='$pid' class='carousel slide' data-interval='false'>
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

    public static function printError(string $errorMessage, string|null $redirectLink = null)
    {
        if ($redirectLink === null)
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
                    </div>
                    <p class='py-4 text-center'>
                        $errorMessage
                    </p>
                </div>
            ";
        }
        else
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
                    <a href='$redirectLink'>Click this to go back</a>
                </div>
            ";
        }
    }

    public static function printStateOptions()
    {
        foreach (State::getAll() as $state)
        {
            print "<option value='$state->state_id'>$state->name</option>";
        }
    }

    public static function formatAgentName(string $first_name, string $last_name)
    {
        $first = ucwords(strtolower($first_name));
        $last = ucwords(strtolower($last_name));

        return "$first $last";
    }

    public static function formatAgentNumber(string $number): string|null {
        if(strlen($number) != 10 || !is_numeric($number)) {
            return null;
        }
    
        $area_code = substr($number, 0, 3);
        $prefix = substr($number, 3, 3);
        $line_number = substr($number, 6);
        
        return "($area_code) $prefix-$line_number";
    }
}
?>