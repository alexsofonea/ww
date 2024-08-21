<?php include "../var.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="viewport-fit=cover, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="../style.css">
    <title><?php echo $app_name; ?> - Log In</title>
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
    <p id="error"></p>

    <div class="user-box">
        <div class="input">
            <input type='text' name="mail" id="mail" autocomplete="no" required placeholder = " "/>
            <p>Mail</p>
        </div>
    </div>
    <div class="user-box">
        <div class="input">
            <input type='password' name="password" id="password" autocomplete="no" required placeholder = " "/>
            <p>Password</p>
        </div>
    </div>

    <button class="big_action" id="submitButton" onclick="submitData();hapticFeedback();">Log In</button>

    <div class="loading-anim" id="loading-anim"><svg id="loading1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z"/></svg><svg id="loading2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z"/></svg></div>

    <table width="100%">
        <tr>
            <td><a href="../forgot">Forgot my password</a></td>
            <td style="text-align: right;"><a href="../signup">Create an account</a></td>
        </tr>
    </table>

</div>

<script>
function submitData() {
    var error = document.getElementById("error");
    if (!document.getElementById("mail").value.length == 0 && !document.getElementById("password").value.length == 0) {
        document.getElementById("submitButton").style.color = "var(--color1)";
        document.getElementById("loading-anim").style.display = "block";
        document.getElementById("submitButton").setAttribute("onclick" , "");
        error.innerHTML = "";
        $.post("login.php",
        {
            mail: document.getElementById("mail").value,
            password: document.getElementById("password").value
        },
        function(data, status){
            //(data);
            document.getElementById("submitButton").style.color = "#000";
            document.getElementById("loading-anim").style.display = "none";
            document.getElementById("submitButton").setAttribute("onclick" , "submitData()");
            if (status != "success")
                error.innerHTML = "An error occured!";
            else if (data.includes("error"))
                error.innerHTML = "Incorrect mail or password!";
            else
                location.assign("/");
        });
    } else
        error.innerHTML = "Please fill in the form!";
}
</script>
    
</body>

<script src="../script.js"></script>


</html>