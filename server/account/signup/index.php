<?php include "../var.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="viewport-fit=cover, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="../style.css">
    <title><?php echo $app_name; ?> - Sign Up</title>
    <script src="../jquery.js"></script>
</head>

<style>
:root {
    --color1: #<?php echo $color; ?>;
    --color2: #<?php echo $color2; ?>;
}
</style>

<body onload="loadElements()">

<table id="app" onclick="location.assign('<?php echo $url; ?>');">
    <tr>
        <td><img class="logo" src="<?php echo $logo; ?>"></td>
        <td><h1><?php echo $app_name; ?></h1></td>
    </tr>
</table>
    
<div class="widget selected">
    <h1><?php echo $motto; ?></h1>
    <p class="error"></p>

    <div class="user-box">
        <div class="input">
            <input type='text' onkeyup="checkName(this.value)" name="name" id="name" autocomplete="no" required placeholder = " "/>
            <p>Name</p>
        </div>
    </div>

    <button class="big_action" onclick="slide(1)" disabled>Sign Up</button>

    <table width="100%">
        <tr>
            <td style="text-align: center;"><a href="../login">Already have an account? <u>Log in.</u></a></td>
        </tr>
    </table>
</div>

<div class="widget">
    <h1 style="height: 80px;"></h1>
    <p class="error"></p>
    <div class="user-box">
        <div class="input">
            <input type='text' onkeyup="checkMail(this.value)" name="mail" id="mail" autocomplete="no" required placeholder = " "/>
            <p>E-Mail</p>
        </div>
    </div>

    <p id="invalidMail" style="opacity: 0;">Invalid Mail.</p>

    <button class="big_action" onclick="slide(2)" disabled>Next</button>
</div>

<div class="widget">
    <h1 style="height: 80px;"></h1>
    <p class="error"></p>
    <div class="user-box">
        <div class="input">
            <input type='password' onkeyup="checkPassword(this.value)" name="password" id="password" autocomplete="no" required placeholder = " "/>
            <p>Password</p>
        </div>
    </div>

    <p class="password">Password must be at least 8 charset long.</p>
    <p class="password">Password must contain a capital letter or a special character.</p>
    <p class="password">Password must contain a number.</p>

    <button class="big_action" id="submitButton" disabled onclick="submitData();hapticFeedback();">Create Account</button>

    <div class="loading-anim" id="loading-anim"><svg id="loading1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z"/></svg><svg id="loading2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z"/></svg></div>
</div>

<script>
function submitData() {
    document.getElementById("submitButton").style.color = "var(--color1)";
    document.getElementById("loading-anim").style.display = "block";
    document.getElementById("submitButton").setAttribute("onclick" , "");
    var error = document.getElementsByClassName("error");
    $.post("signup.php",
    {
        name: document.getElementById("name").value,
        mail: document.getElementById("mail").value,
        password: document.getElementById("password").value
    },
    function(data, status){
        document.getElementById("submitButton").style.color = "#000";
        document.getElementById("loading-anim").style.display = "none";
        document.getElementById("submitButton").setAttribute("onclick" , "submitData()");
        if (status != "success")
            error[2].innerHTML = "An error occured!";
        else if (data.includes("Duplicate entry")) {
            error[1].innerHTML = "This mail is already in use!";
            slide(1);
        } else
            location.assign("/");
    });
}
</script>
    
</body>

<script src="../script.js"></script>


</html>