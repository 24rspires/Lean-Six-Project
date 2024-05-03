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
        $loginButton = "<a class='nav-link active nav-text' href='login.php'>Login</a>";

        if ($account !== null) $loginButton = "
            <div class='dropdown-center mx-2'>
                <button class='btn btn-dark dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>
                    $account->first_name  $account->last_name
                </button>
                <ul class='dropdown-menu dropdown-menu-dark dropdown-menu-end'>
                    <li><a class='dropdown-item nav-font' href='profile.php'>Profile</a></li>
                    <li>
                        <form class='dropdown-item' method='post'>
                            <input type='submit' class='logout-btn h-100 w-100 text-start bg-none border-0' value='Logout' name='logout'>
                        </form>
                    </li>
                </ul>
            </div>
            ";

        if ($account !== null && $account->type > 0) $loginButton .= "
            <div class='navbar-create-icon align-items-center'>
                <a href='create-property.php' class='text-white create-icon text-center'>
                    <i class='fa-solid fa-pen-to-square'></i>
                </a>
            </div>
            <div class='navbar-create-text'>
                <a href='create-property.php' class='text-white navbar-text-style'>
                    Create Property
                </a>
            </div>";

        // include account because logout will be in navbar
        // possibly consider adding two navbar functions
        // one with paramater for user and a separate version for logged out mode
        print "
            <nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
    <div class='container-fluid'>
        <a class='navbar-brand nav-text' href='index.php'>Boker</a>
        <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon'></span>
        </button>
        <div class='collapse navbar-collapse' id='navbarSupportedContent'>
        <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
            <li class='nav-item nav-text'>
                <a class='nav-link active nav-text' aria-current='page' href='agents.php'>Agents</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link active nav-text' aria-current='page' href='FAQ.php'>FAQ</a>
            </li>
        </ul>
            <ul class='navbar-nav'>
                $loginButton
            </ul>
        </div>
    </div>
    </nav>";

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
    
    public static function agentCard(string $pfpUrl, string $name, string $phone, string $email, int $id): void
    {
        

        print "
            <div class='col-md-4 agent-card'>
                <img src='$pfpUrl' alt='Agent PFP $pfpUrl'>
                <h3>$name</h3>
                <p>Email Address: <a href='mailto:$email' class='agent-a'>$email</a></p>
                <p>Phone Number: <a href='tel:$phone' class='agent-a'>$phone</a></p>
                <a href='./agent.php?id=$id' class='btn btn-primary'>Learn More</a>
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
            <div class='col-sm-5 col-lg-3 col-md-4 col-xl-3 property-container m-2' pid='$pid'>
                <div id='boker$pid' class='carousel slide' data-interval='false'>
                    <div class='carousel-inner rounded-property-image'>
                        $imageString
                    </div>
                    <button class='carousel-control-prev' type='button' data-bs-target='#boker$pid' data-bs-slide='prev'>
                        <span class='carousel-control-prev-icon' click-ignore aria-hidden='true'></span>
                        <span class='visually-hidden'>Previous</span>
                    </button>
                    <button class='carousel-control-next' type='button' data-bs-target='#boker$pid' data-bs-slide='next'>
                        <span class='carousel-control-next-icon' click-ignore aria-hidden='true'></span>
                        <span class='visually-hidden'>Next</span>
                    </button>
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

    public static function getMap(String $addr): void {
        $root = __DIR__;
        $address = $addr;
        $env_path = "$root/env.ini";
        if (file_exists($env_path))
        {
            $apiKey = parse_ini_file($env_path)["GOOGLE_API_KEY"];
            print "
                <iframe
                        class=''
                        style='border:0; width: 95vw; height: 50vh;'
                        loading='eager'
                        allowfullscreen
                        referrerpolicy='no-referrer-when-downgrade'
                        src='https://www.google.com/maps/embed/v1/place?key={$apiKey}
                        &q={$address}'>
                </iframe>
            ";
        }
        else
        {
            print "env.ini is missing";
        }
    }

    
    public static function printFAQCard(string $question, string $answer, int $id): void
    {
        print "
         <div class='card'>
            <div class='card-header' id='heading$id'>
                <h2 class='mb-0'>
                    <i class='fa-solid fa-question'></i>
                    <button class='btn btn-link collapsed' type='button' data-toggle='collapse' data-target='#collapse$id' aria-expanded='false' aria-controls='collapseTwo'>
                        $question
                    </button>
                </h2>
            </div>
            <div id='collapse$id' class='collapse' aria-labelledby='headingTwo' data-parent='#accordionExample'>
                <div class='card-body'>
                    $answer
                </div>
            </div>
        </div>";
    }
}
?>