<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="viewport-fit=cover, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>New wwProject</title>
    <link rel="stylesheet" href="/assets/font/stylesheet.css">
    <link rel="stylesheet" href="/style.css">
</head>

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
            <input class="input" placeholder="Enter your domain or subdomain" required="" type="text" id="projectDomain">
            <span class="input-border"></span>
        </div>
        <br />
        <a href="javascript:changeContainer(2)" class="action">I don't have a domain</a>
        <button class="action" onclick="validateDomain()">Next</button>
    </div>
    <div class="container">
        <a href="javascript:changeContainer(1)">Back</a>
        <h1>Choose a unique id</h1>
        <div class="form">
            <input class="input" placeholder="Choose an id for your project" required="" onkeyup="document.getElementById('customId').innerText = this.value;" type="text">
            <span class="input-border"></span>
        </div>
        <br />
        <p>https://ww.alexsofonea.com/<?php echo strtolower(str_replace(" ", "+", $name)); ?>/<b id='customId'></b></p>
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