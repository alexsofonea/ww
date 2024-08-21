<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/font/stylesheet.css">
</head>

<style>
body {
    font-family: 'Qartella';
    font-weight: 300;
    font-style: normal;
    margin: 0;
    background: #ebebeb;
    overflow: hidden;
}

.container {
    width: calc(100% - 20px);
    max-width: 700px;
    height: calc(100vh - 200px);
    margin: auto;
    padding-top: 100px;
    padding-bottom: 100px;

    position: relative;
    transition: transform 0.4s ease-in-out;
}
.card {
    width: calc(70% - 40px);
    height: fit-content;
    border-radius: 40px;
    padding: 20px;
    box-shadow:  8px 8px 16px #b0b0b0,
            -8px -8px 16px #ffffff,
            inset 4px 4px 16px rgba(0, 0, 0, 0.1),
            inset -4px -4px 16px rgba(255, 255, 255, 0.7);
}
.form {
    --width-of-input: 100%;
    --border-height: 1px;
    --border-before-color: #CCC;
    --border-after-color: #1181A9;
    --input-hovered-color: #FFF;
    position: relative;
    width: var(--width-of-input);
}
.input {
    color: #000;
    font-size: 1.6rem;
    background-color: transparent;
    width: 100%;
    box-sizing: border-box;
    padding-inline: 0.5em;
    padding-block: 0.7em;
    border: none;
    border-bottom: var(--border-height) solid var(--border-before-color);
}
.input-border {
    position: absolute;
    background: var(--border-after-color);
    width: 0%;
    height: 2px;
    bottom: 0;
    left: 0;
    transition: 0.3s;
}
input:hover {
    background: var(--input-hovered-color);
}
input:focus {
    outline: none;
}
input:focus ~ .input-border {
    width: 100%;
}
button {
    color: #090909;
    padding: 0.7em 1.7em;
    font-size: 18px;
    border-radius: 0.5em;
    background: #e8e8e8;
    cursor: pointer;
    border: 1px solid #e8e8e8;
    transition: all 0.3s;
    box-shadow: 6px 6px 12px #c5c5c5, -6px -6px 12px #ffffff;
}
button:hover {
    border: 1px solid white;
}
button:active {
    box-shadow: 4px 4px 12px #c5c5c5, -4px -4px 12px #ffffff;
}
button.action {
    position: absolute;
    bottom: 100px;
    right: 0;
}


a:hover,
a:focus,
a:active {
	color: #333;
	text-decoration: none;
}

a {
	text-decoration: none;
	transition: color 0.1s, background-color 0.1s;
	color: #333 !important;
	width: fit-content !important;
}
a.action {
    position: absolute;
    bottom: 100px;
    left: 0;
}

a {
	position: relative;
	display: block;
	padding: 16px 0;
	margin: 0 12px;
	letter-spacing: 1px;
	font-size: 12px;
	line-height: 16px;
	font-weight: 900;
	transition: color 0.1s, background-color 0.1s, padding 0.2s ease-in;
}

a::before {
	content: '';
	display: block;
	position: absolute;
	bottom: 3px;
	left: 0;
	height: 3px;
	width: 100%;
	background-color: #333;
	transform-origin: right top;
	transform: scale(0, 1);
	transition: color 0.1s, transform 0.2s ease-out;
}

a:active::before {
	background-color: #000;
}

a:hover::before,
a:focus::before {
	transform-origin: left top;
	transform: scale(1, 1);
}
</style>

<body>

    <?php
        include "../db.php";
        include "../account/accountId.php";
    ?>

    <div class="container">
        <h1>Let's start with a name for your project</h1>
        <div class="form">
            <input class="input" placeholder="Enter the name of the project" required="" type="text" id="projectName">
            <span class="input-border"></span>
        </div>
        <br />
        <button class="action" onclick="validateName()">Next</button>
    </div>
    <div class="container">
    <a href="javascript:changeContainer(0)">Back</a>
        <h1>Customize with your own domain</h1>
        <div class="form">
            <input class="input" placeholder="Enter your domain" required="" type="text" id="projectDomain">
            <span class="input-border"></span>
        </div>
        <br />
        <a class="action">I don't have a domain</a>
        <button class="action" onclick="validateDomain()">Next</button>
    </div>
    <div class="container">
        <a href="javascript:changeContainer(1)">Back</a>
        <h1>Choose a unique id</h1>
        <div class="form">
            <input class="input" placeholder="Choose an id for your project" required="" type="text">
            <span class="input-border"></span>
        </div>
        <br />
        <button class="action">Create</button>
    </div>

<script>
    var curentContainer = 0;
    function changeContainer(c) {
        var containers = document.getElementsByClassName("container");
        const height = containers[0].getBoundingClientRect().height;
        if (curentContainer < c) 
            for (const cont of containers) {
                var h = Number(cont.getAttribute("data-h") ?? 0) + height;
                cont.setAttribute("data-h", h);
                cont.style.transform = `translateY(-${h}px)`;
            }
        else if (c > curentContainer)
            for (const cont of containers) {
                var h = Number(cont.getAttribute("data-h") ?? 0) - height;
                cont.setAttribute("data-h", h);
                cont.style.transform = `translateY(-${h}px)`;
            }
        else {
            var curentSlide = containers[c];
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
        curentContainer = c;
    }


    function validateName() {
        var value = document.getElementById('projectName').value;
        if (/^[a-zA-Z0-9\s]+$/.test(value) && value.length != 0)
            changeContainer(1);
        else
            changeContainer(0);
    }
    function validateDomain() {
        var value = document.getElementById('projectDomain').value;
        if (/^(?!:\/\/)([a-zA-Z0-9-_]{1,63}\.)+[a-zA-Z]{2,}$/.test(value) && value.length != 0)
            changeContainer(2);
        else
            changeContainer(1);
    }
</script>

</body>
</html>