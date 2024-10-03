
var edit = document.getElementById("editor");
function editor(el) {
    removeActionMenu();

    el = document.getElementById("element" + el);
    edit.querySelector("iframe").srcdoc = el.querySelector("iframe").getAttribute("srcdoc");

    var form = edit.querySelector(".form.op");
    form.innerHTML = "";
    Object.entries(JSON.parse(atob(el.getAttribute("data-var")))).forEach(([key, value]) => {
        form.innerHTML += `<div name="vars">
            <input value="${key}" disabled>
            <input placeholder="${value}" value="${value}">
        </div>`;
    });

    var version = edit.querySelector(".version");
    version.querySelectorAll(".v").forEach(el => {
        el.remove();
    });
    JSON.parse(atob(el.getAttribute("data-variation"))).forEach((value) => {
        version.innerHTML += `<p class="v" value='${value[1]}' onclick="select(this); updateView();"><img src="/assets/icons/props.svg"> ${value[0]}</p>`;
    });

    edit.querySelector("xmp").innerText = atob(el.getAttribute("data-html"));

    edit.style.opacity = 1;
    edit.style.pointerEvents = "all";
    var bg = document.querySelector(".backgroundBlur")
    bg.style.opacity = 1;
    bg.style.pointerEvents = "all";
}
function getVars() {
    var vars = {};
    edit.querySelectorAll("div[name='vars']").forEach(el => {
        let key = el.querySelectorAll("input")[0].value.toLowerCase().replace(/\s+/g, '-');
        vars[key] = el.querySelectorAll("input")[1].value;
    });
    return vars;
}
function dismissEditor(e) {
    var edit = document.getElementById("editor");
    edit.style.opacity = 0;
    edit.style.pointerEvents = "none";
    e.style.opacity = 0;
    e.style.pointerEvents = "none";
}
function updateView() {
    var css = "body { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); margin: 0; } " + convertToCSS(edit.querySelector(".version").getAttribute("value"));
    css = css.replace(/\$([^\;]+)\;/g, function(match, p1) {
        return getVars()[p1] + ";";
    });
    if (css != "")
        render2(edit.querySelector("iframe"), css);
}
function render2(iframe, css) {
    var doc = iframe.contentWindow.document;
    var styleTag = doc.querySelector('style');
    if (styleTag) {
        styleTag.innerHTML = css;
    } else {
        styleTag = doc.createElement('style');
        styleTag.innerHTML = css;
        doc.head.appendChild(styleTag);
    }
}
function convertToCSS(css) {
    let cssString = '';

    css = JSON.parse(css);

    
    for (const selector in css) {
        cssString += `${selector} {\n`;

        for (const property in css[selector]) {
            const value = css[selector][property];
            cssString += `  ${property}: ${value};\n`;
        }
        cssString += `}\n`;
    }

    return cssString;
}
