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

            if (empty($_POST["siteName"] || $_POST["userName"] || $_POST["userPassword"] || $_POST["website"])) {
                header("location: ../newLogin?error=emptyFields");
                exit();
            } else {
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
                    $countCategory => $dataNew
                ) + array_slice($dataArray["loginDetails"], $countCategory, NULL, true);
                $insertIntoAll = array_slice($dataArray, $countAll, NULL, true) + array(
                    "loginDetails" => $insertIntoCategory
                ) + array_slice($dataArray, 0, $countAll, true);

                if (is_writeable($filepath)) {
                    file_put_contents($filepath, json_encode($insertIntoAll));
                }
            }
            echo 'Insert Successfully';
            break;

        case ("paymentCard"):

            $name = $_GET["siteName"];
            $cardholderName = $_GET["cardholderName"];
            $cardNumber = $_GET["cardNumber"];
            $expMonth = $_GET["expMonth"];
            $expYear = $_GET["expYear"];
            $CVV = $_GET["CVV"];
            $jsonFile = file_get_contents($filepath);
            $dataArray = json_decode($jsonFile, true);
            $countCategory = count($dataArray["paymentCard"]);
            $countAll = count($dataArray);

            $dataNew = array(
                'name' => $name,
                'cardholderName' => $cardholderName,
                'cardNumber' => $cardNumber,
                'expMonth' => $expMonth,
                'expYear' => $expYear,
                'CVV' => $CVV
            );

            $insertIntoCategory = array_slice($dataArray["paymentCard"], 0, $countCategory, true) + array(
                $countCategory => $dataNew
            ) + array_slice($dataArray["paymentCard"], $countCategory, NULL, true);
            $insertIntoAll = array_slice($dataArray, $countAll, NULL, true) + array(
                "paymentCard" => $insertIntoCategory
            ) + array_slice($dataArray, 0, $countAll, true);

            if (is_writeable($filepath)) {
                file_put_contents($filepath, json_encode($insertIntoAll));
            }
            echo 'Insert Successfully';

            break;

        case ("identityCard"):

            $name = $_GET["siteName"];
            $firstName = $_GET["firstName"];
            $middleName = $_GET["middleName"];
            $lastName = $_GET["lastName"];
            $userName = $_GET["userName"];
            $companyName = $_GET["companyName"];
            $ssNumber = $_GET["ssNumber"];
            $passportNumber = $_GET["passportNumber"];
            $licenseNumber = $_GET["licenseNumber"];
            $userEmail = $_GET["userEmail"];
            $mobileNumber = $_GET["mobileNumber"];
            $line1Address = $_GET["line1Address"];
            $line2Address = $_GET["line2Address"];
            $line3Address = $_GET["line3Address"];
            $cityTown = $_GET["cityTown"];
            $stateProvince = $_GET["stateProvince"];
            $postalCode = $_GET["postalCode"];
            $country = $_GET["country"];
            $jsonFile = file_get_contents($filepath);
            $dataArray = json_decode($jsonFile, true);
            $countCategory = count($dataArray["identityCard"]);
            $countAll = count($dataArray);

            $dataNew = array(
                'name' => $name,
                'firstName' => $firstName,
                'middleName' => $middleName,
                'lastName' => $lastName,
                'userName' => $userName,
                'companyName' => $companyName,
                'ssNumber' => $ssNumber,
                'passportNumber' => $passportNumber,
                'licenseNumber' => $licenseNumber,
                'userEmail' => $userEmail,
                'mobileNumber' => $mobileNumber,
                'line1Address' => $line1Address,
                'line2Address' => $line2Address,
                'line3Address' => $line3Address,
                'cityTown' => $cityTown,
                'stateProvince' => $stateProvince,
                'postalCode' => $postalCode,
                'country' => $country
            );

            $insertIntoCategory = array_slice($dataArray["identityCard"], 0, $countCategory, true) + array(
                $countCategory => $dataNew
            ) + array_slice($dataArray["identityCard"], $countCategory, NULL, true);
            $insertIntoAll = array_slice($dataArray, $countAll, NULL, true) + array(
                "identityCard" => $insertIntoCategory
            ) + array_slice($dataArray, 0, $countAll, true);

            if (is_writeable($filepath)) {
                file_put_contents($filepath, json_encode($insertIntoAll));
            }
            echo 'Insert Successfully';

            break;

        case ("licenseKey"):

            $name = $_GET["siteName"];
            $firstName = $_GET["firstName"];
            $lastName = $_GET["lastName"];
            $licenseKey = $_GET["licenseKey"];
            $jsonFile = file_get_contents($filepath);
            $dataArray = json_decode($jsonFile, true);
            $countCategory = count($dataArray["licenseKey"]);
            $countAll = count($dataArray);

            $dataNew = array(
                'name' => $name,
                'firstName' => $firstName,
                'lastName' => $lastName,
                'licenseKey' => $licenseKey,
            );

            $insertIntoCategory = array_slice($dataArray["licenseKey"], 0, $countCategory, true) + array(
                $countCategory => $dataNew
            ) + array_slice($dataArray["licenseKey"], $countCategory, NULL, true);
            $insertIntoAll = array_slice($dataArray, $countAll, NULL, true) + array(
                "licenseKey" => $insertIntoCategory
            ) + array_slice($dataArray, 0, $countAll, true);

            if (is_writeable($filepath)) {
                file_put_contents($filepath, json_encode($insertIntoAll));
            }
            echo 'Insert Successfully';

            break;

        case ("secureNotes"):

            $name = $_GET["siteName"];
            $message = $_GET["message"];
            $jsonFile = file_get_contents($filepath);
            $dataArray = json_decode($jsonFile, true);
            $countCategory = count($dataArray["secureNotes"]);
            $countAll = count($dataArray);

            $dataNew = array(
                'name' => $name,
                'message' => $message
            );

            $insertIntoCategory = array_slice($dataArray["secureNotes"], 0, $countCategory, true) + array(
                $countCategory => $dataNew
            ) + array_slice($dataArray["secureNotes"], $countCategory, NULL, true);
            $insertIntoAll = array_slice($dataArray, $countAll, NULL, true) + array(
                "secureNotes" => $insertIntoCategory
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
};
