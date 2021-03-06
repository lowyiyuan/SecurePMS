<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SecurePMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css"
        integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <style>
        * {
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
    <div class="container mt-3">
        <?php
if (isset($_GET['error'])) {
    if ($_GET['error'] == "emptyinput") {
        echo '<div class="alert alert-danger" role="alert">
                                        Please fill in all fields!
                                    </div>';
    } else if ($_GET['error'] == "wronglogin") {
        echo '<div class="alert alert-danger" role="alert">
                                        Incorrect Username or Password.
                                    </div>';
    } else if ($_GET['error'] == "logout") {
        echo '<div class="alert alert-success" role="alert">
                                        Logout Successfully!
                                    </div>';
    } else if ($_GET['error'] == "nosession") {
        echo '<div class="alert alert-success" role="alert">
                                        Please login before continuing.
                                    </div>';
    } else if ($_GET['error'] == "relog") {
        echo '<div class="alert alert-success" role="alert">
                                        Please relogin for changes to take effect!
                                    </div>';
    }
} else if (isset($_GET['reset'])) {
    if ($_GET['reset'] == "success") {
        echo '<div class="alert alert-success" role="alert">
                                        Password Reset Successfully!
                                    </div>';
    }
}

?>
    </div>
    <form class="container border rounded rounded-3 p-3 mt-5 col-3" action="include/login.inc" method="POST">
        <h1 class="text-center py-3">login</h1>
        <div class="mb-3">
            <label for="txtUsername" class="form-label">Username/Email</label>
            <input type="text" class="form-control" placeholder="Username/Email..." id="txtUsername" name="userName">
        </div>
        <div class="mb-3">
            <label for="txtPassword" class="form-label">Password</label>
            <div class="input-group">
                <input type="password" class="form-control" placeholder="Password..." id="txtPassword"
                    name="userPassword">
                <span class="input-group-text p-0 rounded-end" id="hide"><button type="button"
                        class="input-group-text btn btn-link text-decoration-none text-dark" id="hidePassword"><i
                            class="fas fa-eye-slash"></i></button></span>
                <span class="input-group-text p-0 rounded-end d-none" id="show"><button type="button"
                        class="input-group-text btn btn-link text-decoration-none text-dark" id="showPassword"><i
                            class="fas fa-eye"></i></button></span>
            </div>
        </div>
        <div class="mb-4">
            <label for="txt2fa" class="form-label">2fa code</label>
            <input type="text" class="form-control" placeholder="Enter 2FA" id="txt2fa">
        </div>
        <div class="d-grid gap-2 mx-auto">
            <button type="submit" class="btn btn-secondary" name="submit">Login</button>
            <a class="text-center" href="resetPassword">Forgot your password?</a>
            <a class="text-center" href="register">Don't have an account? Sign Up</a>
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