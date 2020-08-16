<?php
echo 'Datatypes', "\n";

if(TRUE)
    echo 'TRUE';
if(FALSE)
    echo 'FALSE';

echo PHP_FLOAT_MAX;

$bikes = array("Honda", "Yamaha", "Unknown");
var_dump($bikes);
echo $bikes[0], "\n";

class bike {
    function model() {
        $model_name = "Royal Enfield";
        echo "Bike Model: " .$model_name;
    }
}
$obj = new bike();
$obj -> model();

$x = "bac" . " is BAC";

echo $x, "\n";

if($obj instanceof bike)
    echo 'yes';
else
    echo 'no';
echo str_repeat("-",20), "\n";
echo `ls`;
echo `mkdir ./tmp`;
echo `echo "example" >> ./tmp/example.txt`;
echo `cat ./tmp/example.txt`;