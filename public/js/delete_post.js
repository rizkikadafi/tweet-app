$(document).on('click', '.delete-post', function() {
  const postId = $(this).data('post-id');
  console.log(postId);
  $('#confirm-delete').attr('href', 'http://localhost/uas-project/public/post/delete/' + postId);
});
