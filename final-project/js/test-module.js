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
	
	var customers;
	var txtPassword;
	var txtFirstName;
	var txtLastName;
	var txtAddress;
	var txtCity;
	var txtState;
	var txtZip;
	var txtEmail;
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
			<div id="form-container">
				<form id="customer-form">
					<input type="text" id="txtCustomerId" readonly="true"><br>
					<label>First Name</label>
					<input type="text" id="txtFirstName" />
					<label>Last Name</label>
					<input type="text" id="txtLastName"/>
					<label>Address</label>
					<input type="text" id="txtAddress"/>
					<label>City</label>
					<input type="text" id="txtCity"/>
					<label>State</label>
					<input type="text" id="txtState"/>
					<label>Zip Code</label>
					<input type="text" id="txtZip"/>
					<label>Email Address</label>
					<input type="text" id="txtEmail"/>
					<br>
					<input type="button" value="Save" id="btnSave">
					<input type="button" value="Clear" id="btnClear">
					<input type="button" value="DELETE" id="btnDelete">
					<br>
					<input type="button" value = "Get All Customers" id="btnGetAll" />
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

		btnGetAll = editContainer.querySelector("#btnGetAll");
		btnGetAll.addEventListener("click", getAllCustomers);

		listContainer.addEventListener("click", getById);
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
			var selectedId = target.closest("li").getAttribute("customerId");
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
		var customerToSave = createCustomerFromForm();
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
		var customer = createCustomerFromForm();
		if(customer != null){
			var result = confirm(`Are you sure we want to delete ${customer.firstName} ${customer.lastName}?`);
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
		

		var html = "";
		for(var x = 0; x < customers.length; x++){
			html += `<li customerId="${customers[x].customerId}">
						${customers[x].firstName} ${customers[x].lastName}
						<br>
						<input type="button" class="btnEdit" value="EDIT">
					</li>`
		}
		var ul = document.createElement("ul");
		ul.innerHTML = html;
		listContainer.appendChild(ul);
		return ul;
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

			return addCustomer;
		}
	}

	function defaultErrorCallback(status, msg){
		console.log("DEFAULT ERROR CALLBACK");
		console.log(status, msg);
	}

	function validateInput(){
		var isValid = true;

		if(txtEmail.value == ""){
			isValid = false;
			txtEmail.focus();
		}

		if(txtZip.value == "" || txtEmail.value.length < 5){
			isValid = false;
			txtZip.focus();
		}

		//TODO: Finish client side validation
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