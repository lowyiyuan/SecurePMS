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
            <div style="width: 600px; height: 800px;">
                <form action="">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control overflow-visible" id="resultEl" readonly>
                        <a class="input-group-text" data-bs-toggle="tooltip" id="copyToClipboard"
                            onclick="copyToClipboard()" data-bs-placement="top" title="Copy to clipboard"><span><i
                                    class="fas fa-copy"></i></span></a>
                    </div>
                    <div>
                        <label for="passwordLength" class="form-label">Length: &nbsp</label><input type="number"
                            id="length" onkeyup="newPassword(), updateSliderValue()" min="10" max="128">
                        <br>
                        <input type="range" class="form-range" min="10" max="128" id="passwordLength" value="14">
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" checked value="" id="lowerCase">
                        <label class="form-check-label" for="flexCheckDefault">
                            include lowercase
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" checked value="" id="upperCase">
                        <label class="form-check-label" for="flexCheckDefault">
                            include uppercase
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" checked value="" id="numberEl">
                        <label class="form-check-label" for="flexCheckDefault">
                            include numbers
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" checked value="" id="symbolsEl">
                        <label class="form-check-label" for="flexCheckDefault">
                            include symbols (!@#$%^&*) only
                        </label>
                    </div>
                    <a class="btn btn-secondary my-3" id="generateEl">Generate Password</a>
                </form>
            </div>
        </div>
    </div>
    <script src="include/generatePassword.inc.js"></script>
    <script>
        window.onload = newPassword(), updateSliderValue();
        generateEl.addEventListener('click', newPassword);
        flavourArray.forEach(function (flavour) {
            flavour.addEventListener("click", newPassword)
        });
        let sliderArray = [updateSliderValue, newPassword];
        sliderArray.forEach(function (update) {
            passwordLength.addEventListener("change", update)
        })
    </script>

</body>

</html>