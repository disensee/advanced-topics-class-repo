var acme = acme || {};

/**
 * Simple Module
 * Creates a simple interactive user interface that keeps track of how many times a button is pressed.
 * 
 * @param {object}  		options 	The option object should contain the following properties:
 * @param {HTMLElement}		options.container 	The HTML element on the page that should contain/display the ui for this module
 * @param {string}			options.firstName 	The name to be displayed in the UI 								 
 */

acme.SimpleModule = function(options){

	//////////////////////////////////////////
	// INSTANCE VARIABLES
	//////////////////////////////////////////

	var container = options.container || null;
	var firstName = options.firstName || null;

	var template = '<div class="simple-module"> \
						<div class="first-name"></div> \
						<input type="button" class="increment" value="Click Me!" /> \
					</div>';
	
	// We'll keep track of how many times the button gets pressed.
	var pressCount = 0;

	// UI variables
	var divFirstName;
	var btnIncrement;

	// set up the user interface...
	initalize();


	//////////////////////////////
	//METHODS
	//////////////////////////////

	
	function initalize(){

		// inject the template into the page
		container.innerHTML = template;
		
		// initalize UI variables
		divFirstName = container.querySelector(".first-name");
		btnIncrement = container.querySelector(".increment");

		// display the first name in the first name div
		divFirstName.innerHTML = "Hello " + firstName;

		// hook up event listeners
		btnIncrement.addEventListener("click", function(){
			pressCount++;
			update();
		});
	}

	/**
	* Updates the ui, showing the current press count.
	* @method update()
	*/
	function update(){
		var msg = firstName + " you have pressed the button " + pressCount + " time(s)!";
		divFirstName.innerHTML = msg;
	}

	/**
	* Sets the firstName property
	* @method setFirstName
	* @param {string} newFirstName
	*/
	function setFirstName(newFirstName){
		firstName = newFirstName;
	}

	// Return an object that consists of the public API of this module
	return {
		update:update,
		setFirstName:setFirstName
	};
	
}