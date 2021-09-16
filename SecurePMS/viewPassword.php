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

    <style>
        * {
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body style="overflow:hidden">
    <?php include 'include/navbar.inc.php';?>
    <div class="container-fluid" style="min-height: 100vh;">
        <div class="row">
            <div class="col-md-2 px-0 pt-2 border-end overflow-auto" style="height: 100vh">
                <ul class="list-group border-0 rounded-0">
                    <li class="list-group-item d-flex border-0 justify-content-between align-items-center">
                        <a class="text-decoration-none stretched-link" onclick="getItems(this.id)" id="loginDetails"><i
                                class="fas fa-key px-2"></i>Passwords</a>
                        <span class="badge bg-primary rounded-pill" id="passwordCount"></span>
                    </li>
                    <li class="list-group-item d-flex border-0 justify-content-between align-items-center">
                        <a class="text-decoration-none stretched-link" onclick="getItems(this.id)" id="paymentCard"><i
                                class="fas fa-credit-card px-2"></i>Payment
                            Cards</a>
                        <span class="badge bg-primary rounded-pill" id="paymentCardCount"></span>
                    </li>
                    <li class="list-group-item d-flex border-0 justify-content-between align-items-center">
                        <a class="text-decoration-none stretched-link" onclick="getItems(this.id)" id="identityCard"><i
                                class="fas fa-id-card px-2"></i>Identity
                            Cards</a>
                        <span class="badge bg-primary rounded-pill" id="identityCardCount"></span>
                    </li>
                    <li class="list-group-item d-flex border-0 justify-content-between align-items-center">
                        <a class="text-decoration-none stretched-link" onclick="getItems(this.id)" id="licenseKey"><i
                                class="fas fa-id-card px-2"></i>License Keys</a>
                        <span class="badge bg-primary rounded-pill" id="licenseKeyCount"></span>
                    </li>
                    <li class="list-group-item d-flex border-0 justify-content-between align-items-center">
                        <a class="text-decoration-none stretched-link" onclick="getItems(this.id)" id="secureNotes"><i
                                class="fas fa-sticky-note px-2"></i>Secure
                            Notes</a>
                        <span class="badge bg-primary rounded-pill" id="secureNotesCount"></span>
                    </li>
                </ul>
            </div>
            <div class="col-md-5 border-end overflow-auto p-0" style="height: 100vh;">
                <form class="p-2" style="width: 100%;">
                    <input class="form-control" type="search" onkeyup="searchItem(this.value)" placeholder="Search"
                        aria-label="Search" id="searchBar">
                    <a id="searchButton"><i class="fas ms-5 fa-search px-2 text-dark"
                            style="position: absolute; top: 5.75rem; left: 63rem;"></i></a>
                </form>
                <div class="list-group rounded-0" id="credentialList">

                </div>
            </div>
            <div class="col-md-5 overflow-auto" style="height: 100vh;">
                <div id="viewDetails">
                    <div class="d-flex justify-content-end">
                        <div class="container" id="notification">
                        </div>
                        <button data-bs-toggle="modal" data-bs-target="#editModal" id="editButton"
                            onclick="editInformation()" class="my-3 py-3 btn btn-secondary">Edit</button>
                        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit Item Information</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" id="editForm">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button onclick="deleteItem()" id="deleteButton" type="button" class="btn btn-danger">Delete Item</button>
                                        <button onclick="saveInformation()" id="saveButton" type="button" class="btn btn-primary">Save Item</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container w-75">
                        <h4>Item Information</h4>
                        <div id="loginDetailsForm">
                            <div>
                                <label for="name" class="form-label">Name</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="siteName" value="" readonly>
                                </div>
                            </div>
                            <label for="username" class="form-label">Username</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="userName" value="" readonly>
                                <a onclick="copyToClipboard('username')" class="input-group-text"><span><i
                                            class="fas fa-copy"></i></span></a>
                            </div>
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" id="password" value="" readonly>
                                <a onclick="checkCompromise()" class="input-group-text" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Check if password has been compromised"><span><i
                                            class="fas fa-check-circle"></i></span></a>
                                <a onclick="showPassword('password'), retrievePassword('password')" id="getPassword"
                                    class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Show Password"><span><i class="fas fa-eye"></i></span></a>
                                <a onclick="copyToClipboard('password')" class="input-group-text"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Copy to clipboard"><span><i
                                            class="fas fa-copy"></i></span></a>
                            </div>
                            <label for="website" class="form-label">Website</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="website" value="" readonly>
                                <a onclick="openInNewTab()" class="input-group-text"><span><i
                                            class="fas fa-share-square"></i></span></a>
                                <a onclick="copyToClipboard('website')" class="input-group-text"><span><i
                                            class="fas fa-copy"></i></span></a>
                            </div>
                        </div>
                        <div id="paymentCardForm">
                            <div>
                                <label for="cardName" class="form-label">Card Name</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="cardName" value="" readonly>
                                </div>
                            </div>
                            <div>
                                <label for="cardholderName" class="form-label">Cardholder Name</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="cardholderName" value="" readonly>
                                </div>
                            </div>
                            <div>
                                <label for="cardNumber" class="form-label">Card Number</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="cardNumber" value="" readonly>
                                    <a onclick="showPassword('cardNumber'), retrievePassword('cardNumber')"
                                        id="getCardNumber" class="input-group-text" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Show Password"><span><i
                                                class="fas fa-eye"></i></span></a>
                                    <a onclick="copyToClipboard('cardNumber')" id="getCardNumber"
                                        class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Show Password"><span><i class="fas fa-copy"></i></span></a>
                                </div>
                            </div>
                            <div>
                                <label for="expMonth" class="form-label">Expiry Month</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="expMonth" value="" readonly>
                                </div>
                            </div>
                            <div>
                                <label for="expYear" class="form-label">Expiry Year</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="expYear" value="" readonly>
                                </div>
                            </div>
                            <div>
                                <label for="CVV" class="form-label">CVV</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="CVV" value="" readonly>
                                    <a onclick="showPassword('CVV'), retrievePassword('CVV')" id="getCVV"
                                        class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Show Password"><span><i class="fas fa-eye"></i></span></a>
                                    <a onclick="copyToClipboard('CVV')" id="getCVV" class="input-group-text"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Show Password"><span><i
                                                class="fas fa-copy"></i></span></a>
                                </div>
                            </div>
                        </div>
                        <div id="identityCardForm">
                            <div>
                                <label for="name" class="form-label">Identity Card Name</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="identityCardName" value="" readonly>
                                </div>
                            </div>
                            <div>
                                <label for="name" class="form-label">First Name</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="firstName" value="" readonly>
                                </div>
                            </div>
                            <div>
                                <label for="name" class="form-label">Middle Name</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="middleName" value="" readonly>
                                </div>
                            </div>
                            <div>
                                <label for="name" class="form-label">Last Name</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="lastName" value="" readonly>
                                </div>
                            </div>
                            <div>
                                <label for="name" class="form-label">Username</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="IDuserName" value="" readonly>
                                </div>
                            </div>
                            <div>
                                <label for="name" class="form-label">Company Name</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="companyName" value="" readonly>
                                </div>
                            </div>
                            <div>
                                <label for="name" class="form-label">Social Security Number</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="ssNumber" value="" readonly>
                                    <a onclick="showPassword('ssNumber'), retrievePassword('ssNumber')" id="getssNumber"
                                        class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Show Password"><span><i class="fas fa-eye"></i></span></a>
                                    <a onclick="copyToClipboard('ssNumber')" id="getssNumber" class="input-group-text"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Show Password"><span><i
                                                class="fas fa-copy"></i></span></a> </div>
                            </div>
                            <div>
                                <label for="name" class="form-label">Passport Number</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="passportNumber" value="" readonly>
                                    <a onclick="showPassword('passportNumber'), retrievePassword('passportNumber')"
                                        id="getpassportNumber" class="input-group-text" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Show Password"><span><i
                                                class="fas fa-eye"></i></span></a>
                                    <a onclick="copyToClipboard('passportNumber')" id="getPassportNumber"
                                        class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Show Password"><span><i class="fas fa-copy"></i></span></a>
                                </div>
                            </div>
                            <div>
                                <label for="name" class="form-label">License Number</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="licenseNumber" value="" readonly>
                                    <a onclick="showPassword('licenseNumber'), retrievePassword('licenseNumber')"
                                        id="getlicenseNumber" class="input-group-text" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Show Password"><span><i
                                                class="fas fa-eye"></i></span></a>
                                    <a onclick="copyToClipboard('licenseNumber')" id="getLicenseNumber"
                                        class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Show Password"><span><i class="fas fa-copy"></i></span></a>
                                </div>
                            </div>
                            <div>
                                <label for="name" class="form-label">Email</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="userEmail" value="" readonly>
                                </div>
                            </div>
                            <div>
                                <label for="name" class="form-label">Mobile Number</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="phoneNumber" value="" readonly>
                                </div>
                            </div>
                            <div>
                                <label for="name" class="form-label">Address 1</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="line1Address" value="" readonly>
                                </div>
                            </div>
                            <div>
                                <label for="name" class="form-label">Address 2</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="line2Address" value="" readonly>
                                </div>
                            </div>
                            <div>
                                <label for="name" class="form-label">Address 3</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="line3Address" value="" readonly>
                                </div>
                            </div>
                            <div>
                                <label for="name" class="form-label">City / Town</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="cityTown" value="" readonly>
                                </div>
                            </div>
                            <div>
                                <label for="name" class="form-label">State / Province</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="stateProvince" value="" readonly>
                                </div>
                            </div>
                            <div>
                                <label for="name" class="form-label">Zip / Postal Code</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="postalCode" value="" readonly>
                                </div>
                            </div>
                            <div>
                                <label for="name" class="form-label">Country</label>
                                <div class="input-group mb-3">
                                    <select class="form-select" id="country" name="country" readonly>
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
                                        <option value="British Indian Ocean Territory">British Indian Ocean Territory
                                        </option>
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
                                        <option value="Democratic People's Republic of Korea">Korea, Democratic People's
                                            Republic of
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
                                        <option value="South Georgia">South Georgia and the South Sandwich Islands
                                        </option>
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
                                        <option value="United States Minor Outlying Islands">United States Minor
                                            Outlying Islands
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
                        </div>
                        <div id="licenseKeyForm">
                            <div>
                                <label for="name" class="form-label">Product Name</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="productName" value="" readonly>
                                </div>
                            </div>
                            <div>
                                <label for="name" class="form-label">First Name</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="licenseFirstName" value="" readonly>
                                </div>
                            </div>
                            <div>
                                <label for="name" class="form-label">Last Name</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="licenseLastName" value="" readonly>
                                </div>
                            </div>
                            <div>
                                <label for="name" class="form-label">License Number</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="licenseKeyNumber" value="" readonly>
                                    <a onclick="showPassword('licenseKeyNumber'), retrievePassword('licenseKeyNumber')"
                                        id="getlicenseKeyNumber" class="input-group-text" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Show Password"><span><i
                                                class="fas fa-eye"></i></span></a>
                                    <a onclick="copyToClipboard('licenseKeyNumber')" id="getLicenseKeyNumber"
                                        class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Show Password"><span><i class="fas fa-copy"></i></span></a>
                                </div>
                            </div>
                        </div>
                        <div id="secureNotesForm">
                            <div>
                                <label for="name" class="form-label">Note Name</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="noteName" value="" readonly>
                                </div>
                            </div>
                            <div>
                                <label for="name" class="form-label">Message</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="message" value="" readonly>
                                    <a onclick="showPassword('message'), retrievePassword('message')" id="getMessage"
                                        class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Show Password"><span><i class="fas fa-eye"></i></span></a>
                                    <a onclick="copyToClipboard('message')" id="getMessage" class="input-group-text"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Show Message"><span><i
                                                class="fas fa-copy"></i></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@mathiscode/password-leak@latest"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="include/viewpassword.inc.js"></script>
    <script src="include/functions.inc.js"></script>
</body>

</html>