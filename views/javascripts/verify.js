// JavaScript Document

function isPass(word) {
	evaluator = /^[a-z0-9]{6}[a-z0-9]*$/i;
	return evaluator.test(word);
}

function isBlank (word) {
	if (word == null || word == "") {
		return true;
	}
	
	evaluator = /^( |\n|\t)+$/i;
	return evaluator.test(word);
}

function isAlpha(word) {
	evaluator = /^[a-z]+$/i;
	return evaluator.test(word);
}

function isName(word) {
	evaluator = /^[a-z]+( ?[a-z]+)*$/i;
	return evaluator.test(word);
}

function isEmail(word) {
	// todo: add underscores.
	evaluator = /^[a-z0-9]+(\.[a-z0-9]+)*@[a-z0-9]+(\.[a-z0-9]+)+$/i;
	return evaluator.test(word);
}

function checkPass(element) {
	if (!isPass(element.value)) {
		alert(element.description + " must be at least 6 alpha-numeric characters long.");
		return false;
	}
	return true;
}

function checkBlank(element) {
	if (isBlank(element.value)) {
		alert(element.description + " cannot be blank.");
		return true;
	}
	return false;
}


function checkAlpha(element) {
	if (!isAlpha(element.value)) {
		alert(element.description + " must consist of alphabetical characters.");
		return false;
	}
	return true;
}


function checkEmail(element) {
	if (!isEmail(element.value)) {
		alert(element.description + " must be in a valid email format.");
		return false;
	}
	return true;
}

function checkName(element) {
	if (!isName(element.value)) {
		alert(element.description + " must consist of one or more words made of alphabetical characters.");
		return false;
	}
	return true;
}

function verifyElement(element) {
	if (element.type == "text" || element.type == "password") {
		if (element.isMandatory && checkBlank(element)) {
			return false;
		}
		
		if (element.isName && !checkName(element)) {
			return false;
		}
		
		if (element.isEmail && !checkEmail(element)) {
			return false;
		}
		
		if (element.isPassword && !checkPass(element.value)) {
			return false;
		}
	}
	return true;
}

function verifyForm(form) {
	for (var i = 0; i < form.length; i++) {
		element = form.elements[i];
		if (!verifyElement(element)) {
			return false;	
		}
	}
	return true;
}

function realtime_verify(element) {
	var validTxt = "<img src=\"views/images/check.gif\">";
	var invalidTxt = "<img src=\"views/images/x.gif\">";
	
	// assume true, set to false if error occurrs
	var valid = true;
	
	if (element.type == "text" || element.type == "password") {
		if (element.isMandatory && isBlank(element.value)) {
			valid = false;
		}
		
		if (element.isName && !isName(element.value)) {
			valid = false;
		}
		
		if (element.isEmail && !isEmail(element.value)) {
			valid = false;
		}
		
		if (element.isPassword && !isPass(element.value)) {
			valid = false;
		}
	}
	
	if (element.value.length == 0) {
		$(element.id+"Display").innerHTML = '';
	} else if (valid) {
		$(element.id+"Display").innerHTML = validTxt;
	} else {
		$(element.id+"Display").innerHTML = invalidTxt;
	}
}

