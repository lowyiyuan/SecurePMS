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
    </script>
    <style>
        * {
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
    <?php include 'include/navbar.inc.php';?>
    <div class="container my-4" id="viewDetails">
        <div id="notification"></div>
        <h4>Item Information</h4>
        <div>
            <label for="name" class="form-label">Type</label>
            <div class="input-group mb-3">
                <select id="itemType" class="form-select" oninput="updateType()" name="itemType">
                    <option value="loginDetails">Login</option>
                    <option value="paymentCard">Payment Card</option>
                    <option value="identityCard">ID Card</option>
                    <option value="licenseKey">License Key</option>
                    <option value="secureNotes">Secure Notes</option>
                </select>
            </div>
        </div>

        <section class="loginDetails" id="loginDetails">
            <form method="POST" id="loginDetailsForm" autocomplete="off">
                <input type="text" id="type" name="type" value="loginDetails" hidden>
                <label for="name" class="form-label">Item Name</label>
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
                        placeholder="Enter a Password..." autocomplete="new-password">
                    <a onclick="checkCompromise('userPassword')" class="input-group-text"
                        title="Check if password has been compromised"><span><i
                                class="fas fa-check-circle"></i></span></a>
                    <a type="button" class="input-group-text" data-bs-toggle="modal"
                        data-bs-target="#generatePasswordModal" title="Generate Password"><span><i
                                class="fas fa-sync"></i></span></a>
                    <a onclick="showPassword('password')" class="input-group-text" title="Show Password"><span><i
                                class="fas fa-eye"></i></span></a>
                    <a onclick="copyClipboard('password')" class="input-group-text" title="Copy to clipboard"><span><i
                                class="fas fa-copy"></i></span></a>
                </div>
                <label for="website" class="form-label">Website</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="website" name="website" placeholder="Enter a Website..."
                        autocomplete="off">
                </div>
                <button type="button" data-name="loginDetails" class="btn submitItem btn-primary">Save Login</button>
            </form>
            <div class="modal fade" id="generatePasswordModal" tabindex="-1" aria-labelledby="modalTitle"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitle">Generate Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control overflow-visible" id="resultEl" value=""
                                    readonly>
                                <a class="input-group-text" data-bs-toggle="tooltip" id="copyToClipboard"
                                    onclick="copyToClipboard()" data-bs-placement="top"
                                    title="Copy to clipboard"><span><i class="fas fa-copy"></i></span></a>
                            </div>
                            <div>
                                <label for="passwordLength" class="form-label">Length: &nbsp</label><input type="number"
                                    id="length" onkeyup="newPassword(), updateSliderValue()" min="10" max="128">
                                <br>
                                <input type="range" class="form-range" min="10" max="128" id="passwordLength"
                                    value="14">
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
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                onclick="autofillPassword()">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="paymentCard d-none" id="paymentCard">
            <form action="include/newLogin.inc.php?type=paymentCard" id="paymentCardForm">
                <input type="text" name="type" value="paymentCard" hidden>
                <label for="name" class="form-label">Card Name</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="cardName" name="cardName" placeholder="Enter a name..."
                        value="" autocomplete="off">
                </div>
                <label for="cardholderName" class="form-label">Cardholder Name</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="cardholderName" name="cardholderName"
                        placeholder="John Doe" autocomplete="off">
                </div>
                <label for="cardNumber" class="form-label">Card Number</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="cardNumber" name="cardNumber" autocomplete="off">
                    <span class="input-group-text">
                        <i class="fab fa-cc-visa" style="color:navy;"></i>
                        <i class="fab fa-cc-amex" style="color:blue;"></i>
                        <i class="fab fa-cc-mastercard" style="color:red;"></i>
                        <i class="fab fa-cc-discover" style="color:orange;"></i>
                        <i class="fab fa-cc-jcb"></i>
                        <i class="fab fa-cc-diners-club"></i>
                    </span>
                    <a onclick="showPassword('cardNumber')" class="input-group-text" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Show Password"><span><i class="fas fa-eye"></i></span></a>

                </div>

                <div class="mb-3">
                    <label for="expMonth" class="form-label">Expiry Month</label>
                    <select id="expMonth" class="form-select" name="expMonth">
                        <option value="January">January / 01</option>
                        <option value="February">February / 02</option>
                        <option value="March">March / 03</option>
                        <option value="April">April / 04</option>
                        <option value="May">May / 05</option>
                        <option value="June">June / 06</option>
                        <option value="July">July / 07</option>
                        <option value="August">August / 08</option>
                        <option value="September">September / 09</option>
                        <option value="October">October / 10</option>
                        <option value="November">November / 11</option>
                        <option value="December">December / 12</option>
                    </select>
                </div>
                <div>
                    <label for="expYear" class="form-label">Expiry Year</label>
                    <div class="input-group mb-3">
                        <select name="expYear" id="expYear" class="form-select">
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                            <option value="2029">2029</option>
                            <option value="2030">2030</option>
                            <option value="2031">2031</option>
                        </select>
                    </div>
                </div>
                <label data-toggle="tooltip" title="Three-digits code on the back of your card">CVV/CVC
                    <i class="fa fa-question-circle"></i>
                </label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="CVV" name="CVV" autocomplete="off">
                    <a onclick="showPassword('CVV')" class="input-group-text" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Show CVV"><span><i class="fas fa-eye"></i></span></a>
                </div>
                <button type="button" data-name="paymentCard" class="btn submitItem btn-primary">Save Payment
                    Card</button>
            </form>
        </section>


        <section class="identityCard d-none" id="identityCard">
            <form action="include/newLogin.inc.php?type=identityCard" id="identityCardForm">
                <input type="text" name="type" value="identityCard" hidden>
                <label for="siteName" class="form-label">Item Name</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="identityCardName" name="identityCardName"
                        placeholder="Enter a name..." value="" autocomplete="off">
                </div>
                <label for="firstName" class="form-label">First Name</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="firstName" name="firstName" value="" autocomplete="off">
                </div>
                <label for="middleName" class="form-label">Middle Name</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="middleName" name="middleName" value=""
                        autocomplete="off">
                </div>
                <label for="lastName" class="form-label">Last Name</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="lastName" name="lastName" value="" autocomplete="off">
                </div>
                <label for="IDuserName" class="form-label">Username</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="IDuserName" name="IDuserName" value=""
                        autocomplete="off">
                </div>
                <label for="companyName" class="form-label">Company Name</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="companyName" name="companyName" value=""
                        autocomplete="off">
                </div>
                <label for="ssNumber" class="form-label">Social Security Number</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="ssNumber" name="ssNumber" value="" autocomplete="off">
                    <a onclick="showPassword('ssNumber')" class="input-group-text" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Show Password"><span><i class="fas fa-eye"></i></span></a>
                </div>
                <label for="passportNumber" class="form-label">Passport Number</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="passportNumber" name="passportNumber" value=""
                        autocomplete="off">
                    <a onclick="showPassword('passportNumber')" class="input-group-text" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Show Password"><span><i class="fas fa-eye"></i></span></a>
                </div>
                <label for="licenseNumber" class="form-label">License Number</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="licenseNumber" name="licenseNumber" value=""
                        autocomplete="off">
                    <a onclick="showPassword('licenseNumber')" class="input-group-text" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Show Password"><span><i class="fas fa-eye"></i></span></a>
                </div>
                <label for="userEmail" class="form-label">Email</label>
                <div class="input-group mb-3">
                    <input type="email" class="form-control" id="userEmail" name="userEmail" value=""
                        autocomplete="off">
                </div>
                <label for="phoneNumber" class="form-label">Phone Number</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value=""
                        autocomplete="off">
                </div>
                <label for="line1Address" class="form-label">Address 1</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="line1Address" name="line1Address" value=""
                        autocomplete="off">
                </div>
                <label for="line2Address" class="form-label">Address 2</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="line2Address" name="line2Address" value=""
                        autocomplete="off">
                </div>
                <label for="line3Address" class="form-label">Address 3</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="line3Address" name="line3Address" value=""
                        autocomplete="off">
                </div>
                <label for="cityTown" class="form-label">City / Town</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="cityTown" name="cityTown" value="" autocomplete="off">
                </div>
                <label for="stateProvince" class="form-label">State / Province</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="stateProvince" name="stateProvince" value=""
                        autocomplete="off">
                </div>
                <label for="postalCode" class="form-label">Zip / Postal Code</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="postalCode" name="postalCode" value=""
                        autocomplete="off">
                </div>
                <label for="country" class="form-label">Country</label>
                <div class="input-group mb-3">
                    <select class="form-select" id="country" name="country">
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
                <button type="button" data-name="identityCard" class="btn submitItem btn-primary">Save ID Card</button>
            </form>
        </section>


        <section class="licenseKey d-none" id="licenseKey">
            <form action="include/newLogin.inc.php?type=licenseKey" id="licenseKeyForm">
                <input type="text" name="type" value="licenseKey" hidden>
                <label for="name" class="form-label">Product Name</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="licenseKeyName" id="licenseKeyName"
                        placeholder="Enter a name..." value="" autocomplete="off">
                </div>
                <label for="firstName" class="form-label">First Name</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="firstName" id="licensefirstName"
                        placeholder="Enter first name..." value="" autocomplete="off">
                </div>
                <label for="lastName" class="form-label">Last Name</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="lastName" id="licenselastName"
                        placeholder="Enter last name..." value="" autocomplete="off">
                </div>
                <label for="licenseKey" class="form-label">License Number</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="licenseKey" id="licenseKeyNumber"
                        placeholder="Enter license key..." value="" autocomplete="off">
                    <a onclick="showPassword('licenseKey')" class="input-group-text" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Show Password"><span><i class="fas fa-eye"></i></span></a>
                </div>
                <button type="button" data-name="licenseKey" class="btn submitItem btn-primary">Save License
                    Key</button>
            </form>
        </section>


        <section class="secureNotes d-none" id="secureNotes">
            <form action="include/newLogin.inc.php?type=secureNotes" id="secureNotesForm">
                <input type="text" name="type" value="secureNotes" hidden>
                <label for="name" class="form-label">Item Name</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="noteName" name="noteName" placeholder="Enter a name..."
                        value="" autocomplete="off">
                </div>
                <label for="name" class="form-label">Message</label>
                <div class="input-group mb-3">
                    <textarea class="form-control" id="message" name="message" width="100%"
                        placeholder="Write note here" id="message" style="height: 150px;"></textarea>
                </div>
                <button type="button" data-name="secureNotes" class="btn submitItem btn-primary">Save Note</button>
            </form>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@mathiscode/password-leak@latest"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="include/functions.inc.js"></script>
    <script src="include/newLogin.inc.js"></script>
    <script src="include/generatePassword.inc.js"></script>
    <script>
        window.onload = newPassword(), updateSliderValue(), hideCards();
        generateEl.addEventListener('click', newPassword);
        flavourArray.forEach(function (flavour) {
            flavour.addEventListener("click", newPassword)
        });
        let sliderArray = [updateSliderValue, newPassword];
        sliderArray.forEach(function (update) {
            passwordLength.addEventListener("change", update)
        })

        function hideCards() {
            $(".fa-cc-visa").hide();
            $(".fa-cc-mastercard").hide();
            $(".fa-cc-amex").hide();
            $(".fa-cc-diners-club").hide();
            $(".fa-cc-jcb").hide();
            $(".fa-cc-discover").hide();
        }

        function checkCompromise(check_id) {
            toCheck = document.getElementById(check_id)
            isPasswordCompromised(toCheck.value).then(isCompromised => {
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

        function autofillPassword() {
            var resultEl = document.getElementById("resultEl");
            var userPassword = document.getElementById("userPassword");
            userPassword.value = resultEl.value;
        }

        function showPassword(toShow) {
            if (toShow === "password") {
                password = document.getElementById("userPassword")
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
            }
        }

        function copyClipboard(type) {
            if (type === "password") {
                var copyEl = document.getElementById("userPassword")
                if (copyEl.value != "") {
                    copyEl.select();
                    navigator.clipboard.writeText(copyEl.value)
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
        }

        var cleave = new Cleave('#cardNumber', {
            creditCard: true,
            onCreditCardTypeChanged: function (type) {
                if (type === "mastercard") {
                    $(".fa-cc-visa").hide();
                    $(".fa-cc-mastercard").show();
                    $(".fa-cc-amex").hide();
                    $(".fa-cc-diners-club").hide();
                    $(".fa-cc-jcb").hide();
                    $(".fa-cc-discover").hide();
                } else if (type === "visa") {
                    $(".fa-cc-visa").show();
                    $(".fa-cc-mastercard").hide();
                    $(".fa-cc-amex").hide();
                    $(".fa-cc-diners-club").hide();
                    $(".fa-cc-jcb").hide();
                    $(".fa-cc-discover").hide();
                } else if (type === "amex") {
                    $(".fa-cc-visa").hide();
                    $(".fa-cc-mastercard").hide();
                    $(".fa-cc-amex").show();
                    $(".fa-cc-diners-club").hide();
                    $(".fa-cc-jcb").hide();
                    $(".fa-cc-discover").hide();
                } else if (type === "diners") {
                    $(".fa-cc-visa").hide();
                    $(".fa-cc-mastercard").hide();
                    $(".fa-cc-amex").hide();
                    $(".fa-cc-diners-club").show();
                    $(".fa-cc-jcb").hide();
                    $(".fa-cc-discover").hide();
                } else if (type === "jcb") {
                    $(".fa-cc-visa").hide();
                    $(".fa-cc-mastercard").hide();
                    $(".fa-cc-amex").hide();
                    $(".fa-cc-diners-club").hide();
                    $(".fa-cc-jcb").show();
                    $(".fa-cc-discover").hide();
                } else if (type === "discover") {
                    $(".fa-cc-visa").hide();
                    $(".fa-cc-mastercard").hide();
                    $(".fa-cc-amex").hide();
                    $(".fa-cc-diners-club").hide();
                    $(".fa-cc-jcb").hide();
                    $(".fa-cc-discover").show();
                } else {
                    $(".fa-cc-visa").hide();
                    $(".fa-cc-mastercard").hide();
                    $(".fa-cc-amex").hide();
                    $(".fa-cc-diners-club").hide();
                    $(".fa-cc-jcb").hide();
                    $(".fa-cc-discover").hide();
                }
            }
        });
    </script>
</body>

</html>