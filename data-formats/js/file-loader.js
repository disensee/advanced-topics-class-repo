var acme = acme || {};

/**
* Create a file input control and handles opening text files.
* When a file is opened, the callback function is invoked and the file contents
* (data) are passed in as a string
* @submodule FileLoader
* @module acme

* @param {HTMLElement}	options.container		The element/tag on the page that will contain the UI for this module
*
* @param {Function} options.callback 			This function will be invoked when a file is opened.
* 												The contents of the file will be passed into the callback
* 												function as an argument/paremeter.
*
* @param {Function} options.allowedFileTypes 	A comma separated string of the types of files that can be loaded into the page.
*												For example: ".xml, .json"
*/
acme.FileLoader = function(options){

	///////////// INSTANCE VARS /////////////////////

	var container = options.container || null;
	var callback = options.callback || null;
	var allowedFileTypes = options.allowedFileTypes || ".csv, .json, .xml";
	var label;
	var fileInput;

	initialize();

	/////////////// METHODS /////////////////////

	function initialize(){

		// remove all tags from the container
		while(container.firstChild){
		    container.removeChild(container.firstChild);
		}

		// set up the label
		label = document.createElement("h4");
		label.textContent = "Select a file";
		container.appendChild(label);

		// set up the file input
		fileInput = document.createElement("input");
		fileInput.setAttribute("type", "file");
		fileInput.setAttribute("accept", allowedFileTypes); // limit the types of files that can be opened 
		container.appendChild(fileInput);
		fileInput.addEventListener('change', handleFileSelect);
	}


	function handleFileSelect(evt) {
	    
	    // get the data from the selected file and pass it to the callback function
	    var file = evt.target.files[0];
	    var reader = new FileReader();
	    reader.addEventListener("load", function(e) {
		  var data = e.target.result;
		  callback(data); // RIGHT HERE IS WHERE WE INVOKE THE CALLBACK FUNCTION!!!!!
		});
		
		reader.readAsText(file); 
	}

};

