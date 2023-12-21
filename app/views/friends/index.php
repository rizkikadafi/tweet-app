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
    <div class="py-5 row justify-content-center">
      <div class="col-7">
        <div class="card">
          <div class="card-body">
            <nav class="mb-3 nav nav-pills flex-column flex-sm-row">
              <a class="flex-sm-fill text-sm-center nav-link active" aria-current="page" href="<?= BASEURL; ?>/friends/<?= $data['user']['username']; ?>/mutual">Mutual</a>
              <a class="flex-sm-fill text-sm-center nav-link" href="<?= BASEURL; ?>/friends/<?= $data['user']['username']; ?>/followers">Followers</a>
              <a class="flex-sm-fill text-sm-center nav-link" href="<?= BASEURL; ?>/friends/<?= $data['user']['username']; ?>/following">Following</a>
            </nav>
            <ul class="list-group list-group-flush">
              <?php foreach($data['friendship_info']['mutual_friends'] as $user) : ?>
                <li class="list-group-item">
                  <div class="user">
                    <div class="row align-items-center">
                      <div class="col-1">
                        <img class="rounded-circle" width="40" height="40" src="<?= $user['picture'] ?? BASEURL . '/img/profile.jpeg'; ?>" alt="">
                      </div>
                      <div class="col">
                        <span class="d-block text-white fw-bold"><?= $user['fullname'] ?? $user['username']; ?></span>
                        <a href="" class="link-underline link-underline-opacity-0 text-secondary">@<?= $user['username']; ?></a>
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