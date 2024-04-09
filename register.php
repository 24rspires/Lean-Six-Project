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
        include_once "UIHelper.php";
        include_once "Account.php";
        
        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $username = UIHelper::checkField("username");
            $password = UIHelper::checkField("password");
            $email = UIHelper::checkField("email");
            $phone = UIHelper::checkField("phone");
            $address = UIHelper::checkField("address");
            if (
                $username &&
                $password &&
                $email &&
                $phone &&
                $address
            )
            {
                $validPhone = UIHelper::validPhone($phone);
                $validEmail = UIHelper::validEmail($email);
                $validPassword = UIHelper::validPassword($password);
                if (
                    $validPhone &&
                    $validEmail &&
                    $validPassword
                    )
                {
                    $account = new Account(
                        username: $username,
                        password: $password,
                        email: $email,
                        phone: $phone,
                        address: $address,
                    );
                    $account->insertIntoDatabase();
                    print "account created";
                }
                else
                {
                    if (!$validPhone)
                    {
                        print "invalid phone<br>";
                    }
                    if (!$validPassword)
                    {
                        print "invalid password<br>";
                    }
                    if (!$validEmail)
                    {
                        print "invalid email<br>";
                    }
                }
                
            }
            else
            {
                print "invalid register";
            }
        }
        ?>
        <form method="post">

            <!-- front end add validation -->
            <label id="username">Username</label>
            <br>
            <input id="username" type="text" placeholder="Username" name="username">
            <br>
            
            <!-- front end add validation minimum 8 characters, 2 numbers, 1 special char max 100 -->
            <label id="password">Password</label>
            <br>
            <input id="Password" type="password" placeholder="Password" name="password">
            <br>

            <!-- front end add validation -->
            <label id="email">Email</label>
            <br>
            <input id="email" type="text" placeholder="Email" name="email">
            <br>

            <!-- front end add validation -->
            <label id="phone">Phone</label>
            <br>
            <input id="phone" type="text" placeholder="Phone" name="phone">
            <br>

            <label id="address">Address</label>
            <br>
            <input id="address" type="address" placeholder="Address" name="address">
            <br>

            <input type="submit" value='sumbit'>
        </form>
    </body>
</html>