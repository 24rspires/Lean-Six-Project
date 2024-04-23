<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Boker Real Estate</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/register.css">
    <link rel="stylesheet" href="./css/nav-bar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
<?php include_once "UIHelper.php"; UIHelper::navBar(); ?>
<div class="container">
    <div class="form-box">
        <h1 id="title">Sign Up</h1>
        <form action="login.php" method="post">
            <div class="input-group">
                <div class="input-field" id="nameField">
                    <i class="fa-solid fa-user-minus"></i>
                    <input type="text" name="firstName" placeholder="First Name">
                </div>

                <div class="input-field">
                    <i class="fa-solid fa-user-plus"></i>
                    <input type="text" name="lastName" placeholder="Last Name">
                </div>

                <div class="input-field">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email">
                </div>

                <div class="input-field">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" placeholder="Password">
                </div>

                <p>Already have an account? <a href="login.php"> Click Here!</a></p>
            </div>

            <div class="btn-field">
                <input type="submit" name="register" value="Sign Up" id="signupBtn">
            </div>
        </form>
    </div>
</div>

</body>
</html>