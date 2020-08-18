<?php
define('VN_EXPRESS_RSFEED_SPORT', 'https://vnexpress.net/rss/the-thao.rss');
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

// availability

//$slots = [
//    array("slot" => "00:00", "status" => true),
//    array("slot" => "00:05", "status" => false),
//    array("slot" => "00:10", "status" => true),
//    array("slot" => "00:15", "status" => true),
//    array("slot" => "00:20", "status" => false),
//    array("slot" => "00:25", "status" => false),
//];
//// duration = 5
//const DURATION = 5;
//const GRADUATE = 5;
//for($i = 0; $i < count($slots); $i++) {
//    for($j = $i + DURATION/GRADUATE; $j < $i; $j--) {
//        if($slots[$i].status && )
//    }
//}
//
//// start block and open end : chan cho cuoc hen tiep theo duoc phep dat
//$call = [
//    array("slot" => "00:00", "status" => false), //block
//    array("slot" => "00:05", "status" => false), //block
//    array("slot" => "00:10", "status" => true),// end : open
//];
//
//$avail = [
//    array("slot" => "00:15", "status" => true),// en
//]
//$call2 = [
//    array("slot" => "00:20", "status" => false),
//    array("slot" => "00:25", "status" => false),
//]
//
//$rebuild = [
//    array("slot" => "00:10", "status" => true),
//    array("slot" => "00:15", "status" => true),
//    array("slot" => "00:20", "status" => false),
//]
//len = 5 -> 0
//len = 10 -> 1
//len =
//i = 0 ; i < 3; i++ {
//    j =  i + len; j > i ; j --
//        slots[i].status = slots[i].status && slots[j].status
//}

// Associated Array
//function fetch_rss_feed($url) {
//    $xml_content = file_get_contents($url);
//    $xmlObject = simplexml_load_string($xml_content) or die("Error: Cannot create object");
//    var_dump($xmlObject);
//}
//
//fetch_rss_feed(VN_EXPRESS_RSFEED_SPORT);
