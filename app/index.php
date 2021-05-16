<?php
$a = 1;
$b = 0;
$x = $a + $b;
//printf("%d\n", $x);
//echo $a, '+', $b, '=', $x;
//print $b;

function global_vars()
{
    static $t = 2;
    $t ++;
    $GLOBALS['a'] = $GLOBALS['a'] + 1;
    echo $GLOBALS['a'], "\n";
}

global_vars();
global_vars();

// refs

$x = "abc";
$$x = 200;
echo $x."<\n";
echo $$x."\n";
echo $abc, "\n";

$ex = 'example';
$$ex = 'is just an example';
echo $ex, $$ex, $example, "\n";

$name="Cat";
${$name}="Dog";
${${$name}}="Monkey";
echo $name. "<br>";
echo ${$name}. "<br>";
echo $Cat. "<br>";
echo ${${$name}}. "<br>";
echo $Dog. "<br>";

// constants
define('PI', 3.14);

echo PI;
const WEEK_DAYS = [2, 3, 4, 5, 6, 7, 8];
//echo constant('WEEK_DAYS').join(',');

// Magic constants

echo __LINE__;
echo __FILE__;
echo __DIR__;
function xyz() {
    echo __FUNCTION__;
}
xyz();
echo "\n";