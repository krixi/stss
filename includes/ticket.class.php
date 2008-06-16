<?php

class Ticket {
	private $category;
	private $price;
	private $eventID;
	private $eventName;

	function __construct($cat, $pr, $id, $name) {
		$this->category = $cat;
		$this->price = $pr;
		$this->eventID = $id;
		$this->eventName = $name;
	}
	
	function getCategory() {
		return $this->category;
	}
	
	function getPrice() {
		return $this->price;
	}
	
	function getEventID() {
		return $this->eventID;
	}
	
	function getName() {
		return $this->eventName;
	}
}


?>