// script for handle follow and unfollow button
$(document).ready(function() {
  $(document).on('click', '#follow-btn', function() {
    const userId = $(this).data('user-id');
    const friendId = $(this).data('friend-id');

    $.ajax({
      url: 'http://localhost/uas-project/public/friends/follow',
      method: 'POST',
      data: { userId: userId, friendId: friendId },
      dataType: 'json',
      success: function(response) {
        console.log(response);
        $('#followers-target-count').html(response['followers_target_count']);
        $("#follow-btn").html('Following');
        $("#follow-btn").removeClass('btn-outline-primary');
        $("#follow-btn").addClass('btn-outline-secondary');
        $("#follow-btn").prop('id', 'unfollow-btn');
      },
      error: function(error) {
        console.error(error);
      }
    });
  });

  $(document).on('click', '#unfollow-btn', function() {
    const userId = $(this).data('user-id');
    const friendId = $(this).data('friend-id');

    $.ajax({
      url: 'http://localhost/uas-project/public/friends/unfollow',
      method: 'POST',
      data: { userId: userId, friendId: friendId },
      dataType: 'json',
      success: function(response) {
        console.log(response);
        $('#followers-target-count').html(response['followers_target_count']);
        $("#unfollow-btn").html('Follow');
        $("#unfollow-btn").removeClass('btn-outline-secondary');
        $("#unfollow-btn").addClass('btn-outline-primary');
        $("#unfollow-btn").prop('id', 'follow-btn');
      },
      error: function(error) {
        console.error(error);
      }
    });
  });
});
