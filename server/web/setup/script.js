var id, verify;
var curentContents = 0;
function changecontents(c = -1) {
    var contentss = document.getElementsByClassName("contents");

    if (typeof c === "string")
        c = [...contentss].findIndex(tab => tab.id === c);

    if (curentContents < c && c != -1) {
        for (const cont of contentss) {
            cont.style.transform = `translateY(100%)`;
        }
        contentss[curentContents].style.transition = `transform 0.4s ease-in-out`;
        contentss[c].style.transition = `transform 0.4s ease-in-out`;
        contentss[curentContents].style.transform = `translateY(-100%)`;
        contentss[c].classList.add("active");
        contentss[c].style.transform = `translateY(0%)`;
        setTimeout(function () {
            contentss[curentContents].classList.remove("active");
            contentss[curentContents].style.transition = `none`;
            contentss[c].style.transition = `none`;
            curentContents = c;
        }, 400);
    } else if (curentContents > c && c != -1) {
        for (const cont of contentss) {
            cont.style.transform = `translateY(-100%)`;
        }
        contentss[curentContents].style.transition = `transform 0.4s ease-in-out`;
        contentss[c].style.transition = `transform 0.4s ease-in-out`;
        contentss[curentContents].style.transform = `translateY(100%)`;
        contentss[c].classList.add("active");
        contentss[c].style.transform = `translateY(0%)`;
        setTimeout(function () {
            contentss[curentContents].classList.remove("active");
            contentss[curentContents].style.transition = `none`;
            contentss[c].style.transition = `none`;
            curentContents = c;
        }, 400);
    } else if (c == curentContents || c == -1) {
        var curentSlide = contentss[curentContents];
        var h = Number(curentSlide.getAttribute("data-h") ?? 0);
        var time = 100;

        curentSlide.style.transition = "transform 0.2s";
        curentSlide.style.transform = `translateY(${-h + 0}px)`;
        curentSlide.style.transform = `translateY(${-h - 30}px)`;
        setTimeout(function () {
            curentSlide.style.transform = `translateY(${-h + 0}px)`;
            setTimeout(function () {
                curentSlide.style.transform = `translateY(${-h + 15}px)`;
                setTimeout(function () {
                    curentSlide.style.transform = `translateY(${-h + 0}px)`;
                    setTimeout(function () {
                        curentSlide.style.transform = `translateY(${-h - 15}px)`;
                        setTimeout(function () {
                            curentSlide.style.transform = `translateY(${-h + 0}px)`;
                            curentSlide.style.transition = "transform 0.4s ease-in-out";
                        }, time);
                    }, time);
                }, time);
            }, time);
        }, time);
    }
}
let typingTimer;  // Timer identifier
const typingDelay = 1000;  // Delay in milliseconds (1 second)
function getNextSiblingButton(element) {
    let sibling = element.nextElementSibling;
    while (sibling) {
        if (sibling.tagName === 'BUTTON') {
            return sibling;
        }
        sibling = sibling.nextElementSibling;
    }
    return document.createElement("button");
}

function updateName(v) {
    v = generateProjectId(v.value);
    document.getElementById("projectUrl").innerHTML = v;
    const r = document.getElementById("nameResponse");
    getNextSiblingButton(r.parentElement).disabled = true;

    if (r.innerHTML != `<svg class="loader" viewBox="25 25 50 50"><circle r="20" cy="50" cx="50"></circle></svg>`)
        r.innerHTML = `<svg class="loader" viewBox="25 25 50 50"><circle r="20" cy="50" cx="50"></circle></svg>`;

    clearTimeout(typingTimer);

    typingTimer = setTimeout(function() {
        $.post("/setup/request/checkName.php",
            {
                name: v
            },
            function(data, status){
                if (data == "0") {
                    r.innerHTML = "Name available.";
                    r.style.color = "#06d6a0";
                    getNextSiblingButton(r.parentElement).disabled = false;
                } else  {
                    r.innerHTML = "Name not available.";
                    r.style.color = "#ef476f";
                    getNextSiblingButton(r.parentElement).disabled = true;
                }
            });
    }, typingDelay);
}
function generateProjectId(name) {
    return name
        .toLowerCase()                 // Convert to lowercase
        .replace(/[^a-z0-9\s]/g, '')   // Remove special characters (except spaces)
        .trim()                        // Remove leading/trailing whitespace
        .replace(/\s+/g, '-');         // Replace spaces with hyphens
}

function validateName() {
    var value = document.getElementById('projectName').value;
    id = generateProjectId(value);
    document.getElementById('lastButton').setAttribute("onclick", "location.assign('/" + userName + "/" + id + "')");
    if (/^[a-zA-Z0-9\s]+$/.test(value) && value.length != 0) {
        $.post("/setup/request/name.php",
            {
                name: value,
                myname: userName
            },
            function(data, status){
                console.log(data)
                changecontents('domain');
            });
    }
    else
        changecontents();

}
function validateDomain() {
    var value = document.getElementById('projectDomain').value;
    if (/^(?!:\/\/)([a-zA-Z0-9-_]{1,63}\.)+[a-zA-Z]{2,}$/.test(value) && value.length != 0) {
        $.post("/setup/request/domain.php",
            {
                id: id,
                domain: value
            },
            function(data, status){
                console.log(data);
                if (data.includes("ww")) {
                    verify = data;
                    document.getElementById("domainVerifyId").innerHTML = verify;
                    changecontents('domainadd');
                }
            });
    } else
        changecontents();
}

function savePicture(picture) {
    $.post("/setup/request/picture.php",
        {
            id: id,
            picture: picture
        },
        function(data, status){
            changecontents('set');
        });
}

function verfiyDomain(but) {
    but.innerHTML = '<svg class="loader" viewBox="25 25 50 50"><circle r="20" cy="50" cx="50"></circle></svg>';
    but.setAttribute("onclick", "");


    $.post("/setup/request/verify.php",
        {
            id: id,
            domain: document.getElementById('projectDomain').value
        },
        function(data, status){
            if (data == "true")
                changecontents('picture');
            else {
                changecontents('verify');
                but.setAttribute("onclick", "verfiyDomain(this)");
                but.innerHTML = "Verify"
            }
        });
}