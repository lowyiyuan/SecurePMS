<?php


function getRandomLowerCase() {
    return chr(floor(((rand(0, 999999999) * 0.000000001) * 26) + 97));
};

function getRandomUpperCase() {
    return chr(floor(((rand(0, 999999999) * 0.000000001) * 26) + 65));
};

function getRandomNumber() {
    return chr(floor(((rand(0, 999999999) * 0.000000001) * 10) + 48));
};

function getRandomSymbols() {
    $symbols = '!@#$%^&*(){}[]=<>/,.';
    return ($symbols[floor((rand(0, 999999999) * 0.000000001) * strlen($symbols))]);
}


?>
