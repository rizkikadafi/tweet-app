<main>
  <div class="container">
    <div class="row mt-3 justify-content-center">
      <div class="col-7">
        <h3 class="fw-bold">Your Post</h5>
      </div>
    </div>
    <?php foreach ($data['post'] as $post) : ?>
      <div class="row justify-content-center">
        <div class="col-7 p-3">
          <div class="card">
            <div class="card-header py-3">
              <div class="user-info">
                <img class="rounded-circle me-1" src="<?= $post['user']['picture'] ?? BASEURL . '/img/profile.jpeg'; ?>" alt="" width="20" height="20">
                <a href="<?= BASEURL; ?>/profile/<?= $post['user']['username']; ?>" class="link-underline link-underline-opacity-0">
                  <span class="text-secondary">@<?= $post['user']['username']; ?></span>
                </a>
                <i class="bi bi-dot text-secondary"></i>
                <span class="text-secondary"><?= $post['interval_time']; ?></span>
              </div>
            </div>

            <div class="card-body" onclick="window.location='<?= BASEURL; ?>/post/<?= $post['post_id']; ?>';" style="cursor:pointer;">
              <h5 class="card-title fw-bold"><?= $post['title']; ?></h5>
              <p class="card-text"><?= $post['content']; ?></p>
            </div>

            <div class="card-footer">
              <div class="row align-items-center">
                <div class="col-2">
                  <?php if ($post['cur_user_liked']) { ?>
                    <i class="bi bi-heart-fill text-danger me-1 unlike-btn" data-user-id="<?= $data['cur_user']['user_id']; ?>" data-post-id="<?= $post['post_id']; ?>"></i>
                  <?php } else { ?>
                    <i class="bi bi-heart me-1 like-btn" data-user-id="<?= $data['cur_user']['user_id']; ?>" data-post-id="<?= $post['post_id']; ?>"></i>
                  <?php } ?>
                  <span class="text-white like-count" id="like-count" data-post-id="<?= $post['post_id']; ?>"><?= $post['like_count']; ?></span>
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
