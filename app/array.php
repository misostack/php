<?php
const ARRAY_LENGTH = 100;
const SELECTION_SORT = 1;
// sort
$numbers = [];
for ($i = 0 ; $i < ARRAY_LENGTH; $i++){
    array_push($numbers, rand(1, ARRAY_LENGTH));
}

function sortArray(&$array, $algorithm) {
    if($algorithm == SELECTION_SORT) {
        selectSort($array);
    }
    displayArray($array);
}

function displayArray($array){
    echo str_repeat("-",ARRAY_LENGTH*2), "\n";
    for($i = 0; $i < sizeof($array); $i++){
        echo $array[$i], " ";
    }
    echo "\n", str_repeat("-",ARRAY_LENGTH*2), "\n";
}

function swap(&$x, &$y){
    $tmp = $x;
    $x = $y;
    $y = $tmp;
}

function selectSort(&$array) {
    /*
     * The selection sort algorithm sorts an array by repeatedly finding the minimum element (considering ascending order)
     * from unsorted part and putting it at the beginning.
     * The algorithm maintains two subarrays in a given array.
     */
    $size_of_array = sizeof($array);

    for($i = 0; $i < $size_of_array; $i++){
        $min_idx = $i;
        for($j =$min_idx; $j < $size_of_array; $j++) {
            if($array[$min_idx] > $array[$j]){
                swap($array[$min_idx], $array[$j]);
            }
        }
    }
}

sortArray($numbers, SELECTION_SORT);
