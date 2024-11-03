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
        }
    }
}
function colapse() {
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
    fetch(url)
        .then(response => response.text())
        .then(data => {
            document.getElementById('content').innerHTML = getContentDiv(data);
            const onloadMatch = data.match(/<body[^>]*onload=["']?([^"'>]*)["']?/i);
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
        e.preventDefault();
        if (e.target.classList.contains("active") || e.target.hasAttribute("onclick")) return;
        const url = e.target.getAttribute("href");

        document.querySelectorAll(".button").forEach(button => {
            button.classList.remove("active");
        });
        e.target.classList.add("active");

        loadPage(url);
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

Object.prototype.loadEditorPage = function(url, style = "") {
    const unixTime = Math.floor(Date.now() / 1000);
    var newContent = `<script src="/builder/editor.js?cache=${unixTime}"></script>
		              <link rel="stylesheet" href="/builder/editor.css?cache=${unixTime}">`;
    fetch(url)
        .then(response => response.text())
        .then(data => {
            const baseUrl = url.substring(0, url.lastIndexOf('/') + 1);
            this.outerHTML = "<iframe sandbox='allow-scripts' srcdoc='" + encodeHTMLQuotes(data.replace(/assets\//g, baseUrl + 'assets/').replace(/<body([^>]*)>/, `<body$1>${newContent}`)) + "'></iframe>";
        })
        .catch(error => {
            console.log('Error loading page: ', url, error);
        });
};