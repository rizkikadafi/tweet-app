<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <img class="me-2" src="<?= BASEURL; ?>/img/tweet-logo.png" width="50" alt="tweet logo">
    <a class="navbar-brand" href="<?= BASEURL; ?>/home">TweetApp</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?= BASEURL; ?>/home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">Friends</a>
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
              <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
              <strong><?= $data['user']['fullname'] ?? $data['user']['username']; ?></strong>
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Profile</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="<?= BASEURL; ?>/logout">Logout</a></li>
            </ul>
          </li>
      </ul>
    </div>
  </div>
</nav>

<main>
  <div class="container my-5">
    <div class="row justify-content-start">
      <div class="col-2">
        <img src="https://github.com/mdo.png" alt="" width="200" height="200" class="rounded-circle me-2">
      </div>
      <div class="ps-5 col align-self-center">
        <h2><?= $data['user']['fullname'] ??$data['user']['username']; ?></h2>
        <a href="#" class="text-secondary link-underline link-underline-opacity-0"><?= '@' . $data['user']['username']; ?></a>
        <i class="bi bi-dot text-secondary"></i>
        <span class="text-secondary"><i class="bi bi-geo-alt-fill"></i> Joined Dec 2023</span>
      </div>
      <div class="col align-self-center">
        <div class="row justify-content-end">
          <div class="col-4">
            <a href="" class="btn btn-outline-primary px-5" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</a>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-5">
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eaque, assumenda!</p>
      </div>
    </div>
  </div>
</main>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="">
          <div class="mb-3">
            <label for="fullname" class="form-label">Name</label>
            <input type="email" name="name" class="form-control" id="fullname">
          </div>
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="username">
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" rows="3"></textarea>
          </div>
          <a type="submit" class="btn btn-primary">Submit</a>
        </form>
      </div>
    </div>
  </div>
</div>
