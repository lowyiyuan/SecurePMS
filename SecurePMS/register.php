<?php include "include/register.php" ?>

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

<body class="bg-dark">

    <form class="container text-light border rounded-3 p-3 mt-5 col-3" action="include/register.php" method="POST">
        <h1 class="text-center py-3">create an account</h1>
        <div class="mb-3">
            <label for="txtuname" class="form-label">Userame</label>
            <input type="text" class="form-control" id="txtuname" name="username" placeholder="bleuberrrry">
        </div>
        <div class="mb-3">
            <label for="txtfname" class="form-label">First Name</label>
            <input type="text" class="form-control" id="txtfname" name="fname" placeholder="John">
        </div>
        <div class="mb-3">
            <label for="txtlname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="txtlname" name="lname" placeholder="Doe">
        </div>
        <div class="mb-3">
            <label for="txtEmail" class="form-label">Email address</label>
            <input type="email" class="form-control" placeholder="joe@example.com" id="txtEmail" name="email" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="txtPassword" class="form-label">Password</label>
            <div class="input-group">
                <input type="password" class="form-control" placeholder="Enter your Password" id="txtPassword" name="password">
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
            <input type="password" class="form-control" placeholder="Re-enter Password" id="txtConfirmPassword">
        </div>
        <div class="d-grid gap-2 mx-auto">
            <button type="submit" class="btn btn-secondary">Sign Up</button>
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