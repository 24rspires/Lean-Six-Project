
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
                        <li><a href='index.php'>Home</a></li>
                        <li>{$loginButton}</li>
                        <li><a href='agents.php'>Agents</a></li>
                    </ul>
                </nav>";

        if (isset($_POST['logout']))
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
}
?>