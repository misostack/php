<?php

$strings = 'A reop erp orady raduis, vkdr';

// count number of r in this string
// highlights all r in this string
// list all words start with r

$count = 0;

for($i = 0; $i < strlen($strings); $i++)
    if($strings[$i] == 'r')
        $count++;

echo $count;

function highlightCharacters($c, $strings)
{
    $newString = '';

    for ($i = 0; $i < strlen($strings); $i++)
        if ($strings[$i] == $c)
            $newString .= "<strong>${strings[$i]}</strong>";
        else
            $newString .= $strings[$i];

    return $newString;
}

echo highlightCharacters('r', $strings);