function acti(){
var formData = new FormData($('#action_form')[0]);
$.ajax({
      type: "POST",
      processData: false,
      contentType: false,
      url: "job.php",
      data: formData,

      })
      .done(function(data) {
      $("#error").html(data);
      }); 
  }
