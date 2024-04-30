<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Boker Real Estate</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/nav-bar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

<?php
include_once "UIHelper.php";
include_once "Account.php";

$user = Account::loadSession();

if ($user !== null) Header("Location: index.php");

UIHelper::navBar();

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $register = UIHelper::checkField("register");

    if ($register === "Sign Up") {
        $firstName = UIHelper::checkField("firstName");
        $lastName = UIHelper::checkField("lastName");
        $email = UIHelper::checkField("email");
        $password = UIHelper::checkField("password");
        $type = $_POST["type"];

        $account = Account::tryLogin($email, $password);

        if ($account === null)
        {
            $account = new Account(first_name: $firstName, last_name: $lastName, password: $password, email: $email, type: $type);
            $account->insert();
        }
    } else {
        $email = UIHelper::checkField("email");
        $password = UIHelper::checkField("password");
        if ($email && $password) {
            $user = Account::tryLogin($email, $password);

            if ($user !== NULL)
            {
                $user->saveSession();
                header('Location: index.php');
            } else  {
                $error = true;
            }
        } else {
            print "invalid";
        }
    }
}


?>
<div class="container1">
    <div class="form-box">
        <?php if ($error) uiHelper::printError("Invalid email or password!"); ?>
        <h1 id="title">Sign In</h1>
        <form method="post">
            <div class="input-group">
                <br>
                <div class="input-field">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" placeholder="Email" name="email">
                </div>

                <div class="input-field">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" placeholder="Password" name="password">
                </div>

                <p>Don't have an account? <a href="register.php"> Click Here!</a></p>
            </div>

            <div id="boker" class="btn-field">
                <input type="submit" value="Sign In" id="signupBtn">
            </div>
        </form>
    </div>
</div>

</body>
</html>