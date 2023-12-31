<main>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-7 dark-secondary p-3 rounded">
        <form method="post" action="<?= BASEURL; ?>/post/new">
          <input type="hidden" name="user_id" value="<?= $data['cur_user']['user_id']; ?>">
          <div class="mb-3">
            <input type="text" name="title" class="form-control form-control-lg" id="title" value="<?= $data['post']["title"]; ?>" placeholder="Enter Title...">
          </div>
          <div class="mb-3">
            <textarea name="content" class="form-control" placeholder="Write your post here..." id="content" style="height: 200px"><?= $data['post']['content']; ?></textarea>
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
