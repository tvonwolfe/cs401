$("#comment_form").submit(function(event) {
  event.preventDefault();
  $.ajax({
    method: "POST",
    data: $(this).serialize(),
    url: "comment_handler.php"
  });
});
