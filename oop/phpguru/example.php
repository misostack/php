<?php
namespace PHPGuru\OOP\Examples;

function oop_phpguru_example(){
	echo "PHPGuru namespace example" . PHP_EOL;
}

class Example {
	private string $title;
	public function __construct(string $title) {
		$this->title = $title;
	}

	public function getTitle() : string {
		return $this->title;
	}
}