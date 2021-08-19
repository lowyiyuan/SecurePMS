<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an Account - SecurePMS</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css"
        integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-3">
        <?php
            if(isset($_GET['error']))
                if($_GET['error'] == "emptyinput") {
                    echo '<div class="alert alert-danger" role="alert">
                            Please fill in all fields!
                        </div>';
                }else if($_GET['error'] == "invaliduname") {
                    echo '<div class="alert alert-danger" role="alert">
                            Invalid username detected, please try again.
                        </div>';
                }else if($_GET['error'] == "invalidemail") {
                    echo '<div class="alert alert-danger" role="alert">
                            You have entered an invalid email, try again.
                        </div>';
                }else if($_GET['error'] == "notmatch") {
                    echo '<div class="alert alert-danger" role="alert">
                            Passwords do not match! Please try again.
                        </div>';
                }else if($_GET['error'] == "usernametaken") {
                    echo '<div class="alert alert-danger" role="alert">
                            The username "<b>'.$_GET['uname'].'</b>" is taken, please choose another username.
                        </div>';
                }else if($_GET['error'] == "stmtfailed") {
                    echo '<div class="alert alert-danger" role="alert">
                            Something went wrong, try again!
                        </div>';
                }else if($_GET['error'] == "none") {
                    echo '<div class="alert alert-success" role="alert">
                            Account created successfully! Log in to continue.
                        </div>';
                }
        ?>
    </div>
    <form class="container border rounded-3 p-3 mt-5 col-3" action="include/register.inc.php" method="POST">
        <h1 class="text-center py-3">create an account</h1>
        <div class="mb-3">
            <label for="txtuname" class="form-label">Userame</label>
            <input type="text" class="form-control" id="txtuname" name="userName" placeholder="Username...">
        </div>
        <div class="mb-3">
            <label for="txtfname" class="form-label">First Name</label>
            <input type="text" class="form-control" id="txtfname" name="firstName" placeholder="First name...">
        </div>
        <div class="mb-3">
            <label for="txtlname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="txtlname" name="lastName" placeholder="Last name...">
        </div>
        <div class="mb-3">
            <label for="txtEmail" class="form-label">Email address</label>
            <input type="email" class="form-control" placeholder="Email..." id="txtEmail" name="userEmail"
                aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="txtPassword" class="form-label">Password</label>
            <div class="input-group">
                <input type="password" class="form-control" placeholder="Password..." id="txtPassword"
                    name="userPassword">
                <span class="input-group-text rounded-end p-0" id="hide"><button type="button"
                        class="input-group-text btn btn-link text-decoration-none text-dark" id="hidePassword"><i
                            class="fas fa-eye-slash"></i></button></span>
                <span class="input-group-text rounded-end p-0 d-none" id="show"><button type="button"
                        class="input-group-text btn btn-link text-decoration-none text-dark" id="showPassword"><i
                            class="fas fa-eye"></i></button></span>
            </div>
        </div>
        <div class="mb-4">
            <label for="txtConfirmPassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" placeholder="Confirm password..." id="txtConfirmPassword"
                name="userConfirmPassword">
        </div>
        <div class="d-grid gap-2 mx-auto">
            <button type="submit" class="btn btn-secondary" name="submit">Sign Up</button>
            <a class="text-center" href="login.php">Already have an account? Log in.</a>
        </div>
    </form>




    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function () {
            $("#hidePassword").click(function () {
                $("#show").removeClass("d-none");
                $("#hide").addClass("d-none");
                $("#txtPassword").attr("type", "text");
            });
            $("#showPassword").click(function () {
                $("#hide").removeClass("d-none");
                $("#show").addClass("d-none");
                $("#txtPassword").attr("type", "password");
            });

        });
    </script>
</body>

</html>