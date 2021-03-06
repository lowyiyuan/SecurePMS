<?php

session_start();

if (!isset($_POST["submit"])) {
    require_once "functions.inc.php";

    $userName = $_SESSION["username"];
    $hmacPwd = $_SESSION["userpassword"];
    $user = strval(hash_hmac("sha256", $userName, $hmacPwd, false));
    $filepath = '../userData/' . $user . '.json';

    switch ($_POST["type"]) {

        case ("loginDetails"):

            $name = $_POST["siteName"];
            $username = $_POST["userName"];
            $password = $_POST["userPassword"];
            $website = $_POST["website"];
            $jsonFile = file_get_contents($filepath);
            $dataArray = json_decode($jsonFile, true);
            $countCategory = count($dataArray["loginDetails"]);
            $countAll = count($dataArray);

            $dataNew = array(
                'name' => $name,
                'username' => $username,
                'password' => $password,
                'website' => $website,
            );

            $insertIntoCategory = array_slice($dataArray["loginDetails"], 0, $countCategory, true) + array(
                $countCategory => $dataNew,
            ) + array_slice($dataArray["loginDetails"], $countCategory, null, true);
            $insertIntoAll = array_slice($dataArray, $countAll, null, true) + array(
                "loginDetails" => $insertIntoCategory,
            ) + array_slice($dataArray, 0, $countAll, true);

            if (is_writeable($filepath)) {
                file_put_contents($filepath, json_encode($insertIntoAll));
            }
            echo 'Insert Successfully';
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

            $dataNew = array(
                'cardName' => $cardName,
                'cardholderName' => $cardholderName,
                'cardNumber' => $cardNumber,
                'expMonth' => $expMonth,
                'expYear' => $expYear,
                'CVV' => $CVV,
            );

            $insertIntoCategory = array_slice($dataArray["paymentCard"], 0, $countCategory, true) + array(
                $countCategory => $dataNew,
            ) + array_slice($dataArray["paymentCard"], $countCategory, null, true);
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

            $insertIntoCategory = array_slice($dataArray["identityCard"], 0, $countCategory, true) + array(
                $countCategory => $dataNew,
            ) + array_slice($dataArray["identityCard"], $countCategory, null, true);
            $insertIntoAll = array_slice($dataArray, $countAll, null, true) + array(
                "identityCard" => $insertIntoCategory,
            ) + array_slice($dataArray, 0, $countAll, true);

            if (is_writeable($filepath)) {
                file_put_contents($filepath, json_encode($insertIntoAll));
            }
            echo 'Insert Successfully';
            break;

        case ("licenseKey"):

            $licenseKeyName = $_POST["licenseKeyName"];
            $licensefirstName = $_POST["licensefirstName"];
            $licenselastName = $_POST["licenselastName"];
            $licenseKeyNumber = $_POST["licenseKeyNumber"];
            $jsonFile = file_get_contents($filepath);
            $dataArray = json_decode($jsonFile, true);
            $countCategory = count($dataArray["licenseKey"]);
            $countAll = count($dataArray);

            $dataNew = array(
                'licenseKeyName' => $licenseKeyName,
                'licensefirstName' => $licensefirstName,
                'licenselastName' => $licenselastName,
                'licenseKeyNumber' => $licenseKeyNumber,
            );

            $insertIntoCategory = array_slice($dataArray["licenseKey"], 0, $countCategory, true) + array(
                $countCategory => $dataNew,
            ) + array_slice($dataArray["licenseKey"], $countCategory, null, true);
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

            $dataNew = array(
                'noteName' => $noteName,
                'message' => $message,
            );

            $insertIntoCategory = array_slice($dataArray["secureNotes"], 0, $countCategory, true) + array(
                $countCategory => $dataNew,
            ) + array_slice($dataArray["secureNotes"], $countCategory, null, true);
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
    header("location: ../newLogin");
    exit();
}
;
