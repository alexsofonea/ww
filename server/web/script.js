
function createActionMenu(el) {
    var actions = el.getAttribute("data-actions").split("|");
    var actionMenu = document.createElement("div");
    actionMenu.setAttribute("class", "actionMenu");
    var i = 0;
    for (var a of actions) {
        a = a.split(";");
        actionMenu.innerHTML += "<div class='action' onClick=\"" + a[0] + "\"><img src='/assets/icons/" + a[1] + ".svg'><p>" + a[2] + "</p></div>";
        i++;
        if (i < actions.length)
            actionMenu.innerHTML += "<hr />";
    }
    var height = (i * 51) - 11;
    document.body.appendChild(actionMenu);
    actionMenu.setAttribute("style", "--t: " + (getOffset(el).top - height + 20) + "px; --l: " + (getOffset(el).left - 100) + "px; --h: " + height + "px; --t1: " + getOffset(el).top + "px;");
    var actionMenuBg = document.createElement("div");
    actionMenuBg.setAttribute("class", "actionMenuBg");
    actionMenuBg.setAttribute("onClick", "removeActionMenu()");
    document.body.appendChild(actionMenuBg);
}
function createActionMenuBig(el) {
    var actions = el.getAttribute("data-actions").split("|");
    var actionMenu = document.createElement("div");
    actionMenu.setAttribute("class", "actionMenu big");
    var i = 0;
    for (var a of actions) {
        a = a.split(";");
        actionMenu.innerHTML += "<div class='action' onClick=\"" + a[0] + "\"><img src='/assets/icons/" + a[1] + ".svg'><p>" + a[2] + "</p></div>";
        i++;
        if (i < actions.length)
            actionMenu.innerHTML += "<hr />";
    }
    var height = (i * 51) - 11;
    document.body.appendChild(actionMenu);
    actionMenu.setAttribute("style", "--t: " + (getOffset(el).top) + "px; --l: " + (getOffset(el).left - 130) + "px; --h: " + height + "px; --t1: " + (getOffset(el).top) + "px;");
    var actionMenuBg = document.createElement("div");
    actionMenuBg.setAttribute("class", "actionMenuBg");
    actionMenuBg.setAttribute("onClick", "removeActionMenu()");
    document.body.appendChild(actionMenuBg);
}
function removeActionMenu() {
    var actionMenu = document.getElementsByClassName("actionMenu");
    for (var i = 0; i < actionMenu.length; i++) {
        //actionMenu[i].style.animation = "none";
        actionMenu[i].style.top = "calc(var(--t1) + 40px)";
        actionMenu[i].style.left = "calc(var(--l) + 140px)";
        actionMenu[i].style.width = "0px";
        actionMenu[i].style.height = "0px";
        actionMenu[i].style.padding = "0px";
    }
    setTimeout(function () {
        actionMenu = document.getElementsByClassName("actionMenu");
        for (var i = 0; i < actionMenu.length; i++)
            actionMenu[i].remove();
    }, 200);
    actionMenu = document.getElementsByClassName("actionMenuBg");
    for (var i = 0; i < actionMenu.length; i++)
        actionMenu[i].remove();
}
function getOffset(el) {
    const rect = el.getBoundingClientRect();
    return {
        left: rect.left + window.scrollX,
        top: rect.top + window.scrollY
    };
}


function version(version) {
    var v = version.getElementsByClassName('v');
    if (version.getAttribute("data-open") == "false") {
        var pos = 30;
        for (var i = 0; i < v.length; i++) {
            v[i].style.display = "block";
            v[i].style.top = (5 + pos) + "px";
            pos += 40;
        }
        version.style.height = (pos + 20) + "px";
        version.getElementsByTagName("svg")[0].style.transform = "rotate(180deg)";
        version.setAttribute("data-open", "true");
    } else {
        for (var i = 0; i < v.length; i++) {
            v[i].style.top = "5px";
            v[i].style.display = "none";
        }
        version.getElementsByTagName("svg")[0].style.transform = "rotate(0deg)";
        version.setAttribute("data-open", "false");
        version.style.height = "45px";
    }
}
function select(el) {
    var p = el.parentElement.getElementsByTagName("p")[0];
    p.innerHTML = `<b>` + el.innerHTML + `</b><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M201.4 342.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 274.7 86.6 137.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"/></svg>`;
    p.getElementsByTagName("img")[0].remove();
    el.parentElement.setAttribute("value", el.getAttribute("value") || p.textContent || p.innerText);
    p.click();
}





function alert(q) {
    askUser("alert", q, function () { });

    //hapticFeedback();
}
function prompt(q, func, data) {
    askUser("prompt", q, func, data);
}
function confirm(q, func, main = 1) {
    askUser("confirm", q, func, main);
}
function askUser(type, question, func, data = "") {
   askUserPrompt = '';
   var box = document.createElement("div");
   box.setAttribute("class", "userBox");
   var blur = document.createElement("div");
   blur.setAttribute("class", "userBoxBlur");
   switch (type) {
       case 'alert':
            box.innerHTML = "<h4>" + question + "</h4><div class='buttons'><a href='javascript:askUserPromptPress(\"Close\")'>Close</a></div>";
            break;
       case 'prompt':
            box.innerHTML = "<div class='user-box'><div class='input'><input type='text' id='pr' data-requiredVal='" + data + "' required name='pr' placeholder = ' '/><p>" + question + "</p></div></div><br /><div class='buttons'><a class='main' href='javascript:askUserPromptPress(\"Submit\")'>Submit</a>&nbsp;&nbsp;&nbsp;<a href='javascript:askUserPromptPress(\"Close\")'>Close</a></div>";
            break;
       case 'confirm':
            if (data == 0)
                var but = "<a class='main' href='javascript:askUserPromptPress(\"Yes\")'>Yes</a>&nbsp;&nbsp;&nbsp;<a href='javascript:askUserPromptPress(\"No\")'>No</a>";
            else
                var but = "<a href='javascript:askUserPromptPress(\"Yes\")'>Yes</a>&nbsp;&nbsp;&nbsp;<a class='main' href='javascript:askUserPromptPress(\"No\")'>No</a>";
            box.innerHTML = "<h4>" + question + "</h4><div class='buttons'>" + but + "</div>";
            break;
       default:
           return -1;
   }
   document.body.appendChild(box);
   document.body.appendChild(blur);
   return askUserWait(func);
}

function askUserWait(func) {
    if (askUserPrompt == '') 
        setTimeout(function () { return askUserWait(func); }, 100);
    else {
        if (askUserPrompt == "Yes" || askUserPrompt == "Close") {
            func();
            removeAskUser();
        } else if (askUserPrompt == "Submit" && document.getElementById('pr').value == document.getElementById('pr').getAttribute("data-requiredVal")) {
            removeAskUser();
            func();
        } else {
            removeAskUser();
        }
        return 0;
    }  
}
function removeAskUser() {
    document.getElementsByClassName('userBox')[0].remove();
    document.getElementsByClassName('userBoxBlur')[0].remove();
}
function askUserPromptPress(el) {
    askUserPrompt = el;
}