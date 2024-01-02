<main>
  <div class="container">
    <!-- <div class="row mt-3 justify-content-center"> -->
    <!--   <div class="col-7"> -->
    <!--     <h3 class="fw-bold">Thread</h3> -->
    <!--   </div> -->
    <!-- </div> -->

    <div class="row justify-content-center">
      <div class="col-7 p-3">
        <div class="card">
          <div class="card-header py-3">
            <div class="user-info">
              <img class="rounded-circle me-1" src="<?= $data['post']['user']['picture']; ?>" alt="" width="20" height="20">
              <a href="<?= BASEURL; ?>/profile/<?= $data['post']['user']['username']; ?>" class="link-underline link-underline-opacity-0">
                <span class="text-secondary">@<?= $data['post']['user']['username']; ?></span>
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

          <div class="card-footer">
            <div class="row align-items-center">
              <div class="col-2">
                <?php if ($data['post']['cur_user_liked']) { ?>
                  <i class="bi bi-heart-fill text-danger me-1 unlike-btn" data-user-id="<?= $data['cur_user']['user_id']; ?>" data-post-id="<?= $data['post']['post_id']; ?>"></i>
                <?php } else { ?>
                  <i class="bi bi-heart me-1 like-btn" data-user-id="<?= $data['cur_user']['user_id']; ?>" data-post-id="<?= $data['post']['post_id']; ?>"></i>
                <?php } ?>
                <span class="text-white like-count me-3" id="like-count" data-post-id="<?= $data['post']['post_id']; ?>"><?= $data['post']['like_count']; ?></span>

                <a href="<?= BASEURL; ?>/post/comment/<?= $data['post']['post_id']; ?>" class="text-white link-underline link-underline-opacity-0 me-1">
                  <i class="bi bi-chat-left-dots"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php if ($data['comments']) : ?>
      <div class="row justify-content-center">
        <div class="col-7">
          <h5 class="fw-bold">Comments</h5>
        </div>
      </div>

      <?php foreach ($data['comments'] as $comment) : ?>
        <div class="row justify-content-center post">
          <div class="col-7 p-3">
            <div class="card">
              <div class="card-header py-3">
                <div class="user-info">
                  <img class="rounded-circle me-1" src="<?= $comment['user']['picture']; ?>" alt="" width="20" height="20">
                  <a href="<?= BASEURL; ?>/profile/<?= $comment['user']['username']; ?>" class="link-underline link-underline-opacity-0">
                    <span class="text-secondary">@<?= $comment['user']['username']; ?></span>
                  </a>

                  <?php if ($comment['status'] == 'edited') { ?>
                    <i class="bi bi-dot text-secondary"></i>
                    <span class="text-secondary">Edited</span>
                  <?php } ?>

                  <i class="bi bi-dot text-secondary"></i>
                  <span class="text-secondary"><?= $comment['interval_time']; ?></span>
                </div>
              </div>

              <div class="card-body" onclick="window.location='<?= BASEURL; ?>/post/<?= $comment['post_id']; ?>';" style="cursor:pointer;">
                <?php if ($comment['title']) : ?>
                  <h5 class="card-title fw-bold"><?= $comment['title']; ?></h5>
                <?php endif ?>
                <p class="card-text"><?= $comment['content']; ?></p>
              </div>

              <div class="card-footer">
                <div class="row align-items-center">
                  <div class="col-4">
                    <?php if ($comment['cur_user_liked']) { ?>
                      <i class="bi bi-heart-fill text-danger me-1 unlike-btn" data-user-id="<?= $data['cur_user']['user_id']; ?>" data-post-id="<?= $comment['post_id']; ?>"></i>
                    <?php } else { ?>
                      <i class="bi bi-heart me-1 like-btn" data-user-id="<?= $data['cur_user']['user_id']; ?>" data-post-id="<?= $comment['post_id']; ?>"></i>
                    <?php } ?>
                    <span class="text-white like-count me-4" id="like-count" data-post-id="<?= $comment['post_id']; ?>"><?= $comment['like_count']; ?></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach ?>
    <?php endif ?>
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
