function XOREncrypt(input, key) {
    var c = '';
    while (key.length < input.length) {
         key += key;
    }
    for(var i=0; i<input.length; i++) {
        var x = input[i].charCodeAt(0);
        var y = key[i].charCodeAt(0);

        var XORxy = x ^ y;

        var XORxyAsHex = XORxy.toString("16");

        if (XORxyAsHex.length < 2) {
            XORxyAsHex = btoa("0" + XORxyAsHex);
        }

        c += XORxyAsHex;
    }
    return c;
}

function XORDecrypt(input, key) {
    var key = '<?php echo $_SESSION["userpassword"]; ?>';
    
}