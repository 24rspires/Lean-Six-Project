<?PHP
sesion_start();
class LocalUser {
    //static UserSessionManager $instance;

    // public static function getInstance(): UserSessionManager {
    //     if (UserSessionManager::$instance === null) {
    //         UserSessionManager::$instance = new UserSessionManager();
    //     }

    //     return UserSessionManager::$instance;
    // }

    public static function set(string $token, Account $account) : NULL
    {
        $this->tokens[$token] = $account;
    }

    public static function get(string $token) : Account|NULL
    {
        $account = $_SESSION[$token];
        if (isset($account))
        {
            return $account;
        }
        else
        {
            return NULL;
        }
    }

    public static function destroy(string $token) : NULL
    {
        unsset($this->tokens[$token])
    }
}

?>