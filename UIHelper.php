
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

    public static function navBar(): void
    {
        $account = Account::loadSession();
        $loginButton = "<a href='login.php'>Login</a>";

        if ($account !== null) $loginButton = "
                                <form method='post'>
                                    <input type='submit' value='Logout' name='logout' class='logout'>
                                </form>";
        // include account because logout will be in navbar
        // possibly consider adding two navbar functions
        // one with paramater for user and a separate version for logged out mode
        print "
                <nav>
                    <ul class='Nav-Bar'>
                        <li><a href='new-index.php'>Home</a></li>
                        <li>{$loginButton}</li>
                        <li><a href='agents.php'>Agents</a></li>
                    </ul>
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
        $first_image = "images/nohouseimage.jpg";
        if (isset($images[0]))
        {
            $first_image = $images[0];
        }
        print "
            <a class='col-sm-5 col-lg-3 col-md-4 col-xl-2 property-container m-2' href='property.php?id=$pid'>
                <div>
                    <img class='property-image' src='$first_image'>
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
            </a>
        ";
    }
}
?>