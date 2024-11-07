const elementsToHover = ['wwEditorText', 'wwEditorElement', 'wwEditorImage', 'wwEditorSection'];
var selectedElement = null, hoveredElement = null;

function checkClass(element) {
    return elementsToHover.some(className => element.classList.contains(className));
}

function selectNewElement(element) {
    if (checkClass(element.parentElement))
        return element.parentElement;
    else
        for (const e of element.children)
            if (checkClass(e))
                return e;
    return null;
}

document.body.addEventListener('click', function(event) {
    var element = event.target;
    var parentElement = element.parentElement;

    while (parentElement) {
        if (parentElement.classList.contains('wwEditWidget'))
            return;
        parentElement = parentElement.parentElement;
    }

    console.log(element);
    if (selectedElement == null) {
        console.log(element);
        if (!checkClass(element)) {
            element = hoveredElement;
            if (element == null)
                return;
        }
        selectedElement = element;

        console.log(element.wwEditWidget);

        if (element.wwEditWidget === undefined) {
            const wwEditor = document.createElement('div');
            wwEditor.className = 'wwEditWidget';
            wwEditor.style.position = 'absolute';

            switch (element.classList[element.classList.length - 1]) {
                case 'wwEditorText':
                    wwEditor.innerHTML = `
                    <img src="/assets/icons/editor/up.svg" onclick="moveUp(this)">
                    <img src="/assets/icons/editor/down.svg" onclick="moveDown(this)">
                    <img src="/assets/icons/editor/duplicate.svg" onclick="duplicate(this)">`;
                    element.contenteditable = true;
                    element.focus();
                    break;
                case 'wwEditorImage':
                    wwEditor.innerHTML = `
                    <div class="version" data-open="false">
                        <p onclick="version(this.parentElement);">Type <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M201.4 342.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 274.7 86.6 137.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"/></svg></p>
                        <p class='v' value='' onclick='select(this)'><img src='/assets/icons/star.svg'> Img</p>
                        <p class='v' value='' onclick='select(this)'><img src='/assets/icons/star.svg'> Img</p>
                        <p class='v' value='' onclick='select(this)'><img src='/assets/icons/star.svg'> Img</p>
                        <p class='v' value='' onclick='select(this)'><img src='/assets/icons/star.svg'> Img</p>
                    </div>`;
                    break;
                case 'wwEditorElement':
                    wwEditor.innerHTML = `<img src="/assets/icons/editor/up.svg" onclick="moveUp(this)">
                    <img src="/assets/icons/editor/down.svg" onclick="moveDown(this)">
                    <img src="/assets/icons/editor/duplicate.svg" onclick="duplicate(this)">`;
                    break;
                case 'wwEditorSection':
                    wwEditor.innerHTML = `<img src="/assets/icons/editor/up.svg" onclick="moveUp(this)">
                    <img src="/assets/icons/editor/down.svg" onclick="moveDown(this)">
                    <img src="/assets/icons/editor/duplicate.svg" onclick="duplicate(this)">`;
                    break;
                default:
                    return;
            }
            wwEditor.style.left = `${element.getBoundingClientRect().left - window.scrollX}px`;
            wwEditor.style.top = `${element.getBoundingClientRect().top - 60 + window.scrollY}px`;
            element.wwEditWidget = wwEditor;
            document.body.appendChild(wwEditor);
        }
    } else if (element != selectedElement) {
        if (selectedElement.wwEditWidget !== undefined) {
            selectedElement.wwEditWidget.remove();
            selectedElement.wwEditWidget = undefined;
        }
        if (selectedElement.wwEdit !== undefined) {
            selectedElement.wwEdit.remove();
            selectedElement.wwEdit = undefined;
        }
        selectedElement = null;
    }
});

document.addEventListener('DOMContentLoaded', () => {
    elementsToHover.forEach(className => {
        console.log(`Checking for elements with class: ${className}`);
        const elements = document.querySelectorAll(`.${className}`);

        elements.forEach(element => {
            prepHover(element);
        });
    });
});

function prepHover(element) {
    element.addEventListener('mouseenter', function() {
        if (element.wwEditWidget === undefined && element.wwEdit === undefined) {
            hover(element);

            let parentElement = element.parentElement;
            while (parentElement) {
                if (checkClass(parentElement) && parentElement.wwEdit) {
                    parentElement.wwEdit.remove();
                    parentElement.wwEdit = undefined;
                }
                parentElement = parentElement.parentElement;
            }

            element.addEventListener('mouseleave', function() {
                unhover(element);
                let parentElement = element.parentElement;
                while (parentElement) {
                    if (checkClass(parentElement)) {
                        hover(parentElement);
                        break;
                    }
                    parentElement = parentElement.parentElement;
                }
            });
        }
    });
}

function hover(element) {
    if (element.wwEditWidget === undefined && element.wwEdit === undefined) {
        const wwEdit = document.createElement('div');
        wwEdit.classList.add('wwEditOverlay');
        wwEdit.style.position = 'absolute';
        wwEdit.style.left = `${element.getBoundingClientRect().left - 10 + window.scrollX}px`;
        wwEdit.style.top = `${element.getBoundingClientRect().top - 10 + window.scrollY}px`;
        wwEdit.style.width = `${element.offsetWidth + 20}px`;
        wwEdit.style.height = `${element.offsetHeight + 20}px`;
        wwEdit.style.backgroundColor = 'rgba(150, 150, 150, 0.3)';
        wwEdit.style.border = '1px solid #e9ecef';
        wwEdit.style.borderRadius = '15px';
        wwEdit.style.pointerEvents = 'none';
        document.body.appendChild(wwEdit);
        element.wwEdit = wwEdit;
        hoveredElement = element;
    }
}
function unhover(element) {
    if (element.wwEditWidget === undefined && element.wwEdit !== undefined) {
        element.wwEdit.remove();
        element.wwEdit = undefined;
    }
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

function moveDown(el) {
    var next = selectedElement.nextElementSibling;
    if (next) {
        const distance = next.getBoundingClientRect().top - selectedElement.getBoundingClientRect().top;
        selectedElement.style.transform = `translateY(${distance}px)`;
        next.style.transform = `translateY(${-distance}px)`;
        setTimeout(() => {
            selectedElement.style.transition = "none";
            next.style.transition = "none";
            next.after(selectedElement);
            selectedElement.style.transform = "";
            next.style.transform = "";
            setTimeout(() => {
                selectedElement.style.transition = "";
                next.style.transition = "";
            }, 100);
        }, 200);
    }
}
function moveUp(el) {
    var next = selectedElement.previousElementSibling;
    if (next) {
        const distance = next.getBoundingClientRect().top - selectedElement.getBoundingClientRect().top;
        selectedElement.style.transform = `translateY(${distance}px)`;
        next.style.transform = `translateY(${-distance}px)`;
        setTimeout(() => {
            selectedElement.style.transition = "none";
            next.style.transition = "none";
            selectedElement.after(next);
            selectedElement.style.transform = "";
            next.style.transform = "";
            setTimeout(() => {
                selectedElement.style.transition = "";
                next.style.transition = "";
            }, 100);
        }, 200);
    }
}

function duplicate(el) {
    var clone = selectedElement.cloneNode(true);
    selectedElement.after(clone);
}