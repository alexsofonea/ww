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
