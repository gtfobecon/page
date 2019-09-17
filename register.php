<?php
// testpass = 1234
$msg = "";
require('mysqli_connect.php');
if (isset($_POST['submit'])) {
    if (empty($_POST["fname"]) || empty($_POST["lname"]) || empty($_POST["email"]) || empty($_POST["password"]) || empty($_POST["rpassword"])) {
        echo "<p style=\"color:red;text-align:center;\">Vui lòng nhập đầy đủ thông tin";
    } else {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $rpassword = $_POST['rpassword'];

        if ($password != $rpassword)
            $msg = "Please check your Password";
        else {
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $conn->query("INSERT INTO users (first_name, last_name, email, password, registration_date, user_level)
            VALUES ('$fname','$lname','$email','$hash', now(), 2)");
            $msg = "You have been registerd!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
</head>

<body>
    <div class="container" style="margin-top: 100px;">
        <div class="row justify-content-center">
            <div class="col-md-6 col-md-offset-3" align="center">
                <img src="ab.png" alt=""><br><br>
                <?php if ($msg != "") echo $msg . "<br><br>"; ?>
                <form action="register.php" method="post">
                    <input class="form-control" name="fname" type="text" placeholder="First name..."><br>
                    <input class="form-control" name="lname" type="text" placeholder="Last name..."><br>
                    <input class="form-control" name="email" type="email" placeholder="Email..."><br>
                    <input class="form-control" name="password" minlength="5" type="password" placeholder="Password..."><br>
                    <input class="form-control" name="rpassword" minlength="5" type="password" placeholder="Confirm Password..."><br>
                    <small id="emailHelp" class="form-text text-muted">You already have account? Do you want to <a href="login.php">login</a>?</small><br>
                    <input class="btn btn-primary" name="submit" type="submit" value="Register...">
                </form>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>