// script for handle search action
$(document).ready(function() {
  $("#search-user").keyup(function() {
    const keyword = $(this).val();
    $('#search-results').html(`
        <li class="list-group-item placeholder-glow">
          <div class="user">
            <div class="row align-items-center">
              <div class="col-1 me-3">
                <img class="rounded-circle placeholder" width="40" height="40">
              </div>
              <div class="col">
                <span class="d-block mb-2 placeholder"></span>
                <div class="row">
                  <div class="col-4">
                    <a href="" class="text-white d-block placeholder"></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </li>
    `);
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
