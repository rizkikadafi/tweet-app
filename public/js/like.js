// script for handle like
$(document).ready(function() {
  $(document).on('click', '.like-btn', function() {
    const postId = $(this).data('post-id');
    const userId = $(this).data('user-id');

    const countElm = $(`.like-count[data-post-id="${postId}"]`)
    const count = parseInt(countElm.text());

    countElm.html(count + 1);
    $(this).removeClass('bi-heart').removeClass('text-white').removeClass('like-btn');
    $(this).addClass('bi-heart-fill').addClass('text-danger').addClass('unlike-btn');

    $.ajax({
      url: `http://localhost/uas-project/public/post/like`,
      method: 'POST',
      data: { userId: userId, postId: postId },
      dataType: 'json',
      success: function(response) {
        console.log(response);
      },
      error: function(error) {
        console.error(error);
      }
    });
  });

  $(document).on('click', '.unlike-btn', function() {
    const postId = $(this).data('post-id');

    const countElm = $(`.like-count[data-post-id="${postId}"]`)
    const count = parseInt(countElm.text());

    countElm.html(count - 1);
    $(this).removeClass('bi-heart-fill').removeClass('text-danger').removeClass('unlike-btn');
    $(this).addClass('bi-heart').addClass('text-white').addClass('like-btn');
    $.ajax({
      url: `http://localhost/uas-project/public/post/unlike`,
      method: 'POST',
      data: { postId: postId },
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
//
