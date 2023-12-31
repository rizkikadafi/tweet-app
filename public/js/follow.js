// script for handle follow and unfollow button
$(document).ready(function() {
  $(document).on('click', '#follow-btn', function() {
    const userId = $(this).data('user-id');
    const friendId = $(this).data('friend-id');

    const followersCount = parseInt($('#followers-target-count').text(), 10);
    // console.log(val);
    $("#follow-btn").html('Following');
    $("#follow-btn").removeClass('btn-outline-primary');
    $("#follow-btn").addClass('btn-outline-secondary');
    $("#follow-btn").prop('id', 'unfollow-btn');
    $('#followers-target-count').html(followersCount + 1);
    $.ajax({
      url: 'http://localhost/uas-project/public/friends/follow',
      method: 'POST',
      data: { userId: userId, friendId: friendId },
      dataType: 'json',
      success: function(response) {
        console.log(response);
      },
      error: function(error) {
        console.error(error);
      }
    });
  });

  $(document).on('click', '#unfollow-btn', function() {
    const userId = $(this).data('user-id');
    const friendId = $(this).data('friend-id');

    const followersCount = parseInt($('#followers-target-count').text(), 10);
    // console.log(val);
    $("#unfollow-btn").html('Follow');
    $("#unfollow-btn").removeClass('btn-outline-secondary');
    $("#unfollow-btn").addClass('btn-outline-primary');
    $("#unfollow-btn").prop('id', 'follow-btn');
    $('#followers-target-count').html(followersCount - 1);
    $.ajax({
      url: 'http://localhost/uas-project/public/friends/unfollow',
      method: 'POST',
      data: { userId: userId, friendId: friendId },
      dataType: 'json',
      success: function(response) {
        console.log(response);
      },
      error: function(error) {
        console.error(error);
      }
    });
  });
});
