function checkUsername() {
    var username = document.getElementById("username");
    var msgElt = document.getElementById("errmsg");
    var letters = /[^A-Za-z]+$/;
    if(username.value.length < 4) {
        msgElt.innerText = "Username must not be less than 4 characters";
    }
    else if(/[^A-Za-z]+$/.test(username.value)) {
        msgElt.innerText = "Username must only have alphabetical letters";
    }
    else {
        msgElt.innerText = "";
    }
}

function checkDate() {
    var ok = _privateCheck();
    var okday = checkD();
    var okmonth = checkMth();
    var submitButton = document.getElementById("submit");
    if(okday == false || okmonth == false || ok == false)
        submitButton.disabled = true;
    else
        submitButton.disabled = false;
}

function _privateCheck() {
    var year = document.getElementById("year").value;
    var msgElt = document.getElementById("errmsg");

    if(year == "") {
        msgElt.innerText = "Year is required and must be between 1900 and 2100";
        return false;
    }

    if(isNaN(year) || year <= 1900 || year >= 2100) {
        msgElt.innerText = "Year must be between 1900 and 2100, not '" + year + "'";
        return false;
    }
    msgElt.innerText = "";
    return true;
}

function checkMonth() {
    var ok = checkMth();
    var submitButton = document.getElementById("submit");
    submitButton.disabled = !ok;
}

function checkMth() {
    var month = document.getElementsByName("month");
    var msgElt = document.getElementById("errmsg");
    for(var i = 0; i < month.length; i++) {
        if(month[i].checked) {
            msgElt.innerText = "";
            return true;
        }
    }
    return false;
}

function checkDay() {
    var ok = checkD();
    var submitButton = document.getElementById("submit");
    submitButton.disabled = !ok;
}

function checkD() {
    var month = document.getElementsByName("month");
    var d = document.getElementById("day");
    var day = d.options[d.selectedIndex].value;
    var year = document.getElementById("year").value;
    var msgElt = document.getElementById("errmsg");
    if(month[1].checked) {
        if(year%4 == 0 && (year > 1900 || year < 2100)) {
            if(day < 1 || day > 29) {
                msgElt.innerText = "Invalid day: " + day + ", must be between 1 and 29";
                return false
            }
        }
        else {
            if(day < 1 || day > 28) {
                msgElt.innerText = "Invalid day: " + day + ", must be between 1 and 28";
                return false;
            }
        }
    }
    if(month[3].checked || month[5].checked || month[8].checked || month[10].checked) {
        if(day < 1 || day > 30) {
            msgElt.innerText = "Invalid day: " + day + ", must be between 1 and 30";
            return false;
        }
    }
    else if(month[0].checked || month[2].checked || month[4].checked || month[6].checked || month[7].checked || month[9].checked || month[11].checked){
        if(day < 1 || day > 31) {
            msgElt.innerText = "Invalid day: " + day + ", must be between 1 and 31";
            return false;
        }
    }
    return true;
}