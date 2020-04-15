window.addEventListener("load", function(){
	
	var tm = namespace.TestModule({
		//webServiceURL: "the url to your contacts web service",
		container: document.getElementById("test-container"),
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