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

    <div class="container" id="name">
        <h1>Let's start with a name for your project</h1>
        <div class="form">
            <input class="input" placeholder="Enter the name of the project" required="" type="text" id="projectName">
            <span class="input-border"></span>
        </div>
        <br />
        <button class="action" onclick="validateName()">Next</button>
    </div>
    <div class="container" id="domain">
        <a href="javascript:changeContainer('name')">Back</a>
        <h1>Customize with your own domain</h1>
        <div class="form">
            <input class="input" placeholder="Enter your domain or subdomain" required="" type="text" id="projectDomain">
            <span class="input-border"></span>
        </div>
        <br />
        <a href="javascript:changeContainer('domainconfirm')" class="action">I don't have a domain</a>
        <button class="action" onclick="validateDomain()">Next</button>
    </div>
    <div class="container" id="domainconfirm">
        <a href="javascript:changeContainer('domain')">Back</a>
        <h1>Note that some functionality might not be available without a domain.</h1>
        <button class="action" onclick="changeContainer('uniqueId')">I understand</button>
    </div>
    <div class="container" id="domainadd">
        <a href="javascript:changeContainer('domain')">Back</a>
        <h1>Let's verify your domain.</h1>

        <p>Please add the following domain records.</p>
        <div class="records">
            <p>Type</p>
            <p>Host</p>
            <p>Value</p>
        </div>
        <div class="records embed">
            <p>TXT</p>
            <p>ww-domain-verification</p>
            <p>ww_gsAt6dhsaXshZHZ</p>
        </div>

        <button class="action" onclick="verfiyDomain(3)">I understand</button>
    </div>
    <div class="container" id="uniqueId">
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
    function changeContainer(c = -1) {
        var containers = document.getElementsByClassName("container");
        console.log(c);

        if (typeof c === "string")
            c = [...containers].findIndex(tab => tab.id === c);

        console.log(c);

        const height = containers[0].getBoundingClientRect().height;
        if (curentContainer < c && c != -1) 
            for (const cont of containers) {
                var h = Number(cont.getAttribute("data-h") ?? 0) + (height * Math.abs(curentContainer - c));
                cont.setAttribute("data-h", h);
                cont.style.transform = `translateY(-${h}px)`;
            }
        else if (c > curentContainer && c != -1)
            for (const cont of containers) {
                var h = Number(cont.getAttribute("data-h") ?? 0) - (height * Math.abs(curentContainer - c));
                cont.setAttribute("data-h", h);
                cont.style.transform = `translateY(-${h}px)`;
            }
        else if (c == curentContainer || c == -1) {
            var curentSlide = containers[curentContainer];
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
        if (c != -1 && typeof c === "number")
            curentContainer = c;
    }


    function validateName() {
        var value = document.getElementById('projectName').value;
        if (/^[a-zA-Z0-9\s]+$/.test(value) && value.length != 0)
            changeContainer('domain');
        else
            changeContainer();
    }
    function validateDomain() {
        var value = document.getElementById('projectDomain').value;
        if (/^(?!:\/\/)([a-zA-Z0-9-_]{1,63}\.)+[a-zA-Z]{2,}$/.test(value) && value.length != 0)
            changeContainer('domainadd');
        else
            changeContainer();
    }
</script>

</body>
</html>