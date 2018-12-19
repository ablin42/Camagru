function insertAfter(newNode, referenceNode) {
    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}

function cooldown(input)
{
    input.disabled = true;
    setTimeout(function ()
    {
        input.disabled = false;
    }, 1000);
}

function submitCheckbox(checkbox)
{
    cooldown(checkbox);
    var xhttp = new XMLHttpRequest(),
        target = checkbox.getAttribute("id"),
        checked = 0,
        state = "disabled",
        msg = " mail notifications!",
        alert = document.getElementById("alert"),
        where = document.getElementById("header");

    if (checkbox.checked) {
        checked = 1;
        state = "enabled";
    }
    if (target === "scrolling")
        msg = " infinite scrolling!";
    xhttp.open("POST", `utils/modify_account.php`, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`form=${target}&state=${checked}`);
    var div = document.createElement('div');
    div.setAttribute("style", "position:fixed; top:0;z-index:10;width:100%;");
    if (alert)
        alert.remove();

    div.innerHTML +=    `  <div id=\"alert\" class=\"alert alert-info\" style=\"text-align: center;\" role=\"alert\">You <b>${state}</b> ${msg}\n ` +
                        "     <button type=\"button\" class=\"close\" onclick=\"dismissAlert(this)\" data-dismiss=\"alert\" aria-label=\"Close\">\n" +
                        "         <span aria-hidden=\"true\">&times;</span>\n" +
                        "     </button>\n" +
                        "  </div>";
    insertAfter(div, where);
}

function submitForm(form)
{
    var xhttp = new XMLHttpRequest(),
        formTarget = form.getAttribute("name"),
        tosend = `form=${formTarget}&`,
        children = form.children,
        childNb = form.childElementCount,
        inputs = [],
        inputId = [],
        inputElem = [],
        inputValue = [],
        alert = document.getElementById("alert"),
        where = document.getElementById("header"),
        div = document.createElement('div');

    cooldown(document.getElementById(`submit_${formTarget}`));
    for (i = 0; i < childNb; i++) {
        if (children[i].getElementsByTagName('input').length !== 0) {
            inputs.push(children[i].getElementsByTagName('input'));
            inputId.push(inputs[i][0].id);
            inputElem.push(document.getElementById(inputId[i]));
            inputValue.push(inputElem[i].value);
            if (i !== 0)
                tosend += '&';
            tosend += `${inputId[i]}=${inputValue[i]}`;
        }
    }

    xhttp.open("POST", `utils/modify_account.php`, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(tosend);

    div.setAttribute("style", "position:fixed; top:0;z-index:10;width:100%;");
    setTimeout(function (){
        if (alert)
            alert.remove();
        div.innerHTML += xhttp.responseText;
        insertAfter(div, where);
    }, 1000);

    //console.log(inputs); console.log(inputId); console.log(inputElem); console.log(inputValue); console.log(tosend);
    return false;
}