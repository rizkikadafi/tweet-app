<?php
// $current_time = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
// var_dump($current_time->diff(new DateTime("2023-12-29 00:20:32", new DateTimeZone('Asia/Jakarta')))->m);
?>
<main>
  <div class="container">
    <div class="row mt-3 justify-content-center">
      <div class="col-7">
        <a href="<?= BASEURL; ?>/post/new" type="button" class="btn btn-primary">New Post</a>
      </div>
    </div>
    <?php foreach ($data['posts'] as $post) : ?>
      <div class="row justify-content-center post">
        <div class="col-7 p-3">
          <div class="card">
            <div class="card-header py-3">
              <div class="user-info">
                <img class="rounded-circle me-1" src="<?= $post['user']['picture']; ?>" alt="" width="20" height="20">
                <a href="<?= BASEURL; ?>/profile/<?= $post['user']['username']; ?>" class="link-underline link-underline-opacity-0">
                  <span class="text-secondary">@<?= $post['user']['username']; ?></span>
                </a>

                <?php if ($post['status'] == 'edited') { ?>
                  <i class="bi bi-dot text-secondary"></i>
                  <span class="text-secondary">Edited</span>
                <?php } ?>

                <i class="bi bi-dot text-secondary"></i>
                <span class="text-secondary"><?= $post['interval_time']; ?></span>
              </div>
            </div>

            <div class="card-body" onclick="window.location='<?= BASEURL; ?>/post/<?= $post['post_id']; ?>';" style="cursor:pointer;">
              <?php if ($post['title']) : ?>
                <h5 class="card-title fw-bold"><?= $post['title']; ?></h5>
              <?php endif ?>
              <p class="card-text"><?= $post['content']; ?></p>
            </div>

            <div class="card-footer">
              <div class="row align-items-center">
                <div class="col-4">
                  <?php if ($post['cur_user_liked']) { ?>
                    <i class="bi bi-heart-fill text-danger me-1 unlike-btn" data-user-id="<?= $data['cur_user']['user_id']; ?>" data-post-id="<?= $post['post_id']; ?>"></i>
                  <?php } else { ?>
                    <i class="bi bi-heart me-1 like-btn" data-user-id="<?= $data['cur_user']['user_id']; ?>" data-post-id="<?= $post['post_id']; ?>"></i>
                  <?php } ?>
                  <span class="text-white like-count me-4" id="like-count" data-post-id="<?= $post['post_id']; ?>"><?= $post['like_count']; ?></span>
                  <a href="<?= BASEURL; ?>/post/comment/<?= $post['post_id']; ?>" class="text-white link-underline link-underline-opacity-0 me-1">
                    <i class="bi bi-chat-left-dots"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach ?>
  </div>
</main>

<!-- Modal -->
<div class="modal fade" id="searchUserModal" tabindex="-1" aria-labelledby="searchUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <input class="form-control" id="search-user" placeholder="Type to search user...">
      </div>
      <div class="modal-body">
        <ul class="list-group list-group-flush" id="search-results">

        </ul>
      </div>
    </div>
  </div>
</div>
