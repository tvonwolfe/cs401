$(function() {
  $("#comment_form").submit(function(event) {
    event.preventDefault();
    var values = $("#comment_form").serialize();
    var comment = $("#comment").val();
    $.ajax({
      type: "POST",
      url: "comment_handler.php",
      data: values,
      success: function() {
        var htmlToPrepend =
          "<hr>" +
          '<p class="timestamp">/ Just now /</p>' +
          '<div class="usr_cmmnt"> <a href="user.php?user="' +
          $(".login").text() +
          '" class="usrnm">' +
          $(".login").text() +
          "</a>";
        $("textarea").val("");
        if (comment.includes("\n")) {
          var paragraphs = comment.split("\n");
          for (var p in paragraphs) {
            htmlToPrepend += "<p>" + p + "</p>";
          }
        } else {
          htmlToPrepend += "<p>" + comment + "</p>";
        }

        htmlToPrepend += "</div>";
        $(".user_comments").prepend(htmlToPrepend);
        $(".no_content").hide();
      }
    });
  });
});
