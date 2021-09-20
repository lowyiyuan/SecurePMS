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

$selector = $_GET["selector"];
$validator = $_GET["validator"];

if (empty($selector) || empty($validator)) {
    echo "We could not validate your request!";
} else if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
    ?>
        <form action="includes/resetPassword.inc" method="POST">
            <div class="mb-3">
                <input type="hidden" class="form-control" name="selector" value="<?php echo $selector; ?>">
            </div>
            <div class="mb-3">
                <input type="hidden" class="form-control" name="validator" value="<?php echo $validator; ?>">
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="pwd" id="" placeholder="Enter a new password...">
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="pwdRepeat" id="" placeholder="Re-enter password...">
            </div>
            <button type="submit" class="form-control" name="resetPasswordSubmit">Reset Password</button>
        </form>

        <?php
}
?>
    </div>

</body>

</html>