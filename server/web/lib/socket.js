function wwLiveSocket() {
    this.socket = null;
    this.server = null;
    this.socketId = "";
    this.userId = null;

    this.customSocket = function(socketId) {
        this.socketId = socketId;
        this.initiate();
    }
    this.setUserId = function(userId) {
        this.userId = userId;
    }
    this.initiate = function() {
        console.log("API: " + "https://ww.alexsofonea.com/connect/" + wwProject.publicKeyId + "/wwLiveSocket/request/" + this.socketId)
        fetch("https://ww.alexsofonea.com/connect/" + wwProject.publicKeyId + "/wwLiveSocket/request/" + this.socketId, {
            method: "POST",
            body: JSON.stringify({}),
            headers: {
            "Content-type": "application/json; charset=UTF-8"
            }
        })
        .then(response => response.json())
        .then((json) => {
            this.server = "socket." + json['server'] + ".ww.alexsofonea.com";
            this.socketId = json['id'];
            this.userId = this.userId == null ? json['userId'] : this.userId;
            this.connect();
        })
        .catch(error => console.error('Error:', error));
    };

    this.message = function(data) {
        console.log("Error: Not connected to socket.");
    };

    this.connect = function() {
        this.socket = new WebSocket("wss://" + this.server);
        console.log("Connected to: wss://" + this.server);
        console.log("SocketId: " + this.socketId);
        console.log("Temp UserId: " + this.userId);

        var sockerId = this.socketId;
        var userId = this.userId;

        this.socket.onopen = function() {
            this.send(JSON.stringify({"channelId": sockerId, "userId": userId}));
        };
        this.socket.onmessage = function(event) {
            processData(event.data);
        };
        this.message = function(data) {
            this.socket.send(JSON.stringify({"message": data, "userPublicId": this.userId}));
        };
    };
    this.getServer = function() {
        fetch("https://ww.alexsofonea.com/connect/" + wwProject.publicKeyId + "/wwLiveSocket/request/" + this.socketId, {
            method: "POST",
            body: JSON.stringify({}),
            headers: {
            "Content-type": "application/json; charset=UTF-8"
            }
        })
        .then(response => response.json())
        .then((json) => {
            this.server = "socket." + json['server'] + ".ww.alexsofonea.com";
            this.socketId = json['id'];
            this.userId = this.userId == null ? json['userId'] : this.userId;
            return this.server;
        })
        .catch(error => console.error('Error:', error));
    }
}
