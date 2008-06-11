// JavaScript Document
var xmlHttp;
var currentElement;

function ajax_verify(element) {
	// store current element for later
	currentElement = element;
	
	var str = element.value;
	//alert(currentElement.id+"Display");
	if (str.length == 0) {
		document.getElementById(element.id+"Display").innerHTML = "";
		return;
	}
	
	xmlHttp = GetXmlHttpObject();
  
	if (xmlHttp == null) {
		alert ("Browser does not support HTTP Request");
		return;
	}
	
	var url = "/phpscripts/ajax_verify.php";
	url = url + "?entered=" + str;
	url = url + "&field=" + element.id;
	url = url + "&sid=" + Math.random();	// prevent server from using cached file
	xmlHttp.onreadystatechange = stateChanged;
	xmlHttp.open("GET", url, true);	// set up a request to a web server
	xmlHttp.send(null);			// send a request to a web server
}

// stateChanged() - Only state 4 is of interest in AJAX
//
// State 0.  Request is not initialized - before open() called
// State 1.  Request is set up - before send() called
// State 2.  Request has been sent - after send() called
// State 3.  Request is in process - browser and server are in communication
// State 4.  Request is complete -request complete, response data received 
//           from server in "responseText" field

function stateChanged() { 
	if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
		document.getElementById(currentElement.id+"Display").innerHTML=xmlHttp.responseText;
	} 
}


function GetXmlHttpObject(){
	var objXMLHttp = null;
	
	if (window.XMLHttpRequest) {
		// Firefox, Opera 8.0+, Safari
    	objXMLHttp = new XMLHttpRequest();
  	} else if (window.ActiveXObject) {
		// Internet Explorer
    	objXMLHttp = new ActiveXObject("Microsoft.XMLHTTP");
  	}
 	return objXMLHttp;
}