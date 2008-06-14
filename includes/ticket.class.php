<?php

class Ticket {
	private $category;
	private $price;
	private $number;

	function __construct($cat, $pr, $num) {
		$this->category = $cat;
		$this->price = $pr;
		$this->number = $num;
	}
	
	function getCategory() {
		return $this->category;
	}
	
	function getPrice() {
		return $this->price;
	}
	
	function getNumber() {
		return $this->number;
	}
}


?>