window.addEventListener("load", function(){
	
	var tm = namespace.TestModule({
		webServiceURL: "//localhost/adv-topics/web-services/customers/",
		loginContainer: document.getElementById("test-container"),
		listContainer: document.getElementById("list-container"),
		editContainer: document.getElementById("edit-container"),
		successfulLoginCallback: function(param){
			alert(param);
			tm.setButtonLabel("YOU HAVE LOGGED IN");
		},
		unsuccessfulLoginCallback: function(param){
			alert(param);
			tm.setButtonLabel("TRY AGAIN!");
		},
	});


});