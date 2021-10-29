<?php

// $str="DB_HOST=127.0.0.1\r\nDB_NAME=phpguru-headfirst\r\nDB_USER=root\r\nDB_PASSWORD=123456";
// $lines = preg_split("/[\s,]+/", $str);

// foreach($lines as $line){
// 	print_r(preg_split($pattern="/=/", $subject=$line));
// }



function prepare_insert_batch($table, $columns, $batch_size){

    // transform column name from columnNane to => 'columnName'
    $columns = array_map(function($v){
        return "`$v`";
    }, $columns);

    // in mysqli value placeholder is question mark
    $question_marks = array_fill(0, count($columns), '?');       
    $prepared_values = "(" . join(',', $question_marks) . ")";
    $prepared_columns = "(". join(',', $columns) . ")";
    $prepared_batch_values = join(',', array_fill(0, $batch_size, $prepared_values));
    
    // insert statement is a combination of columns and value placeholders
    return "
    INSERT INTO $table
        $prepared_columns
        VALUES
        $prepared_batch_values
    ";
}


function random_values_in_array($arr){
	return $arr[rand(0, count($arr) - 1)];
}

function prepared_bind_params($values){
	$mapping_types = array(
		'integer' => 'i',
		'double' => 'd',
		'string' => 's',
		'blob' => 'b'
	);
	$bind_string = "";
	foreach($values as $value){
		$bind_string .= $mapping_types[gettype($value)];
	}
	
	return $bind_string;
}

function generate_user_data($start, $size){

	$insert_values = [];
	$allowed_statuses = ['pending','active','inactive'];
	for($i = $start; $i< $start + $size; $i++){
		$current_date_time = date('Y-m-d H:i:s');
		$insert_values[] = array(
			'login' => "test.user.$i",
			'password' => '123456',
			'email' => "test.user.$i@yopmail.com",
			'first_name' => "user.$i",
			'last_name'=> 'test',
			'type' => 'member',
			'status' => random_values_in_array($allowed_statuses),
			'created_at' => $current_date_time,
			'updated_at' => $current_date_time, 
			'is_super_admin' => 0,
			'gender' => rand(0,1) ? 'M' : 'F'
		);
	}
	return $insert_values;	
}

function main(){
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	// connect database
	$servername = "localhost";
	$username = "root";
	$password = "123456";
	$dbname = "phpguru-headfirst";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	

	$table = "`phpguru_users`";
    $columns = [
        'login','password','email','first_name','last_name',
        'type','status','created_at','updated_at','is_super_admin',
        'gender'
    ];    

	
	// prepare and bind
	try{		
		// $stmt = $conn->prepare($prepared_statement);
		// Eg: when we hav 10k record need to be insert
		// each batch size should be 100
		// the cycle will be continue until there is no left record on the bench
		// also the batch size max is 100 record/cycle and must be higher than
		// the actual number of input records
		$total_records = 1e6; // 1,000,000 records
		$batch_size = 1000;
		$total_batches = ceil($total_records/$batch_size);
		for($i = 1; $i<= $total_batches; $i += 1){
			$size = $batch_size * $i < $total_records ? $batch_size : $total_records - $batch_size * ($i-1);
			// $batch_values = array_slice($insert_values, $batch_size * ($i - 1), $size);
			$batch_values = generate_user_data($batch_size * ($i - 1), $size);
			// var_dump(array_slice($batch_values, $batch_size * ($i - 1), $size));			
			$stmt = $conn->prepare(prepare_insert_batch($table, $columns, $size));
			$values = array();
			for($rid = 0; $rid < count($batch_values); $rid ++){
				$values = array_merge($values, array_values($batch_values[$rid]));
			}
			
			$stmt->bind_param(prepared_bind_params($values), ...$values);
			$stmt->execute();
			// query count
			$res = $conn->query("SELECT COUNT(*) as count FROM `phpguru-headfirst`.phpguru_users;");
			$row = $res->fetch_assoc();
			var_dump($row);
		}
	    				
	}catch(Exception $error){
		echo $error->getMessage();
	}
	
	// close db connection
	mysqli_close($conn);
}

main();