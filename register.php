<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Boker Real Estate</title>
    <link rel="stylesheet" href="./css/register.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>
<?php include_once "UIHelper.php"; UIHelper::navBar(); ?>
<div class="container">
    <div class="form-box">
        <h1 id="title">Sign Up</h1>
        <form>
            <div class="input-group">
                <div class="input-field" id="nameField">
                    <img src="./images/user-svg.svg">
                    <input type="text" placeholder="Name">
                </div>

                <div class="input-field">
                    <img src="./images/email-svg.svg">
                    <input type="email" placeholder="Email">
                </div>

                <div class="input-field">
                    <img src="./images/lock-svg.svg">
                    <input type="password" placeholder="Password">
                </div>
                <p>Forgot your password? <a href="#"> Click Here!</a></p>
            </div>

            <div class="btn-field">
                <button type="button" id="signupBtn">Sign Up</button>
                <button type="button" id="signinBtn" class="disable">Sign In</button>
            </div>
        </form>
    </div>
</div>

<script>
    let signupBtn = document.getElementById("signupBtn");
    let signinBtn = document.getElementById("signinBtn");
    let nameField = document.getElementById("nameField");
    let title = document.getElementById("title");

    signinBtn.onclick = function() {
        nameField.style.maxHeight = "0px";
        title.innerHTML = "Sign In";
        signupBtn.classList.add("disable");
        signinBtn.classList.remove("disable");
    }

    signupBtn.onclick = function() {
        nameField.style.maxHeight = "60px";
        title.innerHTML = "Sign Up";
        signupBtn.classList.remove("disable");
        signinBtn.classList.add("disable");
    }

</script>
</body>
</html>