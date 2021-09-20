<?php session_start();?>
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
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body style="margin: 0; overflow:hidden">
    <?php include 'include/navbar.inc.php';?>

    <div class="container" id="notification">
    </div>

    <div class="container mt-5 h-100">
        <div class="d-flex justify-content-center h-100 ">
            <div style="width: 400px; height: 500px;">
                <h1>Edit Information</h1>
                <form action="include/editProfile.inc.php" method="POST">
                    <div class="mb-3">
                        <input type="text" name="uuid" value="<?php echo $_SESSION['userid']; ?>" hidden>
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="newEmail"
                            value="<?php echo $_SESSION['useremail']; ?>">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="newUsername" disabled
                            value="<?php echo $_SESSION['username']; ?>">
                        <label for="username" class="form-label">First Name</label>
                        <input type="text" class="form-control" name="newFname"
                            value="<?php echo $_SESSION['userfname']; ?>">
                        <label for="username" class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="newLname"
                            value="<?php echo $_SESSION['userlname']; ?>">
                        <label for="password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="confirmPass" value="">
                        <div class="d-grid pt-3">
                            <button type="submit" name="save-profile" class="btn btn-primary">Save Profile</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>