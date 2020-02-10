var acme = acme || {};

acme.SimpleModule = function(options){
		
	//////////////////////
	// INSTANCE VARIABLES
	//////////////////////

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

	// set everything up
	initalize();

	//////////////////////////
	// METHODS
	//////////////////////////

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

	function update(){
		var msg = firstName + " you have pressed the button " + pressCount + " time(s)!";
		divFirstName.innerHTML = msg;
	}
}