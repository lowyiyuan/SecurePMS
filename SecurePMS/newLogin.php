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

<body>
    <?php include 'include/navbar.inc.php'; ?>
    <div class="container my-4" id="viewDetails">
        <h4>Item Information</h4>
        <div>
            <label for="name" class="form-label">Type</label>
            <div class="input-group mb-3">
                <select id="itemType" oninput="updateType()" name="itemType">
                    <option value="loginDetails">Login</option>
                    <option value="paymentCard">Payment Card</option>
                    <option value="identityCard">ID Card</option>
                    <option value="licenseKey">License Key</option>
                    <option value="secureNotes">Secure Notes</option>
                </select>
            </div>
        </div>

        <section class="loginDetails" id="loginDetails">
            <form method="POST" id="loginDetailsForm">
                <input type="text" id="type" name="type" value="loginDetails" hidden>
                <label for="name" class="form-label">Name</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="siteName" name="siteName" placeholder="Enter a name..."
                        value="" autocomplete="off">
                </div>
                <label for="userName" class="form-label">Username</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="userName" name="userName"
                        placeholder="Enter username..." autocomplete="off">
                </div>
                <label for="userPassword" class="form-label">Password</label>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" id="userPassword" name="userPassword"
                        placeholder="Enter a Password..." autocomplete="off">
                    <a href="" class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Check if password has been compromised"><span><i
                                class="fas fa-check-circle"></i></span></a>
                    <a href="" class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Show Password"><span><i class="fas fa-eye"></i></span></a>
                    <a href="" class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Copy to clipboard"><span><i class="fas fa-copy"></i></span></a>
                </div>
                <label for="website" class="form-label">Website</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="website" name="website" placeholder="Enter a Website..."
                        autocomplete="off">
                </div>
                <button type="submit" class="btn submitItem btn-primary">Save Login</button>
            </form>
        </section>


        <section class="paymentCard d-none" id="paymentCard">
            <form action="include/newLogin.inc.php?type=paymentCard" id="paymentCardForm">
                <input type="text" name="type" value="paymentCard" hidden>
                <label for="name" class="form-label">Name</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="siteName" placeholder="Enter a name..." value=""
                        autocomplete="off">
                </div>
                <label for="cardholderName" class="form-label">Cardholder Name</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="cardholderName" placeholder="John Doe"
                        autocomplete="off">
                </div>
                <label for="cardNumber" class="form-label">Card Number</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="cardNumber" autocomplete="off">
                    <a href="" class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Show Password"><span><i class="fas fa-eye"></i></span></a>
                </div>
                <div class="mb-3">
                    <label for="expMonth" class="form-label">Expiry Month</label>
                    <select id="month" class="form-select" name="expMonth">
                        <option value="jan">January / 01</option>
                        <option value="feb">February / 02</option>
                        <option value="mar">March / 03</option>
                        <option value="apr">April / 04</option>
                        <option value="may">May / 05</option>
                        <option value="jun">June / 06</option>
                        <option value="jul">July / 07</option>
                        <option value="aug">August / 08</option>
                        <option value="sep">September / 09</option>
                        <option value="oct">October / 10</option>
                        <option value="nov">November / 11</option>
                        <option value="dec">December / 12</option>
                    </select>
                </div>
                <div>
                    <label for="expYear" class="form-label">Expiry Year</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="expYear" placeholder="Ex. 2021"
                            autocomplete="off">
                    </div>
                </div>
                <label for="CVV" class="form-label">CVV</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="CVV" autocomplete="off">
                    <a href="" class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Show Password"><span><i class="fas fa-eye"></i></span></a>
                </div>
                <button type="submit" class="btn submitItem btn-primary">Save Payment Card</button>
            </form>
        </section>


        <section class="identityCard d-none" id="identityCard">
            <form action="include/newLogin.inc.php?type=identityCard" id="identityCardForm">
                <input type="text" name="type" value="identityCard" hidden>
                <label for="siteName" class="form-label">Name</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="siteName" placeholder="Enter a name..." value=""
                        autocomplete="off">
                </div>
                <label for="firstName" class="form-label">First Name</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="firstName" value="" autocomplete="off">
                </div>
                <label for="middleName" class="form-label">Middle Name</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="middleName" value="" autocomplete="off">
                </div>
                <label for="lastName" class="form-label">Last Name</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="lastName" value="" autocomplete="off">
                </div>
                <label for="userName" class="form-label">Username</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="userName" value="" autocomplete="off">
                </div>
                <label for="companyName" class="form-label">Company Name</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="companyName" value="" autocomplete="off">
                </div>
                <label for="ssNumber" class="form-label">Social Security Number</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="ssNumber" value="" autocomplete="off">
                </div>
                <label for="passportNumber" class="form-label">Passport Number</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="passportNumber" value="" autocomplete="off">
                </div>
                <label for="licenseNumber" class="form-label">License Number</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="licenseNumber" value="" autocomplete="off">
                </div>
                <label for="userEmail" class="form-label">Email</label>
                <div class="input-group mb-3">
                    <input type="email" class="form-control" name="userEmail" value="" autocomplete="off">
                </div>
                <label for="mobileNumber" class="form-label">Phone Number</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="mobileNumber" value="" autocomplete="off">
                </div>
                <label for="line1Address" class="form-label">Address 1</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="line1Address" value="" autocomplete="off">
                </div>
                <label for="line2Address" class="form-label">Address 2</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="line2Address" value="" autocomplete="off">
                </div>
                <label for="line3Address" class="form-label">Address 3</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="line3Address" value="" autocomplete="off">
                </div>
                <label for="cityTown" class="form-label">City / Town</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="cityTown" value="" autocomplete="off">
                </div>
                <label for="stateProvince" class="form-label">State / Province</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="stateProvince" value="" autocomplete="off">
                </div>
                <label for="postalCode" class="form-label">Zip / Postal Code</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="postalCode" value="" autocomplete="off">
                </div>
                <label for="country" class="form-label">Country</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="country" value="" autocomplete="off">
                </div>
                <button type="submit" class="btn submitItem btn-primary">Save ID Card</button>
            </form>
        </section>


        <section class="licenseKey d-none" id="licenseKey">
            <form action="include/newLogin.inc.php?type=licenseKey" id="licenseKeyForm">
                <input type="text" name="type" value="licenseKey" hidden>
                <label for="name" class="form-label">Name</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="siteName" placeholder="Enter a name..." value=""
                        autocomplete="off">
                </div>
                <label for="firstName" class="form-label">First Name</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="firstName" placeholder="Enter first name..." value=""
                        autocomplete="off">
                </div>
                <label for="lastName" class="form-label">Last Name</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="lastName" placeholder="Enter last name..." value=""
                        autocomplete="off">
                </div>
                <label for="licenseKey" class="form-label">License Number</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="licenseKey" placeholder="Enter license key..."
                        value="" autocomplete="off">
                </div>
                <button type="submit" class="btn submitItem btn-primary">Save ID Card</button>
            </form>
        </section>


        <section class="secureNotes d-none" id="secureNotes">
            <form action="include/newLogin.inc.php?type=secureNotes" id="secureNotesForm">
                <input type="text" name="type" value="secureNotes" hidden>
                <label for="name" class="form-label">Name</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="siteName" placeholder="Enter a name..." value=""
                        autocomplete="off">
                </div>
                <label for="name" class="form-label">Message</label>
                <div class="input-group mb-3">
                    <div class="form-floating">
                        <textarea class="form-control" name="message" placeholder="Leave a comment here" id="message"
                            style="height: 150px;"></textarea>
                        <label for="message">Comments</label>
                    </div>
                </div>
                <button type="submit" class="btn submitItem btn-primary">Save Note</button>
            </form>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="include/functions.inc.js"></script>
    <script src="include/newLogin.inc.js"></script>
</body>

</html>