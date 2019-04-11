$(function () {
    $(".user_comments").submit(function() {
        var values = $("form").serialize();
        var comment = $("#comment").val();
        $.ajax({
            type: "POST",
            url: "comment_handler.php",
            data: values,
            success: function() {
                var timestamp = new Date();
                var month = timestamp.getMonth() + 1;
                var day = timestamp.getDay();
                var year = timestamp.getFullYear();
                var hours = timestamp.getHours();
                var min = timestamp.getMinutes();
                var timestamp_str = "/ " + month + "/" + day + "/" + year + " " + hours + ":" + min + " /";
                var htmlToPrepend = "<hr>" + '<p class="timestamp">' + timestamp_str + "</p>"
                + '<div class="usr_cmmnt"> + <a href="user.php?user="' + $("a.login").text() + '" class="usrnm"' + $("a.login").text() + "</a>";

                var paragraphs = comment.split("\n");
                for(var p in paragraphs) {

                }
                $("user_comments").prepend();


            }
        });
    });
}
