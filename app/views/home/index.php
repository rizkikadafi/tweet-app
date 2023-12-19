<h1 class="text-center">Halaman Home</h1>

<?php if (isset($data['user'])) : ?>
  <img src='<?= $data['user']['picture']; ?>' class="rounded-circle border border-secondary p-1 mx-auto d-block">
  <h2 class="text-center"><?= $data['user']['name']; ?></h2>
<?php endif; ?>

<?php if (isset($_SESSION['username'])) : ?>
  <img src='<?= BASEURL ?>/img/tweet-logo.png' class="rounded-circle border border-secondary p-1 mx-auto d-block">
  <h2 class="text-center"><?= $_SESSION['username']; ?></h2>
<?php endif; ?>


<a href="<?= BASEURL ?>/logout" type="button" class="btn btn-primary mx-auto">Logout</a>
