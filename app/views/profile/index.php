<?php
// var_dump($_FILES);
?>
<main>
  <div class="container my-5">
    <div class="row justify-content-start">
      <div class="col-auto">
        <img src="<?= $data['user']['picture'] ?? BASEURL . '/img/profile.jpeg'; ?>" alt="" width="200" height="200" class="rounded-circle me-2">
      </div>
      <div class="col align-self-center">
        <h2><?= $data['user']['fullname'] ?? $data['user']['username']; ?></h2>
        <a href="<?= BASEURL; ?>/profile/<?= $data['user']['username']; ?>" class="text-secondary link-underline link-underline-opacity-0"><?= '@' . $data['user']['username']; ?></a>
        <i class="bi bi-dot text-secondary"></i>
        <span class="text-secondary"><i class="bi bi-geo-alt-fill"></i> Joined <?= date("M Y", strtotime($data['user']['created_at'])); ?></span>
        <div class="mt-1 friendship-info">
          <a href="<?= BASEURL; ?>/friends/<?= $data['user']['username']; ?>/followers" class="link-underline link-underline-opacity-0">
            <span id="followers-target-count" class="text-white fw-bold"><?= $data['friendship_info']['followers_count']; ?></span>
            <span class="text-secondary">Followers</span>
          </a>

          <i class="bi bi-dot text-secondary"></i>

          <a href="<?= BASEURL; ?>/friends/<?= $data['user']['username']; ?>/following" class="link-underline link-underline-opacity-0">
            <span class="text-white fw-bold"><?= $data['friendship_info']['following_count']; ?></span>
            <span class="text-secondary">Following</span>
          </a>
        </div>
      </div>
      <div class="col-auto align-self-center">
        <div class="row">
          <div class="col-4">
            <?php if ($data['email'] === $_SESSION['email']) { ?>
              <button class="btn btn-outline-primary px-5" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</button>
            <?php } else { ?>
              <?php if ($data['status'] === 'FOLLOWING') { ?>
                <button class="btn btn-outline-secondary px-5" id="unfollow-btn" data-user-id="<?= $data['cur_user']['user_id']; ?>" data-friend-id="<?= $data['user']['user_id']; ?>" data-status="<?= $data['status']; ?>">Following</button>
              <?php } else { ?>
                <button class="btn btn-outline-primary px-5" id="follow-btn" data-user-id="<?= $data['cur_user']['user_id']; ?>" data-friend-id="<?= $data['user']['user_id']; ?>" data-status="<?= $data['status']; ?>">Follow</button>
              <?php } ?>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-5">
        <p><?= $data['user']['description']; ?></p>
      </div>
    </div>
  </div>
</main>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="upload-alert"></div>
        <form action="<?= BASEURL ?>/profile/edit" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?= $data['user']['user_id'] ?>">
          <div class="row justify-content-center">
            <div class="col-5" id="user-profile">
              <input type="file" name="profile-img" class="form-control" id="imageInput" aria-describedby="inputGroupFileAddon04" aria-label="Upload" hidden>

              <div class="content">
                <div id="image-link">
                  <img src="<?= $data['cur_user']['picture'] ?? BASEURL . '/img/profile.jpeg'; ?>" alt="" width="150" height="150" class="rounded-circle border border-secondary">
                  <div class="content-details">
                    <h5 class="content-title">Upload Photo</h5>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <div class="mb-3">
            <label for="fullname" class="form-label">Name</label>
            <input type="text" name="fullname" class="form-control" id="fullname" value="<?= $data['user']['fullname'] ?? $data['user']['username']; ?>">
          </div>
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="username" value="<?= $data['user']['username']; ?>">
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="description" rows="3"><?= $data['user']['description']; ?></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

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
