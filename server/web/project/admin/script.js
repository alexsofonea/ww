function showSub(el) {
    var svg = el.getElementsByTagName("svg")[0];
    el = el.nextElementSibling;
    if (el.classList.contains('sub')) {
        if (el.getAttribute("open") == "1") {
            el.style.height = "0";
            el.style.paddingTop = "0";
            el.style.marginTop = "0";
            svg.style.transform = "rotate(-90deg)";
            el.setAttribute("open", "0");
            let height = el.offsetHeight;
            if (el.parentElement.classList.contains('sub')) { 
                let height2 = 0;
                Array.from(el.parentElement.children).forEach(child => {
                    height2 += child.offsetHeight + 5;
                });
                height2 -= height + 5;
                el.parentElement.style.height = height2 + "px";
            }
        } else {
            let height = 0;
            Array.from(el.children).forEach(child => {
                height += child.offsetHeight + 5;
            });
            el.style.paddingTop = "5px";
            el.style.marginTop = "-5px";
            el.style.height = height + "px";
            svg.style.transform = "rotate(0deg)";
            el.setAttribute("open", "1");
            if (el.parentElement.classList.contains('sub')) { 
                let height2 = 0;
                Array.from(el.parentElement.children).forEach(child => {
                    height2 += child.offsetHeight + 5;
                });
                height2 += height + 5;
                el.parentElement.style.height = height2 + "px";
            }
        }
    }
}
function collapse() {
    var bar = document.getElementsByClassName("bar")[0];
    var content = document.getElementsByClassName("content")[0];

    if (bar.getAttribute("data-collapse") == "false") {
        bar.style.transform = "translateX(-100%)";
        bar.style.width = "0%";
        content.style.width = "100%";
        bar.setAttribute("data-collapse", "true");
    } else {
        bar.removeAttribute("style");
        content.removeAttribute("style");
        bar.setAttribute("data-collapse", "false");
    }
}

function getContentDiv(htmlString) {
    const tempDiv = $("<div>").html(htmlString);
    const content = tempDiv.find("#content").html();
    return content;
  }

function loadPage(url) {
    console.log(`Loading page: ${url}`);
    fetch(url)
        .then(response => response.text())
        .then(data => {
            document.getElementById('content').innerHTML = getContentDiv(data);
            const onloadMatch = data.match(/<body[^>]*onload=["']?([^"'>]*)["']?/i);
            runScriptsFromHTML(getContentDiv(data));
            if (onloadMatch && onloadMatch[1]) {
                const onloadFunctionName = onloadMatch[1].split('(')[0]; // Extract the function name without parentheses
                console.log(`Found onload function: ${onloadFunctionName}`);

                // Step 2: Check if the function exists and then call it
                if (typeof window[onloadFunctionName] === 'function') {
                    window[onloadFunctionName]();
                } else {
                    console.log(`Function ${onloadFunctionName} is not defined.`);
                }
            }
            history.pushState(null, null, url);
        })
        .catch(() => {
            console.log('Error loading page');
        });
}

document.addEventListener("click", function (e) {
    if (e.target.classList.contains("button")) {
        if (e.target.classList.contains("link")) {
            location.assign(e.target.getAttribute("href"));
            return;
        }
        if (e.target.classList.contains("active") || e.target.hasAttribute("onclick")) return;
        e.preventDefault();
        const url = e.target.getAttribute("href");

        loadPage(url);

        document.querySelectorAll(".button").forEach(button => {
            button.classList.remove("active");
        });
        e.target.classList.add("active");
        if (e.target.parentElement.classList.contains("sub")) {
            console.log(e.target.parentElement);
            var p = e.target.parentElement.previousSibling;
            if (p.parentElement.classList.contains("sub"))
                p.parentElement.previousSibling.classList.add("active");
            else
                p.classList.add("active");
        }
    }
});

window.addEventListener("popstate", function () {
    loadPage(location.pathname);
});

function encodeHTMLQuotes(htmlString) {
    return htmlString
      .replace(/"/g, "&quot;")      // Replace double quotes
      .replace(/'/g, "&#39;")       // Replace single quotes
      .replace(/`/g, "&#96;");      // Replace backticks
}

Object.prototype.loadEditorPage = function(url) {
    const unixTime = Math.floor(Date.now() / 1000);
    var newContent = `<script src="/project/admin/builder/editor.js?cache=${unixTime}"></script>
		              <link rel="stylesheet" href="/project/admin/builder/editor.css?cache=${unixTime}">`;
    fetch(url)
        .then(response => response.text())
        .then(data => {
            const baseUrl = url.substring(0, url.lastIndexOf('/') + 1);
            this.innerHTML = "<iframe sandbox='allow-scripts' srcdoc='" + encodeHTMLQuotes(data.replace(/(?<!https:\/\/[^\/]+\/)assets\//g, baseUrl + 'assets/').replace(/<body([^>]*)>/, `<body$1>${newContent}`)) + "'></iframe>";
        })
        .catch(error => {
            console.log('Error loading page: ', url, error);
        });
};
Object.prototype.loadSimplePage = function(url, additional = "") {
    const unixTime = Math.floor(Date.now() / 1000);
    var newContent = `<script src="/project/admin/builder/editor.js?cache=${unixTime}"></script>
		              <link rel="stylesheet" href="/project/admin/builder/editor.css?cache=${unixTime}">`;
    fetch(url)
        .then(response => response.text())
        .then(data => {
            const baseUrl = url.substring(0, url.lastIndexOf('/') + 1);
            this.innerHTML = additional + "<iframe sandbox='allow-scripts' srcdoc='" + encodeHTMLQuotes(data.replace(/(?<!https:\/\/[^\/]+\/)assets\//g, baseUrl + 'assets/').replace(/<body([^>]*)>/, `<body$1>${newContent}`)) + "'></iframe>";
        })
        .catch(error => {
            console.log('Error loading page: ', url, error);
        });
};
function runScriptsFromHTML(htmlString) {
    const parser = new DOMParser();
    const doc = parser.parseFromString(htmlString, 'text/html');
    const scripts = doc.querySelectorAll('script');
    scripts.forEach(script => {
        const newScript = document.createElement('script');
        if (script.textContent) {
            newScript.textContent = script.textContent;
        }
        if (script.src) {
            newScript.src = script.src;
        }
        document.body.appendChild(newScript);
        document.body.removeChild(newScript);
    });
}

function version(version) {
    var v = version.getElementsByClassName('v');
    console.log(v);
    if (version.getAttribute("data-open") == "false") {
        var pos = 30;
        for (var i = 0; i < v.length; i++) {
            v[i].style.display = "block";
            v[i].style.top = (5 + pos) + "px";
            pos += 40;
        }
        version.style.height = (pos + 20) + "px";
        version.getElementsByTagName("svg")[0].style.transform = "translateY(6px) rotate(180deg)";
        version.setAttribute("data-open", "true");
    } else {
        for (var i = 0; i < v.length; i++) {
            v[i].style.top = "5px";
            v[i].style.display = "none";
        }
        version.getElementsByTagName("svg")[0].style.transform = "translateY(6px) rotate(0deg)";
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