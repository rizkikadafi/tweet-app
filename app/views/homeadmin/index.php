<main>
  <div class="container">
    <br>
    <h1>Welcome Back Admin <i class="fa-regular fa-hand"></i></h1>
    <?php foreach ($data['user'] as $user) : ?>
      <div class="row justify-content-center">
        <div class="col-auto mt-3 mb-3">
            <div class="card btn btn-sm btn-secondary text-start" onclick="window.location='<?= BASEURL; ?>/editdata/<?= $user['user_id']; ?>';" style="width: 30rem;">
                <div class="card-body row">
                    <div class="col-auto">
                      <img class="rounded-circle" src="<?= $user['picture'] ?? BASEURL . '/img/profile.jpeg'; ?>" alt="" width="50">
                    </div>

                    <div class="col">
                      <h5 class="card-title"><?= $user['email']; ?></h5>
                      <h6 class="card-subtitle mb-2 text-body-secondary">@<?= $user['username']; ?></h6>
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
