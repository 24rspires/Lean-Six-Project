<?PHP
include_once "dbhelper.php";
include_once "General.php";

startSessionIfNotStarted();

class Account {
    public int|NULL $id;
    public string|NULL $username;
    public string|NULL $password;
    public string|NULL $email;
    public string|NULL $phone;
    public string|NULL $address;
    public string|NULL $create_date;
    
    public function __construct(int $id = null, string $username = null, string $password = null, string $email = null, string $phone = null, string $address = null, string $create_date = null) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
        $this->create_date = $create_date;
    }

    public static function getFromId(int $id)
    {
        // TODO work
        $result = dbhelper::getInstance()->query("SELECT * FROM accounts WHERE account_id=$id");
        
        if ($result !== false) $result = $result->fetch_assoc();

        if ($result !== false && $result !== null)
        {
            return new Account(
                $result["account_id"],
                $result["username"],
                $result["password"],
                $result["email"],
                $result["phone"],
                $result["address"],
                $result["create_date"]
            );
        }
    }

    public static function tryLogin(string $username, string $password) : Account|null {
        $result = dbhelper::getInstance()->query("SELECT * FROM accounts WHERE username=\"{$username}\" and password=\"{$password}\"");
        
        if ($result !== false) $result = $result->fetch_assoc();

        if ($result !== false && $result !== null)
        {
            return new Account(
                $result["account_id"],
                $result["username"],
                $result["password"],
                $result["email"],
                $result["phone"],
                $result["address"],
                $result["create_date"]
            );
        }

        return null;
    }

    private static function generateGUID() : string
    {
        return md5(uniqid('', true));
    }

    public function saveSession(): void
    {
        // $id = Account::generateGUID();
        // $sessionMan = UserSessionManager::getInstance();
        // setcookie($id, $this);
        // $sessionMan->set($id, $this)
        $_SESSION['user_account'] = serialize($this);
    }

    public function loadSession() : Account|null
    {
        $account = $_SESSION['user_account'];
        if (isset($account))
        {
            return $account;
        }
        else
        {
            return null;
        }
    }

    public function insertIntoDatabase() : void {
        $un = $this->username;
        $pass = $this->password;
        $em = $this->email;
        $phone = $this->phone;
        $addr = $this->address;
        $sql = "INSERT INTO accounts (username, password, email, phone, address, create_date) VALUES ('$un', '$pass', '$em', '$phone', '$addr', NOW())";
        
        dbhelper::getInstance()->query($sql);
    }

    public function unloadSession() : void
    {
        unset($_SESSION['user_account']);
    }
}