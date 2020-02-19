var contactmanager = contactmanager || {};


/**
* Creates an instance of the contact form and renders it on the page.
* @param {object} 		options	
* @param {HTML Element} options.container 	The HTML element which will contain the UI
*/
contactmanager.ContactForm = function(options) {
	
	//////////////////////////////////////
	// INSTANCE VARIABLES
	//////////////////////////////////////

	var container = options.container || null;
	
	var template = `<div class="contact-form">
			<input type="hidden" class="txtId" size="3" readonly/>
			<div>
				<label>First Name:</label>
				<input type="text" name="firstName" class="txtFirstName">
				<span class="validation vFirstName"></span>
			</div>
			<div>
				<label>Last Name:</label>
				<input type="text" name="lastName" class="txtLastName">
				<span class="validation vLastName"></span>
			</div>
			<div>
				<label>Email:</label>
				<input type="text" name="email" class="txtEmail">
				<span class="validation vEmail"></span>
			</div>
			<div>
				<label>Phone:</label>	
				<input type="text" name="phone" class="txtPhone">
				<span class="validation vPhone"></span>
			</div>
			<div>
				<label></label>
				<input type="button" class="btnSave" value="SAVE">
				<input type="button" class="btnCancel" value="CLEAR">
				<input type="button" class="btnDelete" value="DELETE">
			</div>
		</div>`;

	// UI instance variables
	var btnSave = null;
	var txtId = null;
	var txtFirstName = null;
	var txtLastName = null;
	var txtEmail = null;
	var txtPhone = null;
	var btnDelete = null;
	var btnCancel = null;

	var vFirstName = null;
	var vLastName = null;
	var vEmail = null;
	var vPhone = null;


	initialize();

	///////////////////////////////
	// METHODS
	///////////////////////////////

	function initialize(){
		container.innerHTML = template;
		btnSave = container.querySelector(".btnSave");

		// set up event handlers
		txtId = container.querySelector(".txtId");
		txtFirstName = container.querySelector(".txtFirstName");
		txtLastName = container.querySelector(".txtLastName");
		txtEmail = container.querySelector(".txtEmail");
		txtPhone = container.querySelector(".txtPhone");
		btnDelete = container.querySelector(".btnDelete");
		btnCancel = container.querySelector(".btnCancel");

		vFirstName = container.querySelector(".vFirstName");
		vLastName = container.querySelector(".vLastName");
		vEmail = container.querySelector(".vEmail");
		vPhone = container.querySelector(".vPhone");

		btnSave.addEventListener("click", handleSaveClick);
	}

	function handleSaveClick(){
		
		if(validate()){
			
		}

	}

	function validate(){
		// This method should return true if the user input is valid, false otherwise
		// It should also display the appropriate validation error messages in the user interface
		clearValidation();
		var valid = true;

		if(txtPhone.value == ""){
			vPhone.innerHTML = "Please enter a phone number";
			valid = false;
			txtPhone.focus();
		}else if(validatePhone(txtPhone.value) == false){
			vPhone.innerHTML = "Invalid phone number entered (valid format: (xxx)xxx-xxxx or xxx-xxx-xxxx)";
			valid = false;
			txtPhone.focus();
		}

		if(txtEmail.value == ""){
			vEmail.innerHTML = "Please enter an email address";
			valid = false;
			txtEmail.focus();
		}else if(validateEmail(txtEmail.value) == false){
			vEmail.innerHTML = "Please enter a valid email address (valid format: emailaddress@domainname.com)";
			valid = false;
			txtEmail.focus();
		}

		if(txtLastName.value == ""){
			vLastName.innerHTML = "Please enter a last name";
			valid = false;
			txtLastName.focus();
		}

		if(txtFirstName.value == ""){
			vFirstName.innerHTML = "Please enter a first name";
			valid = false;
			txtFirstName.focus();
		}
		
		return valid;
	}
	

	function clearValidation(){
		vFirstName.innerHTML = "";
		vLastName.innerHTML = "";
		vPhone.innerHTML = "";
		vEmail.innerHTML = "";
	}
	
	function validatePhone(phone){
		var regExp = /^(\()?\d{3}(\))?(-|\s)?\d{3}(-|\s)\d{4}$/
		return regExp.test(phone);
	}

	function validateEmail(email){
        var regExp = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regExp.test(email);
	}

	// Return the public API
	return {

	}


};