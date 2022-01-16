<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>WebSocket Chat Application</title>
    <link rel="stylesheet" href="css/bootstrap.css" media="screen" title="no title" charset="UTF-8">

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-push-2 col-md-8">
            <h2>php Chat Application</h2>
            <h3>Messages</h3>
            <ul class="messages-list">

            </ul>
            <from class="chatForm" action="index.html" method="post">
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea type="button" id="message" name="message" class="form-control" value="">

                    </textarea>
                </div>

                <button onclick="send()" type="submit" name="button" class="btn btn-primary pull-right">Send</button>

                <br/>
                <br/>
                <br/>
                <button onclick="privateChat()" type="button" name="button" class="btn btn-primary pull-right">Private Chat</button>

            </from>
        </div>
    </div>

</div>

</body>

<script src="js/jquery.js"></script>
<script src="js/jquery.cookie.js"></script>
<!--<script src="js/main.js"></script>-->

<script>
    var conn = new WebSocket("ws://localhost:8080");
    conn.onopen = function (e) {
        console.log("Connection established!");

        //conn.send("message test from a browser clinet");
        // $.ajax({
        //     url: 'http://localhost:8012/chat/load_history.php',
        //     dataType: 'json',
        //     success: function (data) {
        //         $.each(data, function () {
        //             messageList.prepend('<li>' + this.text + '</li>')
        //         })
        //     }
        // })


    };
    conn.onmessage = function (e) {
        console.log(e.data);
        messageList.prepend('<li>' + e.data + '</li>')
    };

    var chatForm = $(".chatForm"),
        messageInputField = chatForm.find("#message"),
        messageList = $(".messages-list");

    function send() {
        var message = messageInputField.val();
        conn.send(message);
        messageList.prepend('<li>' + message + '</li>');
    }

    function privateChat() {
        window.open("http://localhost:8012/chat/login.php", "_blank");
    }

</script>

</html>

