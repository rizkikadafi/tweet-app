<main>
  <div class="container">
    <?php foreach ($data['post'] as $post) : ?>
      <div class="row justify-content-center">
        <div class="col-7 p-3">
          <div class="card">
            <div class="card-body" onclick="window.location='<?= BASEURL; ?>/post/<?= $post['post_id']; ?>';" style="cursor:pointer;">
              <div class="user-info mb-3">
                <img class="rounded-circle me-1" src="<?= $post['user']['picture'] ?? BASEURL . '/img/profile.jpeg'; ?>" alt="" width="20" height="20">
                <a href="<?= BASEURL; ?>/profile/<?= $post['user']['username']; ?>" class="link-underline link-underline-opacity-0">
                  <span class="text-secondary">@<?= $post['user']['username']; ?></span>
                </a>
                <i class="bi bi-dot text-secondary"></i>
                <span class="text-secondary"><?= $post['interval_time']; ?></span>
              </div>
              <h5 class="card-title fw-bold"><?= $post['title']; ?></h5>
              <p class="card-text"><?= $post['content']; ?></p>
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
