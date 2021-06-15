$(document).ready(function () {
    $("#sendmsg").click(function () {
        var clientmsg = $("#usermsg").val();
        console.log(clientmsg);
        if (clientmsg){
            if(clientmsg.charAt(0) == "$"){
                $.post("post_commands.php", { command: clientmsg, });
                $("#usermsg").val("");
                return false;
            }
            $.post("post.php", { text: clientmsg });
            $("#usermsg").val("");
            return false;
        }
    });

    function loadLog() {
        var oldscrollHeight = $("#chatbox")[0].scrollHeight - 20;

        $.ajax({
            url: "log.html",
            cache: false,
            success: function (html) {
                $("#chatbox").html(html); 

                //Auto-scroll           
                var newscrollHeight = $("#chatbox")[0].scrollHeight - 20;
                if(newscrollHeight > oldscrollHeight){
                    $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal');
                }   
            }
        });
    }

    function deleteOldestLogMsg(){
        $.post("delete.php", {delete: true});
    };

    setInterval(loadLog, 1000);
    setInterval(deleteOldestLogMsg, 30000);

    $("#exit").click(function () {
        var exit = confirm("Logout?");
        if (exit == true) {
            window.location = "index.php?logout=true";
        }
    });
});