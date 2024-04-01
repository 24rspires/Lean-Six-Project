<?PHP
include_once "dbhelper.php";

class Account {
    public int $id;
    public string $username;
    public string $password;
    public string $email;
    public string $phone;
    public string $address;

    public function __construct(int $id = null, string $username = null, string $password = null, string $email = null, string $phone = null, string $address = null) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
    }

    public static function tryLogin(string $username, string $password) : Account|null {
        $result = dbhelper::getInstance()->query("SELECT * FROM accounts WHERE username=\"{$username}\" and password=\"{$password}\"");
        
        if ($result !== false) $result = $result->fetch_assoc();
        
        return $result !== false || $result !== null ? new Account($result["account_id"], $result["username"], $result["password"], $result["email"], $result["phone"], $result["address"]) : null;
    }

    private static function generateGUID()
    {
        return md5(uniqid('', true));
    }

    public function save()
    {
        // $id = Account::generateGUID();
        // $sessionMan = UserSessionManager::getInstance();
        // setcookie($id, $this);
        // $sessionMan->set($id, $this)
        $_SESSION['user_account'] = $this;
    }

    public function load() : NULL
    {
        $account = $_SESSION['user_account'];
        if (isset($account))
        {
            return $account;
        }
        else
        {
            return NULL;
        }
    }

    public function unload()
    {
        unsset($_SESSION['user_account']);
    }
}

?>