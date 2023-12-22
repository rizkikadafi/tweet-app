<nav class="navbar sticky-top navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <img class="me-2" src="<?= BASEURL; ?>/img/tweet-logo.png" width="50" alt="tweet logo">
    <a class="navbar-brand" href="<?= BASEURL; ?>/home">TweetApp</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= BASEURL; ?>/home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= BASEURL; ?>/friends/<?= $data['user']['username']; ?>/mutual">Friends</a>
        </li>
      </ul>
      <ul class="navbar-nav w-100 justify-content-center">
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="<?= $data['user']['picture'] ?? BASEURL . '/img/profile.jpeg'; ?>" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong><?= $data['user']['fullname'] ?? $data['user']['username']; ?></strong>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?= BASEURL; ?>/profile">Profile</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="<?= BASEURL; ?>/logout">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<main>
  <div class="container">
    <div class="row mt-3 justify-content-center">
      <div class="col-7">
        <a href="<?= BASEURL; ?>/post" type="button" class="btn btn-primary">New Post</a>
      </div>
    </div>
    <?php foreach ($data['posts'] as $post) : ?>
      <div class="row justify-content-center">
        <div class="col-7 p-3">
          <div class="card">
            <div class="card-body">
              <div class="user-info mb-3">
                <img class="rounded-circle me-1" src="<?= $post['user']['picture'] ?? BASEURL . '/img/profile.jpeg'; ?>" alt="" width="20" height="20">
                <a href="<?= BASEURL; ?>/profile/<?= $post['user']['username']; ?>" class="link-underline link-underline-opacity-0">
                  <span class="text-secondary">@<?= $post['user']['username']; ?></span>
                </a>
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
