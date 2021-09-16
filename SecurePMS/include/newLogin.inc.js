const itemType = document.getElementById("itemType");
const loginDetails = document.getElementById("loginDetails");
const paymentCard = document.getElementById("paymentCard");
const identityCard = document.getElementById("identityCard");
const licenseKey = document.getElementById("licenseKey");
const secureNotes = document.getElementById("secureNotes");
const popoutAlert = document.getElementById("notification");


function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}


updateType = () => {
    switch (itemType.value) {
        case "loginDetails":
            loginDetails.classList.add("d-block")
            loginDetails.classList.remove("d-none")
            paymentCard.classList.add("d-none")
            identityCard.classList.add("d-none")
            licenseKey.classList.add("d-none")
            secureNotes.classList.add("d-none")
            break;
        case "paymentCard":
            paymentCard.classList.add("d-block")
            paymentCard.classList.remove("d-none")
            loginDetails.classList.add("d-none")
            identityCard.classList.add("d-none")
            licenseKey.classList.add("d-none")
            secureNotes.classList.add("d-none")
            break;
        case "identityCard":
            identityCard.classList.add("d-block")
            identityCard.classList.remove("d-none")
            paymentCard.classList.add("d-none")
            loginDetails.classList.add("d-none")
            licenseKey.classList.add("d-none")
            secureNotes.classList.add("d-none")
            break;
        case "licenseKey":
            licenseKey.classList.add("d-block")
            licenseKey.classList.remove("d-none")
            paymentCard.classList.add("d-none")
            loginDetails.classList.add("d-none")
            identityCard.classList.add("d-none")
            secureNotes.classList.add("d-none")
            break;
        default:
            secureNotes.classList.add("d-block")
            secureNotes.classList.remove("d-none")
            licenseKey.classList.add("d-none")
            paymentCard.classList.add("d-none")
            loginDetails.classList.add("d-none")
            identityCard.classList.add("d-none")
            break;
    }
}

$(".submitItem[data-name='loginDetails']").click(function (event) {
    event.preventDefault();

    var itemTypeValue = itemType.value;
    var name = $("#siteName").val();
    var userName = $("#userName").val();
    var password = $("#userPassword").val();
    var website = $("#website").val();

    var key = getCookie('userpassword');
    var salt = getCookie('hash');

    var encryptedKey = XOR(key, salt);
    var encryptedName = XOR(name, key);
    var encrypteduserName = XOR(userName, key);
    var encryptedPassword = XOR(password, encryptedKey);
    var encryptedWebsite = XOR(website, key);

    $.ajax({
        url: 'include/newLogin.inc.php',
        method: 'POST',
        data: {
            type: itemTypeValue,
            siteName: encryptedName,
            userName: encrypteduserName,
            userPassword: encryptedPassword,
            website: encryptedWebsite
        },
        success: function (data) {
            if (data) {
                popoutAlert.innerHTML = `<div class="alert alert-success alert-dismissible fade show mt-3 w-75" role="alert" id="success-alert">
                    <strong>Item Saved!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`
                window.setTimeout(function () {
                    $("#success-alert").fadeTo(500, 0, function () {
                        $("#success-alert").remove();
                    });
                }, 2000);
                document.getElementById("siteName").value = "";
                document.getElementById("userName").value = "";
                document.getElementById("userPassword").value = "";
                document.getElementById("website").value = "";
            }
        }
    });
});

$(".submitItem[data-name='paymentCard']").click(function (event) {
    event.preventDefault();

    var itemTypeValue = itemType.value;
    var cardName = $("#cardName").val();
    var cardholderName = $("#cardholderName").val();
    var cardNumber = $("#cardNumber").val();
    var expMonth = $("#expMonth").val();
    var expYear = $("#expYear").val();
    var CVV = $("#CVV").val();

    var key = getCookie('userpassword');
    var salt = getCookie('hash');

    var encryptedKey = XOR(key, salt);
    var encryptedcardName = XOR(cardName, key);
    var encryptedcardholderName = XOR(cardholderName, key);
    var encryptedcardNumber = XOR(cardNumber, encryptedKey);
    var encryptedexpMonth = XOR(expMonth, key);
    var encryptedexpYear = XOR(expYear, key);
    var encryptedCVV = XOR(CVV, encryptedKey);

    $.ajax({
        url: 'include/newLogin.inc.php',
        method: 'POST',
        data: {
            type: itemTypeValue,
            cardName: encryptedcardName,
            cardholderName: encryptedcardholderName,
            cardNumber: encryptedcardNumber,
            expMonth: encryptedexpMonth,
            expYear: encryptedexpYear,
            CVV: encryptedCVV
        },
        success: function (data) {
            if (data) {
                popoutAlert.innerHTML = `<div class="alert alert-success alert-dismissible fade show mt-3 w-75" role="alert" id="success-alert">
                    <strong>Item Saved!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`
                window.setTimeout(function () {
                    $("#success-alert").fadeTo(500, 0, function () {
                        $("#success-alert").remove();
                    });
                }, 2000);
                document.getElementById("cardName").value = "";
                document.getElementById("cardholderName").value = "";
                document.getElementById("cardNumber").value = "";
                document.getElementById("expMonth").value = "";
                document.getElementById("expYear").value = "";
                document.getElementById("CVV").value = "";
            }
        }
    });
});

$(".submitItem[data-name='identityCard']").click(function (event) {
    event.preventDefault();

    var itemTypeValue = itemType.value;
    var identityCardName = $("#identityCardName").val();
    var firstName = $("#firstName").val();
    var middleName = $("#middleName").val();
    var lastName = $("#lastName").val();
    var IDuserName = $("#IDuserName").val();
    var companyName = $("#companyName").val();
    var ssNumber = $("#ssNumber").val();
    var passportNumber = $("#passportNumber").val();
    var licenseNumber = $("#licenseNumber").val();
    var userEmail = $("#userEmail").val();
    var phoneNumber = $("#phoneNumber").val();
    var line1Address = $("#line1Address").val();
    var line2Address = $("#line2Address").val();
    var line3Address = $("#line3Address").val();
    var cityTown = $("#cityTown").val();
    var stateProvince = $("#stateProvince").val();
    var postalCode = $("#postalCode").val();
    var country = $("#country").val();

    var key = getCookie('userpassword');
    var salt = getCookie('hash');

    var encryptedKey = XOR(key, salt)
    var encryptedidentityCardName = XOR(identityCardName, key);
    var encryptedfirstName = XOR(firstName, key);
    var encryptedmiddleName = XOR(middleName, key);
    var encryptedlastName = XOR(lastName, key);
    var encryptedIDuserName = XOR(IDuserName, key);
    var encryptedcompanyName = XOR(companyName, key);
    var encryptedssNumber = XOR(ssNumber, encryptedKey);
    var encryptedpassportNumber = XOR(passportNumber, encryptedKey);
    var encryptedlicenseNumber = XOR(licenseNumber, encryptedKey);
    var encrypteduserEmail = XOR(userEmail, key);
    var encryptedphoneNumber = XOR(phoneNumber, key);
    var encryptedline1Address = XOR(line1Address, key);
    var encryptedline2Address = XOR(line2Address, key);
    var encryptedline3Address = XOR(line3Address, key);
    var encryptedcityTown = XOR(cityTown, key);
    var encryptedstateProvince = XOR(stateProvince, key);
    var encryptedpostalCode = XOR(postalCode, key);
    var encryptedcountry = XOR(country, key);

    $.ajax({
        url: 'include/newLogin.inc.php',
        method: 'POST',
        data: {
            type: itemTypeValue,
            identityCardName: encryptedidentityCardName,
            firstName: encryptedfirstName,
            middleName: encryptedmiddleName,
            lastName: encryptedlastName,
            IDuserName: encryptedIDuserName,
            companyName: encryptedcompanyName,
            ssNumber: encryptedssNumber,
            passportNumber: encryptedpassportNumber,
            licenseNumber: encryptedlicenseNumber,
            userEmail: encrypteduserEmail,
            phoneNumber: encryptedphoneNumber,
            line1Address: encryptedline1Address,
            line2Address: encryptedline2Address,
            line3Address: encryptedline3Address,
            cityTown: encryptedcityTown,
            stateProvince: encryptedstateProvince,
            postalCode: encryptedpostalCode,
            country: encryptedcountry
        },
        success: function (data) {
            if (data) {
                popoutAlert.innerHTML = `<div class="alert alert-success alert-dismissible fade show mt-3 w-75" role="alert" id="success-alert">
                    <strong>Item Saved!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`
                window.setTimeout(function () {
                    $("#success-alert").fadeTo(500, 0, function () {
                        $("#success-alert").remove();
                    });
                }, 2000);
                document.getElementById("identityCardName").value = "";
                document.getElementById("firstName").value = "";
                document.getElementById("middleName").value = "";
                document.getElementById("lastName").value = "";
                document.getElementById("IDuserName").value = "";
                document.getElementById("companyName").value = "";
                document.getElementById("ssNumber").value = "";
                document.getElementById("passportNumber").value = "";
                document.getElementById("licenseNumber").value = "";
                document.getElementById("userEmail").value = "";
                document.getElementById("phoneNumber").value = "";
                document.getElementById("line1Address").value = "";
                document.getElementById("line1Address").value = "";
                document.getElementById("line1Address").value = "";
                document.getElementById("cityTown").value = "";
                document.getElementById("stateProvince").value = "";
                document.getElementById("postalCode").value = "";
                document.getElementById("country").value = "default";
            }
        }
    });
});

$(".submitItem[data-name='licenseKey']").click(function (event) {
    event.preventDefault();

    var itemTypeValue = itemType.value;
    var productName = $("#licenseKeyName").val();
    var firstName = $("#licensefirstName").val();
    var lastName = $("#licenselastName").val();
    var licenseKeyNumber = $("#licenseKeyNumber").val();

    var key = getCookie('userpassword');
    var salt = getCookie('hash');

    var encryptedKey = XOR(key, salt)
    var encryptedproductName = XOR(productName, key);
    var encryptedfirstName = XOR(firstName, key);
    var encryptedlastName = XOR(lastName, key);
    var encryptedlicenseKeyNumber = XOR(licenseKeyNumber, encryptedKey);


    $.ajax({
        url: 'include/newLogin.inc.php',
        method: 'POST',
        data: {
            type: itemTypeValue,
            productName: encryptedproductName,
            firstName: encryptedfirstName,
            lastName: encryptedlastName,
            licenseKeyNumber: encryptedlicenseKeyNumber
        },
        success: function (data) {
            if (data) {
                popoutAlert.innerHTML = `<div class="alert alert-success alert-dismissible fade show mt-3 w-75" role="alert" id="success-alert">
                    <strong>Item Saved!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`
                window.setTimeout(function () {
                    $("#success-alert").fadeTo(500, 0, function () {
                        $("#success-alert").remove();
                    });
                }, 2000);
                document.getElementById("noteName").value = "";
                document.getElementById("message").value = "";
            }
        }
    });
});

$(".submitItem[data-name='secureNotes']").click(function (event) {
    event.preventDefault();

    var itemTypeValue = itemType.value;
    var noteName = $("#noteName").val();
    var message = $("#message").val();

    var key = getCookie('userpassword');
    var salt = getCookie('hash');

    var encryptedKey = XOR(key, salt)
    var encryptednoteName = XOR(noteName, key);
    var encryptedmessage = XOR(message, encryptedKey);

    $.ajax({
        url: 'include/newLogin.inc.php',
        method: 'POST',
        data: {
            type: itemTypeValue,
            noteName: encryptednoteName,
            message: encryptedmessage
        },
        success: function (data) {
            if (data) {
                popoutAlert.innerHTML = `<div class="alert alert-success alert-dismissible fade show mt-3 w-75" role="alert" id="success-alert">
                    <strong>Item Saved!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`
                window.setTimeout(function () {
                    $("#success-alert").fadeTo(500, 0, function () {
                        $("#success-alert").remove();
                    });
                }, 2000);
                document.getElementById("noteName").value = "";
                document.getElementById("message").value = "";
            }
        }
    });
});