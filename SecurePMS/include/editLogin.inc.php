<?php

session_start();

if (!isset($_POST["submit"])) {
    require_once "functions.inc.php";

    $userName = $_SESSION["username"];
    $hmacPwd = $_SESSION["userpassword"];
    $user = strval(hash_hmac("sha256", $userName, $hmacPwd, false));
    $filepath = '../userData/' . $user . '.json';

    if ($_POST['type'] === 'delete') {
        $delete = $_POST['category'];
        $idRef = $_POST['id'];
        $jsonFile = file_get_contents($filepath);
        $dataArray = json_decode($jsonFile, true);
        $countCategory = count($dataArray[$delete]);
        $countAll = count($dataArray);

        $insertIntoCategory = array_slice($dataArray[$delete], 0, $idRef, true) + array_slice($dataArray[$delete], $idRef + 1, null, true);
        $insertIntoAll = array_slice($dataArray, $countAll, null, true) + array(
            $delete => $insertIntoCategory,
        ) + array_slice($dataArray, 0, $countAll, true);

        if (is_writeable($filepath)) {
            file_put_contents($filepath, json_encode($insertIntoAll));
        }
    }

    switch ($_POST["type"]) {

        case ("loginDetails"):

            $name = $_POST["name"];
            $username = $_POST["username"];
            $password = $_POST["password"];
            $website = $_POST["website"];
            $jsonFile = file_get_contents($filepath);
            $dataArray = json_decode($jsonFile, true);
            $idRef = $_POST["id"];
            $countCategory = count($dataArray["loginDetails"]);
            $countAll = count($dataArray);

            $dataNew = array(
                'name' => $name,
                'username' => $username,
                'password' => $password,
                'website' => $website,
            );
            $insertIntoCategory = array_slice($dataArray["loginDetails"], 0, $idRef, true) + array(
                $dataArray["loginDetails"][$idRef] = $dataNew,
            ) + array_slice($dataArray["loginDetails"], $idRef, null, true);
            $insertIntoAll = array_slice($dataArray, $countAll, null, true) + array(
                "loginDetails" => $insertIntoCategory,
            ) + array_slice($dataArray, 0, $countAll, true);

            if (is_writeable($filepath)) {
                file_put_contents($filepath, json_encode($insertIntoAll));
            }

            break;

        case ("paymentCard"):

            $cardName = $_POST["cardName"];
            $cardholderName = $_POST["cardholderName"];
            $cardNumber = $_POST["cardNumber"];
            $expMonth = $_POST["expMonth"];
            $expYear = $_POST["expYear"];
            $CVV = $_POST["CVV"];
            $jsonFile = file_get_contents($filepath);
            $dataArray = json_decode($jsonFile, true);
            $countCategory = count($dataArray["paymentCard"]);
            $countAll = count($dataArray);
            $idRef = $_POST["id"];

            $dataNew = array(
                'cardName' => $cardName,
                'cardholderName' => $cardholderName,
                'cardNumber' => $cardNumber,
                'expMonth' => $expMonth,
                'expYear' => $expYear,
                'CVV' => $CVV,
            );

            $insertIntoCategory = array_slice($dataArray["paymentCard"], 0, $idRef, true) + array(
                $dataArray["paymentCard"][$idRef] = $dataNew,
            ) + array_slice($dataArray["paymentCard"], $idRef, null, true);
            $insertIntoAll = array_slice($dataArray, $countAll, null, true) + array(
                "paymentCard" => $insertIntoCategory,
            ) + array_slice($dataArray, 0, $countAll, true);

            if (is_writeable($filepath)) {
                file_put_contents($filepath, json_encode($insertIntoAll));
            }
            echo 'Insert Successfully';

            break;

        case ("identityCard"):

            $identityCardName = $_POST["identityCardName"];
            $firstName = $_POST["firstName"];
            $middleName = $_POST["middleName"];
            $lastName = $_POST["lastName"];
            $IDuserName = $_POST["IDuserName"];
            $companyName = $_POST["companyName"];
            $ssNumber = $_POST["ssNumber"];
            $passportNumber = $_POST["passportNumber"];
            $licenseNumber = $_POST["licenseNumber"];
            $userEmail = $_POST["userEmail"];
            $phoneNumber = $_POST["phoneNumber"];
            $line1Address = $_POST["line1Address"];
            $line2Address = $_POST["line2Address"];
            $line3Address = $_POST["line3Address"];
            $cityTown = $_POST["cityTown"];
            $stateProvince = $_POST["stateProvince"];
            $postalCode = $_POST["postalCode"];
            $country = $_POST["country"];
            $jsonFile = file_get_contents($filepath);
            $dataArray = json_decode($jsonFile, true);
            $countCategory = count($dataArray["identityCard"]);
            $countAll = count($dataArray);
            $idRef = $_POST["id"];

            $dataNew = array(
                'identityCardName' => $identityCardName,
                'firstName' => $firstName,
                'middleName' => $middleName,
                'lastName' => $lastName,
                'IDuserName' => $IDuserName,
                'companyName' => $companyName,
                'ssNumber' => $ssNumber,
                'passportNumber' => $passportNumber,
                'licenseNumber' => $licenseNumber,
                'userEmail' => $userEmail,
                'phoneNumber' => $phoneNumber,
                'line1Address' => $line1Address,
                'line2Address' => $line2Address,
                'line3Address' => $line3Address,
                'cityTown' => $cityTown,
                'stateProvince' => $stateProvince,
                'postalCode' => $postalCode,
                'country' => $country,
            );

            $insertIntoCategory = array_slice($dataArray["identityCard"], 0, $idRef, true) + array(
                $dataArray["identityCard"][$idRef] = $dataNew,
            ) + array_slice($dataArray["identityCard"], $idRef, null, true);
            $insertIntoAll = array_slice($dataArray, $countAll, null, true) + array(
                "identityCard" => $insertIntoCategory,
            ) + array_slice($dataArray, 0, $countAll, true);

            if (is_writeable($filepath)) {
                file_put_contents($filepath, json_encode($insertIntoAll));
            }
            echo 'Insert Successfully';

            break;

        case ("licenseKey"):

            $licenseKeyName = $_POST["productName"];
            $licensefirstName = $_POST["firstName"];
            $licenselastName = $_POST["lastName"];
            $licenseKeyNumber = $_POST["licenseKeyNumber"];
            $jsonFile = file_get_contents($filepath);
            $dataArray = json_decode($jsonFile, true);
            $countCategory = count($dataArray["licenseKey"]);
            $countAll = count($dataArray);
            $idRef = $_POST["id"];

            $dataNew = array(
                'productName' => $licenseKeyName,
                'firstName' => $licensefirstName,
                'lastName' => $licenselastName,
                'licenseKeyNumber' => $licenseKeyNumber,
            );

            $insertIntoCategory = array_slice($dataArray["licenseKey"], 0, $idRef, true) + array(
                $dataArray["licenseKey"][$idRef] = $dataNew,
            ) + array_slice($dataArray["licenseKey"], $idRef, null, true);
            $insertIntoAll = array_slice($dataArray, $countAll, null, true) + array(
                "licenseKey" => $insertIntoCategory,
            ) + array_slice($dataArray, 0, $countAll, true);

            if (is_writeable($filepath)) {
                file_put_contents($filepath, json_encode($insertIntoAll));
            }
            echo 'Insert Successfully';

            break;

        case ("secureNotes"):

            $noteName = $_POST["noteName"];
            $message = $_POST["message"];
            $jsonFile = file_get_contents($filepath);
            $dataArray = json_decode($jsonFile, true);
            $countCategory = count($dataArray["secureNotes"]);
            $countAll = count($dataArray);
            $idRef = $_POST["id"];

            $dataNew = array(
                'noteName' => $noteName,
                'message' => $message,
            );

            $insertIntoCategory = array_slice($dataArray["secureNotes"], 0, $idRef, true) + array(
                $dataArray["secureNotes"][$idRef] = $dataNew,
            ) + array_slice($dataArray["secureNotes"], $idRef, null, true);
            $insertIntoAll = array_slice($dataArray, $countAll, null, true) + array(
                "secureNotes" => $insertIntoCategory,
            ) + array_slice($dataArray, 0, $countAll, true);

            if (is_writeable($filepath)) {
                file_put_contents($filepath, json_encode($insertIntoAll));
            }
            echo 'Insert Successfully';

            break;

        default:
            break;
    }
} else {
    header("location: ../index");
    exit();
}
;
