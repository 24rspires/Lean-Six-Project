<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Login</title>
    </head>
    <body>
        <?PHP
        include_once "FormHelper.php";
        include_once "Account.php";
        
        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $username = FormHelper::checkField("username");
            $password = FormHelper::checkField("password");
            if ($username && $password)
            {
                $user = Account::tryLogin($username, $password);
                
                if ($user !== NULL)
                {
                    $user->saveSession();
                    print "saved";
                }
                else
                {
                    echo "invalid login";
                }
            }
            else
            {
                echo "invalid";
            }
        }
        ?>
        <form method="post">
            <label id="username">Username</label>
            <br>
            <input id="username" type="text" placeholder="Username" name="username">
            <br>
            <label id="password">Password</label>
            <br>
            <input id="Password" type="password" placeholder="Password" name="password">
            <br>
            <input type="submit" value='sumbit'>
        </form>
    </body>
</html>