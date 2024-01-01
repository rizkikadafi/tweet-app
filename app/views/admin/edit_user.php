<main>
  <div class="container">
    <div class="row mt-5 justify-content-center">
      <div class="col-auto">

        <div class="card text-bg-dark mb-3" style="width: 22rem;">
          <div class="card-header">
            <div class="row d-flex align-items-center">

              <div class="col">
                Edit Data
              </div>

              <div class="col-auto">

                <form action="<?= BASEURL; ?>/admin/deleteUser" method="post">
                  <input type="hidden" name="id_user" value="<?= $data['user_current']['user_id']; ?>">
                  <button type="submit" name="del_btn" class="btn btn-outline-danger"><i class="fa-regular fa-trash-can"></i></button>
                </form>

              </div>

            </div>

          </div>

          <div class="card-body">
            <!-- <h5 class="card-title">User Details</h5> -->
            <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
            <form method="post" action="<?= BASEURL; ?>/admin/updateUser">
              <input type="hidden" name="user_id" value="<?= $data['user_current']['user_id']; ?>">
              <div class="mb-3">
                <label for="InputUsername" class="form-label">Username</label>
                <input type="text" class="form-control" id="InputUsername" aria-describedby="usernameHelp" value="<?= $data['user_current']['username']; ?>" disabled>
              </div>

              <div class="mb-3">
                <label for="InputFullname" class="form-label">Fullname</label>
                <input type="text" class="form-control" id="InputFullname" aria-describedby="fullnameHelp" value="<?= $data['user_current']['fullname']; ?>" disabled>
              </div>

              <div class="mb-3">
                <label for="InputEmail1" class="form-label">Email address</label>
                <input type="email" name="inpEmail" class="form-control" id="InputEmail1" aria-describedby="emailHelp" value="<?= $data['user_current']['email']; ?>">
              </div>

              <div class="mb-3">
                <label for="InputPassword1" class="form-label">Password</label>
                <input type="password" name="inpPassword" class="form-control" id="InputPassword1" value="<?= $data['user_current']['password']; ?>">
              </div>
          </div>

          <div class="card-footer d-flex justify-content-between">
            <button type="button" class="btn btn-secondary" onclick="window.location='<?= BASEURL; ?>/homeadmin';">Back</button>
            <button type="submit" name="edit_user" class="btn btn-primary">Save changes</button>
            </form>
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
