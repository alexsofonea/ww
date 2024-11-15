<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple HTML Page</title>
</head>

<script src="https://ww.alexsofonea.com/lib/d59934dc073cec6bf1a107a61cf0487593c943721312123cfdf4713aeda8a736/socket"></script>

<script>
const mySocket = new wwLiveSocket();
mySocket.initiate(<?php isset($_GET['id']) ? "'" . $_GET['id'] . "'" : "" ?>);

function processData(data) {
    document.getElementById("message").innerHTML += data + "<br>";
}
</script>

<body>
    <input type="text" id="messageInput">
    <button onclick="mySocket.message(document.getElementById('messageInput').value)">Send Message</button>
    <p id="message"></p>
</body>
</html>