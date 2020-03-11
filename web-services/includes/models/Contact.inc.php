<?php 
include_once("Model.inc.php");

class Contact extends Model{

	// INSTANCE VARIABLES
	public $id;
	public $firstName;
	public $lastName;
	public $email;
	public $phone;


	// CONSTRUCTOR

	/**
	* Constructor for creating Contact model objects
	* @param {asoociative array} $args 	key value pairs that map to the instance variables
	*									NOTE: the $args param is OPTIONAL, if it is not passed in
	* 									The default will be an empty array: []									
	*/
	public function __construct($args = []){

		// NOTE that in PHP we use bracket notation for associative arrays
		$this->id = $args['id'] ?? 0;
		$this->firstName = $args['firstName'] ?? "";
		$this->lastName = $args['lastName'] ?? "";
		$this->email = $args['email'] ?? "";
		$this->phone = $args['phone'] ?? "";
	
	}

	/**
	* Validates the state of a Contact object. Returns true if it is valid, false otherwise
	* @return {boolean}
	*/
	public function isValid(){
		
		// TODO - complete the validation code
		//firstName must not be empty
		if(empty($this->firstName)){
			return false;
		}
		// lastName must not be empty
		if(empty($this->lastName)){
			return false;
		}
		// email must not be empty
		if(empty($this->email)){
			return false;
		}
		// email must be valid
		if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
			return false;
		}
		// phone must not be empty
		if(empty($this->phone)){
			return false;
		}
		// phone must be in this format: 555-555-5555
		
		if(!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $this->phone)) {
			return false;
		}

		return true;
	}

}