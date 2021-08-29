<?php session_start(); ?>
<?php require_once 'include/index.inc.php';?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SecurePMS</title>
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
    <?php include 'include/navbar.inc.php'; ?>
    
    <div class="d-flex flex-column justify-content-center" style="min-height: 60vh;">
        <div class="container d-flex justify-content-center d-grid gap-5">
            <div class="text-start">
                <a href="generatePassword" class="btn btn-primary p-5 fs-4"><i class="fas fa-sync"></i> <br> Generate Password</a>
            </div>
            <div class="text-center">
                <a href="viewPassword" class="btn btn-primary p-5 fs-4"><i class="fas fa-lock"></i> <br> My Vault</a>
            </div>
            <div class="text-end">
                <a href="newLogin" class="btn btn-primary p-5 fs-4"><i class="fas fa-plus"></i> <br>Add New Login</a>
            </div>
        </div>
        <div class="container mt-3 d-flex justify-content-center d-grid gap-5">
            <div class="text-start">
                <a href="" class="btn btn-primary p-5 fs-4"><i class="fas fa-user"></i> <br> My Profile</a>
            </div>
            <div class="text-end">
                <a href="" class="btn btn-primary p-5 fs-4"><i class="fas fa-cogs"></i> <br> Settings</a>
            </div>
        </div>
    </div>

</body>

</html>