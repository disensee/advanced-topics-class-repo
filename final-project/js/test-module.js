var namespace = namespace || {};

namespace.TestModule = function(options){
	
	// "INSTANCE" vars
	var loginContainer = options.loginContainer || null;
	var listContainer = options.listContainer || null;
	var editContainer = options.editContainer || null;
	var callback = options.callback;
	var webServiceURL = options.webServiceURL || "//localhost/adv-topics/web-services/customers/";
	var loginURL = options.loginURL || "login.php";
	var successfulLoginCallback = options.successfulLoginCallback || null;
	var unsuccessfulLoginCallback = options.unsuccessfulLoginCallback || defaultErrorCallback;
	
	//var customers;
	
	var txtPassword;
	var txtFirstName;
	var txtLastName;
	var txtAddress;
	var txtCity;
	var txtState;
	var txtZip;
	var txtEmail;
	
	var vFirstName;
	var vLastName;
	var vAddress;
	var vCity;
	var vState;
	var vZip;
	var vEmail;

	var btnLogin;
	var btnTestWebService;
	var btnSave;
	var btnClear;
	var btnDelete;
	var btnGetAll;
	

	if(!loginContainer){
		//throw new Error("container option is required");
		console.log("container option is required");
	}else if((loginContainer instanceof HTMLElement) == false){
		//throw new Error("the container must be an HTMLElement");
		console.log("the container must be an HTMLElement");
	}

	// this module depends on the ajax module
	if(!namespace.ajax){
		//throw new Error("this module requires the ajax module");
		console.log("this module requires the ajax module");
	}

	initialize();

	function initialize(){
		// make sure the container is empty
		loginContainer.innerHTML = "";
		listContainer.innerHTML = "";
		editContainer.innerHTML = "";

		loginContainer.innerHTML = `
			<input type="password" class="txtPassword">
			<input type="button" class="btnLogin" value="LOG IN">
			<input type="button" class="btnTestWebService" value="Test Request to Contacts WebService">
			<br>To logout, visit the <a href="login.php">login page</a> and then return to this page without logging in. 
		`;

		editContainer.innerHTML = `
			<div id="form-container" class=container-fluid>
			<h4>Add/Edit Customer</h4>
				<form id="customer-form">
						<input type="text" id="txtCustomerId" readonly="true"><br>
					<div class="form-group">
						<label for="txtFirstName">First Name</label>
						<input type="text" class="form-control" id="txtFirstName" placeholder="Enter first name" />
						<span class = "validation vFirstName"></span>
					</div>
					<div class="form-group">
						<label for="txtLastName">Last Name</label>
						<input type="text" class="form-control" id="txtLastName" placeholder="Enter last name" />
						<span class = "validation vLastName"></span>
					</div>
					<div class="form-group">
						<label for="txtAddress">Address</label>
						<input type="text" class="form-control" id="txtAddress" placeholder="Enter address"/>
						<span class = "validation vAddress"></span>
					</div>
					<div class="form-group">
						<label for="txtCity">City</label>
						<input type="text" class="form-control" id="txtCity" placeholder="Enter city"/>
						<span class = "validation vCity"></span>
					</div>
					<div class="form-group">
						<label for="txtState">State</label>
						<input type="text" class="form-control" id="txtState" placeholder="Enter state"/>
						<span class = "validation vState"></span>
					</div>
					<div class="form-group">
						<label for="txtZip">Zip Code</label>
						<input type="text" class="form-control" id="txtZip" placeholder="Enter zip code"/>
						<span class = "validation vZip"></span>
					</div>
					<div class="form-group">
						<labe for="txtEmail">Email Address</label>
						<input type="text" class="form-control" id="txtEmail" placeholder="Enter email address"/>
						<span class = "validation vEmail"></span>
					</div>
					<div class="text-center">
						<input type="button" class="btn btn-outline-success" value="Save" id="btnSave">
						<input type="button" class="btn btn-outline-info" value="Clear" id="btnClear">
						<input type="button" class="btn btn-outline-danger" value="DELETE" id="btnDelete">
					</div>
						<br>
						<!--<input type="button" class="btn btn-outline-primary" value="Get All Customers" id="btnGetAll" />-->
				</form>
			</div>
		`;
			
		

		txtPassword = loginContainer.querySelector(".txtPassword");
		txtCustomerId = editContainer.querySelector("#txtCustomerId");
		txtFirstName = editContainer.querySelector("#txtFirstName");
		txtLastName = editContainer.querySelector("#txtLastName");
		txtAddress = editContainer.querySelector("#txtAddress");
		txtCity = editContainer.querySelector("#txtCity");
		txtState = editContainer.querySelector("#txtState");
		txtZip = editContainer.querySelector("#txtZip");
		txtEmail = editContainer.querySelector("#txtEmail");

		vFirstName = editContainer.querySelector(".vFirstName");
		vLastName = editContainer.querySelector(".vLastName");
		vAddress = editContainer.querySelector(".vAddress");
		vCity = editContainer.querySelector(".vCity");
		vState = editContainer.querySelector(".vState");
		vZip = editContainer.querySelector(".vZip");
		vEmail = editContainer.querySelector(".vEmail");

		btnLogin = loginContainer.querySelector(".btnLogin");
		btnLogin.addEventListener("click", loginButtonClickHandler);

		btnTestWebService = loginContainer.querySelector(".btnTestWebService");
		btnTestWebService.addEventListener("click", getAllCustomers);		

		btnSave = editContainer.querySelector("#btnSave");
		btnSave.addEventListener("click", saveCustomer);

		btnClear = editContainer.querySelector("#btnClear");
		btnClear.addEventListener("click", clearForm);

		btnDelete = editContainer.querySelector("#btnDelete");
		btnDelete.addEventListener("click", deleteCustomer);

		//btnGetAll = editContainer.querySelector("#btnGetAll");
		//btnGetAll.addEventListener("click", getAllCustomers);

		listContainer.addEventListener("click", getById);

		getAllCustomers();
	}

	function loginButtonClickHandler(){

		var passwordEntered = txtPassword.value;
		namespace.ajax.send({
			url: loginURL,
			method: "OPTIONS",
			callback: function(response){
				console.log("response to ajax call was status 200!");
				if(successfulLoginCallback){
					successfulLoginCallback("CONGRATS ON AUTHENTICATING\nRESPONSE BODY:\n" + response)
				}
			},
			errorCallback: function(status, msg){
				//console.log(status, msg);
				unsuccessfulLoginCallback("SORRY!!!");
			},
			headers: {"Authentication": passwordEntered}
		});
	}

	function getAllCustomers(){
		
		namespace.ajax.send({
			url: webServiceURL,
			method: "GET",
			callback: function(response){
				customers = JSON.parse(response);
				console.log(customers);
				createCustomerList(customers);
			}
		});
	}

	function getById(evt){

		var target = evt.target;
		if(target.classList.contains("btnEdit")){
			var selectedId = target.closest("tr").getAttribute("customerId");
		}
		
		namespace.ajax.send({
			url: webServiceURL + selectedId,
			method: "GET",
			callback: function(response){
				customer = JSON.parse(response);
				console.log(customer);
				populateCustomerForm(customer);
			}
		});
	}

	function saveCustomer(){
		if(validateInput()){
			var customerToSave = createCustomerFromForm();
		}else{
			return false;
		}
		if (customerToSave.customerId == 0){
			namespace.ajax.send({
				url: webServiceURL,
				method: "POST",
				headers: {"Content-Type": "application/json", "Accept": "application/json"},
				requestBody: JSON.stringify(customerToSave),
				callback: function(response){
					customers = JSON.parse(response);
					console.log(customers);
				}
			});
		}else{
			namespace.ajax.send({
				url: webServiceURL + customerToSave.customerId,
				method: "PUT",
				headers: {"Content-Type": "application/json", "Accept": "application/json"},
				requestBody: JSON.stringify(customerToSave),
				callback: function(response){
					customer = JSON.parse(response);
					console.log(customer);
					populateCustomerForm(customer);
				}
			});
		}

		getAllCustomers();
	}

	function deleteCustomer(){
		if(validateInput()){
			var customer = createCustomerFromForm();
		}else{
			alert("Please select a customer from the list");
			clearValidationMessages();
		}
		if(customer != null){
			var result = confirm(`Are you sure you want to delete ${customer.firstName} ${customer.lastName}?`);
			if(result){
				namespace.ajax.send({
					url: webServiceURL + customer.customerId,
					method: "DELETE",
					callback: function(response){
						getAllCustomers();
						clearForm();
						alert(`${customer.firstName} ${customer.lastName} has been deleted.`);
					}
				});
			}
		}
	}

	function createCustomerList(customers){

		listContainer.innerHTML = "";
		

		var html = `<h4>All Customers</h4>`;
		for(var x = 0; x < customers.length; x++){
			html += `<tr customerId="${customers[x].customerId}">
						<td>
							${customers[x].firstName} ${customers[x].lastName}
						</td>
						<td>
							<input type="button" class="btnEdit btn btn-outline-info pull-right" value="EDIT">
						</td>
					</tr>`
		}
		var table = document.createElement("table");
		table.classList.add("table");
		table.innerHTML = html;
		listContainer.appendChild(table);
		return table;
	}

	function populateCustomerForm(customer){
		clearForm();
		document.querySelector("#txtCustomerId").value = customer.customerId;
		document.querySelector("#txtFirstName").value = customer.firstName;
		document.querySelector("#txtLastName").value = customer.lastName;
		document.querySelector("#txtAddress").value = customer.address;
		document.querySelector("#txtCity").value = customer.city;
		document.querySelector("#txtState").value = customer.state;
		document.querySelector("#txtZip").value = customer.zip;
		document.querySelector("#txtEmail").value = customer.email;
	}

	function clearForm(){
		txtCustomerId.value = "";
		txtFirstName.value = "";
		txtLastName.value = "";
		txtAddress.value = "";
		txtCity.value = "";
		txtState.value = "";
		txtZip.value = "";
		txtEmail.value = "";

		clearValidationMessages();
	}

	function clearValidationMessages(){
		vFirstName.innerHTML = "";
		vLastName.innerHTML = "";
		vAddress.innerHTML = "";
		vCity.innerHTML = "";
		vState.innerHTML = "";
		vZip.innerHTML = "";
		vEmail.innerHTML = "";
	}

	function createCustomerFromForm(){
		if(txtCustomerId.value != 0){
			var updateCustomer = {
				customerId: txtCustomerId.value,
				firstName: txtFirstName.value,
				lastName: txtLastName.value,
				address: txtAddress.value,
				city: txtCity.value,
				state: txtState.value,
				zip: txtZip.value,
				email: txtEmail.value
			};

			return updateCustomer;
		}else{
			var addCustomer = {
				customerId: 0,
				firstName: txtFirstName.value,
				lastName: txtLastName.value,
				address: txtAddress.value,
				city: txtCity.value,
				state: txtState.value,
				zip: txtZip.value,
				email: txtEmail.value
			};

			clearValidationMessages();
			return addCustomer;
			
		}
	}

	function defaultErrorCallback(status, msg){
		console.log("DEFAULT ERROR CALLBACK");
		console.log(status, msg);
	}

	function validateZip(zip){
		var regExp = /^\d{5}$/;
		return regExp.test(zip);
	}

	function validateEmail(email){
        var regExp = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regExp.test(email);
	}

	function validateInput(){
		var isValid = true;

		if(!validateEmail(txtEmail.value)){
			isValid = false;
			txtEmail.focus();
			vEmail.innerHTML = "Please enter a valid email address.";
		}

		if(txtEmail.value == ""){
			isValid = false;
			txtEmail.focus();
			vEmail.innerHTML = "Please enter an email address.";
		}

		if(!validateZip(txtZip.value)){
			isValid = false;
			txtZip.focus();
			vZip.innerHTML = "Please enter a valid zip code.";
		}

		if(txtZip.value == ""){
			isValid = false;
			txtZip.focus();
			vZip.innerHTML = "Please enter a zip code.";
		}

		if(txtState.value == ""){
			isValid = false;
			txtState.focus();
			vState.innerHTML = "Please enter a state name."
		}

		if(txtCity.value == ""){
			isValid = false;
			txtCity.focus();
			vCity.innerHTML = "Please enter a city."
		}

		if(txtAddress.value == ""){
			isValid = false;
			txtAddress.focus();
			vAddress.innerHTML = "Please enter an address.";
		}

		if(txtLastName.value == ""){
			isValid = false;
			txtLastName.focus();
			vLastName.innerHTML = "Please enter a last name."
		}

		if(txtFirstName.value == ""){
			isValid = false;
			txtFirstName.focus();
			vFirstName.innerHTML = "Please enter a first name.";
		}

		return isValid;
	}

	////////////////////////////////////
	// "PUBLIC" methods (methods that are included in the return object below)
	/////////////////////////////////////
	function setButtonLabel(newLabel){
		btnLogin.value = newLabel;
	}

	// return the public API of the module
	return {
		setButtonLabel: setButtonLabel
	};

}