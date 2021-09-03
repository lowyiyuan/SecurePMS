const itemType = document.getElementById("itemType");
const loginDetails = document.getElementById("loginDetails");
const paymentCard = document.getElementById("paymentCard");
const identityCard = document.getElementById("identityCard");
const licenseKey = document.getElementById("licenseKey");
const secureNotes = document.getElementById("secureNotes");


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

$(document).ready(function () {

    $(".submitItem").click(function () {

        var itemTypeValue = itemType.value;
        var name = $("#siteName").val();
        var username = $("#userName").val();
        var password = $("#userPassword").val();
        var website = $("#website").val();
        event.preventDefault();

        var key = "<?php echo $_SESSION['userpassword']; ?>";
        var salt = '<?php echo $_SESSION["hash"]; ?>';

        var encryptedKey = XOR(key, salt)
        var encryptedName = XOR(name, key);
        var encryptedUserName = XOR(username, key);
        var encryptedPassword = XOR(password, encryptedKey);
        var encryptedWebsite = XOR(website, key);
        $.ajax({
            url: 'include/newLogin.inc.php',
            method: 'POST',
            data: {
                type: itemTypeValue,
                siteName: encryptedName,
                userName: encryptedUserName,
                userPassword: encryptedPassword,
                website: encryptedWebsite
            },
            success: function (data) {
                console.log(data);
            }
        });

    });
});