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
    <style>
        * {
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body style="margin: 0; overflow:hidden">
    <div class="container-fluid" style="min-height: 100vh;">
        <div class="row">
            <div class="col-md-2 px-0 border-end overflow-auto" style="height: 100vh">
                <ul class="list-group border-0 rounded-0">
                    <li class="list-group-item d-flex border-0 justify-content-between align-items-center">
                        <a class="text-decoration-none" href=""><i class="fas fa-key px-2"></i>Passwords</a>
                        <span class="badge bg-primary rounded-pill">14</span>
                    </li>
                    <li class="list-group-item d-flex border-0 justify-content-between align-items-center">
                        <a class="text-decoration-none" href=""><i class="fas fa-credit-card px-2"></i>Payment
                            Cards</a>
                        <span class="badge bg-primary rounded-pill">14</span>
                    </li>
                    <li class="list-group-item d-flex border-0 justify-content-between align-items-center">
                        <a class="text-decoration-none" href=""><i class="fas fa-id-card px-2"></i>Identity
                            Cards</a>
                        <span class="badge bg-primary rounded-pill">14</span>
                    </li>
                    <li class="list-group-item d-flex border-0 justify-content-between align-items-center">
                        <a class="text-decoration-none" href=""><i class="fas fa-id-card px-2"></i>License Keys</a>
                        <span class="badge bg-primary rounded-pill">14</span>
                    </li>
                    <li class="list-group-item d-flex border-0 justify-content-between align-items-center">
                        <a class="text-decoration-none" href=""><i class="fas fa-sticky-note px-2"></i>Secure
                            Notes</a>
                        <span class="badge bg-primary rounded-pill">14</span>
                    </li>
                </ul>
            </div>
            <div class="col-md-5 border-end overflow-auto p-0" style="height: 100vh;">
                <form class="p-2" style="width: 100%;">
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search" id="searchBar">
                    <a href="" id="searchButton"><i class="fas ms-5 fa-search px-2 text-dark"
                            style="position: absolute; top: 1.25rem; left: 63rem;"></i></a>
                </form>
                <div class="list-group rounded-0">
                    <a href="#" class="list-group-item list-group-item-action active border-start-0 border-end-0 py-5"
                        aria-current="true">
                        The current link item
                    </a>
                    <a href="#" class="list-group-item list-group-item-action border-start-0 border-end-0 py-5">A second
                        link item</a>
                    <a href="#" class="list-group-item list-group-item-action border-start-0 border-end-0 py-5">A third
                        link item</a>
                    <a href="#" class="list-group-item list-group-item-action border-start-0 border-end-0 py-5">A fourth
                        link item</a>
                    <a href="#" class="list-group-item list-group-item-action border-start-0 border-end-0 py-5">A fourth
                        link item</a>
                    <a href="#" class="list-group-item list-group-item-action border-start-0 border-end-0 py-5">A fourth
                        link item</a>
                    <a href="#" class="list-group-item list-group-item-action border-start-0 border-end-0 py-5">A fourth
                        link item</a>
                    <a href="#" class="list-group-item list-group-item-action border-start-0 border-end-0 py-5">A fourth
                        link item</a>
                    <a href="#" class="list-group-item list-group-item-action border-start-0 border-end-0 py-5">A fourth
                        link item</a>

                </div>
            </div>
            <div class="col-md-5 overflow-auto" style="height: 100vh;">
                <div class="d-flex justify-content-end">
                    <a class="my-3 btn btn-secondary" href="">Edit</a>
                </div>
                <div class="container w-75">
                    <h4>Item Information</h4>
                    <div>
                        <label for="name" class="form-label">Name</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="username" placeholder="Enter a Name" readonly>
                            <a href="" class="input-group-text"><span><i class="fas fa-copy"></i></span></a>
                        </div>
                    </div>
                    <label for="username" class="form-label">Username</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="username" placeholder="Enter a username" readonly>
                        <a href="" class="input-group-text"><span><i class="fas fa-copy"></i></span></a>
                    </div>
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="password" placeholder="Enter a Password"
                            readonly>
                        <a href="" class="input-group-text"><span><i class="fas fa-check-circle"></i></span></a>
                        <a href="" class="input-group-text"><span><i class="fas fa-eye"></i></span></a>
                        <a href="" class="input-group-text"><span><i class="fas fa-copy"></i></span></a>
                    </div>
                    <label for="website" class="form-label">Website</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="website" placeholder="Enter a Website" readonly>
                        <a href="" class="input-group-text"><span><i class="fas fa-copy"></i></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>