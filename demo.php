<?php
require_once './stack.php';

$stack = create_stack();

$stack = push_in_stack('1', $stack);
$stack = push_in_stack('2', $stack);
$stack = push_in_stack('3', $stack);

var_dump($stack);

$ele = pop_out_stack($stack);

var_dump($ele);

var_dump($stack);
