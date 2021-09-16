const resultEl = document.getElementById("resultEl");
const passwordLength = document.getElementById("passwordLength");
const lowerCase = document.getElementById("lowerCase");
const upperCase = document.getElementById("upperCase");
const numberEl = document.getElementById("numberEl");
const symbolsEl = document.getElementById("symbolsEl");
const generateEl = document.getElementById("generateEl");
const copyEl = document.getElementById("copyToClipboard");
const output = document.getElementById("length");
var flavourArray = [lowerCase, upperCase, numberEl, symbolsEl];

const updateSliderValue = () => {

    if (output > 129) {
        passwordLength.value = 128;
        output.value = 128;
    } else if (output < 10) {
        passwordLength.value = 10;
        output.value = 10;
    }

    output.value = passwordLength.value;
    passwordLength.oninput = function () {
        output.value = this.value;
    }
    output.oninput = function () {
        passwordLength.value = this.value;
    }
}

const randomFunc = {
    lower: getRandomLower,
    upper: getRandomUpper,
    number: getRandomNumber,
    symbol: getRandomSymbol
}

function newPassword() {
    const length = +passwordLength.value;
    const hasLower = lowerCase.checked;
    const hasUpper = upperCase.checked;
    const hasNumber = numberEl.checked;
    const hasSymbol = symbolsEl.checked;
    resultEl.value = generateNewPassword(
        length,
        hasLower,
        hasUpper,
        hasNumber,
        hasSymbol
    );
}

const generateNewPassword = (length, lower, upper, number, symbol) => {

    let generatedPassword = '';
    const typesCount = lower + upper + number + symbol;
    const typesArr = [{
        lower
    }, {
        upper
    }, {
        number
    }, {
        symbol
    }].filter(item => Object.values(item)[0]);

    if (typesCount === 0) {
        return '';
    }

    for (let i = 0; i < length; i += typesCount) {
        typesArr.forEach(type => {
            const funcName = Object.keys(type)[0];
            generatedPassword += randomFunc[funcName]();
        });
    }
    const finalPassword = generatedPassword.slice(0, length);
    return finalPassword;
}

const copyToClipboard = () => {
    resultEl.select();
    if (navigator.clipboard.writeText(resultEl.value)) {
        popoutAlert = document.getElementById("notification");
        popoutAlert.innerHTML = `<div class="alert alert-success alert-dismissible fade show mt-3" role="alert" id="success-alert">
            <strong>Copied to clipboard!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`
    }
    window.setTimeout(function () {
        $("#success-alert").fadeTo(500, 0, function () {
            $("#success-alert").remove();
        });
    }, 2000);
}

function getRandomLower() {
    return String.fromCharCode(Math.floor(Math.random() * 26) + 97);
}

function getRandomUpper() {
    return String.fromCharCode(Math.floor(Math.random() * 26) + 65);
}

function getRandomNumber() {
    return +String.fromCharCode(Math.floor(Math.random() * 10) + 48);
}

function getRandomSymbol() {
    const symbols = '!@#$%^&*';
    return symbols[Math.floor(Math.random() * symbols.length)];
}