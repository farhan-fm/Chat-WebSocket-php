$(document).ready(function () {

    var conn = new WebSocket("ws://localhost:8080");

    var chatForm = $(".chatForm"),
        messageInputField = chatForm.find("#message"),
        messageList = $(".messages-list");


    // $('.chatForm.btn').onclick(function (e) {
    //     console.log("Connection established!");
    // })

    chatForm.on("submit", function (e) {
        e.preventDefault();
        var message = messageInputField.val();
        conn.send(message);
        messageList.prepend('<li>' + message + '</li>');
    });

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
});
