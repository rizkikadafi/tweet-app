<div class="container text-center">
  <div class="row min-vh-100 align-items-center">
    <div class="col style=" border: 1px solid white">

      <div class="row mb-3">
        <div class="col">
          <img class="mb-3" src="<?= BASEURL; ?>/img/tweet-logo.png" alt="app logo" width="120">
          <h4>TweeetApp Admin</h4>
        </div>
      </div>

      <div class="row mb-3">
        <div class="text-start col-5 mx-auto px-0">
          <?php Flasher::flash() ?>
        </div>
      </div>


      <div class="row mb-3">
        <div class="col-5 mx-auto px-0">
          <form method="post" action="<?= BASEURL ?>/admin/login">
            <div class="mb-3 mx-0">
              <label for="username" class="form-label d-block text-start">Username</label>
              <input type="username" name="username" class="form-control" id="username" placeholder="Enter admin username" required>
            </div>
            <div class="mb-3 mx-0">
              <label for="password" class="form-label d-block text-start">Password</label>
              <input type="password" name="password" class="form-control" id="password" placeholder="Enter admin Password" required>
            </div>
            <div class="captcha">
              <label for="captcha" class="form-label d-block text-start">Captcha</label>
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><?= $data['captcha'][0] ?> + <?= $data['captcha'][1] ?></span>
                <input type="hidden" name="val1" value="<?= $data['captcha'][0] ?>">
                <input type="hidden" name="val2" value="<?= $data['captcha'][1] ?>">
                <input type="text" name="captcha" id="captcha" class="form-control" placeholder="Enter the result">
              </div>
            </div>
            <div class="d-grid mx-auto gap-2">
              <button type="submit" name="submit" class="btn btn-primary rounded-1 fw-medium">Login</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
