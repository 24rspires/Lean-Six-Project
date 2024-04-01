<?PHP

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

    public function tryLogin($username, $password) : Account|null {
        $result = dbhelper::getInstance()->query("SELECT * FROM accounts WHERE username=\"{$username}\" and password=\"{$password}\"");

        if ($result !== false) $result = $result->fetch_assoc();

        return $result !== false ? new Account($result["id"], $result["username"], $result["password"], $result["email"], $result["phone"], $result["address"]) : null;
    }
}

?>