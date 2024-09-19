
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


function version() {
    var version = document.getElementsByClassName('version')[0];
    var v = document.getElementsByClassName('v');
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