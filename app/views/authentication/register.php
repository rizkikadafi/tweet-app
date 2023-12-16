<div class="container text-center">
  <div class="row min-vh-100 align-items-center">
    <div class="col style="border: 1px solid white">

      <div class="row mb-5">
        <div class="col">
          <img class="mb-3" src="<?= BASEURL; ?>/img/tweet-logo.png" alt="app logo" width="120">
          <h4>Welcome to TweetApp</h4>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col px-0">
          <div class="d-grid col-5 mx-auto gap-2">
            <button type="button" class="btn btn-secondary rounded-1 fw-medium"><i class="bi bi-google"></i> Continue with Google</button>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-5 mx-auto px-0">
          <form method="post" action="<?= BASEURL ?>/authentication/register">
            <div class="mb-3 mx-0">
              <label for="exampleFormControlInput1" class="form-label d-block text-start">Email address</label>
              <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>
            <div class="d-grid mx-auto gap-2">
              <button type="submit" name="submit" class="btn btn-primary rounded-1 fw-medium">Continue with Email</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>