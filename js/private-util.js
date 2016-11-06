function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
};

function isValidName(name){
 var pattern = /^[A-Za-z]{2,30}$/; 
 return pattern.test(name);
}

function isValidMobileNumber(number){
var pattern = /^\d{10}$/;
return pattern.test(number);
}

function isValidFile(file){
	var validExts = new Array(".docx", ".doc", ".pdf");
	var fileName = file.prop('files')[0].name;
	var fileSize = (file.prop('files')[0].size)/1000;
    	//var fileExt = file.value;
    	fileExt = fileName.substring(fileName.lastIndexOf('.'));
    	if (validExts.indexOf(fileExt) < 0 || fileSize > 1000) {
      		alert("Invalid file selected, valid files are of " + validExts.toString() + " types. File must be smaller than 1Mb in size.");
      		return false;
    	}
    else return true;
}

function validateProfileInfo(firstName, lastName, email, mobileNumber, file){
	var resultArray = [];
	resultArray.push(isValidName(firstName));
	resultArray.push(isValidName(lastName));
	resultArray.push(isValidEmailAddress(email));
	resultArray.push(isValidMobileNumber(mobileNumber));
	resultArray.push(isValidFile(file));
	return resultArray;
}

function getAllIndexes(arr, val) {
    var indexes = [], i = -1;
    while ((i = arr.indexOf(val, i+1)) != -1){
        indexes.push(i);
    }
    return indexes;
}

function clearDialogFormData(){
	for(i=0; i<arguments.length; i++){
		arguments[i].val("");
	}
}