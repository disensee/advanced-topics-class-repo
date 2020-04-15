var namespace = namespace || {};

namespace.TestModule = function(options){
	
	// "INSTANCE" vars
	var container = options.container;
	var callback = options.callback;
	var webServiceURL = options.webServiceURL || "//localhost/adv-topics/web-services/contacts/";
	var loginURL = options.loginURL || "login.php";
	var successfulLoginCallback = options.successfulLoginCallback || null;
	var unsuccessfulLoginCallback = options.unsuccessfulLoginCallback || defaultErrorCallback;
	
	var btnLogin;
	var txtPassword;
	var btnTestWebService;
	

	if(!container){
		//throw new Error("container option is required");
		console.log("container option is required");
	}else if((container instanceof HTMLElement) == false){
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
		container.innerHTML = "";
		
		container.innerHTML = `
			<input type="password" class="txtPassword">
			<input type="button" class="btnLogin" value="LOG IN">
			<input type="button" class="btnTestWebService" value="Test Request to Contacts WebService">
			<br>To logout, visit the <a href="login.php">login page</a> and then return to this page without logging in. 
		`;

		txtPassword = container.querySelector(".txtPassword");
		
		btnLogin = container.querySelector(".btnLogin");
		btnLogin.addEventListener("click", loginButtonClickHandler);

		btnTestWebService = container.querySelector(".btnTestWebService");
		btnTestWebService.addEventListener("click", testButtonClickHandler);
		
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

	function testButtonClickHandler(){
		
		namespace.ajax.send({
			url: webServiceURL,
			method: "GET",
			callback: function(response){
				console.log(response);
			}
		});
	}

	function defaultErrorCallback(status, msg){
		console.log("DEFAULT ERROR CALLBACK");
		console.log(status, msg);
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