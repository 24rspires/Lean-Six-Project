
<?PHP
class UIHelper
{
    public static function checkField(string $name) : FALSE|string
    {
        if (!isset($_POST[$name]) || empty($_POST[$name]))
        {
            return false;
        }
        
        return $_POST[$name];
    }

    public static function navBar() {
        print "
            <nav>
                <ul class='Nav-Bar'>
                    <li><a href='index.php'>Home</a></li>
                    <li><a href='login.php'>Login</a></li>
                </ul>
            </nav>";
    }

    public static function validEmail(string $email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function validPhone(string $phone)
    {
        return preg_match('/^\d{10}$/', $phone) === 1;
    }

    public static function validPassword(string $password)
    {
        $length = strlen($password);
        $numbers = preg_match_all('/\d/', $password, $matches);
        
        return $length >= 8 && $numbers >= 2 && $length < 100;
    }
}
?>