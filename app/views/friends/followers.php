<main>
  <div class="container">
    <div class="py-5 row justify-content-center">
      <div class="col-7">
        <div class="card">
          <div class="card-body">
            <div class="user p-2 mb-3">
              <div class="row align-items-center">
                <div class="col-1">
                  <img class="rounded-circle" width="40" height="40" src="<?= $data['user']['picture'] ?? BASEURL . '/img/profile.jpeg'; ?>" alt="">
                </div>
                <div class="col">
                  <span class="d-block text-white fw-bold"><?= $data['user']['fullname'] ?? $data['user']['username']; ?></span>
                  <a href="<?= BASEURL; ?>/profile/<?= $data['user']['username']; ?>" class="link-underline link-underline-opacity-0 text-secondary">@<?= $data['user']['username']; ?></a>
                </div>
              </div>
            </div>
            <nav class="mb-3 nav nav-pills flex-column flex-sm-row border border-secondary rounded p-2">
              <a class="flex-sm-fill text-sm-center nav-link" aria-current="page" href="<?= BASEURL; ?>/friends/<?= $data['user']['username']; ?>/mutual">Mutual</a>
              <a class="flex-sm-fill text-sm-center nav-link active" href="<?= BASEURL; ?>/friends/<?= $data['user']['username']; ?>/followers">Followers</a>
              <a class="flex-sm-fill text-sm-center nav-link" href="<?= BASEURL; ?>/friends/<?= $data['user']['username']; ?>/following">Following</a>
            </nav>
            <ul class="list-group list-group-flush">
              <?php foreach ($data['friendship_info']['followers'] as $user) : ?>
                <li class="list-group-item">
                  <div class="user">
                    <div class="row align-items-center">
                      <div class="col-1">
                        <img class="rounded-circle" width="40" height="40" src="<?= $user['picture'] ?? BASEURL . '/img/profile.jpeg'; ?>" alt="">
                      </div>
                      <div class="col">
                        <span class="d-block text-white fw-bold"><?= $user['fullname'] ?? $user['username']; ?></span>
                        <a href="<?= BASEURL; ?>/profile/<?= $user['username']; ?>" class="link-underline link-underline-opacity-0 text-secondary">@<?= $user['username']; ?></a>
                      </div>
                    </div>
                  </div>
                </li>
              <?php endforeach ?>
            </ul>
          </div>
        </div>
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
