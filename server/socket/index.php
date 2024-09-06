<html>
    <head>
        <style>
            input, button { padding: 10px; }
        </style>
    </head>
    <body>
        <input type="text" id="message" />
        <button onclick="transmitMessage()">Send</button>
        <div class="content"></div>
        <script>
            var socketId = "<?php echo $_GET['room'] ?? "default"; ?>";

            var socket  = new WebSocket('wss://socket.ww.alexsofonea.com/' + socketId);
            
            var message = document.getElementById('message');

            function transmitMessage() {
                socket.send(message.value);
            }

            socket.onmessage = function(e) {
                document.getElementsByClassName("content")[0].innerHTML += "<p>" + e.data + "</p>";
            }
            socket.onopen = function() {
                const data = {"channelId": socketId, "userId": "<?php echo $_GET['id'] ?? uniqid(); ?>"};
                socket.send(JSON.stringify(data));
            }
        </script>
    </body>
</html>
