<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Boker Real Estate</title>
    <link rel="stylesheet" href="./css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>
<?php include_once "UIHelper.php"; UIHelper::navBar(); ?>
<div class="container">
    <div class="form-box">
        <h1 id="title">Sign In</h1>
        <form method="post">
            <div class="input-group">
                <br>
                <div class="input-field">
                    <img src="./images/email-svg.svg">
                    <input type="text" placeholder="Username" name="username">
                </div>

                <div class="input-field">
                    <img src="./images/lock-svg.svg">
                    <input type="password" placeholder="Password" name="password">
                </div>

                <p>Don't have an account? <a href="register.php"> Click Here!</a></p>
            </div>

            <div id="boker" class="btn-field">
                <input type="submit" value="Sign In" id="signupBtn">
<!--                <button type="button" id="signupBtn"><a href="index.php">Sign In</a></button>-->
            </div>
        </form>
    </div>
</div>

<?PHP
include_once "UIHelper.php";
include_once "Account.php";

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $username = UIHelper::checkField("username");
    $password = UIHelper::checkField("password");
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