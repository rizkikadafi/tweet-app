// script for handle search action
$(document).ready(function() {
  $("#search-user").keyup(function() {
    const keyword = $(this).val();
    $.ajax({
      url: 'http://localhost/uas-project/public/profile/search',
      method: 'POST',
      data: { keyword: keyword },
      dataType: 'html',
      success: function(response) {
        console.log(response);
        $("#search-results").html(response);
      },
      error: function(error) {
        console.error(error);
      }
    });
  });
});
