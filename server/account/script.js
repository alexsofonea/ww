var maxSlide = 0;
var slideNr = 0;
var cancelSlide = false;

function checkName(name) {
    if (name.length > 0)
        document.getElementsByClassName("big_action")[0].disabled = false;
    else
        document.getElementsByClassName("big_action")[0].disabled = true;
}
function checkMail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (emailRegex.test(email)) {
        document.getElementsByClassName("big_action")[1].disabled = false;
        document.getElementById("invalidMail").style.opacity = "0";
    } else {
        document.getElementsByClassName("big_action")[1].disabled = true;
        document.getElementById("invalidMail").style.opacity = "1";
    }
}
function checkPassword(password) {
    var p = document.getElementsByClassName("password");
    if (password.length >= 8)
        p[0].style.color = "var(--green)";
    else
        p[0].style.color = "var(--red)";
    if (/[A-Z]/.test(password) || /[!?@#$%^&*()\-_=+{};:,<.>]/.test(password))
        p[1].style.color = "var(--green)";
    else
        p[1].style.color = "var(--red)";
    if (/\d/.test(password))
        p[2].style.color = "var(--green)";
    else
        p[2].style.color = "var(--red)";
    if (password.length >= 8 && /\d/.test(password) && (/[A-Z]/.test(password) || /[!?@#$%^&*()\-_=+{};:,<.>]/.test(password)))
        document.getElementsByClassName("big_action")[2].disabled = false;
    else
        document.getElementsByClassName("big_action")[2].disabled = true;
}
function checkPassword2(password) {
    var p = document.getElementsByClassName("password");
    if (password.length >= 8)
        p[0].style.color = "var(--green)";
    else
        p[0].style.color = "var(--red)";
    if (/[A-Z]/.test(password) || /[!?@#$%^&*()\-_=+{};:,<.>]/.test(password))
        p[1].style.color = "var(--green)";
    else
        p[1].style.color = "var(--red)";
    if (/\d/.test(password))
        p[2].style.color = "var(--green)";
    else
        p[2].style.color = "var(--red)";
    if (password.length >= 8 && /\d/.test(password) && (/[A-Z]/.test(password) || /[!?@#$%^&*()\-_=+{};:,<.>]/.test(password)))
        document.getElementsByClassName("big_action")[3].disabled = false;
    else
        document.getElementsByClassName("big_action")[3].disabled = true;
}

function loadElements() {
    /*var code = generateRandomId();
    document.getElementById('codeText').innerHTML = code + '<input type="text" name="code" id="copyCode" value="' + code + '" style="display:none;">';*/

    var lessons = document.getElementsByClassName("widget");
    maxSlide = lessons.length;
    slide(0);
}
function slide(s) {
    if (s != 0 && document.getElementsByClassName("actionMenu").length > 0) {
        const menu = document.getElementsByClassName("actionMenu")[0];
        if (window.innerWidth < 900) {
            if (window.innerWidth < 700) {
                menu.setAttribute("style", "left: 20px; transform: translate(0, -50%); width: 40px !important");
                $(".widget").css({"width":"calc(90% - 80px)", "margin-left":"40px"});
            } else {
                menu.setAttribute("style", "left: 40px; transform: translate(0, -50%); width: 40px !important");
                $(".widget").css({"width":"90%", "margin-left":"0px"});
            }
            for (const p of menu.getElementsByTagName("p"))
                p.style.display = "none";
            for (const p of menu.getElementsByClassName("action"))
                p.style.width = "20px";
        } else {
            menu.style.left = "40px";
            menu.style.transform = "translate(0, -50%)";
        }
    }

    var curentSlide = document.getElementsByClassName("widget")[s];
    if (s > 0 && s > slideNr) {
        var prevSlide = document.getElementsByClassName("widget")[slideNr];
        prevSlide.style.left = "calc(0% - 300px)";
        prevSlide.style.opacity = "0";
        setTimeout(function () {
            prevSlide.style.display = "none";
        }, 300);
        curentSlide.style.transition = "none";
        curentSlide.style.left = "calc(100% + 300px)";
        curentSlide.style.display = "block";
        curentSlide.style.transition = "all 0.3s";
        setTimeout(function () {
            curentSlide.style.opacity = "1";
            curentSlide.style.left = "calc(50% - 0px)";
        }, 0.1);
        slideNr = s;
    } else if (s > slideNr || (s == 0 && slideNr == 0)) {
        slideNr = s;
        curentSlide.style.opacity = "0";
        curentSlide.style.display = "block";
        curentSlide.style.left = "calc(50% - 0px)";
        curentSlide.style.transition = "all 0.3s";
        curentSlide.style.opacity = "1";
    } else if (s != slideNr) {
        var prevSlide = document.getElementsByClassName("widget")[slideNr];
        prevSlide.style.left = "calc(100% + 300px)";
        prevSlide.style.opacity = "0";
        setTimeout(function () {
            prevSlide.style.display = "none";
        }, 300);
        curentSlide.style.transition = "none";
        curentSlide.style.left = "calc(0% - 300px)";
        curentSlide.style.display = "block";
        curentSlide.style.transition = "all 0.3s";
        setTimeout(function () {
            curentSlide.style.opacity = "1";
            curentSlide.style.left = "calc(50% - 0px)";
        }, 0.1);
        slideNr = s;
    } else {
        curentSlide.style.transition = "all 0.05s";
        curentSlide.style.left = "calc(50% + 30px)";
        var time = 60;
        setTimeout(function () {
            curentSlide.style.left = "calc(50% + 0px)";
            setTimeout(function () {
                curentSlide.style.left = "calc(50% - 30px)";
                setTimeout(function () {
                    curentSlide.style.left = "calc(50% + 0px)";
                    setTimeout(function () {
                        curentSlide.style.left = "calc(50% + 15px)";
                        setTimeout(function () {
                            curentSlide.style.left = "calc(50% + 0px)";
                            setTimeout(function () {
                                curentSlide.style.left = "calc(50% - 15px)";
                                setTimeout(function () {
                                    curentSlide.style.left = "calc(50% + 0px)";
                                    curentSlide.style.transition = "all 0.3s";
                                }, time);
                            }, time);
                        }, time);
                    }, time);
                }, time);
            }, time);
        }, time);
    }
}


function deleteSession(sessionId) {
    $.post("index.php",
    {
        action: "delete",
        id: sessionId
    },
    function(data, status){
        if (data.includes("done")) {
            document.getElementById("session_" + sessionId).remove();
            slide(2);
        }
    });
}
function deleteSessions(el, s) {
    confirm("Are you sure you want to log all devices out?", function () {
        $.post("index.php",
        {
            action: "deleteAll"
        },
        function(data, status){
            if (data.includes("done")) {
                for (const e of el.closest(".widget").getElementsByTagName("a"))
                    if (e.id != "session_" + s)
                    e.remove();
                slide(2);
            }
        });
    });
}



$('#accontInfo').on('submit', function(event) {
    event.preventDefault();
    document.getElementById("loading-anim").style.display = "block";
    document.getElementById("submitButton").innerHTML = "&nbsp;";
    
    var formData = new FormData(this);
    
    $.ajax({
        url: 'index.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            //console.log(response);
            if (response.includes(".") && !response.includes(" "))
                document.getElementById("accountImage").src = "https://cloud-api.ww.alexsofonea.com/" + response;
            openPopUp("basicInfoUpdate");
            document.getElementById("loading-anim").style.display = "none";
            document.getElementById("submitButton").innerHTML = "Update info";
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('Error:', textStatus, errorThrown);
        }
    });
});

function submitFileInput(event) {
    if (event.target.files && event.target.files[0]) {
        document.getElementById("removePic").style.display = "block";
        var reader = new FileReader();
        reader.onload = function(e) {
            var uploadDiv = document.getElementById('uploadDiv');
            for (const r of uploadDiv.getElementsByTagName("text"))
                r.remove();
            for (const r of uploadDiv.getElementsByTagName("img"))
                r.remove();
            for (const r of uploadDiv.getElementsByTagName("img"))
                if (r.getAttribute("type") == "hidden")
                    r.remove();
            var img = document.createElement('img');
            img.src = e.target.result;
            uploadDiv.appendChild(img);
        }
        reader.readAsDataURL(event.target.files[0]);
    }
}
function openPopUp(id) {
    var menu = document.getElementById(id);
    menu.style.bottom = "10px";
    setTimeout(function () {
        menu.style.bottom = "-100%";
    }, 2000);
}

function removePicture() {
    var uploadDiv = document.getElementById('uploadDiv');
    for (const r of uploadDiv.getElementsByTagName("text"))
        r.remove();
    for (const r of uploadDiv.getElementsByTagName("img"))
        r.remove();
    document.getElementById('fileInput').value = null;
    uploadDiv.innerHTML += "<input type='hidden' name='noPic' value='true'><text>Add profile picture.</text>";
    document.getElementById('fileInput').addEventListener('change', function(event) {
        submitFileInput(event);
    });
    document.getElementById("removePic").style.display = "none";
}


function openMenu(id) {
    var menu = document.getElementById(id);
    var menuBg = document.getElementById("menuBg");
    if (menu.getAttribute("data-open") == "false") {
        menu.style.display = "block";
        menuBg.style.display = "block";
        menu.setAttribute("data-open", "true");
    } else {
        menu.setAttribute("style", "animation: none !important; display:block; transform: translate(-50%, 1000px) !important;");
        setTimeout(function() {
            menu.style.display = "none";
            menu.style.transform = "translate(-50%, -50%)";
            menu.style.animation = "menuAnim 0.7s ease-in-out";
            menu.setAttribute("data-open", "false");
        }, 200);
    }
}
function closeMenus() {
    var menus = document.getElementsByClassName("menu");
    for (const m of menus)
        if(m.getAttribute("data-open") == "true")
            openMenu(m.id);
    document.getElementById("menuBg").style.animation = "none !important";
    document.getElementById("menuBg").style.opacity = "0";

    setTimeout(function () {
        document.getElementById("menuBg").style.opacity = "1";
        document.getElementById("menuBg").style.animation = "menuBgAnim 0.4s ease-in-out";
        document.getElementById("menuBg").style.display = "none";
    }, 200);
}