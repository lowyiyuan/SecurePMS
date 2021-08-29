<?php session_start(); ?>
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
<body style="overflow:hidden">
    <?php include 'include/navbar.inc.php'; ?>
    <div class="container-fluid" style="min-height: 100vh;">
        <div class="row">
            <div class="col-md-2 px-0 pt-2 border-end overflow-auto" style="height: 100vh">
                <ul class="list-group border-0 rounded-0">
                    <li class="list-group-item d-flex border-0 justify-content-between align-items-center">
                        <a class="text-decoration-none stretched-link" href=""><i
                                class="fas fa-key px-2"></i>Passwords</a>
                        <span class="badge bg-primary rounded-pill">14</span>
                    </li>
                    <li class="list-group-item d-flex border-0 justify-content-between align-items-center">
                        <a class="text-decoration-none stretched-link" href=""><i
                                class="fas fa-credit-card px-2"></i>Payment
                            Cards</a>
                        <span class="badge bg-primary rounded-pill">14</span>
                    </li>
                    <li class="list-group-item d-flex border-0 justify-content-between align-items-center">
                        <a class="text-decoration-none stretched-link" href=""><i
                                class="fas fa-id-card px-2"></i>Identity
                            Cards</a>
                        <span class="badge bg-primary rounded-pill">14</span>
                    </li>
                    <li class="list-group-item d-flex border-0 justify-content-between align-items-center">
                        <a class="text-decoration-none stretched-link" href=""><i
                                class="fas fa-id-card px-2"></i>License Keys</a>
                        <span class="badge bg-primary rounded-pill">14</span>
                    </li>
                    <li class="list-group-item d-flex border-0 justify-content-between align-items-center">
                        <a class="text-decoration-none stretched-link" href=""><i
                                class="fas fa-sticky-note px-2"></i>Secure
                            Notes</a>
                        <span class="badge bg-danger rounded-pill">14</span>
                    </li>
                </ul>
            </div>
            <div class="col-md-5 border-end overflow-auto p-0" style="height: 100vh;">
                <form class="p-2" style="width: 100%;">
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search" id="searchBar">
                    <a href="" id="searchButton"><i class="fas ms-5 fa-search px-2 text-dark"
                            style="position: absolute; top: 5.75rem; left: 63rem;"></i></a>
                </form>
                <div class="list-group rounded-0" id="credentialList">
                <a href="retrievePassword.php" class="list-group-item list-group-item-action border-start-0 border-end-0 py-4">apspace.apu.edu.my<span class="align-middle"><i class="fas float-end fa-chevron-right"></i></span></a>
                <a href="retrievePassword.php" class="list-group-item list-group-item-action border-start-0 border-end-0 py-4">apspace.apu.edu.my<span class="align-middle"><i class="fas float-end fa-chevron-right"></i></span></a>
                <a href="retrievePassword.php" class="list-group-item list-group-item-action border-start-0 border-end-0 py-4">apspace.apu.edu.my<span class="align-middle"><i class="fas float-end fa-chevron-right"></i></span></a>
                <a href="retrievePassword.php" class="list-group-item list-group-item-action border-start-0 border-end-0 py-4">apspace.apu.edu.my<span class="align-middle"><i class="fas float-end fa-chevron-right"></i></span></a>
                <a href="retrievePassword.php" class="list-group-item list-group-item-action border-start-0 border-end-0 py-4">apspace.apu.edu.my<span class="align-middle"><i class="fas float-end fa-chevron-right"></i></span></a>
                <a href="retrievePassword.php" class="list-group-item list-group-item-action border-start-0 border-end-0 py-4">apspace.apu.edu.my<span class="align-middle"><i class="fas float-end fa-chevron-right"></i></span></a>
                <a href="retrievePassword.php" class="list-group-item list-group-item-action border-start-0 border-end-0 py-4">apspace.apu.edu.my<span class="align-middle"><i class="fas float-end fa-chevron-right"></i></span></a>
                <a href="retrievePassword.php" class="list-group-item list-group-item-action border-start-0 border-end-0 py-4">apspace.apu.edu.my<span class="align-middle"><i class="fas float-end fa-chevron-right"></i></span></a>
                <a href="retrievePassword.php" class="list-group-item list-group-item-action border-start-0 border-end-0 py-4">apspace.apu.edu.my<span class="align-middle"><i class="fas float-end fa-chevron-right"></i></span></a>
                <a href="retrievePassword.php" class="list-group-item list-group-item-action border-start-0 border-end-0 py-4">apspace.apu.edu.my<span class="align-middle"><i class="fas float-end fa-chevron-right"></i></span></a>
                <a href="retrievePassword.php" class="list-group-item list-group-item-action border-start-0 border-end-0 py-4">apspace.apu.edu.my<span class="align-middle"><i class="fas float-end fa-chevron-right"></i></span></a>
                <a href="retrievePassword.php" class="list-group-item list-group-item-action border-start-0 border-end-0 py-4">apspace.apu.edu.my<span class="align-middle"><i class="fas float-end fa-chevron-right"></i></span></a>
                <a href="retrievePassword.php" class="list-group-item list-group-item-action border-start-0 border-end-0 py-4">apspace.apu.edu.my<span class="align-middle"><i class="fas float-end fa-chevron-right"></i></span></a>
                <a href="retrievePassword.php" class="list-group-item list-group-item-action border-start-0 border-end-0 py-4">apspace.apu.edu.my<span class="align-middle"><i class="fas float-end fa-chevron-right"></i></span></a>
                <a href="retrievePassword.php" class="list-group-item list-group-item-action border-start-0 border-end-0 py-4">apspace.apu.edu.my<span class="align-middle"><i class="fas float-end fa-chevron-right"></i></span></a>
                <a href="retrievePassword.php" class="list-group-item list-group-item-action border-start-0 border-end-0 py-4">apspace.apu.edu.my<span class="align-middle"><i class="fas float-end fa-chevron-right"></i></span></a>
                <a href="retrievePassword.php" class="list-group-item list-group-item-action border-start-0 border-end-0 py-4">apspace.apu.edu.my<span class="align-middle"><i class="fas float-end fa-chevron-right"></i></span></a>
                </div>
            </div>
            <div class="col-md-5 pt-2 overflow-auto" style="height: 100vh;">
                <div id="viewDetails">
                    <div class="d-flex justify-content-end">
                        <a class="my-3 btn btn-secondary" href="">Edit</a>
                    </div>
                    <div class="container w-75">
                        <h4>Item Information</h4>
                        <div>
                            <label for="name" class="form-label">Name</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="username" placeholder="apspace.apu.edu.my" value="apspace.apu.edu.my"
                                    readonly>
                            </div>
                        </div>
                        <label for="username" class="form-label">Username</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="username" placeholder="TP048107" value="TP048107"
                                readonly>
                            <a href="" class="input-group-text"><span><i class="fas fa-copy"></i></span></a>
                        </div>
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" id="password" placeholder="Enter a Password" value="@4tDUqD67ryU$*"
                                readonly>
                            <a href="" class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="Check if password has been compromised"><span><i class="fas fa-check-circle"></i></span></a>
                            <a href="" class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="Show Password"><span><i class="fas fa-eye"></i></span></a>
                            <a href="" class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="Copy to clipboard"><span><i class="fas fa-copy"></i></span></a>
                        </div>
                        <label for="website" class="form-label">Website</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="website" placeholder="Enter a Website" value="apspace.apu.edu.my" readonly>
                            <a href="" class="input-group-text"><span><i class="fas fa-copy"></i></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <script>
        function getCredentialList() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("credentialList").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "test.php?user=yiyuanlow@gmail.com&q=password", true);
            xhttp.send();
        }
        document.onload = getCredentialList();
    </script> -->
</body>

</html>


function display_array($json_rec) {
            if($json_rec) {
                foreach ($json_rec as $key => $value) {
                    if(is_array($value)){
                        display_array($value);
                    }else{
                        echo $key . $value . '<br>';
                    }
                }
            }
        };

        display_array($dataArray);