function XOR(input, key) {
    var c = '';
    for (var x = 0; x < input.length; x++) {
        if (x > key.length - 1) {
            y = x % key.length;
        } else {
            y = x;
        }
        c += String.fromCharCode(input.charCodeAt(x) ^ key.charCodeAt(y));
    }
    return unescape(encodeURIComponent(c));
}