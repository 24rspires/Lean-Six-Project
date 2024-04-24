<?PHP
include_once "dbhelper.php";
include_once "General.php";

startSessionIfNotStarted();

class Account {
    public int|NULL $account_id;
    public string|NULL $first_name;
    public string|NULL $last_name;
    public string|NULL $password;
    public string|NULL $email;
    public string|NULL $phone;
    public string|NULL $address;
    public int|null $type;
    public string|NULL $create_date;
    
    public function __construct(int $account_id = null, string $first_name = null, string $last_name = null, string $password = null, string $email = null, string $phone = null, string $address = null, $type = null, string $create_date = null) {
        $this->account_id = $account_id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->password = $password;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
        $this->type = $type;
        $this->create_date = $create_date;
    }

    public static function getFromId(int $id)
    {
        $result = dbhelper::getInstance()->query("SELECT * FROM accounts WHERE account_id=$id");
        
        if ($result !== false) $result = $result->fetch_assoc();

        if ($result !== false && $result !== null)
        {
            return new Account(
                $result["account_id"],
                $result["first_name"],
                $result["last_name"],
                $result["password"],
                $result["email"],
                $result["phone"],
                $result["address"],
                $result["type"],
                $result["create_date"]
            );
        }
    }

    public static function tryLogin(string $email, string $password) : Account|null {
        $result = dbhelper::getInstance()->query("SELECT * FROM accounts WHERE email=\"{$email}\" and password=\"{$password}\"");
        
        if ($result !== false) $result = $result->fetch_assoc();

        if ($result !== false && $result !== null)
        {
            return new Account(
                $result["account_id"],
                $result["first_name"],
                $result["last_name"],
                $result["password"],
                $result["email"],
                $result["phone"],
                $result["address"],
                $result["type"],
                $result["create_date"]
            );
        }

        return null;
    }

    public function saveSession(): void
    {
        // $id = Account::generateGUID();
        // $sessionMan = UserSessionManager::getInstance();
        // setcookie($id, $this);
        // $sessionMan->set($id, $this)
        $_SESSION['user_account'] = serialize($this);
    }

    public static function loadSession() : Account|null
    {
        if (isset($_SESSION['user_account']))
        {
            $account = $_SESSION['user_account'];
            return unserialize($account);
        }
        else
        {
            return null;
        }
    }

    public function insert() : void {
        $first_name = $this->first_name;
        $last_name = $this->last_name;
        $password = $this->password;
        $email = $this->email;
        $phone = $this->phone;
        $type = $this->type;
        $address = $this->address;
        $sql = "INSERT INTO accounts (first_name, last_name, password, email, phone, address, type, create_date) VALUES ('$first_name', '$last_name' , '$password', '$email', '$phone', $type, '$address', NOW())";
        
        dbhelper::getInstance()->query($sql);
    }

    public static function unloadSession() : void
    {
        unset($_SESSION['user_account']);
    }

    public function getProfilePicture()
    {
        $query = "select * from agent_media where agent_id=$this->account_id";
        
        $result = dbhelper::getInstance()->query($query);

        if ($result !== false) $result = $result->fetch_assoc();
        
        if ($result !== null && $result !== false)
        {
            $media_id = $result['media_id'];
            $media_query = "select * from media where media_id=$media_id";
            
            $media_result = dbhelper::getInstance()->query($media_query);
            
            if ($media_result !== false) $media_result = $media_result->fetch_assoc();

            if ($media_result !== null && $media_result !== false)
            {
                $relative_path = $media_result['file_path'];
                return "images/agents/$relative_path";
            }
        }

        return "images/default-agent-profile-picture.png";
    }
}