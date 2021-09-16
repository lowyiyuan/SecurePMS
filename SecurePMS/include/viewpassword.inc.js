const displayList = document.getElementById("credentialList");
const passwordCount = document.getElementById("passwordCount");
const paymentCardCount = document.getElementById("paymentCardCount");
const identityCardCount = document.getElementById("identityCardCount");
const licenseKeyCount = document.getElementById("licenseKeyCount");
const secureNotesCount = document.getElementById("secureNotesCount");
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


var key = getCookie('userpassword');
var salt = getCookie('hash');

var result = [];

$.ajax({
    url: 'include/viewpassword.inc.php',
    method: 'GET',
    dataType: "json",
    success: function (data) {
        result.push(data)
        resultArr = result[0];
        passwordCount.innerHTML = resultArr.loginDetails.length;
        paymentCardCount.innerHTML = resultArr.paymentCard.length;
        identityCardCount.innerHTML = resultArr.identityCard.length;
        licenseKeyCount.innerHTML = resultArr.licenseKey.length;
        secureNotesCount.innerHTML = resultArr.secureNotes.length;
    }
});

function searchItem(searchKey) {
    displayList.innerHTML = "";

}

function defaultForm() {
    $("#loginDetailsForm").show()
    $("#paymentCardForm").hide()
    $("#identityCardForm").hide()
    $("#licenseKeyForm").hide()
    $("#secureNotesForm").hide()
}

window.onload = defaultForm();

function showForm(dataName) {
    if (dataName.getAttribute("data-name") === "loginDetails") {
        $("#loginDetailsForm").show()
        $("#paymentCardForm").hide()
        $("#identityCardForm").hide()
        $("#licenseKeyForm").hide()
        $("#secureNotesForm").hide()
    } else if (dataName.getAttribute("data-name") === "paymentCard") {
        $("#loginDetailsForm").hide()
        $("#paymentCardForm").show()
        $("#identityCardForm").hide()
        $("#licenseKeyForm").hide()
        $("#secureNotesForm").hide()
    } else if (dataName.getAttribute("data-name") === "identityCard") {
        $("#loginDetailsForm").hide()
        $("#paymentCardForm").hide()
        $("#identityCardForm").show()
        $("#licenseKeyForm").hide()
        $("#secureNotesForm").hide()
    } else if (dataName.getAttribute("data-name") === "licenseKey") {
        $("#loginDetailsForm").hide()
        $("#paymentCardForm").hide()
        $("#identityCardForm").hide()
        $("#licenseKeyForm").show()
        $("#secureNotesForm").hide()
    } else if (dataName.getAttribute("data-name") === "secureNotes") {
        $("#loginDetailsForm").hide()
        $("#paymentCardForm").hide()
        $("#identityCardForm").hide()
        $("#licenseKeyForm").hide()
        $("#secureNotesForm").show()
    }
}

function getItems(clicked_id) {
    displayList.innerHTML = "";
    if (clicked_id === "loginDetails") {
        for (i = 0; i < resultArr.loginDetails.length; i++) {
            displayList.insertAdjacentHTML('afterbegin', '<a onclick="displayItem(this.id), showForm(this), updateEditButton(this)" data-name="loginDetails" id="' + i + '" class="list-group-item list-group-item-action border-start-0 border-end-0 py-4">' + XOR(resultArr.loginDetails[i].name, key) + '<span class="align-middle"><i class="fas float-end fa-chevron-right"></i></span></a>')
        }
    } else if (clicked_id === "paymentCard") {
        for (i = 0; i < resultArr.paymentCard.length; i++) {
            displayList.insertAdjacentHTML('afterbegin', '<a onclick="displayItem(this.id), showForm(this), updateEditButton(this)" data-name="paymentCard" id="' + i + '" class="list-group-item list-group-item-action border-start-0 border-end-0 py-4">' + XOR(resultArr.paymentCard[i].cardName, key) + '<span class="align-middle"><i class="fas float-end fa-chevron-right"></i></span></a>')
        }
    } else if (clicked_id === "identityCard") {
        for (i = 0; i < resultArr.identityCard.length; i++) {
            displayList.insertAdjacentHTML('afterbegin', '<a onclick="displayItem(this.id), showForm(this), updateEditButton(this)" data-name="identityCard" id="' + i + '" class="list-group-item list-group-item-action border-start-0 border-end-0 py-4">' + XOR(resultArr.identityCard[i].identityCardName, key) + '<span class="align-middle"><i class="fas float-end fa-chevron-right"></i></span></a>')
        }
    } else if (clicked_id === "licenseKey") {
        for (i = 0; i < resultArr.licenseKey.length; i++) {
            displayList.insertAdjacentHTML('afterbegin', '<a onclick="displayItem(this.id), showForm(this), updateEditButton(this)" data-name="licenseKey" id="' + i + '" class="list-group-item list-group-item-action border-start-0 border-end-0 py-4">' + XOR(resultArr.licenseKey[i].productName, key) + '<span class="align-middle"><i class="fas float-end fa-chevron-right"></i></span></a>')
        }
    } else if (clicked_id === "secureNotes") {
        for (i = 0; i < resultArr.secureNotes.length; i++) {
            displayList.insertAdjacentHTML('afterbegin', '<a onclick="displayItem(this.id), showForm(this), updateEditButton(this)" data-name="secureNotes" id="' + i + '" class="list-group-item list-group-item-action border-start-0 border-end-0 py-4">' + XOR(resultArr.secureNotes[i].noteName, key) + '<span class="align-middle"><i class="fas float-end fa-chevron-right"></i></span></a>')
        }
    }
    return clicked_id;
}

function displayItem(displayItemIndex) {
    var dataName = document.getElementById(displayItemIndex).getAttribute("data-name");
    if (dataName === "loginDetails") {
        const siteName = document.getElementById("siteName");
        const userName = document.getElementById("userName");
        const password = document.getElementById("password");
        const website = document.getElementById("website");
        const getPassword = document.getElementById("getPassword");
        siteName.value = XOR(resultArr[dataName][displayItemIndex].name, key);
        userName.value = XOR(resultArr[dataName][displayItemIndex].username, key);
        website.value = XOR(resultArr[dataName][displayItemIndex].website, key);
        password.value = resultArr[dataName][displayItemIndex].password;
        password.setAttribute("type", "password")
        getPassword.setAttribute("data-ref", displayItemIndex)
    } else if (dataName === "paymentCard") {
        const cardName = document.getElementById("cardName");
        const cardholderName = document.getElementById("cardholderName");
        const cardNumber = document.getElementById("cardNumber");
        const expMonth = document.getElementById("expMonth");
        const expYear = document.getElementById("expYear");
        const CVV = document.getElementById("CVV");
        const getCardNumber = document.getElementById("getCardNumber");
        const getCVV = document.getElementById("getCVV");
        cardName.value = XOR(resultArr[dataName][displayItemIndex].cardName, key);
        cardholderName.value = XOR(resultArr[dataName][displayItemIndex].cardholderName, key);
        cardNumber.value = resultArr[dataName][displayItemIndex].cardNumber, key;
        expMonth.value = XOR(resultArr[dataName][displayItemIndex].expMonth, key);
        expYear.value = XOR(resultArr[dataName][displayItemIndex].expYear, key);
        CVV.value = resultArr[dataName][displayItemIndex].CVV;
        cardNumber.setAttribute("type", "password");
        getCardNumber.setAttribute("data-ref", displayItemIndex);
        CVV.setAttribute("type", "password");
        getCVV.setAttribute("data-ref", displayItemIndex);
    } else if (dataName === "identityCard") {
        const identityCardName = document.getElementById("identityCardName");
        const firstName = document.getElementById("firstName");
        const middleName = document.getElementById("middleName");
        const lastName = document.getElementById("lastName");
        const IDuserName = document.getElementById("IDuserName");
        const companyName = document.getElementById("companyName");
        const ssNumber = document.getElementById("ssNumber");
        const passportNumber = document.getElementById("passportNumber");
        const licenseNumber = document.getElementById("licenseNumber");
        const userEmail = document.getElementById("userEmail");
        const phoneNumber = document.getElementById("phoneNumber");
        const line1Address = document.getElementById("line1Address");
        const line2Address = document.getElementById("line2Address");
        const line3Address = document.getElementById("line3Address");
        const cityTown = document.getElementById("cityTown");
        const stateProvince = document.getElementById("stateProvince");
        const postalCode = document.getElementById("postalCode");
        const country = document.getElementById("country");
        const getssNumber = document.getElementById("getssNumber");
        const getpassportNumber = document.getElementById("getpassportNumber");
        const getlicenseNumber = document.getElementById("getlicenseNumber");
        identityCardName.value = XOR(resultArr[dataName][displayItemIndex].identityCardName, key);
        firstName.value = XOR(resultArr[dataName][displayItemIndex].firstName, key);
        middleName.value = XOR(resultArr[dataName][displayItemIndex].middleName, key);
        lastName.value = XOR(resultArr[dataName][displayItemIndex].lastName, key);
        IDuserName.value = XOR(resultArr[dataName][displayItemIndex].IDuserName, key);
        companyName.value = XOR(resultArr[dataName][displayItemIndex].companyName, key);
        ssNumber.value = resultArr[dataName][displayItemIndex].ssNumber;
        passportNumber.value = resultArr[dataName][displayItemIndex].passportNumber;
        licenseNumber.value = resultArr[dataName][displayItemIndex].licenseNumber;
        userEmail.value = XOR(resultArr[dataName][displayItemIndex].userEmail, key);
        phoneNumber.value = XOR(resultArr[dataName][displayItemIndex].phoneNumber, key);
        line1Address.value = XOR(resultArr[dataName][displayItemIndex].line1Address, key);
        line2Address.value = XOR(resultArr[dataName][displayItemIndex].line2Address, key);
        line3Address.value = XOR(resultArr[dataName][displayItemIndex].line3Address, key);
        cityTown.value = XOR(resultArr[dataName][displayItemIndex].cityTown, key);
        stateProvince.value = XOR(resultArr[dataName][displayItemIndex].stateProvince, key);
        postalCode.value = XOR(resultArr[dataName][displayItemIndex].postalCode, key);
        country.value = XOR(resultArr[dataName][displayItemIndex].country, key);
        ssNumber.setAttribute("type", "password");
        getssNumber.setAttribute("data-ref", displayItemIndex);
        passportNumber.setAttribute("type", "password");
        getpassportNumber.setAttribute("data-ref", displayItemIndex);
        licenseNumber.setAttribute("type", "password");
        getlicenseNumber.setAttribute("data-ref", displayItemIndex);

    } else if (dataName === "licenseKey") {
        const productName = document.getElementById("productName");
        const firstName = document.getElementById("licenseFirstName");
        const lastName = document.getElementById("licenseLastName");
        const licenseKeyNumber = document.getElementById("licenseKeyNumber");
        const getlicenseKeyNumber = document.getElementById("getlicenseKeyNumber");
        productName.value = XOR(resultArr[dataName][displayItemIndex].productName, key);
        firstName.value = XOR(resultArr[dataName][displayItemIndex].firstName, key);
        lastName.value = XOR(resultArr[dataName][displayItemIndex].lastName, key);
        licenseKeyNumber.value = resultArr[dataName][displayItemIndex].licenseKeyNumber;
        licenseKeyNumber.setAttribute("type", "password");
        getlicenseKeyNumber.setAttribute("data-ref", displayItemIndex);

    } else if (dataName === "secureNotes") {
        const noteName = document.getElementById("noteName");
        const message = document.getElementById("message");
        const getMessage = document.getElementById("getMessage");
        noteName.value = XOR(resultArr[dataName][displayItemIndex].noteName, key);
        message.value = resultArr[dataName][displayItemIndex].message;
        message.setAttribute("type", "password");
        getMessage.setAttribute("data-ref", displayItemIndex);
    }
}

function openInNewTab() {
    link = document.getElementById("website");
    if (link.value != "") {
        if (link.value.substring(0, 8) === "https://") {
            window.open(link.value);
        } else if (link.value.substring(0, 7) === "http://") {
            window.open(link.value);
        } else {
            window.open("https://" + link.value);
        }
    }
}

function retrievePassword(field) {
    var encryptedKey = XOR(key, salt);
    if (field === 'password') {
        if (password.value != "") {
            var dataRef = document.getElementById("getPassword").getAttribute("data-ref");
            var fieldType = password.getAttribute("type");
            var dataName = document.getElementById(dataRef).getAttribute("data-name");
            if (fieldType === "text") {
                password.value = XOR(resultArr[dataName][dataRef].password, encryptedKey);
            } else {
                password.value = resultArr[dataName][dataRef].password;
            }
        }
    } else if (field === 'cardNumber') {
        if (cardNumber.value != "") {
            var dataRef = document.getElementById("getCardNumber").getAttribute("data-ref");
            var fieldType = cardNumber.getAttribute("type");
            var dataName = document.getElementById(dataRef).getAttribute("data-name");
            if (fieldType === "text") {
                cardNumber.value = XOR(resultArr[dataName][dataRef].cardNumber, encryptedKey);
            } else {
                cardNumber.value = resultArr[dataName][dataRef].cardNumber;
            }
        }
    } else if (field === 'CVV') {
        if (CVV.value != "") {
            var dataRef = document.getElementById("getCVV").getAttribute("data-ref");
            var fieldType = CVV.getAttribute("type");
            var dataName = document.getElementById(dataRef).getAttribute("data-name");
            if (fieldType === "text") {
                CVV.value = XOR(resultArr[dataName][dataRef].CVV, encryptedKey);
            } else {
                CVV.value = resultArr[dataName][dataRef].CVV;
            }
        }
    } else if (field === 'ssNumber') {
        if (ssNumber.value != "") {
            var dataRef = document.getElementById("getssNumber").getAttribute("data-ref");
            var fieldType = ssNumber.getAttribute("type");
            var dataName = document.getElementById(dataRef).getAttribute("data-name");
            if (fieldType === "text") {
                ssNumber.value = XOR(resultArr[dataName][dataRef].ssNumber, encryptedKey);
            } else {
                ssNumber.value = resultArr[dataName][dataRef].ssNumber;
            }
        }
    } else if (field === 'passportNumber') {
        if (passportNumber.value != "") {
            var dataRef = document.getElementById("getpassportNumber").getAttribute("data-ref");
            var fieldType = passportNumber.getAttribute("type");
            var dataName = document.getElementById(dataRef).getAttribute("data-name");
            if (fieldType === "text") {
                passportNumber.value = XOR(resultArr[dataName][dataRef].passportNumber, encryptedKey);
            } else {
                passportNumber.value = resultArr[dataName][dataRef].passportNumber;
            }
        }
    } else if (field === 'licenseNumber') {
        if (licenseNumber.value != "") {
            var dataRef = document.getElementById("getlicenseNumber").getAttribute("data-ref");
            var fieldType = licenseNumber.getAttribute("type");
            var dataName = document.getElementById(dataRef).getAttribute("data-name");
            if (fieldType === "text") {
                licenseNumber.value = XOR(resultArr[dataName][dataRef].licenseNumber, encryptedKey);
            } else {
                licenseNumber.value = resultArr[dataName][dataRef].licenseNumber;
            }
        }
    } else if (field === 'licenseKeyNumber') {
        if (licenseKeyNumber.value != "") {
            var dataRef = document.getElementById("getlicenseKeyNumber").getAttribute("data-ref");
            var fieldType = licenseKeyNumber.getAttribute("type");
            var dataName = document.getElementById(dataRef).getAttribute("data-name");
            if (fieldType === "text") {
                licenseKeyNumber.value = XOR(resultArr[dataName][dataRef].licenseKeyNumber, encryptedKey);
            } else {
                licenseKeyNumber.value = resultArr[dataName][dataRef].licenseKeyNumber;
            }
        }
    } else if (field === 'message') {
        if (message.value != "") {
            var dataRef = document.getElementById("getMessage").getAttribute("data-ref");
            var fieldType = message.getAttribute("type");
            var dataName = document.getElementById(dataRef).getAttribute("data-name");
            if (fieldType === "text") {
                message.value = XOR(resultArr[dataName][dataRef].message, encryptedKey);
            } else {
                message.value = resultArr[dataName][dataRef].message;
            }
        }
    }

}

function checkCompromise() {
    var encryptedKey = XOR(key, salt);
    if (password.getAttribute("type") === "text") {
        toCheck = password.value;
    } else {
        toCheck = XOR(password.value, encryptedKey);
    }
    if (password.value != "") {
        isPasswordCompromised(toCheck).then(isCompromised => {
            if (isCompromised === false) {
                popoutAlert.innerHTML = `<div class="alert alert-success alert-dismissible fade show mt-3 w-75" role="alert" id="success-alert">
                    <strong>Congrats, your password is not compromised!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`
                window.setTimeout(function () {
                    $("#success-alert").fadeTo(500, 0, function () {
                        $("#success-alert").remove();
                    });
                }, 2000);
            } else {
                popoutAlert.innerHTML = `<div class="alert alert-danger alert-dismissible fade show mt-3 w-75" role="alert" id="success-alert">
                    <strong>Your password is compromised! Please change it immediately.</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`
                window.setTimeout(function () {
                    $("#success-alert").fadeTo(500, 0, function () {
                        $("#success-alert").remove();
                    });
                }, 2000);
            }
        })
    }
}

function showPassword(toShow) {
    if (toShow === "password") {
        if (password.getAttribute("type") === "password") {
            password.setAttribute("type", "text")
        } else {
            password.setAttribute("type", "password")
        }
    } else if (toShow === "cardNumber") {
        if (cardNumber.getAttribute("type") === "password") {
            cardNumber.setAttribute("type", "text")
        } else {
            cardNumber.setAttribute("type", "password")
        }
    } else if (toShow === "CVV") {
        if (CVV.getAttribute("type") === "password") {
            CVV.setAttribute("type", "text")
        } else {
            CVV.setAttribute("type", "password")
        }
    } else if (toShow === "ssNumber") {
        if (ssNumber.getAttribute("type") === "password") {
            ssNumber.setAttribute("type", "text")
        } else {
            ssNumber.setAttribute("type", "password")
        }
    } else if (toShow === "passportNumber") {
        if (passportNumber.getAttribute("type") === "password") {
            passportNumber.setAttribute("type", "text")
        } else {
            passportNumber.setAttribute("type", "password")
        }
    } else if (toShow === "licenseNumber") {
        if (licenseNumber.getAttribute("type") === "password") {
            licenseNumber.setAttribute("type", "text")
        } else {
            licenseNumber.setAttribute("type", "password")
        }
    } else if (toShow === "licenseKeyNumber") {
        if (licenseKeyNumber.getAttribute("type") === "password") {
            licenseKeyNumber.setAttribute("type", "text")
        } else {
            licenseKeyNumber.setAttribute("type", "password")
        }
    } else if (toShow === "message") {
        if (message.getAttribute("type") === "password") {
            message.setAttribute("type", "text")
        } else {
            message.setAttribute("type", "password")
        }
    }
}

function copyToClipboard(type) {
    encryptedKey = XOR(key, salt);
    if (type === "username") {
        copyEl = document.getElementById("userName");
    } else if (type === "password") {
        copyEl = document.getElementById("password");
    } else if (type === "website") {
        copyEl = document.getElementById("website");
    } else if (type === "cardNumber") {
        copyEl = document.getElementById("cardNumber")
    } else if (type === "CVV") {
        copyEl = document.getElementById("CVV");
    } else if (type === "ssNumber") {
        copyEl = document.getElementById("ssNumber");
    } else if (type === "passportNumber") {
        copyEl = document.getElementById("passportNumber");
    } else if (type === "licenseNumber") {
        copyEl = document.getElementById("licenseNumber");
    } else if (type === "licenseKeyNumber") {
        copyEl = document.getElementById("licenseKeyNumber");
    } else if (type === "message") {
        copyEl = document.getElementById("message");
    }
    if (copyEl.value != "") {
        if (copyEl.getAttribute("type") != "text") {
            copyEl.select();
            navigator.clipboard.writeText(XOR(copyEl.value, encryptedKey))
        } else {
            copyEl.select();
            navigator.clipboard.writeText(copyEl.value)
        }
    }
    popoutAlert.innerHTML = `<div class="alert alert-success alert-dismissible fade show mt-3 w-75" role="alert" id="success-alert">
                <strong>Copied to clipboard!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>`
    window.setTimeout(function () {
        $("#success-alert").fadeTo(500, 0, function () {
            $("#success-alert").remove();
        });
    }, 2000);
}

function updateEditButton(toUpdate) {
    nameRef = toUpdate.getAttribute("data-name");
    idRef = toUpdate.getAttribute("id");
    editButton = document.getElementById("editButton");
    editButton.removeAttribute("onclick");
    editButton.setAttribute("onclick", "editInformation(" + nameRef + "," + idRef + ")");
    deleteButton = document.getElementById("deleteButton");
    deleteButton.removeAttribute("onclick");
    deleteButton.setAttribute("onclick", "deleteItem(" + nameRef + "," + idRef + ")");
}

function editInformation(element, idRef) {
    nameRef = element.getAttribute("id");
    editForm = document.getElementById("editForm");
    encryptedKey = XOR(key, salt);
    saveButton = document.getElementById("saveButton");
    if (nameRef === "loginDetails") {
        value = resultArr[nameRef][idRef];
        saveButton.setAttribute("onclick", "saveInformation(" + nameRef + "," + idRef + ")");
        editForm.innerHTML = `<div id="editLoginDetailsForm">
        <div>
            <label for="name" class="form-label">Name</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="editSiteName" value="` + XOR(value.name, key) + `">
            </div>
        </div>
        <label for="username" class="form-label">Username</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" id="editUserName" value="` + XOR(value.username, key) + `">
        </div>
        <label for="password" class="form-label">Password</label>
        <div class="input-group mb-3">
            <input type="password" class="form-control" id="editPassword" value="` + XOR(value.password, encryptedKey) + `">
        </div>
        <label for="website" class="form-label">Website</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" id="editWebsite" value="` + XOR(value.website, key) + `">
        </div>
    </div>`;
    } else if (nameRef === "paymentCard") {
        value = resultArr[nameRef][idRef];
        saveButton.setAttribute("onclick", "saveInformation(" + nameRef + "," + idRef + ")");
        editForm.innerHTML = `<div id="editPaymentCardForm">
        <div>
            <label for="cardName" class="form-label">Card Name</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="editCardName" value="` + XOR(value.cardName, key) + `">
            </div>
        </div>
        <div>
            <label for="cardholderName" class="form-label">Cardholder Name</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="editCardholderName" value="` + XOR(value.cardholderName, key) + `">
            </div>
        </div>
        <div>
            <label for="cardNumber" class="form-label">Card Number</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="editCardNumber" value="` + XOR(value.cardNumber, encryptedKey) + `">
            </div>
        </div>
        <div>
            <label for="expMonth" class="form-label">Expiry Month</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="editExpMonth" value="` + XOR(value.expMonth, key) + `">
            </div>
        </div>
        <div>
            <label for="expYear" class="form-label">Expiry Year</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="editExpYear" value="` + XOR(value.expYear, key) + `">
            </div>
        </div>
        <div>
            <label for="CVV" class="form-label">CVV</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="editCVV" value="` + XOR(value.CVV, encryptedKey) + `">
            </div>
        </div>
    </div>`;
    } else if (nameRef === "identityCard") {
        value = resultArr[nameRef][idRef];
        saveButton.setAttribute("onclick", "saveInformation(" + nameRef + "," + idRef + ")");
        editForm.innerHTML = `<div id="editIdentityCardForm">
        <div>
            <label for="name" class="form-label">Identity Card Name</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="editIdentityCardName" value="` + XOR(value.identityCardName, key) + `">
            </div>
        </div>
        <div>
            <label for="name" class="form-label">First Name</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="editFirstName" value="` + XOR(value.firstName, key) + `">
            </div>
        </div>
        <div>
            <label for="name" class="form-label">Middle Name</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="editMiddleName" value="` + XOR(value.middleName, key) + `">
            </div>
        </div>
        <div>
            <label for="name" class="form-label">Last Name</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="editLastName" value="` + XOR(value.lastName, key) + `">
            </div>
        </div>
        <div>
            <label for="name" class="form-label">Username</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="editIDuserName" value="` + XOR(value.IDuserName, key) + `">
            </div>
        </div>
        <div>
            <label for="name" class="form-label">Company Name</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="editCompanyName" value="` + XOR(value.companyName, key) + `">
            </div>
        </div>
        <div>
            <label for="name" class="form-label">Social Security Number</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="editSsNumber" value="` + XOR(value.ssNumber, encryptedKey) + `">
        </div>
        <div>
            <label for="name" class="form-label">Passport Number</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="editPassportNumber" value="` + XOR(value.passportNumber, encryptedKey) + `">
            </div>
        </div>
        <div>
            <label for="name" class="form-label">License Number</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="editLicenseNumber" value="` + XOR(value.licenseNumber, encryptedKey) + `">
            </div>
        </div>
        <div>
            <label for="name" class="form-label">Email</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="editUserEmail" value="` + XOR(value.userEmail, key) + `">
            </div>
        </div>
        <div>
            <label for="name" class="form-label">Mobile Number</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="editPhoneNumber" value="` + XOR(value.phoneNumber, key) + `">
            </div>
        </div>
        <div>
            <label for="name" class="form-label">Address 1</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="editLine1Address" value="` + XOR(value.line1Address, key) + `">
            </div>
        </div>
        <div>
            <label for="name" class="form-label">Address 2</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="editLine2Address" value="` + XOR(value.line2Address, key) + `">
            </div>
        </div>
        <div>
            <label for="name" class="form-label">Address 3</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="editLine3Address" value="` + XOR(value.line3Address, key) + `">
            </div>
        </div>
        <div>
            <label for="name" class="form-label">City / Town</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="editCityTown" value="` + XOR(value.cityTown, key) + `">
            </div>
        </div>
        <div>
            <label for="name" class="form-label">State / Province</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="editStateProvince" value="` + XOR(value.stateProvince, key) + `">
            </div>
        </div>
        <div>
            <label for="name" class="form-label">Zip / Postal Code</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="editPostalCode" value="` + XOR(value.postalCode, key) + `">
            </div>
        </div>
        <div>
            <label for="name" class="form-label">Country</label>
            <div class="input-group mb-3">
                <select class="form-select" id="editCountry" name="country" value="` + XOR(value.country, key) + `">
                    <option value="default" selected>Choose Country</option>
                    <option value="Afghanistan">Afghanistan</option>
                    <option value="Albania">Albania</option>
                    <option value="Algeria">Algeria</option>
                    <option value="American Samoa">American Samoa</option>
                    <option value="Andorra">Andorra</option>
                    <option value="Angola">Angola</option>
                    <option value="Anguilla">Anguilla</option>
                    <option value="Antartica">Antarctica</option>
                    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                    <option value="Argentina">Argentina</option>
                    <option value="Armenia">Armenia</option>
                    <option value="Aruba">Aruba</option>
                    <option value="Australia">Australia</option>
                    <option value="Austria">Austria</option>
                    <option value="Azerbaijan">Azerbaijan</option>
                    <option value="Bahamas">Bahamas</option>
                    <option value="Bahrain">Bahrain</option>
                    <option value="Bangladesh">Bangladesh</option>
                    <option value="Barbados">Barbados</option>
                    <option value="Belarus">Belarus</option>
                    <option value="Belgium">Belgium</option>
                    <option value="Belize">Belize</option>
                    <option value="Benin">Benin</option>
                    <option value="Bermuda">Bermuda</option>
                    <option value="Bhutan">Bhutan</option>
                    <option value="Bolivia">Bolivia</option>
                    <option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
                    <option value="Botswana">Botswana</option>
                    <option value="Bouvet Island">Bouvet Island</option>
                    <option value="Brazil">Brazil</option>
                    <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                    <option value="Brunei Darussalam">Brunei Darussalam</option>
                    <option value="Bulgaria">Bulgaria</option>
                    <option value="Burkina Faso">Burkina Faso</option>
                    <option value="Burundi">Burundi</option>
                    <option value="Cambodia">Cambodia</option>
                    <option value="Cameroon">Cameroon</option>
                    <option value="Canada">Canada</option>
                    <option value="Cape Verde">Cape Verde</option>
                    <option value="Cayman Islands">Cayman Islands</option>
                    <option value="Central African Republic">Central African Republic</option>
                    <option value="Chad">Chad</option>
                    <option value="Chile">Chile</option>
                    <option value="China">China</option>
                    <option value="Christmas Island">Christmas Island</option>
                    <option value="Cocos Islands">Cocos (Keeling) Islands</option>
                    <option value="Colombia">Colombia</option>
                    <option value="Comoros">Comoros</option>
                    <option value="Congo">Congo</option>
                    <option value="Congo">Congo, the Democratic Republic of the</option>
                    <option value="Cook Islands">Cook Islands</option>
                    <option value="Costa Rica">Costa Rica</option>
                    <option value="Cota D'Ivoire">Cote d'Ivoire</option>
                    <option value="Croatia">Croatia (Hrvatska)</option>
                    <option value="Cuba">Cuba</option>
                    <option value="Cyprus">Cyprus</option>
                    <option value="Czech Republic">Czech Republic</option>
                    <option value="Denmark">Denmark</option>
                    <option value="Djibouti">Djibouti</option>
                    <option value="Dominica">Dominica</option>
                    <option value="Dominican Republic">Dominican Republic</option>
                    <option value="East Timor">East Timor</option>
                    <option value="Ecuador">Ecuador</option>
                    <option value="Egypt">Egypt</option>
                    <option value="El Salvador">El Salvador</option>
                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                    <option value="Eritrea">Eritrea</option>
                    <option value="Estonia">Estonia</option>
                    <option value="Ethiopia">Ethiopia</option>
                    <option value="Falkland Islands">Falkland Islands (Malvinas)</option>
                    <option value="Faroe Islands">Faroe Islands</option>
                    <option value="Fiji">Fiji</option>
                    <option value="Finland">Finland</option>
                    <option value="France">France</option>
                    <option value="France Metropolitan">France, Metropolitan</option>
                    <option value="French Guiana">French Guiana</option>
                    <option value="French Polynesia">French Polynesia</option>
                    <option value="French Southern Territories">French Southern Territories</option>
                    <option value="Gabon">Gabon</option>
                    <option value="Gambia">Gambia</option>
                    <option value="Georgia">Georgia</option>
                    <option value="Germany">Germany</option>
                    <option value="Ghana">Ghana</option>
                    <option value="Gibraltar">Gibraltar</option>
                    <option value="Greece">Greece</option>
                    <option value="Greenland">Greenland</option>
                    <option value="Grenada">Grenada</option>
                    <option value="Guadeloupe">Guadeloupe</option>
                    <option value="Guam">Guam</option>
                    <option value="Guatemala">Guatemala</option>
                    <option value="Guinea">Guinea</option>
                    <option value="Guinea-Bissau">Guinea-Bissau</option>
                    <option value="Guyana">Guyana</option>
                    <option value="Haiti">Haiti</option>
                    <option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
                    <option value="Holy See">Holy See (Vatican City State)</option>
                    <option value="Honduras">Honduras</option>
                    <option value="Hong Kong">Hong Kong</option>
                    <option value="Hungary">Hungary</option>
                    <option value="Iceland">Iceland</option>
                    <option value="India">India</option>
                    <option value="Indonesia">Indonesia</option>
                    <option value="Iran">Iran (Islamic Republic of)</option>
                    <option value="Iraq">Iraq</option>
                    <option value="Ireland">Ireland</option>
                    <option value="Israel">Israel</option>
                    <option value="Italy">Italy</option>
                    <option value="Jamaica">Jamaica</option>
                    <option value="Japan">Japan</option>
                    <option value="Jordan">Jordan</option>
                    <option value="Kazakhstan">Kazakhstan</option>
                    <option value="Kenya">Kenya</option>
                    <option value="Kiribati">Kiribati</option>
                    <option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of
                    </option>
                    <option value="Korea">Korea, Republic of</option>
                    <option value="Kuwait">Kuwait</option>
                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                    <option value="Lao">Lao People's Democratic Republic</option>
                    <option value="Latvia">Latvia</option>
                    <option value="Lebanon">Lebanon</option>
                    <option value="Lesotho">Lesotho</option>
                    <option value="Liberia">Liberia</option>
                    <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                    <option value="Liechtenstein">Liechtenstein</option>
                    <option value="Lithuania">Lithuania</option>
                    <option value="Luxembourg">Luxembourg</option>
                    <option value="Macau">Macau</option>
                    <option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
                    <option value="Madagascar">Madagascar</option>
                    <option value="Malawi">Malawi</option>
                    <option value="Malaysia">Malaysia</option>
                    <option value="Maldives">Maldives</option>
                    <option value="Mali">Mali</option>
                    <option value="Malta">Malta</option>
                    <option value="Marshall Islands">Marshall Islands</option>
                    <option value="Martinique">Martinique</option>
                    <option value="Mauritania">Mauritania</option>
                    <option value="Mauritius">Mauritius</option>
                    <option value="Mayotte">Mayotte</option>
                    <option value="Mexico">Mexico</option>
                    <option value="Micronesia">Micronesia, Federated States of</option>
                    <option value="Moldova">Moldova, Republic of</option>
                    <option value="Monaco">Monaco</option>
                    <option value="Mongolia">Mongolia</option>
                    <option value="Montserrat">Montserrat</option>
                    <option value="Morocco">Morocco</option>
                    <option value="Mozambique">Mozambique</option>
                    <option value="Myanmar">Myanmar</option>
                    <option value="Namibia">Namibia</option>
                    <option value="Nauru">Nauru</option>
                    <option value="Nepal">Nepal</option>
                    <option value="Netherlands">Netherlands</option>
                    <option value="Netherlands Antilles">Netherlands Antilles</option>
                    <option value="New Caledonia">New Caledonia</option>
                    <option value="New Zealand">New Zealand</option>
                    <option value="Nicaragua">Nicaragua</option>
                    <option value="Niger">Niger</option>
                    <option value="Nigeria">Nigeria</option>
                    <option value="Niue">Niue</option>
                    <option value="Norfolk Island">Norfolk Island</option>
                    <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                    <option value="Norway">Norway</option>
                    <option value="Oman">Oman</option>
                    <option value="Pakistan">Pakistan</option>
                    <option value="Palau">Palau</option>
                    <option value="Panama">Panama</option>
                    <option value="Papua New Guinea">Papua New Guinea</option>
                    <option value="Paraguay">Paraguay</option>
                    <option value="Peru">Peru</option>
                    <option value="Philippines">Philippines</option>
                    <option value="Pitcairn">Pitcairn</option>
                    <option value="Poland">Poland</option>
                    <option value="Portugal">Portugal</option>
                    <option value="Puerto Rico">Puerto Rico</option>
                    <option value="Qatar">Qatar</option>
                    <option value="Reunion">Reunion</option>
                    <option value="Romania">Romania</option>
                    <option value="Russia">Russian Federation</option>
                    <option value="Rwanda">Rwanda</option>
                    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                    <option value="Saint LUCIA">Saint LUCIA</option>
                    <option value="Saint Vincent">Saint Vincent and the Grenadines</option>
                    <option value="Samoa">Samoa</option>
                    <option value="San Marino">San Marino</option>
                    <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                    <option value="Saudi Arabia">Saudi Arabia</option>
                    <option value="Senegal">Senegal</option>
                    <option value="Seychelles">Seychelles</option>
                    <option value="Sierra">Sierra Leone</option>
                    <option value="Singapore">Singapore</option>
                    <option value="Slovakia">Slovakia (Slovak Republic)</option>
                    <option value="Slovenia">Slovenia</option>
                    <option value="Solomon Islands">Solomon Islands</option>
                    <option value="Somalia">Somalia</option>
                    <option value="South Africa">South Africa</option>
                    <option value="South Georgia">South Georgia and the South Sandwich Islands</option>
                    <option value="Span">Spain</option>
                    <option value="SriLanka">Sri Lanka</option>
                    <option value="St. Helena">St. Helena</option>
                    <option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
                    <option value="Sudan">Sudan</option>
                    <option value="Suriname">Suriname</option>
                    <option value="Svalbard">Svalbard and Jan Mayen Islands</option>
                    <option value="Swaziland">Swaziland</option>
                    <option value="Sweden">Sweden</option>
                    <option value="Switzerland">Switzerland</option>
                    <option value="Syria">Syrian Arab Republic</option>
                    <option value="Taiwan">Taiwan, Province of China</option>
                    <option value="Tajikistan">Tajikistan</option>
                    <option value="Tanzania">Tanzania, United Republic of</option>
                    <option value="Thailand">Thailand</option>
                    <option value="Togo">Togo</option>
                    <option value="Tokelau">Tokelau</option>
                    <option value="Tonga">Tonga</option>
                    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                    <option value="Tunisia">Tunisia</option>
                    <option value="Turkey">Turkey</option>
                    <option value="Turkmenistan">Turkmenistan</option>
                    <option value="Turks and Caicos">Turks and Caicos Islands</option>
                    <option value="Tuvalu">Tuvalu</option>
                    <option value="Uganda">Uganda</option>
                    <option value="Ukraine">Ukraine</option>
                    <option value="United Arab Emirates">United Arab Emirates</option>
                    <option value="United Kingdom">United Kingdom</option>
                    <option value="United States">United States</option>
                    <option value="United States Minor Outlying Islands">United States Minor Outlying Islands
                    </option>
                    <option value="Uruguay">Uruguay</option>
                    <option value="Uzbekistan">Uzbekistan</option>
                    <option value="Vanuatu">Vanuatu</option>
                    <option value="Venezuela">Venezuela</option>
                    <option value="Vietnam">Viet Nam</option>
                    <option value="Virgin Islands (British)">Virgin Islands (British)</option>
                    <option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
                    <option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
                    <option value="Western Sahara">Western Sahara</option>
                    <option value="Yemen">Yemen</option>
                    <option value="Serbia">Serbia</option>
                    <option value="Zambia">Zambia</option>
                    <option value="Zimbabwe">Zimbabwe</option>
                </select>
            </div>
        </div>
    </div>`;
    } else if (nameRef === "licenseKey") {
        value = resultArr[nameRef][idRef];
        saveButton.setAttribute("onclick", "saveInformation(" + nameRef + "," + idRef + ")");
        editForm.innerHTML = `<div id="editLicenseKeyForm">
        <div>
            <label for="name" class="form-label">Product Name</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="editProductName" value="` + XOR(value.productName, key) + `">
            </div>
        </div>
        <div>
            <label for="name" class="form-label">First Name</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="editFirstName" value="` + XOR(value.firstName, key) + `">
            </div>
        </div>
        <div>
            <label for="name" class="form-label">Last Name</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="editLastName" value="` + XOR(value.lastName, key) + `">
            </div>
        </div>
        <div>
            <label for="name" class="form-label">License Number</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="editLicenseKeyNumber" value="` + XOR(value.licenseKeyNumber, encryptedKey) + `">
            </div>
        </div>
    </div>`;
    } else if (nameRef === "secureNotes") {
        value = resultArr[nameRef][idRef];
        saveButton.setAttribute("onclick", "saveInformation(" + nameRef + "," + idRef + ")");
        editForm.innerHTML = `<div id="editSecureNotesForm">
        <div>
            <label for="name" class="form-label">Note Name</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="editNoteName" value="` + XOR(value.noteName, key) + `">
            </div>
        </div>
        <div>
            <label for="name" class="form-label">Message</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="editMessage" value="` + XOR(value.message, encryptedKey) + `">
            </div>
        </div>
    </div>`;
    }
}

function deleteItem(itemEl, idRef) {
    nameRef = itemEl.getAttribute("id");
    $.ajax({
        url: 'include/editLogin.inc.php',
        method: 'POST',
        data: {
            type: 'delete',
            id: idRef,
            category: nameRef
        },
        success: function (data) {
            if (data) {
                popoutAlert.innerHTML = `<div class="alert alert-danger alert-dismissible fade show mt-3 w-75" role="alert" id="success-alert">
                    <strong>Item Removed!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`
                window.setTimeout(function () {
                    $("#success-alert").fadeTo(500, 0, function () {
                        $("#success-alert").remove();
                    });
                }, 2000);
            }
            window.top.location = window.top.location
        }
    });
}

function saveInformation(itemEl, idRef) {
    nameRef = itemEl.getAttribute("id");
    if (nameRef === "loginDetails") {
        newSiteName = document.getElementById("editSiteName");
        newUserName = document.getElementById("editUserName");
        newPassword = document.getElementById("editPassword");
        newWebsite = document.getElementById("editWebsite");

        var key = getCookie('userpassword');
        var salt = getCookie('hash');

        var encryptedKey = XOR(key, salt)
        var encryptedSiteName = XOR(newSiteName.value, key);
        var encryptedUserName = XOR(newUserName.value, key);
        var encryptedPassword = XOR(newPassword.value, encryptedKey);
        var encryptedWebsite = XOR(newWebsite.value, key);

        $.ajax({
            url: 'include/editLogin.inc.php',
            method: 'POST',
            data: {
                id: idRef,
                type: nameRef,
                name: encryptedSiteName,
                username: encryptedUserName,
                password: encryptedPassword,
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
                }
                window.top.location = window.top.location
            }
        });

    } else if (nameRef === "paymentCard") {
        newCardName = document.getElementById("editCardName");
        newCardholderName = document.getElementById("editCardholderName");
        newCardNumber = document.getElementById("editCardNumber");
        newExpMonth = document.getElementById("editExpMonth");
        newExpYear = document.getElementById("editExpYear");
        newCVV = document.getElementById("editCVV");

        var key = getCookie('userpassword');
        var salt = getCookie('hash');

        var encryptedKey = XOR(key, salt)
        var encryptedcardName = XOR(newCardName.value, key);
        var encryptedcardholderName = XOR(newCardholderName.value, key);
        var encryptedcardNumber = XOR(newCardNumber.value, encryptedKey);
        var encryptedexpMonth = XOR(newExpMonth.value, key);
        var encryptedexpYear = XOR(newExpYear.value, key);
        var encryptedCVV = XOR(newCVV.value, encryptedKey);

        $.ajax({
            url: 'include/editLogin.inc.php',
            method: 'POST',
            data: {
                id: idRef,
                type: nameRef,
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
                }
                window.top.location = window.top.location
            }
        });
    } else if (nameRef === "identityCard") {
        newIdentityCardName = document.getElementById("editIdentityCardName");
        newFirstName = document.getElementById("editFirstName");
        newMiddleName = document.getElementById("editMiddleName");
        newLastName = document.getElementById("editLastName");
        newIDuserName = document.getElementById("editIDuserName");
        newCompanyName = document.getElementById("editCompanyName");
        newSsNumber = document.getElementById("editSsNumber");
        newPassportNumber = document.getElementById("editPassportNumber");
        newLicenseNumber = document.getElementById("editLicenseNumber");
        newUserEmail = document.getElementById("editUserEmail");
        newPhoneNumber = document.getElementById("editPhoneNumber");
        newLine1Address = document.getElementById("editLine1Address");
        newLine2Address = document.getElementById("editLine2Address");
        newLine3Address = document.getElementById("editLine3Address");
        newCityTown = document.getElementById("editCityTown");
        newStateProvince = document.getElementById("editStateProvince");
        newPostalCode = document.getElementById("editPostalCode");
        newCountry = document.getElementById("editCountry");

        var key = getCookie('userpassword');
        var salt = getCookie('hash');

        var encryptedKey = XOR(key, salt)
        var encryptedIdentityCardName = XOR(newIdentityCardName.value, key);
        var encryptedFirstName = XOR(newFirstName.value, key);
        var encryptedMiddleName = XOR(newMiddleName.value, key);
        var encryptedLastName = XOR(newLastName.value, key);
        var encryptedIDuserName = XOR(newIDuserName.value, key);
        var encryptedCompanyName = XOR(newCompanyName.value, key);
        var encryptedSsNumber = XOR(newSsNumber.value, encryptedKey);
        var encryptedPassportNumber = XOR(newPassportNumber.value, encryptedKey);
        var encryptedLicenseNumber = XOR(newLicenseNumber.value, encryptedKey);
        var encryptedUserEmail = XOR(newUserEmail.value, key);
        var encryptedPhoneNumber = XOR(newPhoneNumber.value, key);
        var encryptedLine1Address = XOR(newLine1Address.value, key);
        var encryptedLine2Address = XOR(newLine2Address.value, key);
        var encryptedLine3Address = XOR(newLine3Address.value, key);
        var encryptedCityTown = XOR(newCityTown.value, key);
        var encryptedStateProvince = XOR(newStateProvince.value, key);
        var encryptedPostalCode = XOR(newPostalCode.value, key);
        var encryptedCountry = XOR(newCountry.value, key);

        $.ajax({
            url: 'include/editLogin.inc.php',
            method: 'POST',
            data: {
                id: idRef,
                type: nameRef,
                identityCardName: encryptedIdentityCardName,
                firstName: encryptedFirstName,
                middleName: encryptedMiddleName,
                lastName: encryptedLastName,
                IDuserName: encryptedIDuserName,
                companyName: encryptedCompanyName,
                ssNumber: encryptedSsNumber,
                passportNumber: encryptedPassportNumber,
                licenseNumber: encryptedLicenseNumber,
                userEmail: encryptedUserEmail,
                phoneNumber: encryptedPhoneNumber,
                line1Address: encryptedLine1Address,
                line2Address: encryptedLine2Address,
                line3Address: encryptedLine3Address,
                cityTown: encryptedCityTown,
                stateProvince: encryptedStateProvince,
                postalCode: encryptedPostalCode,
                country: encryptedCountry
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
                }
                window.top.location = window.top.location
            }
        });
    } else if (nameRef === "licenseKey") {
        newProductName = document.getElementById("editProductName");
        newFirstName = document.getElementById("editFirstName");
        newLastName = document.getElementById("editLastName");
        newLicenseKeyNumber = document.getElementById("editLicenseKeyNumber");

        var key = getCookie('userpassword');
        var salt = getCookie('hash');

        var encryptedKey = XOR(key, salt)
        var encryptedProductName = XOR(newProductName.value, key);
        var encryptedFirstName = XOR(newFirstName.value, key);
        var encryptedLastName = XOR(newLastName.value, key);
        var encryptedLicenseKeyNumber = XOR(newLicenseKeyNumber.value, encryptedKey);

        $.ajax({
            url: 'include/editLogin.inc.php',
            method: 'POST',
            data: {
                id: idRef,
                type: nameRef,
                productName: encryptedProductName,
                firstName: encryptedFirstName,
                lastName: encryptedLastName,
                licenseKeyNumber: encryptedLicenseKeyNumber
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
                }
                window.top.location = window.top.location
            }
        });
    } else if (nameRef === "secureNotes") {
        newNoteName = document.getElementById("editNoteName");
        newMessage = document.getElementById("editMessage");

        var key = getCookie('userpassword');
        var salt = getCookie('hash');

        var encryptedKey = XOR(key, salt)
        var encryptedNoteName = XOR(newNoteName.value, key);
        var encryptedMessage = XOR(newMessage.value, encryptedKey);

        $.ajax({
            url: 'include/editLogin.inc.php',
            method: 'POST',
            data: {
                id: idRef,
                type: nameRef,
                noteName: encryptedNoteName,
                message: encryptedMessage
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
                }
                window.top.location = window.top.location
            }
        });
    }
}