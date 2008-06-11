// JavaScript Document

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

function isUsername(word) {
	evaluator = /^[a-z0-9]+(_?[a-z0-9]+)*$/i;
	return evaluator.test(word);
}

function isEmail(word) {
	// todo: add underscores.
	evaluator = /^[a-z0-9]+(\.[a-z0-9]+)*@[a-z0-9]+(\.[a-z0-9]+)+$/i;
	return evaluator.test(word);
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
		alert(element.description + " must be in the form: xxx@xxx.xx and not contain underscores.");
		return false;
	}
	return true;
}

function checkUsername(element) {
	if (!isUsername(element.value)) {
		alert(element.description + " must be alpha-numeric with only 1 consecutive underscore.");
		return false;
	}
	return true;
}

function verifyElement(element) {
	if (element.type == "text" || element.type == "password") {
		if (element.isMandatory && checkBlank(element)) {
			return false;
		}
		
		if (element.isUsername && !checkUsername(element)) {
			return false;
		}
		
		if (element.isEmail && !checkEmail(element)) {
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
