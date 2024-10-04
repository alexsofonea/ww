
var cssCode = Array(), defalutCSS = "";

function addVariation(el) {
    el.outerHTML = "<div class='form mini'><input class='input' name='styleName' placeholder='Variation Name'><span class='input-border'></span></div><div class='form mini'><textarea class='input' id='cssInput' placeholder='Add CSS' required='' rows='10' onkeyup='parseCSS(this)'></textarea><span class='input-border'></span></div><a onclick='addVariation(this)' style='float: right;'>Add Variation</a>";

    var v = document.getElementById("versionPreview");
    var nr = Number(v.getAttribute("data-nr")) + 1;
    v.setAttribute("data-nr", nr);
    v.innerHTML += `<p class='v' value='${nr}' onclick='select(this); render();'><img src='/assets/icons/props.svg'> Style ${nr}</p>`;
}
function addVariable(el) {
    el.outerHTML = "<div class='form mini op' name='variables'><div><input placeholder='Variable Name'><input placeholder='Default Value'></div></div><a onclick='addVariable(this)' style='float: right;'>Add Variable</a>";
}
function render() {
    var html = document.getElementById("htmlInput").value;
    var css = convertToCSS(reParseCSS(Number(document.querySelector("#versionPreview").getAttribute("value")) ?? 0));
    if (html == "" || css == "") return;
    var iframe = document.createElement("iframe");
    document.querySelector(".preview").innerHTML = "";
    document.querySelector(".preview").appendChild(iframe);

    var doc = iframe.contentWindow.document;
    doc.open();
    doc.write(html + "<style>" + css + "</style>");
    doc.write("<script>var element = document.querySelector('wwElement'); " + document.getElementById("jsInput").value + "</script>");
    doc.close();

    var el = doc.body;
    el.style.position = "absolute";
    el.style.top = "50%";
    el.style.left = "50%";
    el.style.transform = "translate(-50%, -50%)";
}
function parseCSS(css) {
    const cssObj = {};
    const rules = css.value.match(/[^{]*\{[^}]*\}/g);

    if (defalutCSS == "") defalutCSS = css.value;

    var parent = css.parentElement;

    rules.forEach(rule => {
        const [selectors, properties] = rule.split('{');
        const selector = selectors.trim().toLowerCase();

        const propertyObj = {};
        properties
        .trim()
        .slice(0, -1)
        .split(';')
        .filter(prop => prop.trim())
        .forEach(prop => {
            const [key, value] = prop.split(':');
            propertyObj[key.trim()] = value.trim();
        });

        cssObj[selector] = propertyObj;
    });

    if (cssObj.length == 0) return;

    parent.innerHTML = "";
    parent.setAttribute("class", "css");

    var elementName = "";

    Object.keys(cssObj).forEach(selector => {
        var p = document.createElement("div");
        p.setAttribute("name", "css");
        p.setAttribute("class", "form mini op");
        parent.appendChild(p);
        const properties = cssObj[selector];
        if (selector != "") {
            if (elementName == "") elementName = selector;
            p.innerHTML += `<div><input type='text' value='${selector.replace(elementName, "wwElement")}'></div>`;
        }
        Object.keys(properties).forEach(property => {
            const value = properties[property];
            if (value != "")
                p.innerHTML += `<div><input type='text' value='${property}'><input type='text' value='${value}'></div>`;
        });
    });

    cssCode.push(cssObj);
}

function convertToCSS(css) {
    let cssString = '';

    for (const cssObj of css) {
        for (const selector in cssObj) {
            cssString += `${selector} {\n`;
    
            for (const property in cssObj[selector]) {
                const value = cssObj[selector][property];
                cssString += `  ${property}: ${value};\n`;
            }
    
            cssString += `}\n`;
        }
    }

    return cssString;
}

function reParseCSS(cssEle = -1) {
    var css = [];
    if (cssEle == -1) {
        document.querySelectorAll('.css').forEach(ele => {
            var cssObj = {};
            var elementName = "";
            ele.querySelectorAll('[name="css"]').forEach(el => {
                const inputs = el.getElementsByTagName("input");
                if (elementName == "") elementName = inputs[0].value;
                var selector = inputs[0].value.replace(elementName, "wwElement");
                var data = {};
                for (var i = 1; i < inputs.length - 1; i += 2) {
                    var property = inputs[i].value;
                    var value = inputs[i + 1].value;
                    data[property] = value;
                }
                cssObj[selector] = data;
            });
            css.push(cssObj);
        });
    } else {
        var cssObj = {};
        var elementName = "";
        document.querySelectorAll('.css')[cssEle].querySelectorAll('[name="css"]').forEach(el => {
            const inputs = el.getElementsByTagName("input");
            if (elementName == "") elementName = inputs[0].value;
            var selector = inputs[0].value.replace(elementName, "wwElement");
            var data = {};
            for (var i = 1; i < inputs.length - 1; i += 2) {
                var property = inputs[i].value;
                var value = inputs[i + 1].value;
                data[property] = value;
            }
            cssObj[selector] = data;
        });
        css.push(cssObj);
    }

    return css;
}

function getVariables() {
    var variables = {};
    var vars = document.getElementsByName("variables");
    for (var i = 0; i < vars.length; i++) {
        var children = vars[i].getElementsByTagName("input");
        variables[children[0].value] = children[1].value;
    }
    return variables;
}

function save() {
    var names = Array();
    document.getElementsByName("styleName").forEach(el => {
        names.push(el.value);
    });
    var data = {
        'category': document.getElementsByClassName("version")[0].getAttribute("value") ?? "",
        'type': document.getElementsByClassName("version")[1].getAttribute("value") ?? "",
        'name': names,
        'css': reParseCSS(),
        'html': document.getElementById("htmlInput").value,
        'variables': getVariables(),
        'js': document.getElementById("jsInput").value,
        'additionalJS': document.getElementById("jsInput2").value
    };

    var s = data.css.flatMap(cssObj => {
        const values = [];
        for (const selector in cssObj) {
            const properties = cssObj[selector];
            for (const property in properties) {
                if (properties[property].includes('$')) {
                    values.push(properties[property]);
                }
            }
        }
        return values;
    });

    const variableKeys = Object.keys(data.variables);
    const sValues = s.map(value => value.replace('$', '').toLowerCase().replace(/\s+/g, '-').replace(/\b\w/g, char => char.toUpperCase()));

    if (!sValues.every(value => variableKeys.includes(value)) || !variableKeys.every(key => sValues.includes(key))) {
        alert("Invalid variables.");
        return;
    }

    if (data.category == "" || data.type == "" || data.name.length == 0 || data.css.length == 0 || data.variables.length == 0 || data.js == "") {
        alert("Missing data.");
        return
    }

    console.log(data);

    $.ajax({
        type: "POST",
        url: "/design/save.php",
        data: data,
        success: function (response) {
            console.log(response);
        }
    });
}