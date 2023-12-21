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
          <a class="nav-link" href="<?= BASEURL; ?>/friends">Friends</a>
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

<div id="sidebar">
    <h2>Menu</h2>
    <ul>
        <li><a href="?action=friends">Friends</a></li>
        <li><a href="?action=following">Following</a></li>
        <li><a href="?action=followed">Followed</a></li>
    </ul>
</div>

<div id="main">
    <h2>Friend List</h2>
    <ul class="friend-list">
        <?php
            $action = isset($_GET['action']) ? $_GET['action'] : 'friends';
            switch ($action) {
                case 'friends':
                    $friends = $data['friends'];
                    break;
                case 'following':
                    $friends = $data['following'];
                    break;
                case 'followed':
                    $friends = $data['followed'];
                    break;
                }
            if ($friends) {
                foreach ($friends as $friend): ?>
                <li class="friend-item">
                    <a href="<?= BASEURL; ?>/profile/other/<?= $friend['email']; ?>">
                        <?= $friend['username']; ?>
                    </a>
                </li>
        <?php endforeach; }?>
    </ul>
</div>