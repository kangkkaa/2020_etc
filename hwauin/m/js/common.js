// Email check 함수
function isValidEmail(emailStr) {
	var emailPat=/^(.+)@(.+)$/
	var specialChars="\\(\\)<>@,;:\\\\\\\"\\.\\[\\]"
	var validChars="\[^\\s" + specialChars + "\]"
	var firstChars=validChars
	var quotedUser="(\"[^\"]*\")"
	var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/
	var atom="(" + firstChars + validChars + "*" + ")"
	var word="(" + atom + "|" + quotedUser + ")"
	var userPat=new RegExp("^" + word + "(\\." + word + ")*$")
	var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$")

	var matchArray=emailStr.match(emailPat)
	if (matchArray==null) {
		alert("이메일 형식에 맞지 않습니다. 다시 확인해주세요.")
		return false;
	} else {
		return true;
	}
}

function urlcheck(strvalue) {
	var url=strvalue;
	var url2=url.match("http://");

	if (url2 != null) {
		alert('http:// 없이 입력하세요.');
		return false;
	} else {
		return true;
	}
}

//입력박스에서 일정갯수의 문자가 입력되면 포커스를 다음 입력박스로 이동한다.
function NextFocus(box, count, nextBox) {
	if (box.value.length == count) {
		nextBox.focus();
	}
}

alpha_numeric = new String("0123456789abcdefghijklmnopqrstuvwxyz.");

function check_alphanumber(str) {
	var rtn;
	for(j=0; j<str.length; j++) {
		rtn = is_alpha_numeric(str.charAt(j));
		if (rtn == false) {
			return rtn;
		}
	}
	return rtn;
}

function is_alpha_numeric(cha1) {
	for(i=0; i<alpha_numeric.length; i++) {
		if (alpha_numeric.charAt(i) == cha1) {
			return true;
		}
	}
	return false;
}

function IsAlpha(c) {
	if (c >= '0' && c <= '9')
			return 1;
	if (c >= 'a' && c <= 'z')
			return 1;
	if (c >= 'A' && c <= 'Z')
			return 1;
	else return 0;
}