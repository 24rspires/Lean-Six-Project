<?php
include_once "UIHelper.php";
include_once "Account.php";
include_once "dbhelper.php";
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Profile Settings</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/nav-bar.css">
        <link rel="stylesheet" href="./css/profile.css">
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/aspect-ratio.css">
        
    </head>
    
    <body >
        <?php 
            
            UIHelper::navBar();
        ?> 
    </body>
    <main class="d-flex flex-column justify-content-center align-items-center">

        
        <?php
            $user = Account::loadSession();

            $errors = [];

            if ($user === null) {
                header("Location: login.php");
            }
        $query = dbhelper::getInstance()->query("SELECT * FROM boker.agent_media WHERE agent_id = $user->account_id");

        if ($query->num_rows > 0) {
                $media_id = $query->fetch_assoc()['media_id'];
                $pfpQuery = dbhelper::getInstance()->query("SELECT * FROM boker.media WHERE media_id = $media_id");
                $pfp = $pfpQuery->fetch_assoc()["file_path"];
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

                        if (isset($_FILES['pfp'])) {

                            $fileExtension = explode(".", $_FILES['pfp']['name'])[1];

                            $agentFolder = "C:/xampp/htdocs/adp2/Lean-Six-Project/images/agents/$user->account_id/";

                            if (!file_exists($agentFolder)) {
                                mkdir($agentFolder, recursive: true);
                            }

                            move_uploaded_file($_FILES['pfp']['tmp_name'], "$agentFolder/profile.$fileExtension");

                            if ($query->num_rows === 0) {
                                dbhelper::getInstance()->insertPFP($user->account_id, $fileExtension);
                            }
                        }
                        
                    }
                }
            }
        ?>
        <h1 class="mt-5">Profile Settings</h1>

        <?= count($errors) === 0 && $_SERVER['REQUEST_METHOD'] === 'POST' ? "
            <div class='alert alert-warning alert-dismissible fade show d-flex justify-content-center align-items-center' role='alert'>
                <p class='my-3'>Account successfully updated!</p>
                <button type='button' class='close my-3' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
            </div>" : "" ?>

        <form method="post" action="profile.php" enctype="multipart/form-data" class="text-left">

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

            <?php
                if ($user->type > 0) {
                    echo "
                        <div class='form-group'>
                            <label for='pfp'>Profile Picture: </label>
                            <input type='file' name='pfp' id='pfp' value='Upload Profile Picture' class='form-control-file' accept='.png,.jpg,.jfif'>
                        </div>
                    ";

                    If (isset($pfp)) {
                        echo "
                            <label>Current Profile Picture:</label><br>
                            <img src='./images/agents/$pfp' alt='Profile Picture' />
                        ";
                    }
                }
            ?>

            <div class="form-group">
                <input type="submit" name="formType" value="Save">
            </div>
        </form>
        
    </main>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>