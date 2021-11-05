<?php

// anonymous functions or lambda

$books = [
    array('name' => 'PHP 7 Blueprint', 'size' => '5MB', 'pages' => 120),
    array('name' => 'PHP 7 Learning', 'size' => '3.5MB', 'pages' => 150),
    array('name' => 'PHP 7 Arrays', 'size' => '1.5MB', 'pages' => 80),
    array('name' => 'PHP 7 Persistence Doctrine', 'size' => '3MB', 'pages' => 105),
    array('name' => 'PHP 7 Modular Programming', 'size' => '2.5MB', 'pages' => 90),
];


/*
 * Requirements:
 * 1. Add labels : PHP 7
 * 2. Add price depends on pages
 * 3. Increase price
 */
function add_labels(&$books, $newLabel){
    // use array_walk
    $add_label = function(&$book, $index, $label){
        if(!isset($book['label'])){
            $book['label'] = $label;
        }
        if(!isset($book['price'])){
            $book['price'] = 0;
        }        
    };
    array_walk($books, $add_label, $newLabel);
}

function add_price(&$books, $price_unit){
    $add_price = function(&$book, $price_unit){
        if(!isset($book['price']) || true){
            $book['price'] = $book['pages'] * $price_unit;
        }
    };
    foreach($books as $index => &$book){
        $add_price($book, $price_unit);
    }
}

function increase_price(&$books, $ratio){
    $increase_price = fn(&$book) => $book['price'] = (float)$book['price'] * (1+ (float)$ratio);
    foreach($books as &$book){
        $increase_price($book);
    }
}

function print_book($book){

    echo str_repeat("-",30) . PHP_EOL;
    echo "Name: {$book['name']}" . PHP_EOL;
    echo "Size: {$book['size']}" . PHP_EOL;
    echo "Pages: {$book['pages']}" . PHP_EOL;
    if(isset($book['label'])) {
        echo "Label: {$book['label']}".PHP_EOL;
    }
    if(isset($book['price'])) {
        $price = number_format($book['price']) . " VND";
        echo "Price: {$price}".PHP_EOL;
    }
}

function print_books($books){
    foreach ($books as $book){
        print_book($book);
    }
}

function lambda_main(){
    global $books;
    print_books($books);
    add_labels($books, 'PHP 7');
    echo "After add labels" . PHP_EOL;
    print_books($books);
    add_price($books, 1000);
    print_books($books);
    increase_price($books, 0.15);
    print_books($books);
}

lambda_main();