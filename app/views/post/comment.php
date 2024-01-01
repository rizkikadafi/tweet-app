<main>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-7 dark-secondary p-3 rounded">

        <div class="card">
          <div class="card-header py-3">
            <div class="user-info">
              <img class="rounded-circle me-1" src="<?= $data['user']['picture']; ?>" alt="" width="20" height="20">
              <span class="text-white fw-bold"><?= $data['user']['fullname']; ?></span>
              <i class="bi bi-dot text-secondary"></i>
              <a href="<?= BASEURL; ?>/profile/<?= $data['user']['username']; ?>" class="link-underline link-underline-opacity-0">
                <span class="text-secondary">@<?= $data['user']['username']; ?></span>
              </a>

              <?php if ($data['post']['status'] == 'edited') { ?>
                <i class="bi bi-dot text-secondary"></i>
                <span class="text-secondary">Edited</span>
              <?php } ?>

              <i class="bi bi-dot text-secondary"></i>
              <span class="text-secondary"><?= $data['post']['interval_time']; ?></span>
            </div>
          </div>

          <div class="card-body">
            <?php if ($data['post']['title']) : ?>
              <h5 class="card-title fw-bold"><?= $data['post']['title']; ?></h5>
            <?php endif ?>
            <p class="card-text"><?= $data['post']['content']; ?></p>
          </div>
        </div>

        <p class="card-text border-start border-2 m-0 py-3 ms-3 ps-3">Commenting to <span class="text-primary">@<?= $data['user']['username']; ?></span></p>

        <form method="post" action="<?= BASEURL; ?>/post/comment/<?= $data['post']['post_id']; ?>">
          <input type="hidden" name="user_id" value="<?= $data['cur_user']['user_id']; ?>">
          <input type="hidden" name="parent_id" value="<?= $data['post']['post_id']; ?>">
          <div class="mb-3">
            <input type="text" name="title" class="form-control form-control-lg" id="title" placeholder="Enter Title...">
          </div>
          <div class="mb-3">
            <textarea name="content" class="form-control" placeholder="Write your post here..." id="content" style="height: 200px"></textarea>
          </div>
          <button type="submit" name="post" class="btn btn-primary">Post</button>
        </form>
      </div>
    </div>
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
