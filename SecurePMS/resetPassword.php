<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css"
        integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <style>
        * {
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body style="margin: 0; overflow:hidden">
    <nav class="navbar navbar-expand-lg navbar-light py-3 bg-light">
        <div class="container">
            <a class="navbar-brand" href="index">SecurePMS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="login">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <?php
if (isset($_GET["reset"])) {
    if ($_GET["reset"] == "success") {
        echo '<div class="alert alert-success" role="alert">If your account exists, you will receive an email from us!</div>';
    } else if ($_GET["reset"] == "noexist") {
        echo '<div class="alert alert-danger" role="alert">User account does not exist!</div>';
    }
}
?>
        <h1>Reset Password</h1>
        <p>An email will be sent to you with instructions on how to reset your password.</p>
        <form action="include/requestReset.inc" method="POST">
            <input type="text" class="form-control mb-3" name="email" placeholder="Enter your email address">
            <button type="submit" class="btn btn-secondary" name="resetRequestSubmit">Reset Password</button>
        </form>


    </div>

</body>

</html>