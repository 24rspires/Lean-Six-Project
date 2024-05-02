<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Boker Real Estate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/nav-bar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
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
        <?php if (isset($error)) uiHelper::printError("Invalid email or password!"); ?>
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
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>