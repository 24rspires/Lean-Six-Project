<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Profile Settings</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/nav-bar.css">
        <link rel="stylesheet" href="./css/profile.css">
        <link rel="stylesheet" href="./css/style.css">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    <body class="d-flex flex-column justify-content-center align-items-center">
        <?php
            include_once "UIHelper.php";
            include_once "Account.php";
            include_once "dbhelper.php";
            UIHelper::navBar();

            $user = Account::loadSession();

            $errors = [];

            if ($user === null) {
                header("Location: login.php");
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if ($_POST['formType'] === 'Save') {




                    $firstName = $_POST['firstName'];
                    $lastName = $_POST['lastName'];
                    $password = $_POST['password'];
                    $confirmPassword = $_POST['confirmPassword'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];
                    $address = $_POST['address'];

                    if (empty($password) && empty($confirmPassword)) {
                        $password = $user->password;
                        $confirmPassword = $user->password;
                    }

                    if (!UIHelper::validName($firstName) || !UIHelper::validName($lastName)) {
                        $errors[] = "name";
                    }

                    if (!UIHelper::validEmail($email)) {
                        $errors[] = "email";
                    }

                    if (!UIHelper::validPhone($phone)) {
                        $errors[] = "phone";
                    }

                    if (!UIHelper::validAddress($address)) {
                        $errors[] = "address";
                    }

                    if (!UIHelper::validPassword($password) || $password !== $confirmPassword) {
                        $errors[] = "password";
                    }

                    if (count($errors) > 0) {
                        $errorMessage = "Please enter a valid";
                        foreach ($errors as $error) {
                            $errorMessage .= " " . $error;
                        }
                        UIHelper::printError($errorMessage);
                    } else {
                        $user->first_name = $firstName;
                        $user->last_name = $lastName;
                        $user->email = $email;
                        $user->phone = $phone;
                        $user->address = $address;
                        $user->password = $password;
                        $user->insert();
                        $user->saveSession();
                        
                    }
                }
            }
        ?>
        <h1 class="mt-5">Profile Settings</h1>

        <?= count($errors) === 0 ? "
            <div class='alert alert-warning alert-dismissible fade show d-flex justify-content-center align-items-center' role='alert'>
                <p class='my-3'>Account successfully updated!</p>
                <button type='button' class='close my-3' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
            </div>" : "" ?>

        <form method="post" action="profile.php" class="text-left">

            <div class="form-group">
                <label for="firstName">First Name: </label>
                <input type="text" name="firstName" id="firstName" class="form-control" placeholder="First Name" value="<?= $user->first_name?>">
            </div>

            <div class="form-group">
                <label for="lastName">Last Name: </label>
                <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Last Name" value="<?= $user->last_name?>">
            </div>

            <div class="form-group">
                <label for="password">New Password: </label>
                <input type="password" name="password" id="password" class="form-control" placeholder="New Password">
            </div>

            <div class="form-group">
                <label for="confirmPassword">Confirm Password: </label>
                <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" placeholder="Confirm Password">
            </div>

            <div class="form-group">
                <label for="email">Email: </label>
                <input type="email" name="email" id="email" placeholder="Email" class="form-control" value="<?= $user->email?>">
            </div>

            <div class="form-group">
                <label for="phone">Phone: </label>
                <input type="tel" name="phone" id="phone" placeholder="Phone" class="form-control" value="<?= $user->phone?>">
            </div>

            <div class="form-group">
                <label for="address">Address: </label>
                <input type="text" name="address" id="address" placeholder="Address" class="form-control" value="<?= $user->address?>">
            </div>

            <div class="form-group">
                <input type="submit" name="formType" value="Save">
            </div>
        </form>
    </body>
</html>