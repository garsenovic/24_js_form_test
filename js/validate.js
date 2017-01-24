function validate() {
    var f = document.forms[0];
    var fehler = false;
    //var regausdruck = new RegExp('.@.');
    meldungenLeeren();
    with(document) {
        // Kontrolle Date
        if(getElementById("datepicker").value == "") {
            getElementById("datepickerinfo").innerHTML = "Das Feld darf nicht leer sein";
            getElementById("datepicker").style.backgroundColor = "red";
            getElementById("datepicker").value = "";
            getElementById("datepicker").focus();
            fehler = true;
        }
        // Kontrolle Descritpion
        if(getElementById("description").value == "") {
            getElementById("descriptioninfo").innerHTML = "Das Feld darf nicht leer sein";
            getElementById("description").style.backgroundColor = "red";
            getElementById("description").value = "";
            getElementById("description").focus();
            fehler = true;
        }
        if(getElementById("description").value.length > 4) {
            getElementById("descriptioninfo").innerHTML = "Die Beschreibung muss mehr als 4 Zeichen enthalten";
            getElementById("description").style.backgroundColor = "red";
            getElementById("description").value = "";
            getElementById("description").focus();
            fehler = true;
        }

        // Kontrolle Price
        if(getElementById("price").value  < 0) {
            getElementById("priceinfo").innerHTML = "Der Wert muss positiv sein / Das Feld darf nicht leer sein";
            getElementById("price").style.backgroundColor = "red";
            getElementById("price").value = "";
            getElementById("price").focus();
            fehler = true;
        }
    }
    if(!fehler) {
        fehler = false;
        f.action = "http://safety-first-rock.de/info.php";
        f.submit();

    } else {
        fehler = false;
        return false;
    }
}

function zuruecksetzen() {
    var f = document.forms[0];
    if(confirm("Das Formular wird zurückgesetzt.\nSind Sie sicher?")) {
        meldungenLeeren();
        f.action = "";
        f.reset();
        return false;
    }
    return false;
}

function meldungenLeeren() {
    with(document) {
        getElementById("datepickerinfo").innerHTML = "";
        getElementById("descriptioninfo").innerHTML = "";
        getElementById("priceinfo").innerHTML = "";
        getElementById("datepicker").style.backgroundColor = "white";
        getElementById("description").style.backgroundColor = "white";
        getElementById("price").style.backgroundColor = "white";
    }
}

function init() {
    document.getElementById("absenden").onclick = validate;
    document.getElementById("zurueck").onclick = zuruecksetzen;
}

window.onload = init;
