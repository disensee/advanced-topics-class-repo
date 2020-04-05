var namespace = namespace || {};

/*
This module is set up just slightly different than other ones we've created.
It uses an IIFE (immediately invoking function expression), look it up if you're interested.
Much like the module functions that we wrote earlier in this course, the anonymous function below 
creates a closure and returns an object that has methods. 
In this case the return object includes a single method (so the API of this module will consist of a single method named 'send') 
*/
namespace.ajax = (function(){

	/**
	* Sends an XMLHttpRequest and returns the response in a callback.
	* @method send
	*
	* @param {function} options.callback 		This function will be invoked when the reqeust completes success
	* 											The responseText (response body) should be passed in as a param
	*
	* @param {string} options.url				The url to request
	*
	* @param {string} options.method			The request method
	*
	* @param {object} [options.headers]			An object (key/value pairs) where the key is the header to set, 
	*											and the value is what the header should be set to. For example:
	* 											{"Content-Type":"text/html", "Accept":"application/json"} 
	*
	* @param {string} [options.requestBody]
	*
	* @param {function} [options.errorCallback]	If an errorCallback is included in the options, it should be invoked when a request fails.
	* 											When invoked, two params should be passed in:
	* 												1. The status code of the response
	*												2. The status text/message
	*											If an errorCallback is NOT included in the options, then the module
	*											should console log the status code and message when the request fails
	*/
	function send(options){
		var http = new XMLHttpRequest();
		http.open(options.method, options.url);

		if(options.headers){
			for(key in options.headers){
				http.setRequestHeader(key, options.headers[key]);
			}
		}

		http.addEventListener("readystatechange", ()=>{
			if(http.readyState == 4 && http.status == 200){
				options.callback(http.responseText);
			}else if(http.readyState == 4){
				if(options.errorCallback){
					options.errorCallback(http.status, http.statusText);
				}else{
					console.log("ERROR: \n Error Status Code: " + http.status + "\nError Message: " + http.statusText);
				}
			}
		});

		http.send(options.requestBody || null);

	}

	return{
		send: send
	}

})();