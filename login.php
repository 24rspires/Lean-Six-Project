<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/login.css">
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
                    header('Location: index.php');
                }
                else
                {
                    print "invalid login";
                }
            }
            else
            {
                print "invalid";
            }
        }
        ?>
    </body>
</html>