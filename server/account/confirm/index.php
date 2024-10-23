<?php include "../var.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="viewport-fit=cover, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="<?php echo $url ; ?>/account/style.css">
    <title><?php echo $app_name; ?> - confirm Account</title>
    <script src="<?php echo $url ; ?>/account/jquery.js"></script>
</head>

<style>
:root {
    --color1: #<?php echo $color; ?>;
    --color2: #<?php echo $color2; ?>;
}
</style>

<body onload="loadElements();<?php echo (isset($_GET['code']) && $_GET['code'] != '') ? "slide(2);" : ''; ?>">

<table id="app" onclick="location.assign('<?php echo $url; ?>');">
    <tr>
        <td><img class="logo" src="<?php echo $logo; ?>"></td>
        <td><h1><?php echo $app_name; ?></h1></td>
    </tr>
</table>

<div class="widget selected">
    <h1>Confirm your <br /><?php echo $app_name; ?> Account</h1>
    <p class="error"></p>

    <div class="user-box">
        <div class="input">
            <input type='text' name="mail" id="mail" value="<?php echo (isset($_GET['mail']) && $_GET['mail'] != '') ? $_GET['mail'] : ''; ?>" autocomplete="no" required placeholder = " "/>
            <p>Mail</p>
        </div>
    </div>

    <button class="big_action" id="submitButton2" onclick="sendMail();hapticFeedback();">Send confirmation email</button>

    <div class="loading-anim" id="loading-anim2"><svg id="loading1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z"/></svg><svg id="loading2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z"/></svg></div>

</div>

<div class="widget">
    <h1>Confirm your <br /><?php echo $app_name; ?> Account</h1>
    <p class="error"></p>

    <h4 style="font-weight: 500; font-size: 20px;">An email with instructions was send.</h4>
    <h4 style="font-weight: 500; font-size: 14px;"><b>Note: </b>If you can't find it, please check your spam folder.</h4>

    <button class="big_action" id="submitButton" onclick="slide(2);hapticFeedback();">Enter code</button>

</div>

<div class="widget">
    <h1>Confirm your <br /><?php echo $app_name; ?> Account</h1>
    <p class="error"></p>

    <div class="user-box">
        <div class="input">
            <input type='text' name="code" id="code" value="<?php echo (isset($_GET['code']) && $_GET['code'] != '') ? $_GET['code'] : ''; ?>" autocomplete="no" required placeholder = " "/>
            <p>Code</p>
        </div>
    </div>

    <button class="big_action" id="submitButton" onclick="submitData();hapticFeedback();">Confirm Account</button>

    <div class="loading-anim" id="loading-anim"><svg id="loading1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z"/></svg><svg id="loading2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z"/></svg></div>

</div>

<div class="widget">
    <h1>Your <?php echo $app_name; ?> Account <br />was confirmed.</h1>

    <button class="big_action" id="submitButton" onclick="location.assign('/');">Go home</button>
</div>

<script>
function sendMail() {
    var error = document.getElementsByClassName("error")[0];
    if (!document.getElementById("mail").value.length == 0) {
        document.getElementById("submitButton2").style.color = "var(--color1)";
        document.getElementById("loading-anim2").style.display = "block";
        document.getElementById("submitButton2").setAttribute("onclick" , "");
        error.innerHTML = "";
        $.post("/account/confirm/confirmMail.php",
        {
            mail: document.getElementById("mail").value
        },
        function(data, status){
            document.getElementById("submitButton2").style.color = "#000";
            document.getElementById("loading-anim2").style.display = "none";
            document.getElementById("submitButton2").setAttribute("onclick" , "submitData()");
            if (status != "success")
                error.innerHTML = "An error occured!";
            else if (data.includes("email_error"))
                error.innerHTML = "Invalid mail!";
            else if (data.includes("unregistered_error"))
                error.innerHTML = "Unregistred email!";
            else
                slide(1);
        });
    } else
        error.innerHTML = "Please fill in the form!";
}
function submitData() {
    var error = document.getElementsByClassName("error")[2];
    if (!document.getElementById("code").value.length == 0 && !document.getElementById("mail").value.length == 0) {
        document.getElementById("submitButton").style.color = "var(--color1)";
        document.getElementById("loading-anim").style.display = "block";
        document.getElementById("submitButton").setAttribute("onclick" , "");
        error.innerHTML = "";
        $.post("/account/confirm/confirm.php",
        {
            mail: document.getElementById("mail").value,
            code: document.getElementById("code").value
        },
        function(data, status){
            document.getElementById("submitButton").style.color = "#000";
            document.getElementById("loading-anim").style.display = "none";
            document.getElementById("submitButton").setAttribute("onclick" , "submitData()");
            if (status != "success")
                error.innerHTML = "An error occured!";
            else if (data.includes("error"))
                error.innerHTML = "Incorrect mail or code!";
            else if (data.includes("done"))
                slide(3);
        });
    } else
        error.innerHTML = "Please fill in the form!";
}
</script>
    
</body>

<script src="<?php echo $url ; ?>/account/script.js"></script>


</html>