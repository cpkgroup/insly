<?php

function stringToBinary($string)
{
    $characters = str_split($string);

    $binary = [];
    foreach ($characters as $character) {
        $data = unpack('H*', $character);
        $binary[] = base_convert($data[1], 16, 2);
    }

    return implode(' ', $binary);
}

function binaryToString($binary)
{
    $binaries = explode(' ', $binary);

    $string = null;
    foreach ($binaries as $binary) {
        $string .= pack('H*', dechex(bindec($binary)));
    }

    return $string;
}

$myName = 'Mohammad';
$str = '01110000 01110010 01101001 01101110 01110100 00100000 01101111 01110101 01110100 00100000 01111001 01101111 01110101 01110010 00100000 01101110 01100001 01101101 01100101 00100000 01110111 01101001 01110100 01101000 00100000 01101111 01101110 01100101 00100000 01101111 01100110 00100000 01110000 01101000 01110000 00100000 01101100 01101111 01101111 01110000 01110011';

echo "<h2>Text:</h2>";
echo binaryToString($str);
echo "<hr>";
echo $myName;

echo "<h2>Binary:</h2>";
echo $str;
echo "<hr>";
echo stringToBinary($myName);
